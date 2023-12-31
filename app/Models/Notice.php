<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(CourseFor::class, 'department_id', 'id');
    }

    public function noticeStatus(){
        $chk = $this->status;
        if ($chk == 1) {
            return '<span class="badge badge-success">Published</span>';
        } else {
            return '<span class="badge badge-danger">Not Publish</span>';
        }
    }
}
