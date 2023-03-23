<?php

namespace App\Http\Controllers;

use App\Models\BseExam;
use App\Models\BseExamine;
use App\Models\FeesMaster;
use App\Models\Notice;
use App\Models\PgExaminationApplication;
use App\Models\SemesterDetails;
use App\Models\StudentAddress;
use App\Models\StudentDetails;
use App\Models\StudentEducationDetails;
use App\Models\UgExaminationApplication;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class StudentPersonalController extends Controller
{
    public function index()
    {
        //dd(session()->all());
        //return Auth()->user()->student_id;
        $stu_id = Auth()->user()->student_id;
        $student = StudentDetails::where('id', $stu_id)->first();

        $dep_id = $student->department_id;
        if($dep_id == 1 ){
            $ug_app = UgExaminationApplication::where('stu_id',$stu_id)->first();
        }else if($dep_id == 2 ){
           
            $ug_app = PgExaminationApplication::where('stu_id',$stu_id)->first();
        }else{
            return $ug_app = '';
        }

        //return $ug_app;
        
        
       
        // return $notice->semester;
        

         
        $notification =  Auth::user()->Notifications;

          //$notification[0];
        
        if (!$notification->isEmpty()) {
            //return 'not empty';
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
            //return 'empty';
            $stu_details =[];
        }

        
        // return $stu_details;
        
        return view('student_personal.exam.regular_exam_notice',compact('stu_details','student','stu_id','ug_app'));
    }

    public function student_apply($id)
    {
        $student_details = StudentDetails::find($id);
        $student_address = StudentAddress::where('student_id', $id)->first();
        $student_education = StudentEducationDetails::where('student_id', $id)->first();

        if($student_education == '')
        {
            $edu_data = '';
        }else{
           $edu_data = json_decode($student_education->qualification);
        }
        
        
        if($edu_data == ''){
            $edu_hsc = '' ;
            $edu_intermediate = '' ;
        }else{
            $edu_hsc = $edu_data->hsc;
            $edu_intermediate = $edu_data->intermediate;
        }
        
        $fee = FeesMaster::all();
        
       
        return view('student_personal.exam.regular_exam', compact('student_details', 'student_address', 'edu_hsc', 'edu_intermediate', 'id', 'fee'));
       
        
    }

    public function student_app_store(Request $request, $id)
    {
        
       

        $student = StudentDetails::find($id);
        $sem_no = $student->current_semester;

        if ($request->bde_year_hid) {
            //return 1;
            for ($i = 0; $i < count($request->bde_year_hid); $i++) {
                $BseExam = new BseExam();
                $BseExam->stu_id = $id;
                $BseExam->year = $request->bde_year_hid[$i];
                $BseExam->name_of_exam = $request->bde_exam_hid[$i];
                $BseExam->roll_no = $request->bde_roll_no_hid[$i];
                $BseExam->regd_no = $request->bde_regd_no_hid[$i];
                $BseExam->save();
            }
        }
        if ($request->bde_course_hid) {
            //return 1;
            for ($i = 0; $i < count($request->bde_course_hid); $i++) {
                $BseExamine = new BseExamine();
                $BseExamine->stu_id = $id;
                $BseExamine->course = $request->bde_course_hid[$i];
                $BseExamine->theory_practical = $request->bde_theo_prac_hid[$i];

                $BseExamine->description = $request->bde_description_hid[$i];
                $BseExamine->save();
            }
        }


        if ($request->addmission_exam == 'on') {
            $addmission_exam = 'yes';
        } else {
            $addmission_exam = 'no';
        }

        $student = StudentDetails::find($id);
        // $student->payment_status = $fee_paid;
        $student->addmission_exam = $addmission_exam;
        $student->save();

        // $semester_details = DB::table('semester_details')->where('stu_id', $id)->where('semester_no', $sem_no)
        //     ->update([
        //         'payment_status' => $fee_paid
        //     ]);

        $ugApp = new UgExaminationApplication();
        $ugApp->stu_id = $id;
        $ugApp->form_status = 1;
        $ugApp->save();

        return redirect()->route('student_app_draft', [$id]);

        // return view('')
    }

    public function student_app_draft($id)
    {
        //return $id.'draft';
        //return $sem_no;
        $student_details = StudentDetails::find($id);
        //$sem_no = $student_details->current_semester;
        $student_address = StudentAddress::where('student_id', $id)->first();
        $student_education = StudentEducationDetails::where('student_id', $id)->first();
        $edu_data = json_decode($student_education->qualification);
        $edu_hsc = $edu_data->hsc;
        $edu_intermediate = $edu_data->intermediate;
        $fee = FeesMaster::all();
        $bse_exams = BseExam::where('stu_id', $id)->get();
        //$semester_details = SemesterDetails::where('semester_no', $sem_no)->first(['payment_status']);
        //$payment_status = $semester_details->payment_status;
        $bse_examines  = BseExamine::where('stu_id', $id)->get();

        return view('student_personal.exam.regular_exam_draft', compact('student_details', 'student_address', 'edu_hsc', 'edu_intermediate', 'id', 'fee', 'bse_exams', 'bse_examines'));
    }

    public function student_app_draft_store(Request $request, $id)
    {
        //return $id;
        if ($request->bde_year_hid) {
            //return 1;
            for ($i = 0; $i < count($request->bde_year_hid); $i++) {
                $BseExam = new BseExam();
                $BseExam->stu_id = $id;
                $BseExam->year = $request->bde_year_hid[$i];
                $BseExam->name_of_exam = $request->bde_exam_hid[$i];
                $BseExam->roll_no = $request->bde_roll_no_hid[$i];
                $BseExam->regd_no = $request->bde_regd_no_hid[$i];
                $BseExam->save();
            }
        }
        if ($request->bde_course_hid) {
            //return 1;
            for ($i = 0; $i < count($request->bde_course_hid); $i++) {
                $BseExamine = new BseExamine();
                $BseExamine->stu_id = $id;
                $BseExamine->course = $request->bde_course_hid[$i];
                $BseExamine->theory_practical = $request->bde_theo_prac_hid[$i];

                $BseExamine->description = $request->bde_description_hid[$i];
                $BseExamine->save();
            }
        }


        if ($request->addmission_exam == 'on') {
            $addmission_exam = 'yes';
        } else {
            $addmission_exam = 'no';
        }

        // if ($request->fee_paid == 'on') {
        //     $fee_paid = 1;
        // } else {
        //     $fee_paid = 0;
        // }

        $student = StudentDetails::find($id);
        // $student->payment_status = $fee_paid;
        $student->addmission_exam = $addmission_exam;
        $student->save();

        // $semester_details = DB::table('semester_details')->where('stu_id', $id)->where('semester_no', $sem_no)
        //     ->update([
        //         'payment_status' => $fee_paid
        //     ]);

        return redirect()->back();
    }

    public function delete_student_examine(Request $request)
    {
        // return $request;

        $bse_examines = BseExamine::find($request->exam_id);
        $bse_examines->delete();

        $bse_examines_data = BseExamine::where('stu_id', $request->stu_id)->get();
        return response()->json($bse_examines_data);
    }
    public function delete_student_exam(Request $request)
    {
        // return $request;

        $bse_exam = BseExam::find($request->exam_id);
        $bse_exam->delete();

        $bse_exam_data = BseExam::where('stu_id', $request->stu_id)->get();
        return response()->json($bse_exam_data);
    }

    public function student_app_preview($id)
    {
        //return $id;
        $ug_app = UgExaminationApplication::where('stu_id',$id)->first();
        $student_details = StudentDetails::find($id);
        $student_address = StudentAddress::where('student_id', $id)->first();
        $student_education = StudentEducationDetails::where('student_id', $id)->first();
        $edu_data = json_decode($student_education->qualification);
        $edu_hsc = $edu_data->hsc;
        $edu_intermediate = $edu_data->intermediate;
        $fee = FeesMaster::all();
        $bse_exams = BseExam::where('stu_id', $id)->get();
        $bse_examines  = BseExamine::where('stu_id', $id)->get();

        return view('student_personal.exam.regular_exam_preview', compact('student_details', 'student_address', 'student_education', 'edu_hsc', 'edu_intermediate', 'fee', 'bse_exams', 'bse_examines', 'id','ug_app'));
    }

    public function student_app_final($id)
    {
        $ug_app = DB::table('ug_examination_applications')
        ->where('stu_id',$id)
        ->update([
            'form_status' => 2
        ]);

        return redirect()->route('exam_notice');
    }


}
