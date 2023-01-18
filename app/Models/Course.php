<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function courseType()
    {
        return $this->belongsTo(CourseType::class, 'course_type', 'id');
    }

    public static function totalCourse()
    {
        return Course::count();
    }


}
