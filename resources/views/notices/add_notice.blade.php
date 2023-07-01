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
                        @if (count($errors) > 0)
                            <div class="alert alert-danger remove-alert">

                                <strong>Whoops!</strong> There were some problems with your input.<br><br>

                                <ul>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>
                        @endif
                        <form method="post" action="{{ url('uuc-create-notice') }}" id="formData">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Notice Type<span class="text-danger">*</span></label>
                                        <select class="form-select form-control notice-type select2" name="notice_type">
                                            <option value="" selected>Select Notice Type</option>
                                            <option value="1" class="admission">Admission Notice</option>
                                            <option value="2" class="exam">College Notice</option>
                                            <option value="3" class="student">Student Notice</option>
                                            <option value="4" class="other">Event Notice</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group input-cont department d-none">
                                        <label class="form-label">Department<span class="text-danger">*</span></label>
                                        <select class="form-select form-control select2" name="department" id="department">
                                            <option value="">Select Department</option>
                                            @foreach ($dept as $item)
                                                <option value="{{ $item->id }}">{{ $item->course_for }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-msg"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group input-cont course d-none">
                                        <label class="form-label">Course<span class="text-danger">*</span></label>
                                        <select class="form-select form-control  select2" name="course[]" id="course">
                                            <option value="">Select Course</option>
                                            @foreach ($course as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="error-msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group input-cont semester d-none">
                                        <label class="form-label">Semester<span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="semester" id="semester">
                                            <option value="" selected>Select Department</option>
                                            @foreach ($dept as $item)
                                                <option value="{{ $item->id }}">{{ $item->semester }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group input-cont start_date">
                                        <label class="form-label">Start Date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control chk_blank fromDate"
                                            placeholder="Enter Start Date" name="start_date" id="start_date">
                                        <span class="error-msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group input-cont end_date ">
                                        <label class="form-label">Expiry Date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control chk_blank toDate"
                                            placeholder="Enter End Date" name="exp_date" id="exp_date">
                                        <span class="error-msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group input-cont fee-payment d-none">
                                        <label class="form-label">Last Date Of Fee Payment<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control chk_blank datepicker-1"
                                            placeholder="Enter Last Date Of Fee Payment" name="fee_payment"
                                            id="fee_payment">
                                        <span class="error-msg"></span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group input-cont publish-date">
                                        <label class="form-label">Publish Date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control chk_blank datepicker-1"
                                            placeholder="Enter Publish Date" name="publish_date" id="publish-date">
                                        <span class="error-msg"></span>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row mb-2 d-flex align-items-center justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group input-cont">
                                        <label class="form-label ">Details<span class="text-danger">*</span></label>
                                        <textarea name="details" id="details" class="form-control chk_blank"></textarea>
                                        <span class="error-msg"></span>

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12 text-center mb-4">
                                    <a href="{{ url('/notices') }}" class="btn btn-danger"
                                        style="margin-right: 8px;">Cancel</a>
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
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
            // console.log(this.value);
            if (this.value == 1) {
                $('.department').removeClass('d-none');
                $('.fee-payment').removeClass('d-none');
                $('.publish-date').removeClass('d-none');
                $('.course').addClass('d-none');
                $('.semester').addClass('d-none');
                $('#department').addClass('chk_blank');
                $('#course_name').removeClass('chk_blank');
                $('#semester').removeClass('chk_blank');
                // $('#publish-date').addClass('chk_blank');


            } else {
                $('.department').addClass('d-none');
                $('.fee-payment').addClass('d-none');
                $('.publish-date').removeClass('d-none');
                // $('.course').removeClass('d-none');
                // $('.semester').removeClass('d-none');

                $('#department').removeClass('chk_blank');
                $('#course').removeClass('chk_blank');
                $('#fee_payment').removeClass('chk_blank');

                // $('#semester').addClass('chk_blank');


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

        $("#formData").on('submit', function(e) {

            e.preventDefault();
            var validation = [];
            validation = $('#formData').scvalidateform({
                formId: 'formData'
            });
            console.log($('.department').val());
            console.log(validation);
            if ($.inArray('false', validation) >= '0') {
                return false;
            } else {
                $(this)[0].submit();
            }
        });
    </script>
@endsection
