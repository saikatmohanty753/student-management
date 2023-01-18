@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create Notice</h5>
                    <div class="card-actions float-right">

                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-6 offset-md-3">
                        <form method="post" action="{{ url('uuc-create-notice') }}" id="myForm">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Notice Type<span class="text-danger">*</span></label>
                                        <select class="form-select form-control notice-type select2"
                                            aria-label="Default select example" name="notice_type">
                                            <option value="" selected>Select Notice Type</option>
                                            <option value="1" class="addmission">Addmission Notice</option>
                                            <option value="2" class="exam">Exam Notice</option>
                                            <option value="3" class="other">Other Notice</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group department d-none">
                                        <label class="form-label">Department<span class="text-danger">*</span></label>
                                        <select class="form-select form-control select2" aria-label="Default select example"
                                            name="department" id="department">
                                            <option value="" selected>Select Department</option>
                                            @foreach ($dept as $item)
                                                <option value="{{ $item->id }}">{{ $item->course_for }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group course d-none">
                                        <label class="form-label">Course<span class="text-danger">*</span></label>
                                        <select class="form-select form-control select2" aria-label="Default select example"
                                            name="course[]" id="course_name" multiple>
                                            <option value="">Select Course</option>
                                            @foreach ($course as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group semester d-none">
                                        <label class="form-label">Semester<span class="text-danger">*</span></label>
                                        <select class="form-select form-control" aria-label="Default select example" name="semester">
                                            <option value="" selected>Select Department</option>
                                            @foreach ($dept as $item)
                                                <option value="{{ $item->id }}">{{ $item->semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group start_date d-none">
                                        <label class="form-label">Start date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control datepicker-1"
                                            placeholder="Enter Department" name="start_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group end_date d-none">
                                        <label class="form-label">Expiry date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control datepicker-1"
                                            placeholder="Enter Department" name="exp_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 d-flex align-items-center justify-content-center">
                                <div class="col-md-12">
                                    <label class="form-label ">Details<span class="text-danger">*</span></label>
                                    <textarea name="details" id="" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12 text-center mb-4">
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"
                                        style="margin-right: 8px;">Cancel</button>
                                    <button type="submit"  class="btn btn-info pull-right">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.notice-type').on('change', function() {
            console.log(this.value);
            if (this.value == 2) {
                $('.department').removeClass('d-none');
                $('.course').removeClass('d-none');
                $('.semester').removeClass('d-none');
                $('.start_date').removeClass('d-none');
                $('.end_date').removeClass('d-none');
            } else if (this.value == 1) {
                $('.department').removeClass('d-none');
                $('.start_date').removeClass('d-none');
                $('.end_date').removeClass('d-none');

            } else {
                $('.department').addClass('d-none');
                $('.course').addClass('d-none');
                $('.semester').addClass('d-none');
                $('.start_date').addClass('d-none');
                $('.end_date').addClass('d-none');
            }
        });


        $('#department').on('change', function() {

            $("#course_name").empty();
            var postData = new FormData();
            postData.append('dep_id', this.value);
            var url = "/get-course";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                async: true,
                type: "post",
                contentType: false,
                url: url,
                data: postData,
                processData: false,
                success: function(response) {
                    $("#course_name").append('<option value="">Select Course</option>');
                    $.each(response, function(key, value) {
                        $("#course_name").append('<option value=' + value.id + '>' + value
                            .name +
                            '</option>');
                    });
                }
            });
        });
    </script>
@endsection
