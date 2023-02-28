@extends('layouts.app')
@section('content')
  <div class="row">
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
