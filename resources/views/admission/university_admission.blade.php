@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="formData" enctype="multipart/form-data" action="{{ url('university-student-admission') }}" class="formSave">
                        @csrf
                        <div class="top_div text-center">
                            <img src="https://uuc.ac.in/wp-content/uploads/2016/11/cropped-logouuc-1.jpg" alt="">
                            <input type="hidden" name="clg_token" value="{{ $clg_id }}">
                        </div>
                        <div class="clearfix mb-2"></div>
                        <div class="border rounded p-2 mb-2">
                            <h2>Personal Information
                                <span class="badge badge-warning float-right mr-2 d-none fs-xs seat-div"> Total Seat <span
                                        id="total"></span></span>
                                <span class="badge badge-info float-right fs-xs mr-2 d-none seat-div"> Occupied Seat <span
                                        id="occupied"></span></span>
                                <span class="badge badge-danger float-right fs-xs mr-2 d-none seat-div"> Remaining Admission
                                    <span id="remaining"></span></span>
                                <input type="hidden" name="remaining_seat" id="remaining_seat">
                            </h2>

                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-12" style="display:none;">

                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="descipline">Discipline<span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control select2 chk_blank" name="course"
                                                id="descipline" onchange="getCourse(this.value)">
                                                <option value="">Select Course</option>
                                                <option value="MPA">MPA</option>
                                                <option value="MVA">MVA</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="course_name">Course Name<span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control select2 chk_blank" name="course"
                                                id="course_name" onchange="checkEmail()">
                                                <option value="">Select Course</option>
                                                @foreach ($course as $item)
                                                    <option value="{{ $item->course_id }}"
                                                        data-id="{{ $item->available_seat }}"
                                                        data-total="{{ $item->total_strength }}"
                                                        data-occupied="{{ $item->consumption_seat }}">{{ $item->name }}
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
                                                id="student_name">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" type="text" class="form-control chk_blank chk_email"
                                                id="email" onblur="checkEmail()">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Father's Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="father_name" type="text"
                                                class="form-control chk_blank alphaonly" id="father_name">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Mother's Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="mother_name" type="text"
                                                class="form-control chk_blank alphaonly" id="mother_name">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="blog-edit-status">Gender <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control chk_blank" name="gender"
                                                id="gender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">DOB <span class="text-danger">*</span></label>
                                            <input name="dob" type="text" id="dob"
                                                class="form-control datepicker-2 chk_blank chk_date">
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
                                                name="cast_category" id="cast">
                                                <option value="GEN">GEN</option>
                                                <option value="ST">ST</option>
                                                <option value="SC">SC</option>
                                                <option value="OBC">OBC</option>
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
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
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
                                                class="form-control chk_blank chk_aadhaar numeric" id="aadhaar"
                                                onkeypress="return /^[0-9]+$/i.test(event.key)" data-maxlength="12"
                                                oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
                                                min="12">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                            <input name="mobile" type="text"
                                                class="form-control chk_blank chk_mobile numeric" id="mobile"
                                                onkeypress="return /^[0-9]+$/i.test(event.key)" data-maxlength="10"
                                                oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
                                                min="10">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

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
                                                        name="present_state" id="present_state">
                                                        <option value="ODISHA">Odisha</option>

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
                                                        name="present_district" id="present_district">
                                                        @foreach ($district as $item)
                                                            <option value="{{ $item->id }}">{{ $item->district_name }}
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
                                                    <input class="form-control chk_blank chk_zip numeric"
                                                        name="present_pin_code" id="present_pin_code"
                                                        onkeypress="return /^[0-9]+$/i.test(event.key)" data-maxlength="6"
                                                        oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
                                                        min="6">
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Present Address <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control chk_blank" name="present_address" id="present_address"></textarea>
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
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="same">
                                                <label class="custom-control-label color-info-400" for="same">Click if
                                                    same with present address</label>
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
                                                        name="permanent_state" id="permanent_state">
                                                        <option value="ODISHA">Odisha</option>
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
                                                            <option value="{{ $item->id }}">
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
                                                    <input class="form-control chk_blank chk_zip numeric"
                                                        name="permanent_pin_code" id="permanent_pin_code"
                                                        onkeypress="return /^[0-9]+$/i.test(event.key)" data-maxlength="6"
                                                        oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
                                                        min="6">
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
                                                    <textarea class="form-control chk_blank" name="permanent_address" id="permanent_address"></textarea>
                                                    <span class="error-msg"></span>
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
                                                <input name="last_collage_name" type="text"
                                                    class="form-control chk_blank" id="last_collage_name">
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
                                                    class="form-control chk_blank yearPicker" id="last_passing_year">
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Last Purchased Course Name <span
                                                        class="text-danger">*</span></label>
                                                <input name="last_course_name" type="text"
                                                    class="form-control chk_blank" id="last_course_name">
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label" for="is_migration">Migration Certificate is
                                                    Availiable <span class="text-danger">*</span></label>
                                                <select class="custom-select form-control chk_blank" id="is_migration"
                                                    name="is_migration">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded p-2 mb-2">
                                <h2>Qualification Details</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Name of the Examinations
                                                        Passed</th>
                                                    <th width="20%">University/School/College</th>
                                                    <th>Year of Passing</th>
                                                    <th width="10%">Month</th>
                                                    <th width="15%">Roll No</th>
                                                    <th>Divn. and Distn.</th>
                                                    <th>Marks Secured</th>
                                                    <th>Maximum Marks</th>
                                                    <th>% of Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($depId == 1)
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc"
                                                                    class="form-control chk_blank"
                                                                    placeholder="H.S.C. or equivalent">
                                                                <p class="help-block">(H.S.C. or equivalent)</p>
                                                                <span class="error-msg"></span>

                                                            </div>



                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" class="form-control chk_blank"
                                                                    name="hsc_board">
                                                                <span class="error-msg"></span>
                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="hsc_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_mark" id="hsc_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_total_mark"
                                                                    id="hsc_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_percentage"
                                                                    id="hsc_percentage" class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate"
                                                                    class="form-control chk_blank"
                                                                    placeholder="Intermediate + 2">
                                                                <p class="help-block">(Intermediate + 2)</p><span
                                                                    class="error-msg"></span>

                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_board"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="intermediate_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_mark"
                                                                    id="intermediate_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_total_mark"
                                                                    id="intermediate_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_percentage"
                                                                    id="intermediate_percentage"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                @elseif($depId == '2')
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc"
                                                                    class="form-control chk_blank"
                                                                    placeholder="H.S.C. or equivalent">
                                                                <p class="help-block">(H.S.C. or equivalent)</p>
                                                                <span class="error-msg"></span>

                                                            </div>



                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" class="form-control chk_blank"
                                                                    name="hsc_board">
                                                                <span class="error-msg"></span>
                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="hsc_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_mark" id="hsc_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_total_mark"
                                                                    id="hsc_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_percentage"
                                                                    id="hsc_percentage" class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate"
                                                                    class="form-control chk_blank"
                                                                    placeholder="Intermediate + 2">
                                                                <p class="help-block">(Intermediate + 2)</p><span
                                                                    class="error-msg"></span>

                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_board"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="intermediate_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_mark"
                                                                    id="intermediate_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_total_mark"
                                                                    id="intermediate_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_percentage"
                                                                    id="intermediate_percentage"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" class="form-control chk_blank"
                                                                    name="graduate"
                                                                    placeholder="Degree Exam /+3 B.Mus./B.V.A./ B.A.">
                                                                <p class="help-block">(Degree Exam /+3 B.Mus./ B.V.A./
                                                                    B.A.)</p>
                                                                <span class="error-msg"></span>
                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_board"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="graduate_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_mark"
                                                                    id="graduate_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_total_mark"
                                                                    id="graduate_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_percentage"
                                                                    id="graduate_percentage"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc"
                                                                    class="form-control chk_blank"
                                                                    placeholder="H.S.C. or equivalent">
                                                                <p class="help-block">(H.S.C. or equivalent)</p>
                                                                <span class="error-msg"></span>

                                                            </div>



                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" class="form-control chk_blank"
                                                                    name="hsc_board">
                                                                <span class="error-msg"></span>
                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="hsc_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_mark" id="hsc_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_total_mark"
                                                                    id="hsc_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="hsc_percentage"
                                                                    id="hsc_percentage" class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate"
                                                                    class="form-control chk_blank"
                                                                    placeholder="Intermediate + 2">
                                                                <p class="help-block">(Intermediate + 2)</p><span
                                                                    class="error-msg"></span>

                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_board"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="intermediate_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_mark"
                                                                    id="intermediate_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_total_mark"
                                                                    id="intermediate_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="intermediate_percentage"
                                                                    id="intermediate_percentage"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" class="form-control chk_blank"
                                                                    name="graduate"
                                                                    placeholder="Degree Exam /+3 B.Mus./B.V.A./ B.A.">
                                                                <p class="help-block">(Degree Exam /+3 B.Mus./ B.V.A./
                                                                    B.A.)</p>
                                                                <span class="error-msg"></span>
                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_board"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="graduate_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_mark"
                                                                    id="graduate_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_total_mark"
                                                                    id="graduate_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="graduate_percentage"
                                                                    id="graduate_percentage"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" class="form-control chk_blank"
                                                                    name="post_graduate" placeholder="M. Mus / MVA">
                                                                <p class="help-block">(M. Mus
                                                                    /
                                                                    MVA)</p><span class="error-msg"></span>
                                                            </div>

                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="post_graduate_board"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg">
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="post_graduate_passing_year"
                                                                    class="form-control yearPicker chk_blank">
                                                                <span class="error-msg">
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <select name="post_graduate_passing_month"
                                                                    class="form-control monthDropdown chk_blank">
                                                                    <option value="">Select Month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="February">February</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>


                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="post_graduate_roll"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg"></span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="post_graduate_division"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg">
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="post_graduate_mark"
                                                                    id="post_graduate_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg">
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="post_graduate_total_mark"
                                                                    id="post_graduate_total_mark"
                                                                    class="form-control numeric chk_blank">
                                                                <span class="error-msg">
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="form-group input-cont">
                                                                <input type="text" name="post_graduate_percentage"
                                                                    id="post_graduate_percentage"
                                                                    class="form-control chk_blank">
                                                                <span class="error-msg">
                                                            </div>
                                                        </th>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" class="form-control chk_blank"
                                                                name="other_graduate"
                                                                placeholder="Any other Qualification"><span
                                                                class="error-msg"><span class="help-block">(Any other
                                                                    Qualification)</span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_board"
                                                                class="form-control chk_blank">
                                                            <span class="error-msg">
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_passing_year"
                                                                class="form-control yearPicker chk_blank">
                                                            <span class="error-msg">
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <select name="other_graduate_passing_month"
                                                                class="form-control monthDropdown">
                                                                <option value="">Select Month</option>
                                                                <option value="January">January</option>
                                                                <option value="February">February</option>
                                                                <option value="March">March</option>
                                                                <option value="April">April</option>
                                                                <option value="May">May</option>
                                                                <option value="June">June</option>
                                                                <option value="July">July</option>
                                                                <option value="August">August</option>
                                                                <option value="September">September</option>
                                                                <option value="October">October</option>
                                                                <option value="November">November</option>
                                                                <option value="December">December</option>
                                                            </select>


                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_roll"
                                                                class="form-control chk_blank">
                                                            <span class="error-msg"></span>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_division"
                                                                class="form-control chk_blank">
                                                            <span class="error-msg">
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_mark"
                                                                id="other_graduate_mark"
                                                                class="form-control numeric chk_blank">
                                                            <span class="error-msg">
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_total_mark"
                                                                id="other_graduate_total_mark"
                                                                class="form-control numeric chk_blank">
                                                            <span class="error-msg">
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="form-group input-cont">
                                                            <input type="text" name="other_graduate_percentage"
                                                                id="other_graduate_percentage"
                                                                class="form-control chk_blank">
                                                            <span class="error-msg">
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
                                            <div class="custom-file  input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_blank chk_5mb_file_only"
                                                    name="profile" id="photo">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Signatue<span class="text-danger">*</span></label>
                                            <div class="custom-file  input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_blank chk_5mb_file_only"
                                                    name="signature" id="signature">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
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
                                                    class="custom-file-input form-control chk_blank chk_5mb_file_only"
                                                    name="aadhaar_card" id="aadhaar_card">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
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
                                                    class="custom-file-input form-control chk_blank chk_5mb_file_only"
                                                    name="hsc_cert" id="hsc_cert">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Migration Certificate</label>
                                            <div class="custom-file input-cont">
                                                <input type="file" class="custom-file-input form-control"
                                                    name="migration_cert" id="migration_cert">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 text-center mt-50">
                                <button type="submit" id="button_preview"
                                    class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                                <a href="{{ route('login') }}" class="btn btn-secondary">Back</a>
                            </div>
                    </form>
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

        $('#course_name').on('change', function() {
            if (this.value != '') {
                $('.seat-div').removeClass('d-none');
                var seat = $(this).find(':selected').data('id');
                var total = $(this).find(':selected').data('total');
                var occupied = $(this).find(':selected').data('occupied');

                $('#remaining_seat').val(seat);
                $('#remaining').html(seat);
                $('#occupied').html(occupied);
                $('#total').html(total);

            } else {
                $('.seat-div').addClass('d-none');
            }
        });
    </script>
    <script>
        $("#formData").on('submit', function(e) {

            e.preventDefault();
            var validation = [];
            validation = $('#formData').scvalidateform({
                formId: 'formData'
            });
            console.log(validation);
            if ($.inArray('false', validation) >= '0') {
                return false;

            } else {
                if(confirm('Are you sure ?'))
                {
                    var html = '<button class="btn btn-info space-button" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Submitting please wait...</button>';

                    $('button[type="submit"]').after(html);

                    $('button[type="submit"]').hide();

                    $(this)[0].submit();
                }
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

        function checkEmail()
        {
            var value = $('#email').val();
            var course = $('#course_name').val();
            if(value!='')
            {
                $.ajax({
                    url:"{{ route('getEmailStatus')}}",
                    type:"POST",
                    data:{"_token":"{{ csrf_token() }}","email":value,"course":course},
                    dataType:"JSON",
                    success:function(res){
                        if(res.status == 0)
                        {
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": true,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": true,
                                "onclick": null,
                                "showDuration": 300,
                                "hideDuration": 100,
                                "timeOut": 5000,
                                "extendedTimeOut": 1000,
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr["error"](res.msg);
                            $('#email').val('');
                        }
                    }
                });
            }
        }
        function getCourse(code)
        {
            $('#course_name').empty();
            $.ajax({
                url:"{{ route('getCourse') }}",
                type:"GET",
                data:{"_token":"{{ csrf_token() }}","clg_id":{{ session()->get('clg') }},"code":code},
                dataType:"JSON",
                success:function(res)
                {
                    $('.seat-div').addClass('d-none');
                    $('#course_name').html(res.msg);
                }
            })
        }
        $('#is_migration').on('change',function(){
            if(this.value == 1)
            {
                $('#is_migration').addClass('chk_blank');
            }else{
                $('#is_migration').removeClass('chk_blank');
            }
        })
    </script>

    <script>
        $(document).ready(function() {
            // Initialize datepicker
            $(".monthPicker").datepicker({
                changeMonth: true,
                changeYear: false,
                showButtonPanel: true,
                dateFormat: 'MM'
            });
        });
    </script>
@endsection
