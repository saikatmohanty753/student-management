@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Applied Application List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-fade table table-bordered display no-footer dt-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>College Name</th>
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
                                        @php
                                            $std = json_decode($item->personal_information);
                                        @endphp

                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->collegeName() }}</td>
                                        <td>{{ $item->department->course_for }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ $std ? $std->name : '' }}</td>
                                        <td>{{ $std ? $std->gender : '' }}</td>
                                        <td>{{ $std ? $std->mobile : '' }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $item->statusColor() }}">{{ $item->applicationStatus() }}</span>
                                        </td>
                                        <td><a href="{{ url('/uuc-verify-admission/' . $item->id) }}"
                                                class="btn btn-outline-success waves-effect waves-themed"><i
                                                    class="fa-solid fa-eye"></i></a>
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
