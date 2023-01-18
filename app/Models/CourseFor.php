<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseFor extends Model
{
    use HasFactory;
    protected $table = 'course_fors';

    public static function CourseFor($id)
    {
        $type = CourseFor::find($id);
        $type = $type->course_for;
        if ($type == 'UG') {
            $code = "A";
        } elseif ($type == 'PG') {
            $code = "B";
        } elseif ($type == 'M.Phil') {
            $code = "C";
        }elseif ($type == 'Certificate') {
            $code = "D";
        }

        return $code;
    }
}
