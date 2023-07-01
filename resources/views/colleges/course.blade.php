@extends('layouts.app')
@section('content')

  <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Courses</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-table">
                            <thead>
                                <tr>

                                    <th>Course</th>
                                    <th>Total Seat</th>
                                    <th>Seat Available</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course_all as $key => $item)
                                    <tr>

                                        <td>{{ $item->course->name }}</td>
                                        <td>{{$item->total_strength == '' ? 0 : $item->total_strength}}</td>
                                        <td>{{ $item->available_seat == '' ? 0 : $item->available_seat }}</td>

                                        <td><a href="{{ url('student-view/'. $item->department_id.'/'.$item->course_id) }}"
                                            class="btn  waves-effect waves-themed btn-outline-primary">
                                            <i class="fa-solid fa-eye"></i></a></td>

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
