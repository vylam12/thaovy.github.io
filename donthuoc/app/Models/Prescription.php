<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prescription extends Model
{
    use HasFactory;    
    protected $table='prescription';   

    public function getPrescription($id_patient){
        $prescription = DB::table('prescription')
        ->select('id_prescription','id_doctor', 'diagnose','updated_at')
        ->where('id_patient',$id_patient)
        ->orderBy('updated_at', 'asc')
        ->get();
        return $prescription;
    }
}
