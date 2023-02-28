@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Filter <span class="fw-300"><i>Course Details</i></span>
                        
                    </h2>
                    <select name="" id="session" class="float-right">
                        @for ($i = date('Y') - 4; $i <= date('Y') + 1; $i++)
                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}
                            </option>
                        @endfor
                    </select>


                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        Department
                                    </label>
                                    <select name="" id="dep" class="form-control select2 get-course">
                                        <option value="">Choose Department</option>
                                        @foreach ($department as $item)
                                            <option value="{{ $item->id }}" data-id="{{ $item->semester }}">
                                                {{ $item->course_for }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        Course
                                    </label>
                                    <select name="" id="course" class="form-control select2">
                                        <option value="">Choose Course</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student Admission List</h5>
                    <div class="card-actions float-right">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-fade table table-bordered display no-footer datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Student Name</th>
                                    <th>Gender</th>
                                    <th>Contact No</th>
                                    <th>Application Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($application as $key => $item)
                                @php
                                    $std = json_decode($item->personal_information);

                                @endphp
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->department->course_for }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ $std ? $std->name : '' }}</td>
                                        <td>{{ $std ? $std->gender : '' }}</td>
                                        <td>{{ $std ? $std->mobile : '' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $item->statusColor() }}">{{ $item->applicationStatus() }}</span>
                                        </td>
                                        <td>
                                            @if ($item->status != 4)
                                                <a href="{{ url('student-admission/applied-application/' . $item->id) }}"
                                                    class="btn  waves-effect waves-themed btn-outline-primary">
                                                    <i class="fa-solid fa-eye"></i></a>
                                            @else
                                                <a href="{{ url('student-admission/edit/' . $item->id) }}"
                                                    class="btn  waves-effect waves-themed btn-outline-primary">
                                                    <i class="fa-solid fa-eye"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
