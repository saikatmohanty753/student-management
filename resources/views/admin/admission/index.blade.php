@extends('layouts.app')
@section('content')
    <div id="panel-6" class="panel">
        <div class="panel-hdr">
            <h2>
                Applied for Admission
            </h2>

        </div>
        <div class="panel-container show">
            <div class="panel-content">

                <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#application" role="tab"
                            aria-selected="false">Not Verified</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#verified-application" role="tab"
                            aria-selected="false">Verified</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-time" role="tab"
                            aria-selected="true">Backed</a></li> --}}
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#rejected-application" role="tab"
                            aria-selected="true">Rejected</a></li>
                </ul>
                <div class="tab-content p-3">
                    <div class="tab-pane fade active show" id="application" role="tabpanel" aria-labelledby="application">
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
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->collegeName() }}</td>
                                            <td>{{ $item->department->course_for }}</td>
                                            <td>{{ $item->course->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item->statusColor() }}">{{ $item->applicationStatus() }}</span>
                                            </td>
                                            <td><a href="{{ url('/uuc-verify-admission/'. $item->id) }}" class="btn btn-outline-success waves-effect waves-themed"><i class="fa-solid fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="verified-application" role="tabpanel" aria-labelledby="verified-application">
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
                                    @foreach ($verified_application as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->collegeName() }}</td>
                                            <td>{{ $item->department->course_for }}</td>
                                            <td>{{ $item->course->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item->statusColor() }}">{{ $item->applicationStatus() }}</span>
                                            </td>
                                            <td><a href="{{ url('/uuc-applicant-admission-details/'. $item->id) }}"><i class="fa-solid fa-eye"></i> View</a></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="rejected-application" role="tabpanel" aria-labelledby="rejected-application">
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
                                    @foreach ($rejected_application as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->collegeName() }}</td>
                                            <td>{{ $item->department->course_for }}</td>
                                            <td>{{ $item->course->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item->statusColor() }}">{{ $item->applicationStatus() }}</span>
                                            </td>
                                            <td><a href="{{ url('/uuc-applicant-admission-details/'. $item->id) }}"><i class="fa-solid fa-eye"></i> View</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
