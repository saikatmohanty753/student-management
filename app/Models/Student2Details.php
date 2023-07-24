<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student2Details extends Model
{
 
use HasFactory;

   protected $table = 'student2_details';
 public $applicationStatus; 
 public $present_dis_id;

 public function course(){
 return $this->belongsTo(Course::class, 'course_id', 'id');
}

 public function department(){

 return $this->belongsTo(CourseFor::class, 'department_id', 'id');
}
 public function districtName(){
 $clg = District::where('id', $this->clg_id)->first();
 return $clg->name;
} 
 public function permanentDis(){
 $present_address = json_decode($this->permanent_address);
 $district = District::where('id', $present_address->present_district_id)->first();
 return $district->district_name;
 } 
 public function presentDis(){
 $present_address = json_decode($this->present_address);
 $district = District::where('id', $present_address->present_district_id)->first();
 return $district->district_name;
} 
 public function collegeName(){
 $clg = College::where('id', $this->clg_id)->first();
 return $clg->name;
 }
 public function applicationStatus(){
 $chk = $this->status;
 if ($chk == 1) {
 return $this->applicationStatus = 'Applied';
 } elseif ($chk == 2) {
 return  $this->applicationStatus = 'Approved';
 } elseif ($chk == 3) {
 return  $this->applicationStatus = 'Rejected';
 } elseif ($chk == 4) {
 return  $this->applicationStatus = 'Application-Backed';
 }elseif ($chk == 5) {
 return  $this->applicationStatus = 'Apply';
 }elseif ($chk == 6) {
 return  $this->applicationStatus = 'Pending for verification';
 } else {
 return '';
 }
 } 
 public function statusColor(){
 $chk = $this->status;
 	if ($chk == 1) {
	 return 'primary';
} elseif ($chk == 2) {
 	 return  'success';
 	 } elseif ($chk == 3) {
 	 return  'danger'; } else {
 	return  'warning';
}
} 
}
