@extends('layouts.app')
@section('content')
    {{-- @php
dd($student_details);
@endphp --}}
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Regular Examination Application (PG)
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="none-2 text-center mb-4">
                            <h1 class="subheader-title mb-1">
                                UTKAL UNIVERSITY OF CULTURE, BHUBANESWAR
                            </h1>
                            <h4 style="font-weight:500;">( APPLICATION FORM FOR POST GRADUATE EXAMINATION )</h4>

                        </div>


                        <div class="border rounded p-2 mb-4">
                            <h4>Personal Information</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-12" style="display:none;">

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="course_name">
                                                Name <span class="text-danger">*</span>
                                            </label>
                                            <input name="name" type="text" class="form-control chk_blank"
                                                id="student_name" placeholder="Enter Full Name"
                                                value="{{ $student_details->name }}">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Name of Father <span
                                                    class="text-danger">*</span></label>
                                            <input name="father_name" type="text" class="form-control chk_blank"
                                                id="father_name" value="{{ $student_details->father_name }}">
                                            {{-- <textarea name="guardian" id="guardian" class="form-control chk_blank" cols="10" rows="2"></textarea> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Name of Mother <span
                                                    class="text-danger">*</span></label>
                                            <input name="father_name" type="text" class="form-control chk_blank"
                                                id="father_name" value="{{ $student_details->mother_name }}">
                                            {{-- <textarea name="guardian" id="guardian" class="form-control chk_blank" cols="10" rows="2"></textarea> --}}
                                        </div>
                                    </div>
                                </div>



                                {{-- <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">DOB (As per HSC Certificate) <span class="text-danger">*</span></label>
                                            <input name="dob" type="text" id="dob"
                                                class="form-control datepicker-2 chk_blank chk_date">
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="cast_category">Caste Category <span
                                                    class="text-danger">*</span></label>
                                            {{-- <select class="custom-select form-control chk_blank" id="cast_category"
                                                name="cast_category" id="cast">
                                                <option value="GEN" {{$student_details->cast == 'GEN' ? 'seleted' : ''}}>GEN</option>
                                                <option value="ST" {{$student_details->cast == 'ST' ? 'seleted' : ''}}>ST</option>
                                                <option value="SC" {{$student_details->cast == 'SC' ? 'seleted' : ''}}>SC</option>
                                                <option value="OBC" {{$student_details->cast == 'OBC' ? 'seleted' : ''}}>OBC</option>
                                            </select> --}}
                                            <input name="mother_name" type="text" class="form-control chk_blank"
                                                id="mother_name" value="{{ $student_details->cast }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="cast_category">Tribe Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="mobile" type="text"
                                                    class="form-control chk_blank chk_mobile" id="mobile">
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Nationality <span class="text-danger">*</span></label>
                                            <input name="mobile" type="text" class="form-control chk_blank  chk_mobile"
                                                id="mobile" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        @php
                                            $permanent_address = trim($student_address->permanent_address . ' , ' . $student_address->permanentDistrict->district_name . ' , ' . $student_address->permanent_pin_code . ' , ' . $student_address->permanent_state);
                                            
                                        @endphp
                                        <div class="form-group input-cont">
                                            <label class="form-label">Address <span class="text-danger">*</span></label>
                                            <textarea name="" id="" class="form-control" rows="2">
                                                {{ $permanent_address }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                                            <input name="" type="text" class="form-control chk_blank"
                                                id="" value="{{ $student_details->gender }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Date of Birth <span
                                                    class="text-danger">*</span></label>
                                            <input name="" type="text" class="form-control chk_blank"
                                                id="" value="{{ $student_details->dob }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>




                        <div class="border rounded p-2 mb-4">
                            <h4>Marticulation / H.S.C / Equivalent Information</h4>

                            <hr>
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="course_name">Name of School<span
                                                    class="text-danger">*</span></label>
                                            <input name="name" type="text" class="form-control chk_blank"
                                                id="student_name" value="{{ $edu_hsc->hsc->board }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Passing year <span
                                                    class="text-danger">*</span></label>
                                            <input name="dob" type="text" id="dob"
                                                class="form-control  chk_blank chk_date"
                                                value="{{ $edu_hsc->hsc->passing_year }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Passing Month <span
                                                    class="text-danger">*</span></label>
                                            {{-- <select class="custom-select select2 form-control" name="course">
                                                <option value="">Select Month</option>
                                                <option value="Jan">Jan</option>
                                                <option value="Feb">Feb.</option>
                                            </select> --}}
                                            <input name="dob" type="text" id="dob"
                                                class="form-control  chk_blank chk_date" value="{{ $edu_hsc->hsc->month }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="student_name">Division <span
                                                    class="text-danger">*</span></label>
                                            <input name="name" type="text" class="form-control chk_blank"
                                                id="student_name" value="{{ $edu_hsc->hsc->division }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Roll No. <span class="text-danger">*</span></label>
                                            <input name="email" type="text" class="form-control chk_blank chk_email"
                                                id="email" value="{{ $edu_hsc->hsc->roll }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">DOB (As per HSC Certificate) <span
                                                    class="text-danger">*</span></label>
                                            <input name="dob" type="text" id="dob"
                                                class="form-control chk_blank chk_date">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="border rounded p-2 mb-4">
                            <h4>Year of Graduation</h4>

                            <hr>
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="course_name">Name of College<span
                                                    class="text-danger">*</span></label>
                                            <input name="name" type="text" class="form-control chk_blank"
                                                id="student_name" value="{{ $edu_hsc->graduate->board }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Passing year <span
                                                    class="text-danger">*</span></label>
                                            <input name="dob" type="text" class="form-control chk_blank chk_date"
                                                value="{{ $edu_hsc->graduate->passing_year }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Passing Month <span
                                                    class="text-danger">*</span></label>
                                            {{-- <select class="custom-select select2 form-control" name="course">
                                                <option value="">Select Month</option>
                                                <option value="Jan">Jan</option>
                                                <option value="Feb">Feb.</option>
                                            </select> --}}
                                            <input name="dob" type="text"
                                                class="form-control  chk_blank chk_date" value="{{ $edu_hsc->graduate->month }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="student_name">Division <span
                                                    class="text-danger">*</span></label>
                                            <input name="name" type="text" class="form-control chk_blank"
                                                id="student_name" value="{{ $edu_hsc->graduate->division }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Roll No. <span class="text-danger">*</span></label>
                                            <input name="email" type="text" class="form-control chk_blank chk_email"
                                                id="email" value="{{ $edu_hsc->graduate->roll }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">DOB (As per HSC Certificate) <span
                                                    class="text-danger">*</span></label>
                                            <input name="dob" type="text" id="dob"
                                                class="form-control chk_blank chk_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <form action="{{ route('pgexamupdate', ['id' => $stu_id]) }}" id="form_dd" method="post">
                            @csrf
                            <div class="border rounded p-2 mb-4">
                                <h4>Examination Form Fill up</h4>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {{-- <label class="form-label" for="same">Whether he/she has been sent up for
                                            admission to the examination:</label> --}}
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <input type="checkbox" name="addmission_exam" id="addmission_exam"
                                            class="" required>
                                    </div> --}}
                                </div>
                                
                                <div class="row ">
                                    {{-- <div class="fw-700 mb-2 text-success">(9).Session of Admission in P.G. Course</div> --}}

                                    <div class="col-md-6 col-4">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">College Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="hidden" id="" name="pgid"
                                                    value="{{ $pgid }}">
                                                <input name="college_name" id="college_name" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-4">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <div class="form-group row">
                                                    <label for="from_date" class="col-sm-4 col-form-label">Start
                                                        Date:</label>
                                                    <div class="col-sm-8">

                                                        <input name="from_date" id="from_date" type="text"
                                                            class="form-control yearPicker" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="to_date" class="col-sm-4 col-form-label">End
                                                        Date:</label>
                                                    <div class="col-sm-8">

                                                        <input name="to_date" id="to_date" type="text"
                                                            class="form-control yearPicker" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-4">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Month Of Admission <span
                                                        class="text-danger">*</span></label>
                                                <select class="custom-select select2 form-control" name="passing_month"
                                                    id="passing_month">
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
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <div class="panel-tag mb-4">
                                       <b> <code>The year or years in which he/she enrolled previously at the Bachelor Degree Examination. please add the details below</code> </b>
                                    </div> --}}
                                        <div class="fw-700 mb-2 text-success">(10). The year or years in which he/she
                                            enrolled previously at the Bachelor Degree Examination. please add the details
                                            below:</div>
                                    </div>


                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                {{-- <label class="form-label">Year <span class="text-danger">*</span></label>
                                                <input name="bde_year" id="bde_year" type="text"
                                                    class="form-control yearPicker"> --}}
                                                <label class="form-label">Name of the Subject <span
                                                        class="text-danger">*</span></label>
                                                {{-- <input name="hidden" id="" name="" value=""
                                                    class="form-control "> --}}
                                                <input name="subject_name" id="subject_name" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Name of the Paper/Papers <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="paper" id="paper" class="form-control">
                                                        <option value="">Select a paper</option>
                                                        <option value="part-1">Part-1</option>
                                                        <option value="part-2">
                                                            Part-2</option>
                                                        <option value="whole">Whole</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Value of the Paper <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="paper_name" id="paper_name"
                                                        class="form-control" placeholder="Enter paper name"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Roll Number<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="" name="roll2"
                                                    id="roll2">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Special Paper <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="special_paper" id="special_paper" class="form-control">
                                                        <option value="">Select a paper</option>
                                                        <option value="Part-VI">
                                                            Part-VI(Group)</option>
                                                        <option value="Part-VII">
                                                            Part-VII(Group)</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Value of the Special Paper <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="special_paper_name"
                                                        id="special_paper_name" class="form-control"
                                                        placeholder="Enter paper name" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mt-4">
                                            <div class="form-group input-cont">
                                                <button type="button" id="button_BDE"
                                                    class="btn btn-primary me-1 waves-effect waves-float waves-light">Add
                                                    More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Subject_Name</th>
                                                    <th>paper_name</th>
                                                    <th>Value of the Paper</th>
                                                    <th>special_paper</th>
                                                    <th>Value of the Special Paper</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            

                                            <tbody id="addBDE"> 


                                                @foreach ($pg_sub as $key => $value)
                                                    <tr>

                                                        

                                                        <td>{{ $value->subject_name }}</td>
                                                        <td>{{ $value->paper_name }}</td>
                                                        <td>{{ $value->paper_value }}</td>
                                                        <td>{{ $value->special_paper }}</td>
                                                        <td>{{ $value->special_paper_value }}</td>
                                                        <td><button type="button"
                                                                class="btn btn-outline-warning waves-effect waves-themed btn-sm remove_field"
                                                                data-id="{{ $value->id }}">Remove</button></td>


                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fw-700 mb-2 text-success">(11). The Year,Month and roll Number of
                                            passing the:</div>
                                    </div>

                                    <div class="col-md-12">
                                        <b>Part-I Examination(incase of appearing)</b>

                                    </div>



                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Roll Number<span
                                                        class="text-danger">*</span></label>

                                                <input type="text" class="form-control"name="roll1" id="roll1"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Month<span class="text-danger">*</span></label>
                                                {{-- <input type="text" class="form-control" value="" name="month1" id="month1"> --}}
                                                <select class="custom-select select2 form-control" name="month1"
                                                    id="month1">
                                                    <option value="">Select Month</option>
                                                    <option value="Jan"
                                                        >
                                                        January</option>
                                                    <option
                                                        value="Feb">
                                                        February</option>
                                                    <option
                                                        value="Mar">
                                                        March</option>
                                                    <option
                                                        value="Apr">
                                                        April</option>
                                                    <option
                                                        value="May">
                                                        May</option>
                                                    <option
                                                        value="Jun">
                                                        June</option>
                                                    <option
                                                        value="Jul">
                                                        July</option>
                                                    <option
                                                        value="Aug">
                                                        August</option>
                                                    <option
                                                        value="Sep">
                                                        September</option>
                                                    <option
                                                        value="Oct">
                                                        October</option>
                                                    <option
                                                        value="Nov">
                                                        November</option>
                                                    <option
                                                        value="Dec">
                                                        December</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Year<span class="text-danger">*</span></label>
                                                <input name="year1" id="year1" type="text"
                                                    class="form-control yearPicker"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Part-II Examination</b>

                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Roll Number<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="roll2" id="roll2"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Month<span class="text-danger">*</span></label>
                                                {{-- <input type="text" class="form-control" value=""name="month2" id="month2" > --}}
                                                <select class="custom-select select2 form-control" name="month2"
                                                    id="month2">
                                                    <option value="">Select Month</option>
                                                    <option value="Jan"
                                                        >
                                                        January</option>
                                                    <option value="Feb"
                                                        >
                                                        February</option>
                                                    <option value="Mar"
                                                        >
                                                        March</option>
                                                    <option value="Apr"
                                                        >
                                                        April</option>
                                                    <option value="May"
                                                        >
                                                        May</option>
                                                    <option value="Jun"
                                                        >
                                                        June</option>
                                                    <option value="Jul"
                                                        >
                                                        July</option>
                                                    <option value="Aug"
                                                        >
                                                        August</option>
                                                    <option value="Sep"
                                                        >
                                                        September</option>
                                                    <option value="Oct"
                                                        >
                                                        October</option>
                                                    <option value="Nov"
                                                        >
                                                        November</option>
                                                    <option value="Dec"
                                                        >
                                                        December</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Year<span class="text-danger">*</span></label>
                                                <input name="year2" id="year2" type="text"
                                                    class="form-control yearPicker"
                                                    value="">
                                                {{-- <input type="text" class="form-control" value="" name="year2" id="year2" > --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fw-700 mb-2 text-success">(12). The Year,Month and Roll Number of
                                            Previous appearance in case of Repeating(after passing):
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Part-I Examination</b>

                                    </div>


                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Roll Number<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="roll3" id="roll3"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Month<span class="text-danger">*</span></label>
                                                {{-- <input type="text" class="form-control" value="" name="month1" id="month1"> --}}
                                                <select class="custom-select select2 form-control" name="month3"
                                                    id="month3">
                                                    <option value="">Select Month</option>
                                                    <option value="Jan"
                                                        >
                                                        January</option>
                                                    <option value="Feb"
                                                       >
                                                        February</option>
                                                    <option value="Mar"
                                                        >
                                                        March</option>
                                                    <option value="Apr"
                                                       >
                                                        April</option>
                                                    <option value="May"
                                                        >
                                                        May</option>
                                                    <option value="Jun"
                                                        >
                                                        June</option>
                                                    <option value="Jul"
                                                        >
                                                        July</option>
                                                    <option value="Aug"
                                                        >
                                                        August</option>
                                                    <option value="Sep"
                                                        >
                                                        September</option>
                                                    <option value="Oct"
                                                        >
                                                        October</option>
                                                    <option value="Nov"
                                                        >
                                                        November</option>
                                                    <option value="Dec"
                                                       >
                                                        December</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Year<span class="text-danger">*</span></label>
                                                <input name="year3" id="year3" type="text"
                                                    class="form-control yearPicker"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Part-II Examination</b>

                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Roll Number<span
                                                        class="text-danger">*</span></label>

                                                <input type="text" class="form-control" name="roll4" id="roll4"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Month<span class="text-danger">*</span></label>
                                                {{-- <input type="text" class="form-control" value=""name="month2" id="month2" > --}}
                                                <select class="custom-select select2 form-control" name="month4"
                                                    id="month4">
                                                    <option value="">Select Month</option>
                                                    <option value="Jan"
                                                       >
                                                        January</option>
                                                    <option value="Feb"
                                                       >
                                                        February</option>
                                                    <option value="Mar"
                                                       >
                                                        March</option>
                                                    <option value="Apr"
                                                        >
                                                        April</option>
                                                    <option value="May"
                                                        >
                                                        May</option>
                                                    <option value="Jun"
                                                        >
                                                        June</option>
                                                    <option value="Jul"
                                                        >
                                                        July</option>
                                                    <option value="Aug"
                                                        >
                                                        August</option>
                                                    <option value="Sep"
                                                        >
                                                        September</option>
                                                    <option value="Oct"
                                                        >
                                                        October</option>
                                                    <option value="Nov"
                                                        >
                                                        November</option>
                                                    <option value="Dec"
                                                        >
                                                        December</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Year<span class="text-danger">*</span></label>

                                                <input name="year4" id="year4" type="text"
                                                    class="form-control yearPicker"
                                                    value="">
                                                {{-- <input type="text" class="form-control" value="" name="year2" id="year2" > --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <b>Whole Examination</b>

                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Roll Number<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="roll5" id="roll5"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Month<span class="text-danger">*</span></label>
                                                {{-- <input type="text" class="form-control" value=""name="month2" id="month2" > --}}
                                                <select class="custom-select select2 form-control" name="month5"
                                                    id="month5">
                                                    <option value="">Select Month</option>
                                                    <option value="Jan"
                                                        >
                                                        January</option>
                                                    <option value="Feb"
                                                        >
                                                        February</option>
                                                    <option value="Mar"
                                                        >
                                                        March</option>
                                                    <option value="Apr"
                                                        >
                                                        April</option>
                                                    <option value="May"
                                                        >
                                                        May</option>
                                                    <option value="Jun"
                                                       >
                                                        June</option>
                                                    <option value="Jul"
                                                        >
                                                        July</option>
                                                    <option value="Aug"
                                                        >
                                                        August</option>
                                                    <option value="Sep"
                                                        >
                                                        September</option>
                                                    <option value="Oct"
                                                        >
                                                        October</option>
                                                    <option value="Nov"
                                                        >
                                                        November</option>
                                                    <option value="Dec"
                                                        >
                                                        December</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Year<span class="text-danger">*</span></label>
                                                <input name="year5" id="year5" type="text"
                                                    class="form-control yearPicker"
                                                    value="">
                                                {{-- <input type="text" class="form-control" value="" name="year2" id="year2" > --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <hr>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fw-700 mb-2 text-success">(13). Amout of Fees Remitted:</div>
                                    </div>


                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(i) Examination fees<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[5]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(ii) Fee for application form<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[6]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(iii) Centre Charge<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[7]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(iv) Fees for mark Sheet<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[8]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(v) Re-registration Fees<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[9]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(vi) Single Paper Fees<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[10]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(vii)Fee for Provisional Certificate<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[11]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">(viii) Late Fee<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $pgfee[12]->amount }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        {{-- <li class="list-group">
                                            <p>I submit the above particulars for consideration by the University
                                                authorities to -admit me for the above examination.</p>
                                        </li> --}}
                                        <li class="list-group">
                                            <p>I hereby undertake to abide by the decision of the University in regard to my
                                                result in case it is found later that my admission is irregular.I,further
                                                agree that the Orissa Examination Act-2 of 1988 is applicable to me for this
                                                examination and I will use blue pen in all my answer scripts.</p>
                                        </li>
                                    </ul>
                                </div>


                                {{-- <div class="col-md-12 text-center mt-4">
                                    <button type="submit"
                                        class="btn btn-success me-1 waves-effect waves-float waves-light">Preview</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                                </div> --}}

                                <div class="col-md-12 text-center mt-4">

                                    <button type="submit"
                                        class="btn btn-success me-1 waves-effect waves-float waves-light">Save As
                                        Draft</button>
                                    <a href="{{ route('pgformpreview', [$stu_id]) }}"
                                        class="btn btn-success me-1 waves-effect waves-float waves-light">Preview</a>
                                </div>

                        </form>
                    </div>











                </div>
            </div>
        </div>


    </div>
    </div>


    <!-- // upload image view -->
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
        $(document).ready(function() {

            // add Examined Section
            // var countOtherDocRow = 1;
            // var counterOtherDocRow = 0;

            // $('#button_examine').click(function(e) {
            //     // alert('hi');
            //     e.preventDefault();
            //     var bde_course = $('#bde_course').val();
            //     var bde_theo_prac = $('#bde_theo_prac').val();
            //     var bde_description = $('#bde_description').val();


            //     var newRow = '<tr>' +
            //         '<td>' + bde_course +
            //         '<input type="hidden" name="bde_course_hid[]" value="' +
            //         bde_course + '"></td>' +

            //         '<td>' + bde_theo_prac +
            //         '<input type="hidden" name="bde_theo_prac_hid[]" value="' +
            //         bde_theo_prac + '"></td>' +

            //         '<td>' + bde_description +
            //         '<input type="hidden" name="bde_description_hid[]" value="' +
            //         bde_description + '"></td>' +


            //         '<td><button type="button" class="btn btn-outline-warning waves-effect waves-themed btn-sm remove_field" id="' +
            //         counterOtherDocRow + '">Remove</button></td></tr>';
            //     $('#addExamined').append(newRow);
            //     countOtherDocRow++;
            //     counterOtherDocRow++;

            // });

            // $("#addExamined").on("click", ".remove_field", function(e) {
            //     // alert('1');
            //     $(this).parent('td').parent('tr').remove();
            //     counterOtherDocRow--;
            //     countOtherDocRow--;
            // });


            // End Examined Section


            var countBDE = 1;
            var counterBDERow = 0;

            $('#button_BDE').click(function(e) {
                // alert('hi');
                e.preventDefault();
                var bde_year = $('#subject_name').val();
                var bde_exam = $('#paper').val();
                var paper_name = $('#paper_name').val();
                var bde_roll_no = $('#special_paper').val();
                var special_paper = $('#special_paper_name').val();
                // var bde_regd_no = $('#bde_regd_no').val();


                var newRow = '<tr>' +
                    '<td>' + bde_year +
                    '<input type="hidden" name="bde_year_hid[]" value="' +
                    bde_year + '"></td>' +

                    '<td>' + bde_exam +
                    '<input type="hidden" name="bde_exam_hid[]" value="' +
                    bde_exam + '"></td>' +
                    '<td>' + paper_name +
                    '<input type="hidden" name="bde_paper_hid[]" value="' +
                    paper_name + '"></td>' +

                    '<td>' + bde_roll_no +
                    '<input type="hidden" name="bde_roll_no_hid[]" value="' +
                    bde_roll_no + '"></td>' +

                    '<td>' + special_paper +
                    '<input type="hidden" name="bde_special_hid[]" value="' +
                    special_paper + '"></td>' +
                    // '<td>' + bde_regd_no +
                    // '<input type="hidden" name="bde_regd_no_hid[]" value="' +
                    // bde_regd_no + '"></td>' +


                    '<td><button type="button" class="btn btn-outline-warning waves-effect waves-themed btn-sm remove_field" id="' +
                    counterBDERow + '">Remove</button></td></tr>';
                $('#addBDE').append(newRow);
                countBDE++;
                counterBDERow++;

            });

            // $("#addBDE").on("click", ".remove_field", function(e) {
            //     // alert('1');
            //     $(this).parent('td').parent('tr').remove();
            //     countBDE--;
            //     counterBDERow--;
            // });

            $("#addBDE").on("click", ".remove_field", function(e) {
                // prevent the default form submission behavior
                e.preventDefault();
                $(this).parent('td').parent('tr').remove();
                countBDE--;
                counterBDERow--;

                // get the ID of the row to be deleted
                var id = $(this).data('id');
                // alert(id);
                // set up the CSRF token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // send an AJAX request to delete the row
                $.ajax({
                    url: '/delete',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        // remove the row from the table
                        // $(this).parent('td').parent('tr').remove();
                        //     countBDE--;
                        //     counterBDERow--;

                        // display a success message (optional)
                        alert('Row deleted successfully!');
                    },
                    error: function(response) {
                        // handle the error response (optional)
                        alert('Error deleting row!');
                    }
                });
            });







        });
    </script>
@endsection
