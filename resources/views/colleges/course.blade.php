@extends('layouts.app')
@section('content')

{{-- @php
dd($courseview);
@endphp --}}
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
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courseview as $key => $item)
                                    <tr>
                                        
                                        <td>{{ $item->course->name }}</td>
                                       
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
