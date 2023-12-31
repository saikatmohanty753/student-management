<?php
use App\Models\City;
use App\Models\College;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\District;

if(!function_exists('modelFn'))
{
    function modelFn($table)
    {
        $object = "\App\Models\\".$table;
        return $object;
    }
}

function districtName($clg_id)
{
    $clg = District::where('id', $clg_id)->first();
    return $clg->name;
}
function applicationStatus($status)
{
    $chk = $status;
    if ($chk == 1) {
        return $applicationStatus = "Applied";
    } elseif ($chk == 2) {
        return  $applicationStatus = "Approved";
    } elseif ($chk == 3) {
        return  $applicationStatus = "Rejected";
    } elseif ($chk == 4) {
        return  $applicationStatus = "Application-Backed";
    }elseif ($chk == 5) {
        return  $applicationStatus = "Apply";
    }elseif ($chk == 6) {
        return  $applicationStatus = "Pending for verification";
    } else {
        return '';
    }
}
function statusColor($status)
{
    $chk = $status;
    if ($chk == 1) {
        return "primary";
    } elseif ($chk == 2) {
        return  "success";
    } elseif ($chk == 3) {
        return  "danger";
    } else {
        return  "warning";
    }
}

function collegeName($clg_id)
{
    $clg = College::where('id', $clg_id)->first();
    return $clg->name;
}

function presentDis($present_address)
{
    $present_address = json_decode($present_address);
    $district = District::where('id', $present_address->present_district_id)->first();
    return $district->district_name;
}
function permanentDis($permanent_address)
{
    $present_address = json_decode($permanent_address);
    $district = District::where('id', $present_address->permanent_district_id)->first();
    return $district->district_name;

}
