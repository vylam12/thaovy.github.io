<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all(); 
        return view('home', ['patients' => $patients]);
    }

    public function showAddPatientForm()
    {
        return view('formBN');
    }
    public static function calculateAge($birthday) {
        $birthDate = date_create($birthday);
        $today = date_create();
        $age = date_diff($birthDate, $today)->y;
        return $age;
    }
    public static function store(Request $request)
    {
        $validatedData = $request->validate([
            'txtFullname' => 'required',        
            'phone' => 'required',
            'gender' => 'required',        
            'birthday' => 'required',
            // 'CCCD' => 'required',        
            'txtAddress' => 'required',
            'txtWeigh' => 'required',        
            'bloodGroup' => 'required',
        ]);

        $patient = new Patient();
        $patient->name_patient = $request->input('txtFullname');
        $patient->email = $request->input('email');
        $patient->phone = $request->input('phone');
        $patient->gender = $request->input('gender');
        $patient->birthday = $request->input('birthday');
        // $patient->CCCD = $request->input('CCCD');
        $patient->address = $request->input('txtAddress');
        $patient->weight = $request->input('txtWeigh');
        $patient->blood_group = $request->input('bloodGroup');
        $tuoi = self::calculateAge($request->input('birthday'));
    
        if ($tuoi >= 18) {
            $patient->CCCD = $request->input('CCCD');
        }
        $patient->save();

        return redirect()->route('patients.index')->with('success', 'Bệnh nhân đã được tạo thành công.');
    }
    public function showPatientInfo($id)
    {    
        $patient = DB::table('patient')->find($id);
      
        if ($patient) {        

            return view('patient_info', ['patient' => $patient]);
        } else {
            abort(404);
        }
    }

 
}
