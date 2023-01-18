<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Notice;
use App\Models\User;
use App\Notifications\UucNotice;

class AjaxController extends Controller
{
    public function getCourse(Request $request)
    {
        $course = Course::where('course_for', $request->dep_id)->get();
        return response()->json($course);
    }

    public function publishNotice(Request $request)
    {
        //College-Exam-Section = 13
        //College-Academic-Section = 14
        //Academic-Section = 10
        //Exam-Section = 12
        //Student = 3

        $check = Notice::where([['id', $request->id], ['status', 0]])->count();
        if ($check == 1) {
            Notice::where('status', 0)
                ->where('id', $request->id)
                ->update(['status' => 1]);
            $notice = Notice::find($request->id);
            $status = "Published";
            if ($notice->notice_type == 1) {
                //academic
                $users = User::whereIn('role_id', [10, 14])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            } elseif ($notice->notice_type == 2) {
                //exam

                $users = User::whereIn('role_id', [12, 13])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            } elseif ($notice->notice_type == 3) {
                #others

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
}
