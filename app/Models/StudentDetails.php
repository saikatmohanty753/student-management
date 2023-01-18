<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    use HasFactory;
    public $applicationStatus;
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(CourseFor::class, 'department_id', 'id');
    }

    public function applicationStatus()
    {
        $chk = $this->status;
        if ($chk == 1) {
           return $this->applicationStatus = "Applied";
        } elseif ($chk == 2) {
           return  $this->applicationStatus = "Approved";

        }elseif ($chk == 3) {
           return  $this->applicationStatus = "Rejected";
        } elseif ($chk == 4){
            return  $this->applicationStatus = "Application-Backed";
        }else{
            return '';
        }

    }
    public function statusColor()
    {
        $chk = $this->status;
        if ($chk == 1) {
           return "primary";
        } elseif ($chk == 2) {
           return  "success";

        }elseif ($chk == 3) {
           return  "danger";
        }else{
            return  "warning";
        }

    }

    public function collegeName(){
        if ($this->clg_id == '000') {
            return 'Utkal University of Culture';
        } else {
            $clg = College::where('id', $this->clg_id)->first();
            return $clg->name;
        }

    }
}
