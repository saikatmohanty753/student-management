<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;

    public function presentDistrict()
    {
        return $this->belongsTo(District::class, 'present_district_id', 'id');
    }
    public function permanentDistrict()
    {
        return $this->belongsTo(District::class, 'permanent_district_id', 'id');
    }
}
