<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailPrescription extends Model
{
    use HasFactory;
    
    protected $table='detail_prescription';
    public static function getDrug($prescriptionId) {
        $drugs = DB::table('detail_prescription')
            ->select('id_drug', 'frequency', 'quantity_Ofmedicine','name_unitDr','note')
            ->where('id_prescription', $prescriptionId)
            ->get();
        return $drugs;
    } 
}


