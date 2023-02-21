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
                <form method="POST" action="" id="myForm">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Paper Type <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Paper Type"
                                        name="paper_type" id="paper_type">
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                            <thead>
                                <tr class="text-dark">
                                    <th style="width: 10%;">Sl. No</th>
                                    <th style="width: 50%;">paper Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->paper_type }}</td>
                                        <td>
                                            <form action="{{ url('paper', $value->id) }}" method="post">
                                                @csrf
                                                <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#exampleModal{{ $value->id }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit"><i
                                                        class="fa fa-trash"></i></button>

                                            </form>
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


    @foreach ($data as $key => $val)
        <div class="modal fade" id="exampleModal{{ $val->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>

                    <form action="{{ url('paper', $val->id) }}" method="post">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label class="form-label">Paper Type<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Paper Type"
                                            name="paper_type" value="{{ $val->paper_type }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')
    <script>
        $("#myForm").validate({
            rules: {
                paper_type: "required",
            }
        });
    </script>
@endsection
