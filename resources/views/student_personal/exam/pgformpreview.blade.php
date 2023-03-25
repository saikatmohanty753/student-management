@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Preview Application Details
                    </h2>
                </div>
                <div class="panel-container show">
                    {{-- <div class="panel-content"> --}}

                    <div class="panel-tag border-left-0">
                        {{-- <div class="row">
                            <div class="col-md-12 d-flex">
                                <div class="table-responsive">
                                    <table class="table table-clean table-sm align-self-end">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>Name of Father</th>
                                                <th>Name of Mother</th>
                                                <th>Caste Category</th>
                                                    <th>Nationality</th>
                                                    <th>Address</th>
                                                    <th>Gender</th>
                                                    <th>Date of Birth</th>
                                                    <th>Year of Passing Matriculation</th>
                                                    <th>Year of Graduation</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>{{ $student_details->name }} </strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $student_details->father_name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $student_details->mother_name }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $student_details->cast }}</strong>
                                                </td>
                                                <td>
                                                    <strong></strong>
                                                </td>
                                                <td>
                                                    <strong>{{$student_address->permanent_address}}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $student_details->gender }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{$student_details->dob}}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{$edu_data->hsc->passing_year}}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{$edu_data->graduate->passing_year}}</strong>
                                                </td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                Personal Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">
                                <div class="col-sm-6 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>

                                                <tr>

                                                    <td>
                                                        Name<strong>: {{ $student_details->name }}</strong>
                                                    </td>
                                                    <td>
                                                        Name of Father<strong>:{{ $student_details->father_name }} </strong>
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td>
                                                        Nationality<strong>:
                                                        </strong>
                                                    </td>

                                                    <td>
                                                        Address<strong>:{{ $student_address->permanent_address }} </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- <td>
                                                        Year of Passing
                                                        Matriculation<strong>:{{ $edu_data->hsc->passing_year }}</strong>
                                                    </td>
                                                    <td>
                                                        Year of Graduation<strong>:{{ $edu_data->graduate->passing_year }}
                                                        </strong>
                                                    </td> --}}
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-6 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Name of Mother <strong>:{{ $student_details->mother_name }}
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        Caste Category <strong>:{{ $student_details->gender }}
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gender <strong>:{{ $student_details->gender }} </strong>
                                                    </td>
                                                    <td>
                                                        Date of Birth <strong>:{{ $student_details->dob }} </strong>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                        <td>
                                                            Aadhar No <strong>:
                                                            </strong>
                                                        </td>
                                                    </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div
                        class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                        <h6 class="text-light">
                            Student Details
                        </h6>
                    </div>
                    <div class="panel-tag border-left-0">
                        <div class="row">
                            <div class="col-sm-12 d-flex">
                                <div class="table-responsive">
                                    <table class="table table-clean table-sm align-self-end">
                                        <tbody>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>College Name</th>
                                                <th>Batch_Year</th>
                                            </tr>
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
                            </div>

                        </div>
                    </div>
                    <div
                        class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                        <h6 class="text-light">
                            Appearing Examination
                        </h6>
                    </div>
                    <div class="panel-tag border-left-0">
                        <div class="row">
                            <div class="col-sm-12 d-flex">
                                <div class="table-responsive">
                                    <table class="table table-clean table-sm align-self-end">
                                        <tbody>
                                            <tr>
                                                <th>Roll No</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                            </tr>
                                            
                                            <tr>
                                                
                                                <td>
                                                    <strong>{{ $personal_information->partIexam->roll1 }} </strong>
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
                                                    <strong>{{ $personal_information->partIIexam->roll2 }} </strong>
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
                            </div>
                        </div>
                    </div>

                    <div
                        class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                        <h6 class="text-light">
                            Previous Examination Appearance
                        </h6>
                    </div>
                    <div class="panel-tag border-left-0">
                        <div class="row">
                            <div class="col-sm-12 d-flex">
                                <div class="table-responsive">
                                    <table class="table table-clean table-sm align-self-end">
                                        <tbody>
                                            <tr>
                                                <th>Roll No</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>{{ $previousexamappearance->partIexam->roll3 }} </strong>
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
                                                    <strong>{{ $previousexamappearance->partIIexam->roll4 }} </strong>
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
                                                    <strong>{{ $previousexamappearance->whole->roll5 }} </strong>
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
                            </div>
                        </div>
                    </div>

                    <div
                        class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                        <h6 class="text-light">
                            Pg Student Subjects
                        </h6>
                    </div>
                    <div class="panel-tag border-left-0">
                        <div class="row">
                            <div class="col-sm-12 d-flex">
                                <div class="table-responsive">
                                    <table class="table table-clean table-sm align-self-end">
                                        <tbody>
                                            <tr>
                                                <th>Pg ID</th>
                                                <th>Subject Name</th>
                                                <th>Paper Name </th>
                                                <th>Paper Value </th>
                                                <th>Special Paper </th>
                                                <th>Special Paper Value </th>
                                            </tr>
                                            

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
                            </div>
                        </div>
                    </div>

                    {{-- <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                Amout of Fees Remitted
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">
                                <div class="col-sm-12 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <th>Examination fees</th>
                                                    <th>Fee for application form</th>
                                                    <th>Centre Charge</th>
                                                    <th>Fees for mark Sheet</th>
                                                    <th>Re-registration Fees</th>
                                                    <th>Single Paper Fees</th>
                                                    <th>Fee for Provisional Certificate</th>
                                                    <th>Late Fee</th>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

    <form action="" method="post" id="myForm">
        @csrf
        <div class="d-print-none mt-4">
            <div class="text-end">

                <a href="{{ route('pgformdraft', ['id' => $pgid]) }}" class="btn btn-primary me-10"><i
                        class="fa-solid fa-pen-to-square"></i>
                    Edit</a>
                {{-- <button type="submit" class="btn btn-info"><i class="fa-solid fa-share-from-square"></i>
                        Submit</button> --}}
                <a href="{{ url('/pg-exam-notice') }}" class="btn btn-primary me-10"><i
                        class="fa-solid fa-share-from-square"></i>
                    Submit</a>

            </div>
        </div>
    </form>
@endsection
