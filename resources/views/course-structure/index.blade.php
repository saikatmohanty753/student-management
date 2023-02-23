@extends('layouts.app')
@section('content')
    <div class="row mt-5">

        <div class="col-xl-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Academic Course List</h5>
                    <div class="card-actions float-right">

                        <a class="btn btn-primary btn-sm" href="{{ url('/academic-course-structure/create') }}">
                            <i class="fa-solid fa-plus"></i> Add Course Structure</a>

                    </div>
                </div>

                <div class="card-body">

                    <table class="table table-bordered dt-table table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th colspan="7">Academic Course Structure</th>
                                <th colspan="5">Mark Structure</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Sl. No</th>
                                <th>Year</th>
                                <th>Session</th>
                                <th>Department</th>
                                <th>Course</th>
                                <th>Semester</th>
                                <th>Paper</th>
                                <th>Subject</th>
                                <th>Mid Sem Marks</th>
                                <th>End Sem Marks</th>
                                <th>Aggregate(Total)</th>
                                <th>Pass Marks</th>
                                <th>Credit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->department ? $item->department->course_for . '-' : '' }}
                                        {{ $item->session_year }}</td>
                                    <td>{{ $item->department ? $item->department->course_for : '' }}</td>
                                    <td style="width:30%;">{{ $item->course ? $item->course->name : '' }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>{{ $item->paper_code }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>{{ $item->mid_sem_mark }}</td>
                                    <td>{{ $item->end_sem_mark }}</td>
                                    <td>{{ $item->total_marks }}</td>
                                    <td>{{ $item->pass_mark }}</td>
                                    <td>{{ $item->credit }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary"
                                                    href="{{ route('academic-course-structure.edit', $item->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script></script>
    @endsection
