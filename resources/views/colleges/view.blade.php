@extends('layouts.app')
@section('content')
    {{-- @php
dd($students);
@endphp --}}
    {{-- <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">College List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Student Name</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Regd. No</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Mother Name</th>
                                    <th>Father Name</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->department->course_for }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ $item->regd_no }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>{{ $item->mother_name }}</td>
                                        <td>{{ $item->father_name }}</td>
                                        

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}





    <div
    class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
    <h6 class="text-light">
        Student Details
    </h6>
</div>
@foreach ($students as $key => $item)
<div class="panel-tag border-left-0">
    <div class="row">
        <div class="col-sm-6 d-flex">
            <div class="table-responsive">
                <table class="table table-clean table-sm align-self-end">
                    <tbody>
                        {{-- <tr>
                            <td>
                                Department Name:
                            </td>
                            <td>
                                <strong>PG</strong>
                            </td>
                        </tr> --}}
                        <tr>

                            <td>
                                Student Name:<strong>{{$item->name}}</strong>
                            </td>
                            <td>
                                Department:<strong>{{ $item->department->course_for }}</strong>
                            </td>

                        </tr>
                        <tr>

                            <td>
                                Course:<strong>{{ $item->course->name }}</strong>
                            </td>

                            <td>
                                Regd. No:<strong>{{ $item->regd_no }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                Email:<strong>{{ $item->email }}</strong>
                            </td>
                            <td>
                                Mobile No.:<strong>{{ $item->mobile }}</strong>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                
                                Roll No:<strong>{{ $item->roll_no }}</strong>
                            </td>

                            <td>
                                
                                Remark:<strong>{{ $item->remarks }}</strong>
                            </td>
                            
                           
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
                                Mother Name: <strong>{{ $item->mother_name }}</strong>
                            </td>
                            <td>
                                Father Name: <strong>{{ $item->father_name }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Gender: <strong>{{ $item->gender }}</strong>
                            </td>
                            <td>
                                DOB: <strong>{{ $item->dob }}</strong>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                               Caste: <strong>{{ $item->cast }}</strong>
                            </td>
                            
                            <td>
                                Aadhar Card No: <strong>{{ $item->aadhaar_no }}</strong>
                             </td>
                             
                             
                        </tr>

                        <tr>
                            <td>
                               Batch Year: <strong>{{ $item->batch_year }}</strong>
                            </td>
                             
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>

    </div>
    <a btn btn-secondary href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
</div>
        {{-- </div> --}}
        

@endforeach
@endsection
