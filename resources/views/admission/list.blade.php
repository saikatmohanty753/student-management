@extends('layouts.app')
@section('content')
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
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->department->course_for }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $item->statusColor() }}">{{ $item->applicationStatus() }}</span>
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
