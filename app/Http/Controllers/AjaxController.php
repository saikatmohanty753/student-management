<?php

namespace App\Http\Controllers;

use App\Models\AdmissionSeat;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\Notice;
use App\Models\PaperSubType;
use App\Models\StudentDetails;
use App\Models\User;
use App\Notifications\UucNotice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class AjaxController extends Controller
{
    public function paperSubtype(Request $request)
    {
        $data = PaperSubType::where('paper_type_id', $request->paper_type)->get();
        return response()->json($data);
    }
    public function getCourse(Request $request)
    {
        $course = Course::where('course_for', $request->dep_id)->get();
        return response()->json($course);
    }

    public function publishNotice(Request $request)
    {
        /*
        College-Exam-Section = 13
        College-Academic-Section = 14
        Academic-Section = 10
        Exam-Section = 12
        Student = 3
        UUC-Exam-Section = 17
        UUC-Academic-Section = 16
        */

        $check = Notice::where([['id', $request->id], ['status', 0]])->count();
        if ($check == 1) {
            Notice::where('status', 0)
                ->where('id', $request->id)
                ->update(['status' => 1, 'published_date' => Carbon::now()]);
            $notice = Notice::find($request->id);
            $status = "Published";
            if ($notice->notice_sub_type == 1) {
                //academic
                $users = User::whereIn('role_id', [14])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    
                    $user->notify(new UucNotice());
                }
            } elseif ($notice->notice_sub_type == 2) {
                //exam

                $users = User::whereIn('role_id', [13, 14])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            } elseif ($notice->notice_sub_type == 3) {
                $users = User::whereIn('role_id', [3])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            } elseif ($notice->notice_sub_type == 4) {
                $users = User::whereIn('role_id', [3, 13, 14])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            }

            // $user->notify(new Notice());
        }
        /* else {
            Notice::where('status', 1)
                ->where('id', $request->id)
                ->update(['status' => 0]);
            $notice = Notice::find($request->id);
            $status = "Not-Published";
        }

        $result = array(
            'code' => 200,
            'status' => $status,
            'data' => $notice
        ); */
        // return response()->json($result);
        return response()->json('success');
    }

    public function courseDetails(Request $request)
    {
        $course =  AdmissionSeat::where('clg_id', $request->clg_id)
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('admission_year', date('Y'))
            ->get(['admission_seats.total_strength as strength', 'courses.name', 'courses.main_course_code as course_code']);
        return response()->json($course);
    }

    public function updateProfileImage(Request $request){
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/profile-photo'), $filename);
            $profile = 'student-documents/profile-photo/' . $filename;
            $student_id = Auth::user()->student_id;
            $data = StudentDetails::find($student_id);

            if ($data->profile_picture) {
                unlink($data->profile_picture);
            }

            $data->profile_picture = $profile;
            $data->save();
        }

        return response()->json('success',200);
    }
}
