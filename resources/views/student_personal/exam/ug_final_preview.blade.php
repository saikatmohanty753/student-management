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

            * {
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            .container2 {
                /* width: 87%; */
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

            table,
            th,
            td {
                border-collapse: collapse;
            }

            table {
                width: 100%;
            }

            header {
                align-items: center;
                text-align: center;
            }

            header h2 {
                border-bottom: 2px solid black;
                width: 65%;
                margin: auto;
            }

            header h3 {
                margin-bottom: 15px;
            }

            header h1 {
                margin-bottom: 10px;
            }

            header p {
                width: 60%;
                margin: auto;
                margin-top: 20px;
            }

            .space {
                padding: 30px;
            }
        }
    </style>
    {{-- {{dd($studentdetails)}} --}}
    <div class="row print_old">


        <div class="col-xl-12">
            <div id="panel-1" class="panel">

                <div class="panel-hdr">
                    <h2>
                        Preview Regular Examination Application (UG)
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
                                                    <th colspan="2">Caste Category : </th>
                                                    <td colspan="2">{{ $student_details->cast }}</td>
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
                                Marticulation / H.S.C / Equivalent Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                       
                                            <tbody>

                                                <tr>
                                                    <th>Name of School</th>
                                                    <th>Passing year </th>
                                                    <th>Passing Month</th>
                                                    <th>Division </th>
                                                    <th>Roll No</th>
                                                    <th>DOB</th>
                                                </tr>
                                                <td>{{ $edu_hsc->board }}</td>
                                                <td>{{ $edu_hsc->passing_year }}</td>
                                                <td>{{ $edu_hsc->month }}</td>
                                                <td>{{ $edu_hsc->division }}</td>
                                                <td>{{ $edu_hsc->roll }}</td>
                                                <td></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                +2 / Intermediate Examination in Arts / Science / Commerce or any Equivalent Examination
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">

                                            <tbody>

                                                <tr>
                                                    <th>Name of College</th>
                                                    <th>Passing year </th>
                                                    <th>Passing Month</th>
                                                    <th>Division </th>
                                                    <th>Roll No</th>
                                                    <th>DOB</th>
                                                </tr>

                                                <tr>
                                                    <td>{{ $edu_intermediate->board }}</td>
                                                    <td>{{ $edu_intermediate->passing_year }}</td>
                                                    <td>{{ $edu_intermediate->month }}</td>
                                                    <td>{{ $edu_intermediate->division }}</td>
                                                    <td>{{ $edu_intermediate->roll }}</td>
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
                                BSE Exam Details
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            {{-- {{-- <tbody> --}}


                                            <tr>
                                                <th>Sl No. </th>
                                                <th>Year </th>
                                                <th>Name of Examination </th>
                                                <th>Roll No</th>
                                                <th>Regd. No. </th>
                                            </tr>



                                            <tr>

                                                @foreach ($bse_exams as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->year }}</td>
                                                <td>{{ $item->name_of_exam }}</td>
                                                <td>{{ $item->roll_no }}</td>
                                                <td>{{ $item->regd_no }}</td>

                                            </tr>
                                            @endforeach

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
                                                    <th>Course </th>
                                                    <th>Theory/Practical </th>
                                                    <th>Description</th>

                                                </tr>
                                                @foreach ($bse_examines as $item)
                                                    <tr>
                                                        <td>{{ $item->course }}</td>
                                                        <td>{{ $item->theory_practical }}</td>
                                                        <td>{{ $item->description }}</td>
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
                                Amount of Fees Remitted:
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Examination Fees</th>
                                                    <td><span class="exam_fee">{{ $fee[0]->amount }}</span></td>
                                                    <th>Center Charges</th>
                                                    <td><span class="center_fee">{{ $fee[1]->amount }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Fee For Marks</th>
                                                    <td><span class="mark_fee">{{ $fee[2]->amount }}</span></td>
                                                    <th>Other Fees</th>
                                                    <td><span class="other_fee">{{ $fee[4]->amount }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Enrolment Fees</th>
                                                    <Td><span class="enrol_fee">{{ $fee[3]->amount }}</span></Td>
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

    {{-- for print --}}

    <div class="print_new">
        <div class="container2">
            <header>
                <h3>FORM NO.-18</h3>
                <h1>UTKAL UNIVERSITY OF CULTURE,BHUBANESWAR</h1>
                <h2>APPLICATION FORM FOR ADMISSION TO EXAMINATION</h2>
                <P>Bachelor's Degree Examination in Fine Arts and Crafts/Music/1 year/ 2nd year/ 3rd year/ BDPA/BDTHS/ BFD
                    for
                    Pre Degree/ Final Degree/ Specialisation/ Art History/ Super Specialisation/ Any other (put tick marks
                    in
                    one)</P>
            </header>
            <table border="0" style="margin: 20px 0 20px 0;">
                <tr>
                    <td>Form:</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>Principal</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 86%;"><input type="text" value="{{ $student_details->collegeName() }}"></td>
                    <td style="width: 10%;">College</td>
                </tr>
                <tr>
                    <td>To:</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>The Controller of Examinations</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>Utkal University of Culture, Bhubaneswar</td>
                </tr>
                <tr>
                    <td>Sir,</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>I forward herewith an application for admission to the above examination and recommend that</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td>the
                        candidate be admitted.</td>
                </tr>

            </table>
            <div style="text-align: center; margin: 15px 0 15px 0;">
                <h1>APPLICATION</h1>
                <h3>(TO BE FILLED UP BY THE CANDIDATE ONLY)</h3>
            </div>
            <table border="0">
                <tr>
                    <td style="width: 4%;">1.</td>
                    <td style="width: 96%;">Name(to be written in block letters)</td>
                    <td></td>
                </tr>
            </table>
            <table border="0">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 9%;">(Surname first)</td>
                    <td style="width: 86%;"><input type="text" value="{{ $student_details->name }}"></td>
                </tr>
            </table>
            <table style="margin: 20px 0 20px 0;">
                <tr>
                    <td style="width: 4%;">2.</td>
                    <td style="width: 96%;">(a)Year and month of passing the Matriculation/ H.S.C or any equivalent
                        examination.</td>
                </tr>
            </table>
            <table border="0" style="margin: 20px 0 20px 0;">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 0%;">Year</td>
                    <td style="width:40% ;"><input type="text" value="{{ $edu_hsc->passing_year }}"></td>
                    <td style="width: 4%; padding-left: 5px;">Month</td>
                    <td style="width: 40%;"><input type="text" value="{{ $edu_hsc->month }}"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 2%;">(b)</td>
                    <td>Name of the school of(Matriculation/HSC/Equivalent).</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 2%;"></td>
                    <td><input type="text" value="{{ $edu_hsc->board }}"></td>
                    <td style="width: 6%; padding-left: 5px;">Division</td>
                    <td style="width: 20%;"><input type="text"b value="{{ $edu_hsc->division }}"></td>
                    <td style="width: 5%; padding-left: 5px;">Roll No.</td>
                    <td style="width: 20%;"><input type="text" value="{{ $edu_hsc->roll }}"></td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 2%;">(c)</td>
                    <td style="width: 21%;">Date of birth(as per HSC certicate):</td>
                    <td style="width: 80%;"><input type="text" value="{{ $student_details->dob }}"></td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;">3.</td>
                    <td>Year and month of passing the +2/intermediate Examination in Arts/Science/Commerce
                        or,any other Examination recognized as equivalent there to:</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 96%;">
                        <input type="text">
                    </td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 31%;">Name of the collage from which passed the
                        examination</td>

                    <td style="width: 61%;">
                        <input type="text" value="{{ $edu_intermediate->board }}">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 0%;">Division</td>
                    <td style="width:40% ;"><input type="text" value="{{ $edu_intermediate->division }}"></td>
                    <td style="width: 5%; padding-left: 5px;">Roll No.</td>
                    <td style="width: 40%;"><input type="text" value="{{ $edu_intermediate->roll }}"></td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;">4.</td>
                    <!-- <td style="width: 2%;"></td> -->
                    <td style="width: 23%;">Name and address of (a)
                        Father/Mother</td>
                    <td style="width: 80%;"><input type="text" value="{{ $student_details->father_name }}"></td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 94%;"><input type="text" value="{{ $student_address->permanent_address }}">
                    </td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width:8%;">Local Address</td>
                    <td style="width:57%;"><input type="text" value="{{ $student_address->present_address }}"></td>
                    <td style="width:4%;">Tel No.</td>
                    <td style="width:22%;"><input type="text" value="{{ $student_details->mobile }}"></td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 95%;">(Both father's and Mother's name shall be given if one is not alive)</td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;">5.</td>
                    <td>Whether the candidate belongs to any of the Scheduled Castes/ Tribes, or any
                        backward class/P.H(Name of the caste,tribe or community should be mention):</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td><input type="text" value="{{ $student_details->cast }}"></td>
                </tr>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 2%;">6.</td>
                    <td style="width: 21%;">Whether he/she has been sent up for admission to the
                        examination:</td>

                    <td style="width: 31%;">
                        <input type="text">
                    </td>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;">7.</td>
                    <td style="width: 25%;">The month and year of admission to
                        course:</td>
                    <td style="width:69%;"><input type="text"></td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;">8.</td>
                    <td>The year or years in which he/she enrolled previously at the Bachelor Degree
                        Examination. Admit Card,Mark List of each examination should be enclosed.</td>
                </tr>
            </table>


            <table border="1" cellpadding="20px">
                <tr>
                    <th>Year</th>
                    <th>Name of Examination</th>
                    <th>Roll No.</th>
                    <th>Regd. No.</th>
                </tr>
                <tr>
                    @foreach ($bse_exams as $item)
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->name_of_exam }}</td>
                        <td>{{ $item->roll_no }}</td>
                        <td>{{ $item->regd_no }}</td>
                    @endforeach
                </tr>

            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;">9.</td>
                    <td>Subjects in which he/she desires to examinted already examined:</td>
                </tr>
            </table>
            <table border="1" cellpadding="30px">
                <tr>
                    <th>Course</th>
                    <th>Theory_practical</th>
                    <th>Description</th>
                </tr>
                @foreach ($bse_examines as $item)
                    <tr>
                        <td style="text-align: left;">{{ $item->course }}</td>
                        <td style="text-align: left; padding-bottom: 40px;">{{ $item->theory_practical }}</td>
                        <td style="text-align: left;padding-bottom: 40px;">{{ $item->description }}</td>
                    </tr>
                @endforeach

            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td style="width: 4%;">10.</td>
                    <td>Amount of fees remitted</td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 12%;">(a) Examination fees</td>
                    <td style="width: 20%;"><input type="text" value="{{ $fee[0]->amount }}"></td>
                    <td style="width: 11%; padding-left: 20px;">(b) Centre Charges</td>
                    <td style="width: 20%;"><input type="text" value="{{ $fee[1]->amount }}"></td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 12%;">(c) Fee for marks</td>
                    <td style="width: 20%;"><input type="text" value="{{ $fee[2]->amount }}"></td>
                    <td style="width: 11%; padding-left: 20px;">(d) Other fees</td>
                    <td style="width: 20%;"><input type="text" value="{{ $fee[4]->amount }}"></td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 12%;">(e) Enrolment fee</td>
                    <td style="width: 20%;"><input type="text" value="{{ $fee[3]->amount }}"></td>
                    <td style="width: 11%; padding-left: 20px;">(f) Total</td>
                    <td style="width: 20%;"><span class="fee_total"><b></b></span></td>
                </tr>
            </table>
            <table style="margin: 10px 0 10px 0;">
                <tr>
                    <td>
                        <h3>Declaration by the candidate</h3>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="width: 4%;">a.</td>
                    <td>I submit the above particulars for consideration by the University authorities to admit me for the
                        above examination.</td>
                </tr>
            </table>
            <table style="margin-top: 10px;">
                <tr>
                    <td style="width: 4%;">b.</td>
                    <td>I shall not indulge in any undesirable activities which will affect the prestige of my Institution
                        of study or of Utkal University of Culture. The University authorities may impose any punishment for
                        any contravention to rule and regulations in force in the conduct of examination.</td>
                </tr>
            </table>
            <table style="margin: 25px 0 35px 0;">
                <tr>
                    <td style="width: 0%;">Date:</td>
                    <td style="width: 32%;"><input type="text"></td>
                    <td style="width: 67%; padding-left: 46%;">Signature of the Candidate in full</td>
                </tr>
            </table>
            <table style="margin: 25px 0 25px 0;">
                <tr>
                    <td style="width: 3%;">Checked by</td>

                    <td style="width: 23%; padding-left: 30%;">Present address</td>
                    <td style="width: 31%;"><input type="text" value="{{ $student_address->present_address }}"></td>
                </tr>
            </table>

            <div>
                <div style="text-align: center; margin: 15px;">
                    <h2>CERTIFICATE</h2>
                </div>
                <table>
                    <tr>
                        <td style="width: 4%;">A.</td>
                        <td style="padding-top: 20px;">Certified (1) that the particulars given overleaf by the candidate
                            are
                            correct, (2) that I have verified his/ her certificates of the qualifying examination and the
                            registration receipt in original,
                            (3) that his/ her conduct has been good, (4) that he/she has studied diligently and (5) that
                            he/she
                            has satisfactorily passed the college periodical eaminations and other tests and there is all
                            probability of his/her passing the examination. Nothing is known to me against his/her moral
                            character. (6) that the candidate has secured the percentage of attendance. (7) that the fees
                            prescribed by the University have been paid by the candidate and deposited.</td>
                    </tr>
                </table>
                <table style="margin-top: 20px;">
                    <tr>
                        <td style="width: 3%;">B.</td>
                        <td style="width: 31%;">(In case of Compartmental appearance) Certified that Sri/ Smt.</td>
                        <td style="width: 52%;"><input type="text" value="{{ $student_details->name }}"></td>
                    </tr>
                </table>
                <table style="margin: 10px 0 10px 0;">
                    <tr>
                        <td style="width: 3%;"></td>
                        <td style="width: 13%;">appeared in Examination in</td>
                        <td style="width: 39%;"><input type="text"></td>
                        <td style="width: 6%;">with Roll No.</td>
                        <td style="width: 21%;"><input type="text"></td>
                    </tr>
                </table>
                <table>

                    <tr>
                        <td style="width: 4%;"></td>
                        <td style="width: 20%;">is eligible to appear in the subjects</td>
                        <td style="width: 59%;"><input type="text"></td>
                        <td>Compartmental/ Back paper</td>
                    </tr>

                </table>
                <table style="margin-top: 20px;">
                    <tr>
                        <td style="width: 4%;">C.</td>
                        <td>(In case of candidates who had already appeared) Certified that the results of the candidate has
                            not been withheld or he/she has not been debarred from appearing at the present examination for
                            being reported to have infringed the rules of examination discipline.</td>
                    </tr>
                </table>
                <table style="margin-top: 25px;">
                    <tr>
                        <td style="width: 70%;">
                            <h4>Seal</h4>
                        </td>
                        <td style="width: 20%;"><input type="text"></td>
                        <td>
                            <h4>Principal College</h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- // upload image view -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            //alert();
            let exam_fee = parseInt($('.exam_fee').text());
            let center_fee = parseInt($('.center_fee').text());
            let mark_fee = parseInt($('.mark_fee').text());
            let other_fee = parseInt($('.other_fee').text());
            let enrol_fee = parseInt($('.enrol_fee').text());

            let fee_total = exam_fee + center_fee + mark_fee + other_fee + enrol_fee;
            //alert(fee_total);
            $('.fee_total b').text(fee_total);
            $('#pay_amt').val(fee_total);

        });
    </script>
   
@endsection
