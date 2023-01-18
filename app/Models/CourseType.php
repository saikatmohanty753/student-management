<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;

    public static function CourseType($id)
    {
        $type = CourseType::find($id);
        return $type->course_type;
    }

    
}
