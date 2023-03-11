<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ClgNoticeController;
use App\Http\Controllers\CourseStructureController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\PaperSubTypeController;
use App\Http\Controllers\UucStudentController;
use App\Http\Livewire\Notification;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(RouteServiceProvider::HOME);
    }
    return view('auth.login');
});
Route::get('test-admission', [AdmissionController::class, 'AdmissionSeat']);

// Route::get('/student, function () {
//     return view('colleges.create_user');
// });
Route::get('/student', function () {
    return view('studentportal.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', 'prevent-back']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard']);
    Route::post('changepassword', [UserController::class, 'changepassword']);
    Route::get('profiledetails/{id}', [UserController::class, 'profiledetails']);
    Route::resource('users', UserController::class);
    Route::get('create-user/{id}', [UserController::class, 'createClgUser']);
    Route::get('edit-user/{id}', [UserController::class, 'editClgUser'])->name('college-users.edit');
    Route::post('store-user', [UserController::class, 'storeClgUser']);
    Route::post('update-user', [UserController::class, 'updateClgUser']);
    Route::get('delete-user/{id}', [UserController::class, 'deleteClgUser'])->name('college-users.delete');

    Route::resource('roles', RoleController::class);

    Route::resource('colleges', CollegeController::class);
    Route::resource('students', StudentController::class);

    Route::resource('paper', PaperController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('course', CourseController::class);
    Route::get('semester/{id}/{parameter}', [SemesterController::class, 'semesterList'])->name('semester.list');
    Route::resource('semester', SemesterController::class);
    Route::post('update-credit', [CreditController::class, 'update']);
    Route::resource('credit', CreditController::class);
    Route::resource('papersubtype', PaperSubTypeController::class);
    Route::get('uuc-syllabus/{id}/{department}/{sem}', [SyllabusController::class, 'syllabus'])->name('uuc.syllabus');
    // Route::resource('uuc-syllabus',SyllabusController::class);

    Route::get('notices', [NoticesController::class, 'index']);
    // Route::get('status/{', [NoticesController::class, 'status']);
    Route::get('add-notices', [NoticesController::class, 'create']);
    Route::post('uuc-create-notice', [NoticesController::class, 'store']);
    Route::resource('notices', NoticesController::class);
    Route::post('status', [NoticesController::class, 'status']);
    // Route::get('verified/{id}', [NoticesController::class, 'verified']);
    // Route::match(['get', 'post', 'put'], 'status', 'NoticesController');

    Route::post('/get-paper-subtype', [AjaxController::class, 'paperSubtype']);
    Route::post('course-details', [AjaxController::class, 'courseDetails']);

    Route::post('get-course', [AjaxController::class, 'getCourse']);
    Route::post('publish-notice', [AjaxController::class, 'publishNotice']);
    Route::get('notice/view/{id}', [NoticesController::class, 'show']);

    Route::get('/new-admission', [AdmissionController::class, 'newAdmission']);
    Route::get('uuc-admission/{id}/{dep}/{depId}', [AdmissionController::class, 'index']);
    Route::post('student-admission', [AdmissionController::class, 'store']);
    Route::post('student-admission/apply', [AdmissionController::class, 'apply']);

    Route::get('student-admission/preview/{id}', [AdmissionController::class, 'show']);
    Route::get('student-admission/edit/{id}', [AdmissionController::class, 'edit']);

    Route::get('student-admission/applied-application/{id}', [AdmissionController::class, 'appliedApplication']);

    Route::get('uuc-admission', [AdmissionController::class, 'admissionList']);
    Route::post('draft-student-admission', [AdmissionController::class, 'update']);

    Route::get('applied-admission-list/{dep}', [AdmissionController::class, 'collegeList']);
    Route::get('applied-admission-list/{dep}/{clg_id}', [AdmissionController::class, 'courseList']);
    Route::get('applied-admission-list/{dep}/{clg_id}/{course}', [AdmissionController::class, 'applyApplication']);

    Route::get('applied-admission-list', [AdmissionController::class, 'appliedAdmissionList']);
    Route::get('uuc-verify-admission/{id}', [AdmissionController::class, 'verifyAdmission']);
    Route::post('uuc-verify-admission', [AdmissionController::class, 'verifyStudentAdmission']);
    Route::get('uuc-applicant-admission-details/{id}', [AdmissionController::class, 'admissionDetails']);

    Route::get('academic-notices', [ClgNoticeController::class, 'index']);
    Route::get('view-notice/{id}/{notification_id}', [ClgNoticeController::class, 'show']);

    Route::resource('academic-course-structure', CourseStructureController::class);

    Route::get('maped-course', [CourseStructureController::class, 'mapedCourse']);
    Route::get('filter-course', [CourseStructureController::class, 'filterCourse']);

    Route::post('change-password', [ClgNoticeController::class, 'index']);

    Route::get('depcou', [AdmissionController::class, 'depcou']);

    // Route::get('college-students', [StudentController::class, 'clgStudents']);

    Route::get('studentdetails-view/{id}', [StudentController::class, 'studentview']);

    Route::get('college-students', [StudentController::class, 'departmentview']);

    Route::get('course-view/{department_id}', [StudentController::class, 'courseview']);

    Route::get('student-view/{department_id}/{course_id}', [StudentController::class, 'studentincourseview']);

    // Route::post('filterstudent', [StudentController::class, 'filterstudent']);

    Route::post('/daterange/filterstudent', [StudentController::class, 'filterstudent'])->name('daterange.filterstudent');

    Route::resource('uuc-students', UucStudentController::class);
    Route::get('uuc-student', [UucStudentController::class, 'uucStudent']);

    Route::get('dashboard/{id}', [AdmissionController::class, 'student']);

    Route::post('/update-profile-image', [AjaxController::class, 'updateProfileImage']);
});
