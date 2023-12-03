<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitDrug extends Model
{
    use HasFactory;

    protected $table = 'unit_drug';
    protected $primaryKey = 'id_unitDr';
    public $timestamps = false;

    // Định nghĩa quan hệ với bảng drug
    public function drugs()
    {
        return $this->belongsToMany(Drug::class, 'detail_drug', 'id_unitDr', 'id_drug');
    }
}