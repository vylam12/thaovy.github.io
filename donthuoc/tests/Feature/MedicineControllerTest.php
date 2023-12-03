<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\DetailPrescription;
use App\Models\Drug;
use App\Http\Controllers\MedicineController;
use Illuminate\Http\RedirectResponse;
class MedicineControllerTest extends TestCase
{
    public function testValidDoseCheck()
    {
        // Tạo dữ liệu giả lập cho request
        $requestData = [
            'searchThuoc' => 'Amoxicillin - Viên',
            'quantity_of_medicine' => 2,
            'frequency' => 2,
            'note' => 'Sau khi an 30 phut',
        ];

        // Lấy id và prescriptionId giả lập
        $id = 1;
        $prescriptionId = 20;

        // Gửi request POST đến route dose với các dữ liệu giả lập
        $response = $this->post(route('dose.check', ['id' => $id, 'prescriptionId' => $prescriptionId]), $requestData);

        // Kiểm tra kết quả trả về
        $response->assertRedirect(route('diagnose.prescriptionId', ['id' => $id, 'prescriptionId' => $prescriptionId]))
            ->assertSessionHas('success', 'Thêm thuốc thành công');

        // Kiểm tra dữ liệu đã được lưu trong cơ sở dữ liệu
        $this->assertDatabaseHas('detail_prescription', [
            'id_drug' => 'D1', // ID của thuốc
            'quantity_Ofmedicine' => 2,
            'frequency' => 2,
            'id_prescription' => 20, // ID của đơn thuốc
            'name_unitDr' => 'Viên',
            'note' => 'Sau khi an 30 phut',
        ]);
    }

    public function testInvalidDoseCheck()
    {
        // Tạo dữ liệu giả lập cho request
        $requestData = [
            'searchThuoc' => 'Amoxicillin - Viên',
            'quantity_of_medicine' => 10,
            'frequency' => 2,
            'note' => 'Ghi chú',
        ];

        // Lấy id và prescriptionId giả lập
        $id = 1;
        $prescriptionId = 20;
        $name_drug= 'Amoxicillin';

        // Gửi request POST đến route dose với các dữ liệu giả lập
        $response = $this->post(route('dose.check', ['id' => $id, 'prescriptionId' => $prescriptionId]), $requestData);

        // Kiểm tra kết quả trả về
        $response->assertRedirect(route('dose', ['id' => $id, 'prescriptionId' => $prescriptionId]))
            ->assertSessionHas('success', 'Liều lượng quá cao so với liều lượng cho 1 lần uống của thuốc ' . $name_drug );

        // Kiểm tra dữ liệu không được lưu trong cơ sở dữ liệu
        $this->assertDatabaseMissing('detail_prescription', [
            'id_drug' => 'D1', // ID của thuốc
            'quantity_Ofmedicine' => 10,
            'frequency' => 2,
            'id_prescription' => 20, // ID của đơn thuốc
            'name_unitDr' => 'Viên',
            'note' => 'Sau khi an 30 phut',
        ]);
    }
    public function test_InvalidDoseCheck()
    {
        // Tạo dữ liệu giả lập cho request
        $requestData = [
            'searchThuoc' => 'Amoxicillin - Viên',
            'quantity_of_medicine' => 2,
            'frequency' => 5,
            'note' => 'Ghi chú',
        ];

        // Lấy id và prescriptionId giả lập
        $id = 1;
        $prescriptionId = 20;
        $name_drug= 'Amoxicillin';

        // Gửi request POST đến route dose với các dữ liệu giả lập
        $response = $this->post(route('dose.check', ['id' => $id, 'prescriptionId' => $prescriptionId]), $requestData);

        // Kiểm tra kết quả trả về
        $response->assertRedirect(route('dose', ['id' => $id, 'prescriptionId' => $prescriptionId]))
            ->assertSessionHas('success', 'Tần suất uống trong 1 ngày của thuốc ' . $name_drug. " qua cao" );

        // Kiểm tra dữ liệu không được lưu trong cơ sở dữ liệu
        $this->assertDatabaseMissing('detail_prescription', [
            'id_drug' => 'D1', // ID của thuốc
            'quantity_Ofmedicine' => 2,
            'frequency' => 5,
            'id_prescription' => 20, // ID của đơn thuốc
            'name_unitDr' => 'Viên',
            'note' => 'Sau khi an 30 phut',
        ]);
    }
}

