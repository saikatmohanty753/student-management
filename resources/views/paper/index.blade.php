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
                                        <td>{{ $value->name }}</td>
                                        <td>

                                            <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal"
                                                data-target="#exampleModal{{ $value->id }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>


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
