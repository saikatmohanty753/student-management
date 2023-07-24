<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student2Address extends Model
{
 
use HasFactory;

   protected $table = 'student2_addresses';
 public function presentDistrict(){
 return $this->belongsTo(\District::class, 'present_district_id', 'id');
}

 public function permanentDistrict(){
 return $this->belongsTo(District::class, 'permanent_district_id', 'id');
}  
}
