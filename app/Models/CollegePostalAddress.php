<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegePostalAddress extends Model
{
    use HasFactory;


    public function districtName()
    {
        return $this->belongsTo(District::class, 'district', 'id');
    }
    public function blockName()
    {
        return $this->belongsTo(Block::class, 'block', 'id');
    }
    public function psName()
    {
        return $this->belongsTo(PoliceStation::class, 'police_station', 'id');
    }
}
