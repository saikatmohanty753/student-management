@extends('layouts.app')
@section('content')
    <style>
        .box-body {
            padding: 30px;
        }
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form method="post" action="" id="myForm">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Department <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Department"
                                        name="course">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"
                                    style="margin-right: 8px;">Cancel</button>
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="row mt-5">

        <div class="col-xl-12">
            <div class="card">
                <table class="text-fade table table-bordered display no-footer datatable table-responsive-lg">
                    <thead>
                        <tr class="text-dark">
                            <th>Sl. No</th>
                            <th style="width: 60%;">Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->course_for }}</td>
                                <td>

                                    {{-- <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button> --}}
                                    <form action="{{ url('department', $value->id) }}" method="post">
                                        @csrf
                                       
                                        {{-- <a class="btn btn-info" href=""><i class="fa-solid fa-eye"></i></a> --}}

                                        <a class="btn btn-outline-primary" href="{{ url('department', $value->id) }}"
                                            data-toggle="modal" data-target="#exampleModal{{ $value->id }}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>

                                        @method('DELETE')

                                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @foreach ($course as $key => $val)
        <div class="modal fade" id="exampleModal{{ $val->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>

                    <form action="{{ url('department', $val->id) }}" method="post">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label class="form-label">Department <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Department"
                                            name="course" value="{{ $val->course_for }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
