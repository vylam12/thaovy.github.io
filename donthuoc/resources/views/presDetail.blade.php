
<?php
    use App\Models\DetailPrescription;  
    use App\Models\Drug;  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">
    <title>CHI TIẾT ĐƠN THUỐC</title>
</head>
<body>
    <div class="nen">
        <img src="http://localhost/donthuoc/public/frontend/img/prescribe%20medicine.jpg" alt="Hình nền">
    </div>
    <div class="navigation">
        <ul>
            <li>
                <a href="{{ route('patients.index')}}">TRANG CHỦ</a>
            </li>
            <li>
                <a href="{{route('patient.info', $patient->id)}}">THÔNG TIN BỆNH NHÂN</a>
            </li>
            <li>
                <a href="{{ route('medicine', $patient->id) }}">ĐƠN THUỐC MỚI</a>
            </li>    
        </ul>
    </div> 
    <h3>CHI TIẾT ĐƠN THUỐC</h3>
    <div class="noidung">
        <?php               
            $DetailPres = new DetailPrescription();
            $id_patient = request()->segment(2);   
            $prescriptionId = request()->segment(4);    
            $drugs = $DetailPres->getDrug($prescriptionId);                                          
        ?>             
   
    </div>
    <div class="danhsach">
        <table>
            <thead>
                <tr>
                    <th scope="col">Tên thuốc</th>
                    <th scope="col">Tần suất</th>
                    <th scope="col">Liều dùng</th>
                    <th scope="col">Ghi chú</th>
                </tr>
            </thead>
            <tbody>        
                @foreach ($drugs as $drug)                                                
                <tr>
                    <td scope="row">
                        <?php 
                            $idDrug = $drug->id_drug;
                            $nameDrug = Drug::getNameDrug($idDrug);                    
                        ?>
                        {{ $nameDrug }}
                    </td>                
                    <td>                                              
                        {{ $drug->frequency }}                        
                    </td>
                    <td>
                      {{$drug->quantity_Ofmedicine}}  {{ $drug->name_unitDr }}
                    </td>
                    <td>
                        {{ $drug->note }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <button class="add-btn" onclick="window.location.href='{{ route('prescription.current', $patient->id) }}'">Quay lại</button>
    {{-- <button class="add-btn" onclick="window.location.href='{{ route('new.prescription',['id' => $id_patient, 'prescriptionId' =>  $prescriptionId]) }}'" >Thay đổi liều lượng</button> --}}
</body>
</html>