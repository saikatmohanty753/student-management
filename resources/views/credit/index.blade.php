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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Credit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Credit" name="credit">
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
                                    <th style="width: 50%;">Credit</th>
                                    @can('credit-edit')
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($credit as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->credit }}</td>
                                        @can('credit-edit')
                                        <td>
                                            <form action="{{ url('credit', $value->id) }}" method="post">
                                                @csrf

                                                <a class="btn btn-primary edit-credit" href="javascript:void(0);"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    data-id="{{ $value->id }}" data-value="{{ $value->credit }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>

                                                @can('credit-delete')
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        </td>
                                        @endcan






                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="creditEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>

                <form action="{{ url('update-credit') }}" method="post" id="edit-credit">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="hid" id="hid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label class="form-label">Credit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Credit" name="ecredit"
                                        id="ecredit">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#myForm").validate({
            rules: {
                credit: {
                    required: true,
                    number: true,
                    min: 1,
                },

            }
        });
        $("#edit-credit").validate({
            rules: {
                ecredit: {
                    required: true,
                    number: true,
                    min: 1,
                },

            }
        });

        $('.edit-credit').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let value = $(this).data('value');
            $('#ecredit').val(value);
            $('#hid').val(id);
            $('#creditEditModal').modal('show');
        });
    </script>
@endsection
