@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($std_app->status == 4)
                        <div class="alert alert-danger" role="alert">
                            <strong>Admission is backed! <a href="javascript:void(0);"
                                    onclick="view_reason('{{ $std_app->remarks }}')"><u> Please view the
                                        reasons.</u></a></strong>
                        </div>
                    @endif

                    <form method="post" id="formData" enctype="multipart/form-data"
                        action="{{ url('draft-student-admission') }}">
                        @csrf
                        <input type="hidden" name="hid" value="{{ $std_app->id }}">
                        <div class="border rounded p-2 mb-2">
                            <h2>Personal Information <span class="badge badge-danger float-right fs-xs d-none seat-div">
                                    Remaing Admission <span id="remaining"></span></span>
                                <input type="hidden" name="remaining_seat" id="remaining_seat">
                            </h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-12" style="display:none;">

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-2">

                                        <div class="form-group input-cont">
                                            <label class="form-label" for="course_name">Course Name<span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control select2 chk_blank" name="course"
                                                id="course_name">
                                                <option value="">Select Course</option>
                                                @foreach ($course as $item)
                                                    <option value="{{ $item->course_id }}"
                                                        data-id="{{ $item->available_seat }}"
                                                        {{ $item->course_id == $std_app->course_id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="student_name">Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="name" type="text" class="form-control chk_blank"
                                                id="student_name" value="{{ $personal_information->name }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" type="text" class="form-control chk_blank chk_email"
                                                value="{{ $personal_information->email }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Mother's name <span
                                                    class="text-danger">*</span></label>
                                            <input name="mother_name" type="text" class="form-control chk_blank"
                                                value="{{ $personal_information->mother_name }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Father's Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="father_name" type="text" class="form-control chk_blank"
                                                value="{{ $personal_information->father_name }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="blog-edit-status">Gender <span
                                                    class="text-danger">*</span></label>
                                            {{-- <input name="father_name" type="text" class="form-control" value="{{$personal_information->gender}}"> --}}
                                            <select class="custom-select form-control chk_blank" name="gender">
                                                <option
                                                    value="Male"{{ 'Male' == $personal_information->gender ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option
                                                    value="Female"{{ 'Female' == $personal_information->gender ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                                <option
                                                    value="Other"{{ 'Other' == $personal_information->gender ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">DOB <span class="text-danger">*</span></label>
                                            <input name="dob" type="text"
                                                class="form-control datepicker-2 chk_blank chk_date"
                                                value="{{ Carbon\Carbon::parse($personal_information->dob)->format('d-m-Y') }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="cast_category">Caste Category <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control chk_blank" id="cast_category"
                                                name="cast_category">
                                                <option
                                                    value="GEN"{{ 'GEN' == $personal_information->cast ? 'selected' : '' }}>
                                                    GEN
                                                </option>
                                                <option
                                                    value="ST"{{ 'ST' == $personal_information->cast ? 'selected' : '' }}>
                                                    ST
                                                </option>
                                                <option
                                                    value="SC"{{ 'SC' == $personal_information->cast ? 'selected' : '' }}>
                                                    SC
                                                </option>
                                                <option
                                                    value="OBC"{{ 'OBC' == $personal_information->cast ? 'selected' : '' }}>
                                                    OBC
                                                </option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="blog-edit-status">If Specially Abled <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control chk_blank" id="specially_abled"
                                                name="specially_abled">
                                                <option
                                                    value="0"{{ '0' == $personal_information->specially_abled ? 'selected' : '' }}>
                                                    No</option>
                                                <option
                                                    value="1"{{ '1' == $personal_information->specially_abled ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Aadhaar No <span
                                                    class="text-danger">*</span></label>
                                            <input name="aadhaar_no" type="text"
                                                class="form-control chk_blank chk_aadhaar "
                                                value="{{ $personal_information->aadhaar_no }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                            <input name="mobile" type="text"
                                                class="form-control chk_blank chk_mobile"
                                                value="{{ $personal_information->mobile }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control">
                                    </div>
                                </div> --}}

                            </div>
                        </div>

                        <div class="border rounded p-2 mb-2">
                            <h2>Address Information</h2>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-md-12 col-12">
                                    <label class="mb-0 flex-1 text-dark fw-500">Present Address Details</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">State <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control chk_blank"
                                                        name="present_state">
                                                        <option
                                                            value="ODISHA"{{ 'ODISHA' == $present_address->present_state ? 'selected' : '' }}>
                                                            Odisha</option>
                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">District <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control chk_blank select2"
                                                        name="present_district" id="present_district">
                                                        @foreach ($district as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $present_address->present_district_id ? 'selected' : '' }}>
                                                                {{ $item->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Pincode <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control chk_blank chk_zip" name="present_pin_code"
                                                        id="present_pin_code"
                                                        value="{{ $present_address->present_pin_code }}">
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Present Address <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control chk_blank" name="present_address" id="present_address" value="">{{ $present_address->present_address }}</textarea>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="same">
                                                    <label class="custom-control-label color-info-400"
                                                        for="same">Click if
                                                        same with present address</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="subheader-titlemb-0 flex-1 text-dark fw-500">Permanent Address
                                        Details</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">State <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control chk_blank"
                                                        name="permanent_state">
                                                        <option
                                                            value="ODISHA"{{ 'ODISHA' == $permanent_address->permanent_address ? 'selected' : '' }}>
                                                            Odisha</option>
                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">District <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control select2 chk_blank"
                                                        name="permanent_district" id="permanent_district">
                                                        @foreach ($district as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $permanent_address->permanent_district_id ? 'selected' : '' }}>
                                                                {{ $item->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Pincode <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control chk_blank chk_zip"
                                                        name="permanent_pin_code" id="permanent_pin_code"
                                                        value="{{ $permanent_address->permanent_pin_code }}">
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Permanent Address <span
                                                            class="text-danger">*</span>
                                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><input type="checkbox" id="sameAddress"> Same as present</small>-->
                                                    </label>
                                                    <textarea class="form-control chk_blank" name="permanent_address" id="permanent_address" value="">{{ $permanent_address->permanent_address }}</textarea>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>


                        <div class="border rounded p-2 mb-2">
                            <h2>College Information</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Last Attended College Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="last_collage_name" type="text" class="form-control chk_blank"
                                                value="{{ $prv_clg_info->clg_name }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Year of Passing Last Exam <span
                                                    class="text-danger">*</span></label>
                                            <input name="last_passing_year" type="text"
                                                class="form-control yearPicker chk_blank"
                                                value="{{ $prv_clg_info->year_of_passing }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Last Pursued Course Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="last_course_name" type="text" class="form-control chk_blank"
                                                value="{{ $prv_clg_info->course_name }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="is_migration">Migration Certificate is
                                                availiable <span class="text-danger">*</span></label>
                                            <select class="custom-select form-control chk_blank" id="is_migration"
                                                name="is_migration">
                                                <option
                                                    value="0"{{ '0' == $prv_clg_info->is_migration_cert ? 'selected' : '' }}>
                                                    No</option>
                                                <option
                                                    value="1"{{ '1' == $prv_clg_info->is_migration_cert ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="border rounded p-2 mb-2">
                                <h2>Qualification Details</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Name of the Examinations
                                                        Passed</th>
                                                    <th width="20%">University/
                                                        Council / Board</th>
                                                    <th>Year of Passing</th>
                                                    <th>Divn. and Distn.</th>
                                                    <th>Marks secured</th>
                                                    <th>Maximum marks</th>
                                                    <th>% of Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th><input type="text" name="hsc" class="form-control"
                                                            placeholder="H.S.C. or equivalent" value="{{ $qualification_details->hsc->course}}">
                                                        <span class="help-block">(H.S.C. or equivalent)</span>
                                                    </th>
                                                    <th> <input type="text" class="form-control" name="board" value="{{ $qualification_details->hsc->board }}">

                                                    </th>
                                                    <th> <input type="text" name="hsc_passing_year"
                                                            class="form-control yearPicker" value="{{ $qualification_details->hsc->passing_year }}"> </th>
                                                    <th> <input type="text" name="division" class="form-control" value="{{ $qualification_details->hsc->division }}">
                                                    </th>
                                                    <th> <input type="text" name="hsc_mark" id="hsc_mark"
                                                            class="form-control" value="{{ $qualification_details->hsc->mark }}"> </th>
                                                    <th> <input type="text" name="total_mark" id="hsc_total_mark"
                                                            class="form-control" value="{{ $qualification_details->hsc->total }}"> </th>
                                                    <th> <input type="text" name="percentage" id="hsc_percentage"
                                                            class="form-control" value="{{ $qualification_details->hsc->percentage }}"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" name="intermediate" class="form-control"
                                                            placeholder="Intermediate + 2" value="{{ $qualification_details->intermediate->course}}"><span
                                                            class="help-block">(Intermediate + 2)</span></th>
                                                    <th> <input type="text" name="intermediate_board"
                                                            class="form-control" value="{{ $qualification_details->intermediate->board }}"> </th>
                                                    <th> <input type="text" name="intermediate_passing_year"
                                                            class="form-control yearPicker" value="{{ $qualification_details->intermediate->passing_year }}"> </th>
                                                    <th> <input type="text" name="intermediate_division"
                                                            class="form-control" value="{{ $qualification_details->intermediate->division }}"> </th>
                                                    <th> <input type="text" name="intermediate_mark"
                                                            id="intermediate_mark" class="form-control" value="{{ $qualification_details->intermediate->mark }}"> </th>
                                                    <th> <input type="text" name="intermediate_total_mark"
                                                            id="intermediate_total_mark" class="form-control" value="{{ $qualification_details->intermediate->total }}"> </th>
                                                    <th> <input type="text" name="intermediate_percentage"
                                                            id="intermediate_percentage" class="form-control" value="{{ $qualification_details->intermediate->percentage }}"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" class="form-control" name="graduate"
                                                            placeholder="Degree Exam /+3 B.Mus./B.V.A./ B.A."><span
                                                            class="help-block">(Degree Exam /+3 B.Mus./ B.V.A./
                                                            B.A.)</span></th>
                                                    <th> <input type="text" name="graduate_board"
                                                            class="form-control" value="{{ $qualification_details->graduate->board }}"> </th>
                                                    <th> <input type="text" name="graduate_passing_year"
                                                            class="form-control yearPicker" value="{{ $qualification_details->graduate->passing_year }}"> </th>
                                                    <th> <input type="text" name="graduate_division"
                                                            class="form-control" value="{{ $qualification_details->graduate->division }}"> </th>
                                                    <th> <input type="text" name="graduate_mark" id="graduate_mark"
                                                            class="form-control" value="{{ $qualification_details->graduate->mark }}"> </th>
                                                    <th> <input type="text" name="graduate_total_mark"
                                                            id="graduate_total_mark" class="form-control" value="{{ $qualification_details->graduate->total }}"> </th>
                                                    <th> <input type="text" name="graduate_percentage"
                                                            id="graduate_percentage" class="form-control" value="{{ $qualification_details->graduate->percentage }}"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" class="form-control" name="post_graduate"
                                                            placeholder="M. Mus / MVA"><span class="help-block">(M. Mus /
                                                            MVA)</span></th>
                                                    <th> <input type="text" name="post_graduate_board"
                                                            class="form-control" value="{{ $qualification_details->postGraduate->board }}"> </th>
                                                    <th> <input type="text" name="post_graduate_passing_year"
                                                            class="form-control yearPicker" value="{{ $qualification_details->postGraduate->passing_year }}"> </th>
                                                    <th> <input type="text" name="post_graduate_division"
                                                            class="form-control" value="{{ $qualification_details->postGraduate->division }}"> </th>
                                                    <th> <input type="text" name="post_graduate_mark"
                                                            id="post_graduate_mark" class="form-control" value="{{ $qualification_details->postGraduate->mark }}"> </th>
                                                    <th> <input type="text" name="post_graduate_total_mark"
                                                            id="post_graduate_total_mark" class="form-control" value="{{ $qualification_details->postGraduate->total }}"> </th>
                                                    <th> <input type="text" name="post_graduate_percentage"
                                                            id="post_graduate_percentage" class="form-control" value="{{ $qualification_details->postGraduate->percentage }}"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" class="form-control" name="other_graduate"
                                                            placeholder="Any other Qualification"><span
                                                            class="help-block">(Any other Qualification)</span></th>
                                                    <th> <input type="text" name="other_graduate_board"
                                                            class="form-control" value="{{ $qualification_details->other->board }}"> </th>
                                                    <th> <input type="text" name="other_graduate_passing_year"
                                                            class="form-control yearPicker" value="{{ $qualification_details->other->passing_year }}"> </th>
                                                    <th> <input type="text" name="other_graduate_division"
                                                            class="form-control" value="{{ $qualification_details->other->division }}"> </th>
                                                    <th> <input type="text" name="other_graduate_mark"
                                                            id="other_graduate_mark" class="form-control" value="{{ $qualification_details->other->mark }}"> </th>
                                                    <th> <input type="text" name="other_graduate_total_mark"
                                                            id="other_graduate_total_mark" class="form-control" value="{{ $qualification_details->other->total }}"> </th>
                                                    <th> <input type="text" name="other_graduate_percentage"
                                                            id="other_graduate_percentage" class="form-control" value="{{ $qualification_details->other->percentage }}"> </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div> --}}

                        <div class="border rounded p-2 mb-4">
                            <div class="border rounded p-2 mb-2">
                                <h2>Qualification Details</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Name of the Examinations
                                                        Passed</th>
                                                    <th width="20%">University/
                                                        Council / Board</th>
                                                    <th>Year of Passing</th>
                                                    <th>Month</th>
                                                    <th>Roll No</th>
                                                    <th>Divn. and Distn.</th>
                                                    <th>Marks secured</th>
                                                    <th>Maximum marks</th>
                                                    <th>% of Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="hsc"
                                                                class="form-control chk_blank"
                                                                placeholder="H.S.C. or equivalent"
                                                                value="{{ $qualification_details->hsc->course }}">
                                                                <p class="help-block">(H.S.C. or equivalent)</p>
                                                                <span class="error-msg"></span>
                                                            
                                                            
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" class="form-control chk_blank"
                                                                name="board"
                                                                value="{{ $qualification_details->hsc->board }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="hsc_passing_year"
                                                                class="form-control yearPicker chk_blank"
                                                                value="{{ $qualification_details->hsc->passing_year }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <select name="hsc_passing_month"
                                                                class="form-control monthDropdown chk_blank">
                                                                <option value="">Select Month</option>
                                                                <option value="January" {{ $qualification_details->hsc->month == 'January' ? 'selected' : '' }}>January</option>
                                                                <option value="February" {{ $qualification_details->hsc->month == 'February' ? 'selected' : '' }}>February</option>
                                                                <option value="March" {{ $qualification_details->hsc->month == 'March' ? 'selected' : '' }}>March</option>
                                                                <option value="April" {{ $qualification_details->hsc->month == 'April' ? 'selected' : '' }}>April</option>
                                                                <option value="May" {{ $qualification_details->hsc->month == 'May' ? 'selected' : '' }}>May</option>
                                                                <option value="June" {{ $qualification_details->hsc->month == 'June' ? 'selected' : '' }}>June</option>
                                                                <option value="July" {{ $qualification_details->hsc->month == 'July' ? 'selected' : '' }}>July</option>
                                                                <option value="August" {{ $qualification_details->hsc->month == 'August' ? 'selected' : '' }}>August</option>
                                                                <option value="September" {{ $qualification_details->hsc->month == 'September' ? 'selected' : '' }}>September</option>
                                                                <option value="October" {{ $qualification_details->hsc->month == 'October' ? 'selected' : '' }}>October</option>
                                                                <option value="November" {{ $qualification_details->hsc->month == 'November' ? 'selected' : '' }}>November</option>
                                                                <option value="December" {{ $qualification_details->hsc->month == 'December' ? 'selected' : '' }}>December</option>
                                                            </select>


                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="hsc_roll"
                                                                class="form-control chk_blank" value="{{ $qualification_details->hsc->roll }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="division"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->hsc->division }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="hsc_mark" id="hsc_mark"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->hsc->mark }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="total_mark" id="hsc_total_mark"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->hsc->total }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="percentage" id="hsc_percentage"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->hsc->percentage }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate"
                                                                class="form-control chk_blank"
                                                                placeholder="Intermediate + 2"
                                                                value="{{ $qualification_details->intermediate->course }}"><p
                                                                class="help-block">(Intermediate + 2)</p>
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate_board"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->intermediate->board }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate_passing_year"
                                                                class="form-control yearPicker chk_blank"
                                                                value="{{ $qualification_details->intermediate->passing_year }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <select name="intermediate_passing_month"
                                                                class="form-control monthDropdown chk_blank">
                                                                <option value="">Select Month</option>
                                                                <option value="January" {{ $qualification_details->intermediate->month == 'January' ? 'selected' : '' }}>January</option>
                                                                <option value="February" {{ $qualification_details->intermediate->month == 'February' ? 'selected' : '' }}>February</option>
                                                                <option value="March" {{ $qualification_details->intermediate->month == 'March' ? 'selected' : '' }}>March</option>
                                                                <option value="April" {{ $qualification_details->intermediate->month == 'April' ? 'selected' : '' }}>April</option>
                                                                <option value="May" {{ $qualification_details->intermediate->month == 'May' ? 'selected' : '' }}>May</option>
                                                                <option value="June" {{ $qualification_details->intermediate->month == 'June' ? 'selected' : '' }}>June</option>
                                                                <option value="July" {{ $qualification_details->intermediate->month == 'July' ? 'selected' : '' }}>July</option>
                                                                <option value="August" {{ $qualification_details->intermediate->month == 'August' ? 'selected' : '' }}>August</option>
                                                                <option value="September" {{ $qualification_details->intermediate->month == 'September' ? 'selected' : '' }}>September</option>
                                                                <option value="October" {{ $qualification_details->intermediate->month == 'October' ? 'selected' : '' }}>October</option>
                                                                <option value="November" {{ $qualification_details->intermediate->month == 'November' ? 'selected' : '' }}>November</option>
                                                                <option value="December" {{ $qualification_details->intermediate->month == 'December' ? 'selected' : '' }}>December</option>
                                                            </select>


                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate_roll"
                                                                class="form-control chk_blank" value="{{ $qualification_details->intermediate->roll }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate_division"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->intermediate->division }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate_mark"
                                                                id="intermediate_mark" class="form-control chk_blank"
                                                                value="{{ $qualification_details->intermediate->mark }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate_total_mark"
                                                                id="intermediate_total_mark"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->intermediate->total }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="intermediate_percentage"
                                                                id="intermediate_percentage"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->intermediate->percentage }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" class="form-control chk_blank"
                                                                name="graduate"
                                                                placeholder="Degree Exam /+3 B.Mus./B.V.A./ B.A."
                                                                value="{{ $qualification_details->graduate->course }}"><p
                                                                class="help-block">(Degree Exam /+3 B.Mus./ B.V.A./
                                                                B.A.)</p>
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="graduate_board"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->graduate->board }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="graduate_passing_year"
                                                                class="form-control yearPicker chk_blank"
                                                                value="{{ $qualification_details->graduate->passing_year }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <select name="graduate_passing_month"
                                                                class="form-control monthDropdown chk_blank">
                                                                <option value="">Select Month</option>
                                                                <option value="January" {{ $qualification_details->graduate->month == 'January' ? 'selected' : '' }}>January</option>
                                                                <option value="February" {{ $qualification_details->graduate->month == 'February' ? 'selected' : '' }}>February</option>
                                                                <option value="March" {{ $qualification_details->graduate->month == 'March' ? 'selected' : '' }}>March</option>
                                                                <option value="April" {{ $qualification_details->graduate->month == 'April' ? 'selected' : '' }}>April</option>
                                                                <option value="May" {{ $qualification_details->graduate->month == 'May' ? 'selected' : '' }}>May</option>
                                                                <option value="June" {{ $qualification_details->graduate->month == 'June' ? 'selected' : '' }}>June</option>
                                                                <option value="July" {{ $qualification_details->graduate->month == 'July' ? 'selected' : '' }}>July</option>
                                                                <option value="August" {{ $qualification_details->graduate->month == 'August' ? 'selected' : '' }}>August</option>
                                                                <option value="September" {{ $qualification_details->graduate->month == 'September' ? 'selected' : '' }}>September</option>
                                                                <option value="October" {{ $qualification_details->graduate->month == 'October' ? 'selected' : '' }}>October</option>
                                                                <option value="November" {{ $qualification_details->graduate->month == 'November' ? 'selected' : '' }}>November</option>
                                                                <option value="December" {{ $qualification_details->graduate->month == 'December' ? 'selected' : '' }}>December</option>
                                                            </select>


                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="graduate_roll"
                                                                class="form-control chk_blank" value="{{ $qualification_details->graduate->roll }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="graduate_division"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->graduate->division }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="graduate_mark" id="graduate_mark"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->graduate->mark }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="graduate_total_mark"
                                                                id="graduate_total_mark" class="form-control chk_blank"
                                                                value="{{ $qualification_details->graduate->total }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="graduate_percentage"
                                                                id="graduate_percentage" class="form-control chk_blank"
                                                                value="{{ $qualification_details->graduate->percentage }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" class="form-control chk_blank"
                                                                name="post_graduate" placeholder="M. Mus / MVA"
                                                                value="{{ $qualification_details->postGraduate->course }}"><p
                                                                class="help-block">(M. Mus /
                                                                MVA)</p>
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="post_graduate_board"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->postGraduate->board }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="post_graduate_passing_year"
                                                                class="form-control yearPicker chk_blank"
                                                                value="{{ $qualification_details->postGraduate->passing_year }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <select name="post_graduate_passing_month"
                                                                class="form-control monthDropdown chk_blank">
                                                                <option value="">Select Month</option>
                                                                <option value="January" {{ $qualification_details->postGraduate->month == 'January' ? 'selected' : '' }}>January</option>
                                                                <option value="February" {{ $qualification_details->postGraduate->month == 'February' ? 'selected' : '' }}>February</option>
                                                                <option value="March" {{ $qualification_details->postGraduate->month == 'March' ? 'selected' : '' }}>March</option>
                                                                <option value="April" {{ $qualification_details->postGraduate->month == 'April' ? 'selected' : '' }}>April</option>
                                                                <option value="May" {{ $qualification_details->postGraduate->month == 'May' ? 'selected' : '' }}>May</option>
                                                                <option value="June" {{ $qualification_details->postGraduate->month == 'June' ? 'selected' : '' }}>June</option>
                                                                <option value="July" {{ $qualification_details->postGraduate->month == 'July' ? 'selected' : '' }}>July</option>
                                                                <option value="August" {{ $qualification_details->postGraduate->month == 'August' ? 'selected' : '' }}>August</option>
                                                                <option value="September" {{ $qualification_details->postGraduate->month == 'September' ? 'selected' : '' }}>September</option>
                                                                <option value="October" {{ $qualification_details->postGraduate->month == 'October' ? 'selected' : '' }}>October</option>
                                                                <option value="November" {{ $qualification_details->postGraduate->month == 'November' ? 'selected' : '' }}>November</option>
                                                                <option value="December" {{ $qualification_details->postGraduate->month == 'December' ? 'selected' : '' }}>December</option>
                                                            </select>


                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="post_graduate_roll"
                                                                class="form-control chk_blank" value="{{ $qualification_details->postGraduate->roll }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="post_graduate_division"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->postGraduate->division }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="post_graduate_mark"
                                                                id="post_graduate_mark" class="form-control chk_blank"
                                                                value="{{ $qualification_details->postGraduate->mark }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="post_graduate_total_mark"
                                                                id="post_graduate_total_mark" class="form-control chk_blank"
                                                                value="{{ $qualification_details->postGraduate->total }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="post_graduate_percentage"
                                                                id="post_graduate_percentage" class="form-control chk_blank"
                                                                value="{{ $qualification_details->postGraduate->percentage }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" class="form-control chk_blank"
                                                                name="other_graduate"
                                                                placeholder="Any other Qualification"
                                                                value="{{ $qualification_details->other->course }}"><p
                                                                class="help-block">(Any other Qualification)</p>
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_board"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->other->board }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_passing_year"
                                                                class="form-control yearPicker chk_blank"
                                                                value="{{ $qualification_details->other->passing_year }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <select name="other_graduate_passing_month"
                                                                class="form-control monthDropdown chk_blank">
                                                                <option value="">Select Month</option>
                                                                <option value="January" {{ $qualification_details->other->month == 'January' ? 'selected' : '' }}>January</option>
                                                                <option value="February" {{ $qualification_details->other->month == 'February' ? 'selected' : '' }}>February</option>
                                                                <option value="March" {{ $qualification_details->other->month == 'March' ? 'selected' : '' }}>March</option>
                                                                <option value="April" {{ $qualification_details->other->month == 'April' ? 'selected' : '' }}>April</option>
                                                                <option value="May" {{ $qualification_details->other->month == 'May' ? 'selected' : '' }}>May</option>
                                                                <option value="June" {{ $qualification_details->other->month == 'June' ? 'selected' : '' }}>June</option>
                                                                <option value="July" {{ $qualification_details->other->month == 'July' ? 'selected' : '' }}>July</option>
                                                                <option value="August" {{ $qualification_details->other->month == 'August' ? 'selected' : '' }}>August</option>
                                                                <option value="September" {{ $qualification_details->other->month == 'September' ? 'selected' : '' }}>September</option>
                                                                <option value="October" {{ $qualification_details->other->month == 'October' ? 'selected' : '' }}>October</option>
                                                                <option value="November" {{ $qualification_details->other->month == 'November' ? 'selected' : '' }}>November</option>
                                                                <option value="December" {{ $qualification_details->other->month == 'December' ? 'selected' : '' }}>December</option>
                                                            </select>


                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_roll"
                                                                class="form-control chk_blank" value="{{ $qualification_details->other->roll }}">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_division"
                                                                class="form-control chk_blank"
                                                                value="{{ $qualification_details->other->division }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_mark"
                                                                id="other_graduate_mark" class="form-control chk_blank"
                                                                value="{{ $qualification_details->other->mark }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_total_mark"
                                                                id="other_graduate_total_mark" class="form-control chk_blank"
                                                                value="{{ $qualification_details->other->total }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_percentage"
                                                                id="other_graduate_percentage" class="form-control chk_blank"
                                                                value="{{ $qualification_details->other->percentage }}">
                                                                <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="border rounded p-2 mb-4">
                                <h2>Document</h2>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Photo<span class="text-danger">*</span></label>
                                            <div class="custom-file input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_5mb_file_only"
                                                    name="profile">
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <span onclick="upload_image_view('{{ asset($documents->profile) }}');"
                                                    class="badge badge-primary mt-4" style="cursor: pointer;"
                                                    id="pdf-file">View Upload
                                                    File</span>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Aadhaar Card<span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_5mb_file_only"
                                                    name="aadhaar_card">
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <span
                                                    onclick="upload_image_view('{{ asset($documents->aadhaar_card) }}');"
                                                    class="badge badge-primary mt-4" style="cursor: pointer;"
                                                    id="pdf-file">View Upload
                                                    File</span>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">HSC Certificate <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_5mb_file_only"
                                                    name="hsc_cert">
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <span onclick="upload_image_view('{{ asset($documents->hsc_cert) }}');"
                                                    class="badge badge-primary mt-4" style="cursor: pointer;"
                                                    id="pdf-file">View Upload
                                                    File</span>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Migration Certificate</label>
                                            <div class="custom-file input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_5mb_file_only"
                                                    name="migration_cert">
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <span
                                                    onclick="upload_image_view('{{ asset($documents->migration_cert) }}');"
                                                    class="badge badge-primary mt-4" style="cursor: pointer;"
                                                    id="pdf-file">View Upload
                                                    File</span>
                                                <span class="error-msg"></span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 text-center mt-50">
                                <button type="submit"
                                    class="btn btn-info me-1 waves-effect waves-float waves-light">Preview</button>

                            </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="upload_image_view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="view_upload_image">
                        {{-- <img src="" alt="Upload_img" class="img-responsive card-img-top" id="view_upload_image">
                        <embed src="" frameborder="0" width="100%" id="view_upload_image" height="400px"> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#same').click(function() {
            if ($(this).is(':checked')) {
                let present_district = $('#present_district').val();
                let present_pin_code = $('#present_pin_code').val();
                let present_address = $('#present_address').val();
                $('#permanent_address').text(present_address);
                $('#permanent_pin_code').val(present_pin_code);
                $("#permanent_district").val(present_district).change();
            }
        });



        $("#formData").on('submit', function(e) {

            e.preventDefault();
            var validation = [];
            validation = $('#formData').scvalidateform({
                formId: 'formData'
            });
            if ($.inArray('false', validation) >= '0') {
                return false;
            } else {
                $(this)[0].submit();
            }
        });

        $('#course_name').on('change', function() {
            if (this.value != '') {
                $('.seat-div').removeClass('d-none');
                var seat = $(this).find(':selected').data('id');

                $('#remaining_seat').val(seat)
                $('#remaining').html(seat)

            } else {
                $('.seat-div').addClass('d-none');
            }
        });
        
            $('#hsc_total_mark, #hsc_mark').keyup(function() {
            var total_marks = parseFloat($('#hsc_total_mark').val());
            var obt_marks = parseFloat($('#hsc_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#hsc_percentage').val(prs_mark);
            }
        });
        $('#intermediate_total_mark, #intermediate_mark').keyup(function() {
            var total_marks = parseFloat($('#intermediate_total_mark').val());
            var obt_marks = parseFloat($('#intermediate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#intermediate_percentage').val(prs_mark);
            }
        });
        $('#graduate_total_mark, #graduate_mark').keyup(function() {
            var total_marks = parseFloat($('#graduate_total_mark').val());
            var obt_marks = parseFloat($('#graduate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#graduate_percentage').val(prs_mark);
            }
        });
        $('#post_graduate_total_mark, #post_graduate_mark').keyup(function() {
            var total_marks = parseFloat($('#post_graduate_total_mark').val());
            var obt_marks = parseFloat($('#post_graduate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#post_graduate_percentage').val(prs_mark);
            }
        });
        $('#other_graduate_total_mark, #other_graduate_mark').keyup(function() {
            var total_marks = parseFloat($('#other_graduate_total_mark').val());
            var obt_marks = parseFloat($('#other_graduate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#other_graduate_percentage').val(prs_mark);

            }
        });
    </script>
@endsection
