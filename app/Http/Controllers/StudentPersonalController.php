<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\StudentDetails;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPersonalController extends Controller
{
    public function index()
    {
        //dd(session()->all());
        //Auth()->user()->student_id;
        $student = StudentDetails::where('id', Auth()->user()->student_id)->first();
       
        // return $notice->semester;
         $stu_id = Auth()->user()->student_id;

         
         $notification =  Auth::user()->Notifications;
        
        if (!$notification->empty()) {
            //return 33;
            $semeter = $notification[0]->data['semester'];
        $semeter = explode(",",$notification[0]->data['semester']);
        //$notice =  Notice::where('department_id', $student->department_id)->get();

        

        foreach ($notification as $key => $value) {
            $semeter = $value->data['semester'];
            $semeter = explode(",",$notification[$key]->data['semester']);

            if (in_array($student->current_semester,$semeter)) {
                $stu_details[] = $value->data;
            }
            
            
        }
        }else{
            $stu_details =[];
        }

        
        // return $stu_details;
        
        return view('student_personal.exam.regular_exam_notice',compact('stu_details','student','stu_id'));
    }

    public function student_apply($id)
    {
        return $id;
    }
}
