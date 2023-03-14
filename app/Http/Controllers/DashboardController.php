<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\CollegeAffiliation;
use App\Models\Course;
use App\Models\RenewalAffiliation;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $chk_role = $this->checkUser(Auth::user()->role_id);
        if ($chk_role == 0) {
            Auth::logout();
            return redirect('/login')->with('error', 'The username and password you entered did not match our records');
        }

        if (Auth::user()->role_id == 10) {
            return $this->academicSection();
        } elseif (Auth::user()->role_id == 11) {
            return $this->adminDashboard();
        } elseif (Auth::user()->role_id == 16) {
            return $this->uucAcademicSection();
        } elseif (Auth::user()->role_id == 18) {
            return $this->sectionOfficer();
        } elseif (Auth::user()->role_id == 14) {
            return $this->collegeAcademicSection();
        } elseif (Auth::user()->role_id == 3) {
            return $this->studentDashboard();
        } else {
            Auth::logout();
            return redirect('/login')->with('error', 'The username and password you entered did not match our records');
        }
    }

    public function checkUser($id)
    {
        $role = [3, 10, 11, 14, 16, 18];
        return in_array($id, $role) == true ? 1 : 0;
    }

    public function adminDashboard()
    {
        return view('dashboard.admin.index');
    }
    public function sectionOfficer()
    {
        return view('dashboard.section-officer.index');
    }
    public function academicSection()
    {
        return view('dashboard.academic.index');
    }
    public function examSection()
    {
        return view('dashboard.examination.index');
    }
    public function uucAcademicSection()
    {
        return view('dashboard.college-academic.index');
    }
    public function uucExamSection()
    {
        return view('dashboard.college-examination.index');
    }
    public function studentDashboard()
    {
        $data = ['email' => '', 'name' => '', 'reg_no' => ''];

        // $customPaper = array(0, 0, 567.00, 883.80);
        $pdf = PDF::loadView('pdf.student_registration_card', $data);
        $pdf->setPaper('L');
        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2, "Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text(
            $width / 35,
            $height / 2,
            'Utkal University of Culture',
            null,
            47,
            array(0, 0, 0),
            1.5,
            1.5,
            -20
        );
        
        file_put_contents('registration_card/UUC2300010.pdf', $pdf->output());

        // return $pdf->download('registration_card/UUC2300010.pdf');

        $collegeName = College::select('name')
            ->where('id', Auth::user()->clg_id)
            ->pluck('name')
            ->first();
        $std_id = Auth::user()->student_id;
        $student = StudentDetails::find($std_id);

        return view('dashboard.student.index', compact('student', 'collegeName'));
    }
    public function collegeAcademicSection()
    {
        return view('dashboard.college-academic.index');
    }
    public function collegeExamSection()
    {
        return view('dashboard.college-examination.index');
    }

}
