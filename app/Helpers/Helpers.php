<?php

namespace App\Helpers;

use App\Models\Affiliation_feemaster;
use App\Models\AffiliationType;
use App\Models\Course;
use App\Models\StudentApplication;
use App\Models\StudentDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    public static function number($number)
    {
        $array = ["First", "Second", "Third", "Fourth", "Fifth", 'Sixth', 'Seventh', 'Eighth'];
        return $array[$number - 1];
    }

    public static function createRollNO($clg_id, $course_id, $year)
    {
        // return $course_id;
        $data = StudentDetails::where([['clg_id', $clg_id], ['course_id', $course_id], ['batch_year', $year]])->latest()->first();

        $course = Course::where('id', $course_id)->first(['main_course_code', 'course_for']);
        $course_code = ($course->course_for == 3 && $course->main_course_code == '') ? 'MPHIL' : substr($course->main_course_code, 0, 3);

        $clg_code = str_pad($clg_id, 3, '0', STR_PAD_LEFT);
        $yr = Carbon::now()->format('y');

        if ($data) {
            $prv_roll_no = $data->roll_no;
            $prv_roll_no = substr($prv_roll_no, 8);
            $increment = intval($prv_roll_no) + 1;
            $sl_no = str_pad($increment, 3, '0', STR_PAD_LEFT);
            $roll_no = $clg_code . $course_code . $yr . $sl_no;
        } else {
            $sl_no = str_pad(1, 3, '0', STR_PAD_LEFT);
            $roll_no = $clg_code . $course_code . $yr . $sl_no;
        }
        return $roll_no;
    }

    public static function application()
    {
        $ug_app = StudentApplication::where([['academic_year', date('Y')], ['status', 1], ['department_id', 1]])->count();
        $pg_app = StudentApplication::where([['academic_year', date('Y')], ['status', 1], ['department_id', 2]])->count();
        $mphil_app = StudentApplication::where([['academic_year', date('Y')], ['status', 1], ['department_id', 3]])->count();
        $cert_app = StudentApplication::where([['academic_year', date('Y')], ['status', 1], ['department_id', 4]])->count();
        $data = [
            'all_app' => $ug_app + $pg_app + $mphil_app + $cert_app,
            'ug' => $ug_app,
            'pg' => $pg_app,
            'mphil' => $mphil_app,
            'certificate' => $cert_app,
        ];
        return $data;
    }
}
