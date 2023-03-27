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

        @media print {
            .print_div {
                display: block;
            }
        }
    </style>
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
                            <h4 style="font-weight:500;">( APPLICATION FORM FOR ADMISSION TO EXAMINATION )</h4>

                        </div>


                        <div class="border rounded p-2 mb-4">
                            <h4>Personal Information</h4>
                            <hr>
                            <table class="table table-bordered">
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
                            </table>

                        </div>

                        
                        <div class="border rounded p-2 mb-4">
                            <h4>Student Details</h4>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                                <th>College Name</th>
                                                <th>Batch_Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>{{ $pgstd->pgexamstd->name }} </strong>
                                        </td>
                                        <td>
                                            <strong>{{ $pgstd->college_name }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $pgstd->batch_year }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>


                        <div class="border rounded p-2 mb-4">
                            <h4>Appearing Examination</h4>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>{{ $personal_information->partIexam->roll1 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $personal_information->partIexam->month1 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $personal_information->partIexam->year1 }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>{{ $personal_information->partIIexam->roll2 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $personal_information->partIIexam->month2 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $personal_information->partIIexam->year2 }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="border rounded p-2 mb-4">
                            <h4>Previous Examination Appearance</h4>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>{{ $previousexamappearance->partIexam->roll3 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $previousexamappearance->partIexam->month3 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $previousexamappearance->partIexam->year3 }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>{{ $previousexamappearance->partIIexam->roll4 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $previousexamappearance->partIIexam->month4 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $previousexamappearance->partIIexam->year4 }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>{{ $previousexamappearance->whole->roll5 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $previousexamappearance->whole->month5 }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $previousexamappearance->whole->year5 }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>


                        <div class="border rounded p-2 mb-4">
                            <h4>Pg Student Subjects</h4>

                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Pg ID</th>
                                        <th>Subject Name</th>
                                        <th>Paper Name </th>
                                        <th>Paper Value </th>
                                        <th>Special Paper </th>
                                        <th>Special Paper Value </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                    </tr>
                                </tbody>
                            </table>

                        </div>


                      

                        

                        <hr>

                        <div class="border rounded p-2 mb-4">
                            <h4>Payment Section</h4>

                            <hr>


                            <hr>
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



                        @if ($pg_app->payment_status == 0)
                            <div class="row">
                                <div class="col-md-12 text-center mt-4">
                                    <a href="{{ route('pg_payment_page', [$id]) }}"
                                        class="btn btn-warning me-1 waves-effect waves-float waves-light">Payment</a>

                                    <input type="hidden" name="pay_amt" id="pay_amt" value="">

                                    {{-- <a href="{{route('regular_exam_preview',[$id])}}"   class="btn btn-success me-1 waves-effect waves-float waves-light">Preview</a> --}}
                                    <button type="button" class="btn btn-primary waves-effect waves-light print_btn"
                                        onclick="window.print()">Print this page</button>
                                </div>



                            </div>
                        @else
                            <form action="{{ route('pg_student_app_final', [$id]) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 text-center mt-4">

                                        <button type="submit"
                                            class="btn btn-success me-1 waves-effect waves-float waves-light">Submit</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light print_btn"
                                            onclick="window.print()">Print this page</button>
                                    </div>



                                </div>
                            </form>
                        @endif












                    </div>
                </div>
            </div>


        </div>
    </div>
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
