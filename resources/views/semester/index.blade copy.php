@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Semesters</h5>
                    <div class="card-actions float-right">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-fade table table-bordered display no-footer datatable">
                            <thead>
                                <tr>
                                    <th style="width: 25%;">No</th>
                                    <th style="width: 25%;">Course Name</th>
                                    <th style="width: 25%;">Semesters</th>
                                    <th style="width: 25%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->course_for }}</td>
                                        <td>{{ $item->semester }}</td>
                                        <td><a href="{{ route('semester.list',['id' => $item->id, 'parameter' => $item->course_for]) }}" class="btn btn-outline-info">View Semester</a></td>
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
@section('js')
@endsection
