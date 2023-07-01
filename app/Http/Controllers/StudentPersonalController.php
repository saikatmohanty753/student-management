<?php

namespace App\Http\Controllers;

use App\Models\BseExam;
use App\Models\BseExamine;
use App\Models\FeesMaster;
use App\Models\PgExaminationApplication;
use App\Models\PgExaminationStudent;
use App\Models\PgExaminationSubject;
use App\Models\StudentAddress;
use App\Models\StudentDetails;
use App\Models\StudentEducationDetails;
use App\Models\UgExaminationApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPersonalController extends Controller
{
    public function index()
    {

        //dd(session()->all());
        //return Auth()->user()->student_id;
        $stu_id = Auth()->user()->student_id;
        $student = StudentDetails::where('id', $stu_id)->first();

        $dep_id = $student->department_id;
        if ($dep_id == 1) {
            $ug_app = UgExaminationApplication::where('stu_id', $stu_id)->latest()->first();
        } else if ($dep_id == 2) {
            $ug_app = PgExaminationApplication::where('stu_id', $stu_id)->latest()->first();
        } else {
            $ug_app = '';
        }

        $notification = Auth::user()->Notifications;
        if (!$notification->isEmpty()) {
            foreach ($notification as $key => $value) {
                $semeter = $value->data['semester'];
                $semeter = explode(",", $notification[$key]->data['semester']);
                if (in_array($student->current_semester, $semeter)) {
                    $stu_details[] = $value->data;

                    //return $stu_details;

                   foreach ($stu_details as $key => $item) {

                    if ($dep_id == 1) {

                        // return 1;
                     $ug_app3 = UgExaminationApplication::where('stu_id', $stu_id)->where('notice_id', $value->data['notice_id'])->get();
                     $ug_app2 = UgExaminationApplication::where('stu_id', $stu_id)->where('notice_id', $item['notice_id'])->count();
                 } else if ($dep_id == 2) {
                     //return 2;
                    // return $stu_id;
                    // return $value->data['notice_id'];
                     $ug_app3 = PgExaminationApplication::where('stu_id', $stu_id)->where('notice_id', $value->data['notice_id'])->get();
                     $ug_app2 = PgExaminationApplication::where('stu_id', $stu_id)->where('notice_id', $item['notice_id'])->count();
                 }else{
                    // return 3;
                     $ug_app3 = [];
                 }





                   foreach ($ug_app3 as $key => $value2) {
                        // $form_status = $value2->form_status;
                        // $payment_status = $value2->payment_status;
                       $item['form_status'] =$value2->form_status;
                       $item['payment_status'] = $value2->payment_status;
                       $item['app_status'] = $value2->app_status;
                       $item['app_id'] = $value2->id;
                   }

                   if($ug_app2 > 0 ){
                    $item['notice_present_ug_app'] = 1;
                   }else{
                    $item['notice_present_ug_app'] = 0;
                   }
                        $stu_details_noti[] = $item;
                    }
                }
            }
        } else {
            $stu_details_noti = [];
        }

        // return  $stu_details_noti;
        //return $ug_stu_app;
       $stu_details = collect($stu_details_noti)->unique('notice_id');
       // return $stu_details[0]['notice_name'];

        return view('student_personal.exam.regular_exam_notice', compact('stu_details', 'student', 'stu_id', 'ug_app', 'stu_details_noti'));
    }

    public function student_apply($id)
    {    
    
        $notice_id = $id;
        $stud_id = Auth::user()->student_id;
        //return $id;

        $notification_id = Auth::user()->Notifications;
        $notification_id = $notification_id[0]->data['notice_id'];
        $student_details = StudentDetails::find($stud_id);
        $student_address = StudentAddress::where('student_id', $stud_id)->first();
        $student_education = StudentEducationDetails::where('student_id', $stud_id)->first();

        $dep_id = $student_details->department_id;

        if ($student_education == '') {
            $edu_data = '';
        } else {
            $edu_data = json_decode($student_education->qualification);
        }

        if ($edu_data == '') {
            $edu_hsc = '';
            $edu_intermediate = '';
        } else {
            $edu_hsc = $edu_data->hsc;
            $edu_intermediate = $edu_data->intermediate;
        }

        $edu_graduate = $edu_data->graduate;

        $fee = FeesMaster::all();

        if ($dep_id == 1) {
            return view('student_personal.exam.regular_exam', compact('student_details', 'student_address', 'edu_hsc', 'edu_intermediate', 'notice_id', 'fee','notification_id','stud_id','id'));
        } elseif ($dep_id == 2) {
            //return 2;
            return view('student_personal.exam.pgform', compact('student_details', 'student_address', 'edu_hsc', 'edu_intermediate', 'notice_id', 'fee', 'edu_graduate','notification_id','stud_id'));
        }
    }

    public function student_app_store(Request $request, $id)
    {

// return $request;
       
        $stu_id = Auth()->user()->student_id;
        $student = StudentDetails::find($stu_id);
        $sem_no = $student->current_semester;

        $ugApp = new UgExaminationApplication();
        $ugApp->stu_id = $stu_id;
        $ugApp->form_status = 1;
        $ugApp->notice_id = $request->notice_id;
        $ugApp->save();

        $ug_app = UgExaminationApplication::latest('id')->first();
        $ug_app_id =  $ug_app->id;

        if ($request->bde_year_hid) {
            //return 1;
            for ($i = 0; $i < count($request->bde_year_hid); $i++) {
                $BseExam = new BseExam();
                $BseExam->stu_id =  $ug_app_id;
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
                $BseExamine->stu_id =  $ug_app_id;
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

        $student = StudentDetails::find($stu_id);
        // $student->payment_status = $fee_paid;
        $student->addmission_exam = $addmission_exam;
        $student->save();

        // $semester_details = DB::table('semester_details')->where('stu_id', $id)->where('semester_no', $sem_no)
        //     ->update([
        //         'payment_status' => $fee_paid
        //     ]);



        return redirect()->route('student_app_draft', [$ug_app_id]);

        // return view('')
    }

    public function student_app_draft($id)
    {
        // return $id;
        //return $id.'draft';
        //return $sem_no;
        $stu_id = Auth()->user()->student_id;
        $student_details = StudentDetails::find($stu_id);
        //$sem_no = $student_details->current_semester;
        $student_address = StudentAddress::where('student_id', $stu_id)->first();
        $student_education = StudentEducationDetails::where('student_id', $stu_id)->first();
        $edu_data = json_decode($student_education->qualification);
        $edu_hsc = $edu_data->hsc;
        $edu_intermediate = $edu_data->intermediate;
        $fee = FeesMaster::all();
        $bse_exams = BseExam::where('stu_id', $id)->get();
        //$semester_details = SemesterDetails::where('semester_no', $sem_no)->first(['payment_status']);
        //$payment_status = $semester_details->payment_status;
        $bse_examines = BseExamine::where('stu_id', $id)->get();

        return view('student_personal.exam.regular_exam_draft', compact('student_details', 'student_address', 'edu_hsc', 'edu_intermediate', 'id', 'fee', 'bse_exams', 'bse_examines'));
    }

    public function student_app_draft_store(Request $request, $id)
    {
        
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
    //    return $id;
        //$app_id 
        $stud_id = Auth::user()->student_id;
        $student_details = StudentDetails::find($stud_id);

        $department_id = $student_details->department_id;

        //return $notification = Auth::user()->Notifications;

        if($department_id == 1){


        $ug_app = UgExaminationApplication::where('id', $id)->first();


        $student_address = StudentAddress::where('student_id', $stud_id)->first();
        $student_education = StudentEducationDetails::where('student_id', $stud_id)->first();
        $edu_data = json_decode($student_education->qualification);
        $edu_hsc = $edu_data->hsc;
        $edu_intermediate = $edu_data->intermediate;
        $fee = FeesMaster::all();

            $bse_exams = BseExam::where('stu_id', $id)->get();
            $bse_examines = BseExamine::where('stu_id', $id)->get();

            return view('student_personal.exam.regular_exam_preview', compact('student_details', 'student_address', 'student_education', 'edu_hsc', 'edu_intermediate', 'fee', 'bse_exams', 'bse_examines', 'id', 'ug_app'));
        }else{

            $pg_app = PgExaminationApplication::where('id', $id)->latest()->first();    


            $pgfee = FeesMaster::all();
            $pgstd = PgExaminationStudent::where('std_id', $id)->first();
            $pgid=$pgstd->id;
            $student_address = StudentAddress::where('student_id', $stud_id)->first();
            $pg_app = PgExaminationApplication::where('id', $id)->first();
            $personal_information = json_decode($pgstd->appearing_exam);
            $previousexamappearance = json_decode($pgstd->previous_exam_appearance);
            $pgstdsub = PgExaminationSubject::where('std_id', $id)->get();
            return view('student_personal.exam.pgformpreview', compact('student_details', 'pgstdsub', 'previousexamappearance', 'personal_information', 'student_address', 'pgstd', 'id', 'pgfee', 'pg_app'));
        }
    }

    // public function pgformpreview($std_id)
    // {


    //     $pgstd = PgExaminationStudent::where('std_id', $std_id)->first();
    //     $pgid=$pgstd->id;

    //     $pg_app = PgExaminationApplication::where('stu_id', $std_id)->first();
    //     $student_details = StudentDetails::where('id', $std_id)->first();

    //     $personal_information = json_decode($pgstd->appearing_exam);
    //     $previousexamappearance = json_decode($pgstd->previous_exam_appearance);
    //     $pgstdsub = PgExaminationSubject::where('std_id', $std_id)->get();
    //     $student_address = StudentAddress::where('student_id', $std_id)->first();
    //     $pgfee = FeesMaster::all();

    //     return view('student_personal.exam.pgformpreview', compact('student_details', 'pgstdsub', 'previousexamappearance', 'personal_information', 'student_address', 'pgstd', 'std_id','pgfee','pg_app'));

    // }

    public function ug_student_app_final($id)
    {
    
        $ug_app = DB::table('ug_examination_applications')
            ->where('id', $id)
            ->update([
                'form_status' => 2,
                'app_status' => 1,
            ]);

        return redirect()->route('exam_notice');
    }

    public function apply_pg_exam($id)
    {

        return 'pg';
    }

    public function pgexamstore(Request $request)
    {
       
        $std_id = $request->std_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $search_year = $from_date . '-' . $to_date;


        $pgexamapp = new PgExaminationApplication;
        $pgexamapp->stu_id=$std_id;
        $pgexamapp->form_status=1;
        $pgexamapp->notice_id = $request->notice_id;

        $pgexamapp->save();

        $pg_app_id = PgExaminationApplication::latest('id')->first();
        $pg_app_id =  $pg_app_id->id;



        $pgexam = new PgExaminationStudent;
        $pgexam->college_name = $request->college_name;
        $pgexam->batch_year = $search_year;

        $pgexam->std_id = $pg_app_id;

        $personal_information = [
            'partIexam' => [
                'roll1' => $request->roll1,
                'month1' => $request->month1,
                'year1' => $request->year1,

            ],
            'partIIexam' => [
                'roll2' => $request->roll2,
                'month2' => $request->month2,
                'year2' => $request->year2,
            ],

        ];

        $pgexam->appearing_exam = json_encode($personal_information);

        $previousexamappearance = [
            'partIexam' => [
                'roll3' => $request->roll3,
                'month3' => $request->month3,
                'year3' => $request->year3,

            ],
            'partIIexam' => [
                'roll4' => $request->roll4,
                'month4' => $request->month4,
                'year4' => $request->year4,
            ],
            'whole' => [
                'roll5' => $request->roll5,
                'month5' => $request->month5,
                'year5' => $request->year5,
            ],

        ];

        $pgexam->previous_exam_appearance = json_encode($previousexamappearance);

        $pgexam->save();
        $pgid = PgExaminationStudent::latest('id')->first();
        $pgid = $pgid->id;

        if (is_countable($request->bde_year_hid)) {
            for ($i = 0; $i < count($request->bde_year_hid); $i++) {
                $pgsubject = new PgExaminationSubject();
                $pgsubject->pg_id = $pgid;
                $pgsubject->std_id = $pg_app_id;
                $pgsubject->subject_name = $request->bde_year_hid[$i];
                $pgsubject->paper_name = $request->bde_exam_hid[$i];
                $pgsubject->paper_value = $request->bde_paper_hid[$i];
                $pgsubject->special_paper = $request->bde_roll_no_hid[$i];
                $pgsubject->special_paper_value = $request->bde_special_hid[$i];
                $pgsubject->save();
            }
        }



        return redirect()->route('pgformdraft', [$pg_app_id]);

    }

    // public function pgformpreview($std_id)
    // {


    //     $pgstd = PgExaminationStudent::where('std_id', $std_id)->first();
    //     $pgid=$pgstd->id;

    //     $pg_app = PgExaminationApplication::where('stu_id', $std_id)->first();
    //     $student_details = StudentDetails::where('id', $std_id)->first();

    //     $personal_information = json_decode($pgstd->appearing_exam);
    //     $previousexamappearance = json_decode($pgstd->previous_exam_appearance);
    //     $pgstdsub = PgExaminationSubject::where('std_id', $std_id)->get();
    //     $student_address = StudentAddress::where('student_id', $std_id)->first();
    //     $pgfee = FeesMaster::all();

    //     return view('student_personal.exam.pgformpreview', compact('student_details', 'pgstdsub', 'previousexamappearance', 'personal_information', 'student_address', 'pgstd', 'std_id','pgfee','pg_app'));

    // }

    public function pgformdraft($stu_id)
    {
        //return $stu_id;
        $student_id = Auth::user()->student_id;
        $pgstd = PgExaminationStudent::where('std_id', $stu_id)->first();
        $pgid = $pgstd->id;

        $pgyear = $pgstd->batch_year;
        [$fromdate, $todate] = explode('-', $pgyear);
        $appearingexam = json_decode($pgstd->appearing_exam);
        $previousappearingexam = json_decode($pgstd->previous_exam_appearance);
        $pg_sub = PgExaminationSubject::where('std_id', $stu_id)->get();
        $student_details = StudentDetails::where('id', $student_id)->first();
        $student_address = StudentAddress::where('student_id', $student_id)->first();
        $student_education = StudentEducationDetails::where('student_id', $student_id)->first();
        $edu_hsc = json_decode($student_education->qualification);
        $pgfee = FeesMaster::all();

        return view('student_personal.exam.pgformdraft', compact('appearingexam', 'previousappearingexam', 'pg_sub', 'student_details', 'student_address', 'edu_hsc', 'pgid', 'stu_id', 'pgstd', 'fromdate', 'todate', 'pgfee'));
    }





    public function pgexamupdate(Request $request, $stu_id)
    {
       
        $pgid=$request->pgid;

        //$std_id = $request->id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $search_year = $from_date . '-' . $to_date;

        $pgexam = PgExaminationStudent::where('id', $pgid)->first();
        $pgexam->college_name = $request->college_name;
        $pgexam->batch_year = $search_year;

        $pgexam->std_id = $stu_id;

        $personal_information = [
            'partIexam' => [
                'roll1' => $request->roll1,
                'month1' => $request->month1,
                'year1' => $request->year1,

            ],
            'partIIexam' => [
                'roll2' => $request->roll2,
                'month2' => $request->month2,
                'year2' => $request->year2,
            ],

        ];

        $pgexam->appearing_exam = json_encode($personal_information);

        $previousexamappearance = [
            'partIexam' => [
                'roll3' => $request->roll3,
                'month3' => $request->month3,
                'year3' => $request->year3,

            ],
            'partIIexam' => [
                'roll4' => $request->roll4,
                'month4' => $request->month4,
                'year4' => $request->year4,
            ],
            'whole' => [
                'roll5' => $request->roll5,
                'month5' => $request->month5,
                'year5' => $request->year5,
            ],

        ];

        $pgexam->previous_exam_appearance = json_encode($previousexamappearance);
        // return $pgexam;
        $pgexam->save();
         $pgid = PgExaminationStudent::latest('id')->first();
         $pgid =  $pgid->id;

        if (is_countable($request->bde_year_hid)) {
            for ($i = 0; $i < count($request->bde_year_hid); $i++) {


                // If the record does not exist, create a new one
                $pgsubject = new PgExaminationSubject();
                $pgsubject->pg_id = $pgid;
                $pgsubject->std_id = $stu_id;

                // $pgsubject->pg_id = $pgid;
                $pgsubject->subject_name = $request->bde_year_hid[$i];
                $pgsubject->paper_name = $request->bde_exam_hid[$i];
                $pgsubject->paper_value = $request->bde_paper_hid[$i];
                $pgsubject->special_paper = $request->bde_roll_no_hid[$i];
                $pgsubject->special_paper_value = $request->bde_special_hid[$i];
                $pgsubject->save();
            }
        }

        // return redirect()->route('pgformpreview', ['id' => $stu_id]);

        return redirect()->back()->with('msg', 'The Message');
    }


    public function delete(Request $request)
    {

        $pgexam = PgExaminationSubject::find($request->id);
        $pgexam->delete();
        return response()->json('row deleted successfully');
    }



    public function pg_student_app_final($id)
    {
     
        $pg_app = DB::table('pg_examination_applications')
            ->where('id', $id)
            ->update([
                'form_status' => 2,
                'app_status' => 1,
            ]);

        return redirect()->route('exam_notice');
    }

    public function final_preview($id){
    //    return $id;
       $stu_id = Auth()->user()->student_id;
        $student_details = StudentDetails::find($stu_id);

        $department_id = $student_details->department_id;




        if($department_id == 1){

            $ug_app = UgExaminationApplication::where('id', $id)->first();

        //$ug_app_id = $ug_app->id;
        $student_address = StudentAddress::where('student_id', $stu_id)->first();
        $student_education = StudentEducationDetails::where('student_id', $stu_id)->first();
        $edu_data = json_decode($student_education->qualification);
        $edu_hsc = $edu_data->hsc;
        $edu_intermediate = $edu_data->intermediate;
        $fee = FeesMaster::all();

            $bse_exams = BseExam::where('stu_id', $id)->get();
            $bse_examines = BseExamine::where('stu_id', $id)->get();

            return view('student_personal.exam.ug_final_preview', compact('student_details', 'student_address', 'student_education', 'edu_hsc', 'edu_intermediate', 'fee', 'bse_exams', 'bse_examines', 'id', 'ug_app'));
        } else {
            $pgfee = FeesMaster::all();
            $pgstd = PgExaminationStudent::where('std_id', $id)->first();
            $pgid=$pgstd->id;
            $student_address = StudentAddress::where('student_id', $stu_id)->first();
            $pg_app = PgExaminationApplication::where('id', $id)->first();
            //$pg_app_id = $pg_app->id;

            $student_education = StudentEducationDetails::where('student_id', $stu_id)->first();
            $edu_data = json_decode($student_education->qualification);
            $personal_information = json_decode($pgstd->appearing_exam);
            $previousexamappearance = json_decode($pgstd->previous_exam_appearance);
            $pgstdsub = PgExaminationSubject::where('std_id', $id)->get();
            return view('student_personal.exam.pg_final_preview', compact('student_details', 'pgstdsub', 'previousexamappearance', 'personal_information', 'student_address', 'pgstd', 'id', 'pgfee', 'pg_app', 'edu_data'));
        }
    }
}
