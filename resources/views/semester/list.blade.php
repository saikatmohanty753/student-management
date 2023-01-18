@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Semesters List for {{ $data->course_for }}</h5>
                    <div class="card-actions float-right">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-fade table table-bordered display no-footer datatable">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Sl No</th>
                                    <th style="width: 25%;">Semesters Name</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= $data->semester; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td> {{ app\Helpers\Helpers::number($i) }} Semester</td>
                                        <td><a href="{{ route('uuc.syllabus', ['id' => $data->id, 'department' => $data->course_for, 'sem' => $i])}}" class="btn btn-outline-info">Syllabus</a></td>
                                    </tr>
                                @endfor
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
