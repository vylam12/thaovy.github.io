<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\DrugUnit;
use App\Models\Drug;
use App\Models\Doctor;
use App\Models\Prescription;
use App\Models\DetailPrescription;
class MedicineController extends Controller
{
    public function donThuoc($id){
        $patient = DB::table('patient')->find($id);
        return view('donthuoc', ['patient' => $patient]);        
    }
    public function showKeDonForm(Request $request, $id,$prescriptionId){     
        $patient = DB::table('patient')->find($id);            
        $result_message = $request->query('message');
        return view('formKedon', ['patient' => $patient, 'prescriptionId' => $prescriptionId, 'result_message' => $result_message]);

    }  
    public function prescriptionCurrent(Request $request, $id){     
        $patient = DB::table('patient')->find($id);             
        return view('prescriptionCurrent',['patient' => $patient]);
    }  
    //chi tiết đơn thuốc
    public function prescriptionDetail(Request $request, $id,$prescriptionId){
        $patient = DB::table('patient')->find($id);  
        return view('presDetail',['patient' => $patient,'prescriptionId' => $prescriptionId]);
    }
    //tạo đơn thuốc mới
    public function diagnose(Request $request, $id)
    {     
        $id_patient = DB::table('patient')->find($id);  
        $doctorId = Auth::guard('doctor')->id();
        $diagnose = $request->input('diagnose');
        
        if ($diagnose != null) {
            $prescription = new Prescription();  
            $prescription->diagnose = $diagnose;            
            $prescription->id_doctor = $doctorId;
            $prescription->id_patient = $id;       
            $prescription->save();   
            $prescriptionId = DB::getPdo()->lastInsertId();              
            return Redirect::route('diagnose.prescriptionId', ['id' => $id_patient->id, 'prescriptionId' => $prescriptionId]);          
        } 
    }
    public function diagnose_prescriptionId(Request $request, $id,$prescriptionId){       
        $id_patient = DB::table('patient')->find($id); 
        $result_message = $request->query('message');
        return view('prescription', ['patient' => $id_patient, 'prescriptionId' => $prescriptionId, 'result_message' => $result_message]);
    }    
    //kê thuốc
    public function doseCheck(Request $request,$id,$prescriptionId)
    {
        $validatedData = $request->validate([
            'searchThuoc' => 'required',        
            'quantity_of_medicine' => 'required',
            'frequency' => 'required',                 
        ]);       
        $searchThuoc = $request->input('searchThuoc');
        $thuocArr = explode(' - ', $searchThuoc);
        $id_patient = $request->segment(2);
        $name_drug = $thuocArr[0]; // tên thuốc
        $unit_drug = $thuocArr[1];
        $quantity_of_medicine = $request->input('quantity_of_medicine');        
        $frequency = $request->input('frequency');
        $note = $request->input('note');
        $id_drug = DB::table('drug')->select('id_drug')->where('name_drug', $name_drug)->first()->id_drug;
        $max_dose_time = Drug::getMaxDoseTime($name_drug);
        $min_dose_time = Drug::getMinDoseTime($name_drug);
        $max_frequency_day = Drug::getMaxFrequencyDay($name_drug);
        $dose = Drug::getDoseByDrugAndUnit($name_drug,$unit_drug);
        $sum_dose = $quantity_of_medicine * $dose;
        $result_message = "";    
      
        //dd($max_dose_time, $sum_dose,$dose , $max_frequency_day,$searchThuoc, $thuocArr, $id_patient, $name_drug, $unit_drug, $quantity_of_medicine, $frequency);
        //Kiểm tra lượng thuốc trong một lần uống
        if ($sum_dose > $max_dose_time) {
            $result_message = "Liều lượng quá cao so với liều lượng cho 1 lần uống của thuốc " . $name_drug;           
            return redirect()   ->route('dose', ['id' => $id_patient, 'prescriptionId' => $prescriptionId])
                                ->with('success', $result_message);
        }else if ($sum_dose < $min_dose_time) {
            $result_message = "Liều lượng quá thấp so với liều lượng cho 1 lần uống của thuốc " . $name_drug ;           
            return redirect()   ->route('dose', ['id' => $id_patient, 'prescriptionId' => $prescriptionId])
                                ->with('success', $result_message);
        }
        // Kiểm tra tần suất uống trong 1 ngày
        else if ($frequency > $max_frequency_day) {
            $result_message = "Tần suất uống trong 1 ngày của thuốc " . $name_drug . " qua cao";          
            return redirect()   ->route('dose', ['id' => $id_patient, 'prescriptionId' => $prescriptionId])
                                ->with('success', $result_message);
        }
        else {
            $result_message = "Thêm thuốc thành công";
                 
            $detail_prescription = new DetailPrescription();
            $detail_prescription->id_drug = $id_drug;
            $detail_prescription->quantity_Ofmedicine = $quantity_of_medicine;
            $detail_prescription->frequency = $frequency;
            $detail_prescription->id_prescription = $prescriptionId;
            $detail_prescription->name_unitDr = $unit_drug;
            $detail_prescription->note= $note;
            $detail_prescription->save();                          
            return redirect()   ->route('diagnose.prescriptionId', ['id' => $id_patient, 'prescriptionId' => $prescriptionId])             
                                ->with('success', $result_message);
        }
    }
    public function deleteDrug($prescriptionId, $drugId)
    {
        DB::table('detail_prescription')
        ->where('id_prescription', $prescriptionId)
        ->where('id_drug', $drugId)
        ->delete();       
        return redirect()->back()->with('success', 'Thuốc đã được xóa khỏi đơn thuốc');         
    }
    public function prescriptionNew($id)
    {
        $prescriptionId=request()->segment(4);                                 
        return view('newPres', ['patient' => $id, 'prescriptionId' => $prescriptionId]);      
    }      
    public function checkprescriptionNew(Request $request,$id )
    {
            
        $data = $request->all();
        $frequencies = $data['frequency'];
        $quantities = $data['quantity'];
    
        foreach ($frequencies as $idDrug => $frequency) {        
            $idDrug = $idDrug;
            $name_drug= DB::table('drug')                
                ->where('id_drug', $idDrug)
                ->first();  
            $frequency = $frequency;        
            $quantity = $quantities[$idDrug];

            $max_dose_time = Drug::getMaxDoseTime($name_drug);
            $min_dose_time = Drug::getMinDoseTime($name_drug);
            $max_frequency_day = Drug::getMaxFrequencyDay($name_drug);
            $dose = Drug::getDoseByDrugAndUnit($name_drug,$unit_drug);
            $sum_dose = $quantity * $dose;
            $result_message = "";   
    
            if ($sum_dose > $max_dose_time) {
                $result_message = "Liều lượng quá cao so với liều lượng cho 1 lần uống của thuốc " . $name_drug;           
                return redirect()   ->route('dose', ['id' => $id_patient, 'prescriptionId' => $prescriptionId])
                                    ->with('success', $result_message);
            }else if ($sum_dose < $min_dose_time) {
                $result_message = "Liều lượng quá thấp so với liều lượng cho 1 lần uống của thuốc " . $name_drug ;           
                return redirect()   ->route('dose', ['id' => $id_patient, 'prescriptionId' => $prescriptionId])
                                    ->with('success', $result_message);
            }
            // Kiểm tra tần suất uống trong 1 ngày
            else if ($frequency > $max_frequency_day) {
                $result_message = "Tần suất uống trong 1 ngày của thuốc " . $name_drug . " qua cao";          
                return redirect()   ->route('dose', ['id' => $id_patient, 'prescriptionId' => $prescriptionId])
                                    ->with('success', $result_message);
            }
            else {
                $result_message = "Thêm thuốc thành công";
                    
                
                $detail_prescription = new DetailPrescription();
                $detail_prescription->id_drug = $id_drug;
                $detail_prescription->quantity_Ofmedicine = $quantity_of_medicine;
                $detail_prescription->frequency = $frequency;
                $detail_prescription->id_prescription = $prescriptionId;
                $detail_prescription->name_unitDr = $unit_drug;
                $detail_prescription->note= $note;
                $detail_prescription->save();                          
                return view();
            }

        }        
        $doctorId = Auth::guard('doctor')->id();
        $prescription = new Prescription();  
        $prescription->diagnose = $diagnose->diagnose;          
        $prescription->id_doctor = $doctorId;
        $prescription->id_patient = $id;       
        $prescription->save();   
        $prescriptionId_new = DB::getPdo()->lastInsertId(); 
        
    } 
}
