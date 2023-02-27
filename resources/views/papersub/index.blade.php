@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Add Paper Sub Type</h5>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('/papersubtype') }}" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Paper Type</label>
                            @if (isset($Paper))
                                <select name="paper_type" id="" class="form-control select2">
                                    <option hidden value="">choose...</option>
                                    @foreach ($Paper as $s)
                                        <option value="{{ $s->id }}">{{ $s->paper_type }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Paper Sub Type</label>
                            <input type="text" class="form-control" placeholder="Enter Paper Sub Type"
                                name="paper_sub_type" id="">
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
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
                                    <th style="width: 50%;">Paper Type</th>
                                    <th style="width: 20%;">Paper Sub Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PaperSub as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->paper_type }}</td>
                                        <td>{{ $value->paper_sub_type }}</td>
                                        <td>
                                            <form action="{{ url('papersubtype', $value->id) }}" method="post">
                                                @csrf

                                                {{-- <a class="btn btn-info" href=""><i class="fa-solid fa-eye"></i></a> --}}

                                                <a class="btn btn-primary paper-sub" href="javascript:void(0)"
                                                    data-id="{{ $value->paper_type_id }}"
                                                    data-value="{{ $value->paper_sub_type }}"><i
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



    {{-- @foreach ($PaperSub as $key => $val) --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Paper Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <label>Paper Type</label>

                                <select name="paper_type" id="paper_type" class="form-control">
                                    @foreach ($Paper as $s)
                                        <option value="{{ $s->id }}">{{ $s->paper_type }}</option>
                                    @endforeach

                                </select>


                            </tr>
                            <tr>
                                <label>Paper Sub Type</label>

                                <input type="text" name="paper_sub_type" id="paper_sub_type" class="form-control">

                                </select>


                            </tr>

                        </thead>
                        <tbody class="paper-sub">

                        </tbody>
                    </table> --}}
                    <form action="{{ url('papersubtype', $s->id) }}" method="post">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>Paper Type</label>

                                        <select name="paper_type" id="paper_type" class="form-control">
                                            @foreach ($Paper as $s)
                                                <option value="{{ $s->id }}">{{ $s->paper_type }}</option>
                                            @endforeach

                                        </select>



                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label>Paper Sub Type</label>

                                        <input type="text" name="paper_sub_type" id="paper_sub_type"
                                            class="form-control">



                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" href="{{ url('/papersubtype') }}">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- @endforeach --}}
@endsection

@section('js')
    <script>
        $("#myForm").validate({
            rules: {
                paper_type: 'required',
                paper_sub_type: 'required'

            }
        });






        // function open_modal(id) {
        //     $('#exampleModal').modal('show');
        // }

        $(document).ready(function() {
            //alert(1);

            $('.paper-sub').on('click', function() {

                let paper = $(this).data('id');
                let sub_paper_type = $(this).data('value');
                // console.log(paper);
                $('#paper_sub_type').val(sub_paper_type);
                $('#paper_type option[value="' + paper + '"]').prop(
                    "selected", true).trigger("change");

                $('#exampleModal').modal('show');


            });

        });
    </script>
@endsection
