<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Drug extends Model
{
    use HasFactory;
    // Tên bảng trong CSDL chứa thông tin thuốc
    protected $table = 'drug';
    
    public static function getDoseByDrugAndUnit($name_drug, $name_unit)
    {
        return self::join('detail_drug', 'drug.id_drug', '=', 'detail_drug.id_drug')
            ->join('unit_drug', 'detail_drug.id_unitDr', '=', 'unit_drug.id_unitDr')
            ->where('drug.name_drug', $name_drug)
            ->where('unit_drug.name_unitDr', $name_unit)
            ->value('detail_drug.dose');
    }
    public static function getNameDrug($id_drug)
    {
        $drug = DB::table('drug')
            ->select('name_drug')
            ->where('id_drug', $id_drug)
            ->first();
    
        if ($drug) {
            return $drug->name_drug;
        }
    
        return null;
    }
    public static function getMaxDoseTime($name_drug)
    {
        $drug = self::where('name_drug', $name_drug)->first();

        if ($drug) {
            return $drug->max_dose_time;
        }

        return null; // Hoặc giá trị mặc định nếu không tìm thấy
    }
    public static function getMinDoseTime($name_drug)
    {
        $drug = self::where('name_drug', $name_drug)->first();

        if ($drug) {
            return $drug->min_dose_time;
        }

        return null; // Hoặc giá trị mặc định nếu không tìm thấy
    }

    public static function getMaxFrequencyDay($name_drug)
    {
        $drug = self::where('name_drug', $name_drug)->first();

        if ($drug) {
            return $drug->max_frequency_day;
        }

        return null; // Hoặc giá trị mặc định nếu không tìm thấy
    }
}
