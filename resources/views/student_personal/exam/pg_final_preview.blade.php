@extends('layouts.app')
@section('content')
<style>
    .print_div table tbody td {
        padding: 10px;
        text-align: justify;
        line-height: 25px;
    }

    .print_div {
        display: none;
    }

    .print_new {
        display: none;
    }

    @media print {

        /* .print_div {
                display: block;
            } */
        .print_old {
            display: none;
        }

        .print_new {
            display: block;
        }

        .container2 {
            
            margin: auto;
        }

        input {
            outline: none;
            width: 100%;
            overflow: visible;
            box-shadow: none;
            background: transparent;
            border: none;
            border-bottom: 1px solid black;
        }

        * {
            margin: 0;
            padding: 0;
            /* border: 1px solid red; */
        }


        .photo {
            display: flex;
        }

        .mg {
            width: 80%;
        }

        .mg h1,
        h3,
        h2 {
            text-align: center;
        }

        .mg p {
            margin-left: 225px;
        }
    }
</style>
    {{-- {{dd($studentdetails)}} --}}
    <div class="row print_old">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Regular Examination Application (PG)
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="logo-2 none-2" style="text-align: center">
                            <a href="login-25.html">
                                <img src="{{ asset('backend/img/logo.jpg') }}" alt="logo">
                            </a>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Student Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>


                                                <tr>
                                                    <th>Name : </th>
                                                    <td>{{ $student_details->name }}</td>
                                                    <th>Mobile No :</th>
                                                    <td>{{ $student_details->mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Father's Name : </th>
                                                    <td>{{ $student_details->father_name }}</td>
                                                    <th>Mother's name :</th>
                                                    <td>{{ $student_details->mother_name }}</td>
                                                </tr>
                                                <tr>
                
                                                    <th colspan="2">Local Address : </th>
                                                    <th colspan="2">Permanent Address</th>
                                                </tr>
                                                <tr>
                                                    @php
                                                        $permanent_address = trim($student_address->permanent_address . ' , ' . $student_address->permanentDistrict->district_name . ' , ' . $student_address->permanent_pin_code . ' , ' . $student_address->permanent_state);
                                                        //dd($permanent_address);
                                                    @endphp
                                                    <td colspan="2">
                                                        {{ $student_address->present_address }},{{ $student_address->presentDistrict->district_name }},{{ $student_address->present_pin_code }},{{ $student_address->present_state }}
                                                    </td>
                                                    <td colspan="2">{{ $permanent_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Caste Category : </th>
                                                    <td>{{ $student_details->cast }}</td>
                                                    <th>Nationality : </th>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                              

                            </div>
                        </div>
                        <div
                        class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                        <h6 class="text-light">
                            Student Details
                        </h6>
                    </div>
                    <div class="panel-tag border-left-0">
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="table-responsive">
                                    <table class="table table-bordered">

                                        <tbody>

                                            <tr>
                                                <th>Student Name</th>
                                                <th>College Name</th>
                                                <th>Batch_Year</th>
                                            </tr>
                                            <tr>
                                                <td>{{ $pgstd->pgexamstd->name }}</td>
                                                <td>{{ $pgstd->college_name }}</td>
                                                <td>{{ $pgstd->batch_year }}</td>
                                            </tr>
                                          
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Appearing Examination
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">

                                            <tbody>

                                                <tr>
                                                <th>Roll No</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                                </tr>
                                              
                                                    <tr>
                                                        <td>{{ $personal_information->partIexam->roll1 }}</td>
                                                        <td>{{ $personal_information->partIexam->month1 }}</td>
                                                        <td>{{ $personal_information->partIexam->year1 }}</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $personal_information->partIIexam->roll2 }}</td>
                                                        <td>{{ $personal_information->partIIexam->month2 }}</td>
                                                        <td>{{ $personal_information->partIIexam->year2 }}</td>
                                                      

                                                    </tr>
                                               

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Previous Examination Appearance
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            {{-- {{-- <tbody> --}}


                                            <tr>
                                                <th>Roll No</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                            </tr>



                                        

                                            
                                            <tr>
                                                <td>{{ $previousexamappearance->partIexam->roll3 }}</td>
                                                <td>{{ $previousexamappearance->partIexam->month3 }}</td>
                                                <td>{{ $previousexamappearance->partIexam->year3 }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $previousexamappearance->partIIexam->roll4 }}</td>
                                                <td>{{ $previousexamappearance->partIIexam->month4 }}</td>
                                                <td>{{ $previousexamappearance->partIIexam->year4 }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $previousexamappearance->whole->roll5 }}</td>
                                                <td>{{ $previousexamappearance->whole->month5 }}</td>
                                                <td>{{ $previousexamappearance->whole->year5 }}</td>
                                            </tr>
                                        

                                         


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Previous Academic Details
                            </h6>
                        </div>

                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>

                                                <tr>
                                                    <th>Pg ID</th>
                                                    <th>Subject Name</th>
                                                    <th>Paper Name </th>
                                                    <th>Paper Value </th>
                                                    <th>Special Paper </th>
                                                    <th>Special Paper Value </th>

                                                </tr>
                                                @foreach ($pgstdsub as $key => $value)
                                                    <tr>
                                            <td>{{ $value->pg_id }}</td>
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ $value->paper_name }}</td>
                                            <td>{{ $value->paper_value }}</td>
                                            <td>{{ $value->special_paper }}</td>
                                            <td>{{ $value->special_paper_value }}</td>
                                                    </tr>
                                                @endforeach




                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Qualification Details

                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Pg Examination Fees</th>
                                                    <td><span class="exam_fee">{{ $pgfee[5]->amount }}</span></td>
            
                                                    <th>Pg Fee for application form</th>
                                                    <td><span class="app_fee">{{ $pgfee[6]->amount }}</span></td>
                                                </tr>
                                                <tr>
                                                    {{-- <th>Pg Fee for Provisional Certificate</th>
                                                    <td><span class="center_fee">{{ $pgfee[7]->amount }}</span></td> --}}
                                                    <th>Pg Centre Charge</th>
                                                    <td><span class="centre_fee">{{ $pgfee[8]->amount }}</span></td>
                                                    <th>Pg Fees for mark Sheet</th>
                                                    <Td><span class="mark_fee">{{ $pgfee[9]->amount }}</span></Td>
                                                </tr>
                                                <tr>
            
                                                    <th>Pg Re-registration Fees</th>
                                                    <Td><span class="rereg_fee">{{ $pgfee[10]->amount }}</span></Td>
            
                                                    <th>Pg Single Paper Fees</th>
                                                    <Td><span class="paper_fee">{{ $pgfee[11]->amount }}</span></Td>
                                                    {{-- <th><b style="color: red;">Total:</b></th>
                                                    <td>
                
                                                        <span class="fee_total"><b></b></span>
                                                    </td> --}}
                                                </tr>
                                                <tr>
            
                                                    <th>Pg Fee for Provisional Certificate</th>
                                                    <td><span class="provision_fee">{{ $pgfee[7]->amount }}</span></td>
                                                    <th>Pg Late Fee</th>
                                                    <Td><span class="late_fee">{{ $pgfee[12]->amount }}</span></Td>
                                                    <th><b style="color: red;">Total:</b></th>
                                                    <td>
            
                                                        <span class="fee_total"><b></b></span>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="print_div">
                                        <h3 class="text-center mb-4">CERTIFICATIE</h3>
                                        <table class="mb-2">
                                            <tr valign=top>
                                                <td>A. </td>
                                                <td>Certified (1) that the particulars given overleaf by the candidate are
                                                    correct, (2)
                                                    that I have
                                                    verified his/ her certificates of the qualifying examination and the
                                                    registration
                                                    receipt in original,
                                                    (3) that his/ her conduct has been good, (4) that he/she has studied
                                                    diligently and
                                                    (5) that
                                                    he/she has satisfactorily passed the college periodical eaminations and
                                                    other tests
                                                    and there
                                                    is all probability of his/her passing the examination. Nothing is known
                                                    to me
                                                    against his/her
                                                    moral character. (6) that the candidate has secured the percentage of
                                                    attendance.
                                                    (7) that the
                                                    fees prescribed by the University have been paid by the candidate and
                                                    deposited.
                                                </td>
                                            </tr>
                                        </table>

                                        <table>
                                            <tr valign=top>
                                                <td>B. </td>
                                                <td>
                                                    <p>(In case of Compartmental appearance) Certified that Sri/ Smt.
                                                        --------------------- with Roll No.
                                                        appeared in Examination in --------------------------- with Roll No.
                                                        ----------------------
                                                        is eligible to appear in the subjects ----------------------
                                                        Compartmental/ Back
                                                        paper.</p>
                                                </td>
                                            </tr>
                                        </table>

                                        <table>
                                            <tr valign=top>
                                                <td>C. </td>
                                                <td>(In case of candidates who had already appeared) Certified that the
                                                    results of the
                                                    candidate
                                                    has not been withheld or he/she has not been debarred from appearing at
                                                    the present
                                                    examination for being reported to have infringed the rules of
                                                    examination
                                                    discipline.</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>



                       




                       
                        <div class="row">
                            <div class="col-md-12 text-center mt-4">


                                <button type="button" class="btn btn-primary waves-effect waves-light print_btn"
                                    onclick="window.print()">Print this page</button>
                            </div>



                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="print_new">
        <div class="container2">
            <div style="text-align: center;">
                <h3>FORM NO-17</h3>
            </div>
            <header>
                <div class="photo">
                    <div><img src="{{ asset('backend/img/favicon/favicon.png') }}" width="100px" height="100px"></div>
                    <div class="mg">
                        <h1>UTKAL UNIVERSITY OF CULTURE</h1>
                        <h3>Post Gradute Examination in_________________________</h3>
                        <h2>Whole/Part-I/Part-II</h2>
                        <P>Roll Number<input type="text" value="{{ $student_details->roll_no }}"></P>
                        <p>Regd No.<input type="text" value="{{ $student_details->regd_no }}"></p>
                        <p>(To be assigned by the University)</p>
                    </div>
                </div>
                <p style="text-align: end;">verified all particulars</p>
                <p style="text-align: end; margin-top: 25px;">Signature of Authorised Official<br>(college of Department
                    level)</p>
            </header>
            <div>
                <h2 style="text-align: center;">PARTICULARS TO BE FILLED IN BY THE CANDIDATE</h2>
            </div>
            <table>
                <tr>
                    <td>1.</td>
                    <td style="width: 30%;">Name(To be written in Block letters)</td>
                    <td style="width: 70%;"><input type="text" value="{{ $student_details->name }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>(Surname First)</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>2.</td>
                    <td style="width: 30%;">Name and Address of Father/Mother</td>
                    <td style="width: 70%;"><input type="text" value="{{ $student_details->father_name }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%; padding-left: 20%;">Guardian</td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>3.</td>
                    <td style="width: 30%;">Permanent Adress</td>
                    <td style="width: 70%;"><input type="text" value="{{ $permanent_address }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>4.</td>
                    <td style="width: 30%;">Nationality</td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>5.</td>
                    <td style="width: 30%;">(a)Whether the candidate belongs to Scheduled</td>
                    <td style="width: 70%;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;">Caste/Scheduled Tribe(Name of the Caste or</td>
                    <td style="width: 70%;"><input type="text" value="{{ $student_details->cast }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;">Tribe should be mention)</td>
                    <td style="width: 70%;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;">(b) Whether Male of Female</td>
                    <td style="width: 70%;"><input type="text" value="{{ $student_details->gender }}"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>6.</td>
                    <td style="width: 30%;">Date of Birth :(In figures)</td>
                    <td style="width: 70%;"><input type="text" value="{{ $student_details->dob }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%; padding-left: 8%;">(In Words)</td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
            </table>
           
            <table>
                <tr>
                    <td>7.</td>
                    <td style="width: 30%;">Year of passing the Matriculation Examination</td>
                    <td style="width: 70%;"><input type="text" value="{{ $edu_data->hsc->passing_year }}"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>8.</td>
                    <td style="width: 30%;">Year of Graduation (Mention the Faculty of </td>
                    <td style="width: 70%;"><input type="text" value="{{ $edu_data->graduate->passing_year }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;">Art/Science/ Commerce or any other)</td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>9.</td>
                    <td style="width: 30%;">Session of Admission in P.G. Course</td>
    
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;">(i) Name of the College/ University </td>
                    <td style="width: 70%;"><input type="text" value="{{ $edu_data->postGraduate->board }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"> (ii) Academic Session 200___</td>
                    <td style="width: 70%;"><input type="text"></td>
                </tr>
            </table>
          
            <table>
                @foreach ($pgstdsub as $key => $value)
                <tr>
                    <td>10.</td>
                    <td style="width: 30%;">Subject and papers to be offered</td>
    
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;">(a) Name of the Subject</td>
                    <td style="width: 70%;"><input type="text" value="{{ $value->subject_name }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;">(b) Name of the paper/papers</td>
                    <td style="width:70%;">Part-I<input type="text"value="{{ $value->paper_value }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width:70%;">Part-II<input type="text" value=""></td>
    
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 30%;"></td>
                    <td style="width:70%;">Whole<input type="text" value="{{ $value->special_paper_value }}"></td>
    
                </tr>
                @endforeach
            </table>
    
    
    
    
    
    
            <table>
                <tr>
                    <td>12.</td>
                    <td>The Year,Month and Roll No. of Previous appearance in case of Repeation(after passing)</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>Part-I Roll Number:</td>
                    <td style="width: 20%;"><input type="text" value="{{$previousexamappearance->partIexam->roll3}}"></td>
                    <td>Month</td>
                    <td style="width: 28%;"><input type="text" value="{{$previousexamappearance->partIexam->month3}}"></td>
                    <td>Year</td>
                    <td style="width: 28%;"><input type="text" value="{{$previousexamappearance->partIexam->year3}}"></td>
    
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>Part-II Roll Number:</td>
                    <td style="width: 20%;"><input type="text" value="{{$previousexamappearance->partIIexam->roll4}}"></td>
                    <td>Month</td>
                    <td style="width: 28%;"><input type="text" value="{{$previousexamappearance->partIIexam->month4}}"></td>
                    <td>Year</td>
                    <td style="width: 30%;"><input type="text" value="{{$previousexamappearance->partIIexam->year4}}"></td>
    
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>Whole Roll Number:</td>
                    <td style="width: 20%;"><input type="text" value="{{$previousexamappearance->whole->roll5}}"></td>
                    <td>Month</td>
                    <td style="width: 28%;"><input type="text" value="{{$previousexamappearance->whole->month5}}"></td>
                    <td>Year</td>
                    <td style="width: 28%;"><input type="text" value="{{$previousexamappearance->whole->year5}}"></td>
    
                </tr>
            </table>
            <table>
                <tr>
                    <td>13.</td>
                    <td>Amount of Fees remitted:</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(a) Examination fees</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[5]->amount}}"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(b) Fee for application form</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[6]->amount}}"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(c) Center Charge</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[7]->amount}}"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(d)Fees for mark Sheet</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[8]->amount}}"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(e) Re-registration Fees</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[9]->amount}}"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(f) Single paper fees</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[10]->amount}}"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(g) Fee for Provisional Certificate</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[11]->amount}}"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td>(h) Late Fee</td>
                    <td style="width: 2%;">Rs.</td>
                    <td style="width: 15%;"><input type="text" value="{{$pgfee[12]->amount}}"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>14.</td>
                    <td>I hereby undertake to abide by the decision of the University in regard to my result in case it is
                        found later that my admission is irregular. I, further agree that the Orissa </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Examination Act-2 of 1988 is applicable to me for this examination and I will use blue pen in all my
                        answer scripts.</td>
                </tr>
            </table>
            <div style="text-align: end; margin-top: 30px;">
                <p>Signature of the Candidate(in full)</p>
                <p>Present Address</p>
            </div>
            <table>
                <tr>
                    <td>Date</td>
                    <td><input type="text"></td>
                    <td style="width: 70%;"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 60%;"></td>
                    <td style="width: 14%;"><input type="text"></td>
                </tr>
                <tr>
                    <td style="width: 60%;"></td>
                    <td style="width: 14%;"><input type="text"></td>
                </tr>
            </table>
            <div style="text-align: center; margin: 15PX 0 15PX 0;">
                <h3>CERTIFICATE</h3>
            </div>
            <table>
                <tr>
                    <td style="width: 27%;">I certify that above mentioned name has satisfied me by the production of his/her diploma that
                        he/she has passed the Bachelor of
                        <td style="width: 10%;"><input type="text"> </td>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Examination,20</td>
                    <td><input type="text"></td>
                    <td>that he/she has
                        deligently and regularly prosecuted his/ her studies; that his/her conduct has been good; that he/she signed the above  </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td> application in my presence or before that of a person duly authorised by me in this be half; that I know nothing against his/her character; that the statement mentioned above is to be true and for any irregularity found later on shall be responsible for the same.</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 70%;"></td>
                    <td style="width: 4%;"> Signature</td>
                    <td style=" width: 26%;"><input type="text"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 70%;"></td>
                    <td style="width: 23%;">Official Designation with seal of the</td>
                </tr>
                <tr>
                    <td style="width: 70%;"></td>
                    <td style="width: 23%;">Head of the Teaching Department</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Date</td>
                    <td><input type="text"></td>
                    <td style="width: 70%;"></td>
                </tr>
            </table>
            <br>
            <hr>
            <div style="text-align:center; margin: 15px 0 15px 0;">
                <h3>INSTRUCTIONS</h3>
            </div>
            <table>
                <tr>
                    <td>1.</td>
                    <td> No application shall be entertained unless it is properly filled in all columns and submitted alongwith necessary documents in conformity with the Regulations and</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>instructions of the University.</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>2.</td>
                    <td>   No candidate shall be allowed to offer any course unit subject or paper other than those mentioned in this application provided the candidate is eligible under the </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>Regulations to offer such subject or paper.</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>3.</td>
                    <td>   No candidate shall be allowed to offer any course unit subject or paper other than those mentioned in this application provided the candidate is eligible under the </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>Regulations to offer such subject or paper.</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>4.</td>
                    <td>   No candidate shall be allowed to offer any course unit subject or paper other than those mentioned in this application provided the candidate is eligible under the </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>Regulations to offer such subject or paper.</td>
                </tr>
            </table>
        </div>

    </div>
    <!-- // upload image view -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        //alert();
        let exam_fee = parseInt($('.exam_fee').text());
        let app_fee = parseInt($('.app_fee').text());
        let centre_fee = parseInt($('.centre_fee').text());
        let mark_fee = parseInt($('.mark_fee').text());
        let rereg_fee = parseInt($('.rereg_fee').text());
        let paper_fee = parseInt($('.paper_fee').text());
        let provision_fee = parseInt($('.provision_fee').text());
        let late_fee = parseInt($('.late_fee').text());

        let fee_total = exam_fee + app_fee + centre_fee + mark_fee + rereg_fee+paper_fee+provision_fee+late_fee;
        //alert(fee_total);
        $('.fee_total b').text(fee_total);
        $('#pay_amt').val(fee_total);


    });
</script>
@endsection
