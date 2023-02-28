@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="formData" enctype="multipart/form-data" action="{{ url('student-admission') }}">
                        @csrf
                        <div class="border rounded p-2 mb-2">
                            <h2>Personal Information
                                <span class="badge badge-danger float-right fs-xs d-none seat-div"> Remaining Admission <span
                                        id="remaining"></span></span>
                                <input type="hidden" name="remaining_seat" id="remaining_seat">
                            </h2>

                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-12" style="display:none;">

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="course_name">Course Name<span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control select2 chk_blank" name="course"
                                                id="course_name">
                                                <option value="">Select Course</option>
                                                @foreach ($course as $item)
                                                    <option value="{{ $item->course_id }}"
                                                        data-id="{{ $item->available_seat }}">{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="student_name">Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="name" type="text" class="form-control chk_blank"
                                                id="student_name">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" type="text" class="form-control chk_blank chk_email"
                                                id="email">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Father's Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="father_name" type="text" class="form-control chk_blank"
                                                id="father_name">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Mother's name <span
                                                    class="text-danger">*</span></label>
                                            <input name="mother_name" type="text" class="form-control chk_blank"
                                                id="mother_name">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="blog-edit-status">Gender <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control chk_blank" name="gender"
                                                id="gender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">DOB <span class="text-danger">*</span></label>
                                            <input name="dob" type="text" id="dob"
                                                class="form-control datepicker-2 chk_blank chk_date">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="cast_category">Caste Category <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control chk_blank" id="cast_category"
                                                name="cast_category" id="cast">
                                                <option value="GEN">GEN</option>
                                                <option value="ST">ST</option>
                                                <option value="SC">SC</option>
                                                <option value="OBC">OBC</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="blog-edit-status">If Specially Abled <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control chk_blank" id="specially_abled"
                                                name="specially_abled">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Aadhaar No <span class="text-danger">*</span></label>
                                            <input name="aadhaar_no" type="text"
                                                class="form-control chk_blank chk_aadhaar" id="aadhaar">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                            <input name="mobile" type="text"
                                                class="form-control chk_blank chk_mobile" id="mobile">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="border rounded p-2 mb-2">
                            <h2>Address Information</h2>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-md-12 col-12">
                                    <label class="mb-0 flex-1 text-dark fw-500">Present Address Details</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">State <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control chk_blank"
                                                        name="present_state" id="present_state">
                                                        <option value="ODISHA">Odisha</option>

                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">District <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control select2 chk_blank"
                                                        name="present_district" id="present_district">
                                                        @foreach ($district as $item)
                                                            <option value="{{ $item->id }}">{{ $item->district_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Pincode <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control chk_blank chk_zip" name="present_pin_code"
                                                        id="present_pin_code">
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Present Address <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control chk_blank" name="present_address" id="present_address"></textarea>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="same">
                                                <label class="custom-control-label color-info-400" for="same">Click if
                                                    same with present address</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="subheader-titlemb-0 flex-1 text-dark fw-500">Permanent Address
                                        Details</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">State <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control chk_blank"
                                                        name="permanent_state" id="permanent_state">
                                                        <option value="ODISHA">Odisha</option>
                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label" for="blog-edit-status">District <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select form-control select2 chk_blank"
                                                        name="permanent_district" id="permanent_district">
                                                        @foreach ($district as $item)
                                                            <option value="{{ $item->id }}">{{ $item->district_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Pincode <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control chk_blank chk_zip"
                                                        name="permanent_pin_code" id="permanent_pin_code">
                                                    <span class="error-msg"></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Permanent Address <span
                                                            class="text-danger">*</span>
                                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><input type="checkbox" id="sameAddress"> Same as present</small>-->
                                                    </label>
                                                    <textarea class="form-control chk_blank" name="permanent_address" id="permanent_address"></textarea>
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>


                            <div class="border rounded p-2 mb-2">
                                <h2>College Information</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Last Attended College Name <span
                                                        class="text-danger">*</span></label>
                                                <input name="last_collage_name" type="text"
                                                    class="form-control chk_blank" id="last_collage_name">
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Year of Passing Last Exam <span
                                                        class="text-danger">*</span></label>
                                                <input name="last_passing_year" type="text"
                                                    class="form-control chk_blank yearPicker" id="last_passing_year">
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label">Last Purchased Course Name <span
                                                        class="text-danger">*</span></label>
                                                <input name="last_course_name" type="text"
                                                    class="form-control chk_blank" id="last_course_name">
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="mb-2">
                                            <div class="form-group input-cont">
                                                <label class="form-label" for="is_migration">Migration Certificate is
                                                    availiable <span class="text-danger">*</span></label>
                                                <select class="custom-select form-control chk_blank" id="is_migration"
                                                    name="is_migration">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded p-2 mb-2">
                                <h2>Qualification Details</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Name of the Examinations
                                                        Passed</th>
                                                    <th width="20%">University/
                                                        Council / Board</th>
                                                    <th>Year of Passing</th>
                                                    <th>Divn. and Distn.</th>
                                                    <th>Marks secured</th>
                                                    <th>Maximum marks</th>
                                                    <th>% of Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th><input type="text" name="hsc" class="form-control"
                                                            placeholder="H.S.C. or equivalent">
                                                        <span class="help-block">(H.S.C. or equivalent)</span>
                                                    </th>
                                                    <th> <input type="text" class="form-control" name="hsc_board">

                                                    </th>
                                                    <th> <input type="text" name="hsc_passing_year"
                                                            class="form-control yearPicker"> </th>
                                                    <th> <input type="text" name="hsc_division" class="form-control">
                                                    </th>
                                                    <th> <input type="text" name="hsc_mark" id="hsc_mark"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="hsc_total_mark" id="hsc_total_mark"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="hsc_percentage" id="hsc_percentage"
                                                            class="form-control"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" name="intermediate" class="form-control"
                                                            placeholder="Intermediate + 2"><span
                                                            class="help-block">(Intermediate + 2)</span></th>
                                                    <th> <input type="text" name="intermediate_board"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="intermediate_passing_year"
                                                            class="form-control yearPicker"> </th>
                                                    <th> <input type="text" name="intermediate_division"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="intermediate_mark"
                                                            id="intermediate_mark" class="form-control"> </th>
                                                    <th> <input type="text" name="intermediate_total_mark"
                                                            id="intermediate_total_mark" class="form-control"> </th>
                                                    <th> <input type="text" name="intermediate_percentage"
                                                            id="intermediate_percentage" class="form-control"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" class="form-control" name="graduate"
                                                            placeholder="Degree Exam /+3 B.Mus./B.V.A./ B.A."><span
                                                            class="help-block">(Degree Exam /+3 B.Mus./ B.V.A./
                                                            B.A.)</span></th>
                                                    <th> <input type="text" name="graduate_board"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="graduate_passing_year"
                                                            class="form-control yearPicker"> </th>
                                                    <th> <input type="text" name="graduate_division"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="graduate_mark" id="graduate_mark"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="graduate_total_mark"
                                                            id="graduate_total_mark" class="form-control"> </th>
                                                    <th> <input type="text" name="graduate_percentage"
                                                            id="graduate_percentage" class="form-control"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" class="form-control" name="post_graduate"
                                                            placeholder="M. Mus / MVA"><span class="help-block">(M. Mus /
                                                            MVA)</span></th>
                                                    <th> <input type="text" name="post_graduate_board"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="post_graduate_passing_year"
                                                            class="form-control yearPicker"> </th>
                                                    <th> <input type="text" name="post_graduate_division"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="post_graduate_mark"
                                                            id="post_graduate_mark" class="form-control"> </th>
                                                    <th> <input type="text" name="post_graduate_total_mark"
                                                            id="post_graduate_total_mark" class="form-control"> </th>
                                                    <th> <input type="text" name="post_graduate_percentage"
                                                            id="post_graduate_percentage" class="form-control"> </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="text" class="form-control" name="other_graduate"
                                                            placeholder="Any other Qualification"><span
                                                            class="help-block">(Any other Qualification)</span></th>
                                                    <th> <input type="text" name="other_graduate_board"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="other_graduate_passing_year"
                                                            class="form-control yearPicker"> </th>
                                                    <th> <input type="text" name="other_graduate_division"
                                                            class="form-control"> </th>
                                                    <th> <input type="text" name="other_graduate_mark"
                                                            id="other_graduate_mark" class="form-control"> </th>
                                                    <th> <input type="text" name="other_graduate_total_mark"
                                                            id="other_graduate_total_mark" class="form-control"> </th>
                                                    <th> <input type="text" name="other_graduate_percentage"
                                                            id="other_graduate_percentage" class="form-control"> </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="border rounded p-2 mb-4">
                                <h2>Document</h2>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Photo<span class="text-danger">*</span></label>
                                            <div class="custom-file  input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_blank chk_5mb_file_only"
                                                    name="profile" id="photo">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Aadhaar Card<span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_blank chk_5mb_file_only"
                                                    name="aadhaar_card" id="aadhaar_card">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">HSC Certificate <span
                                                    class="text-danger">*</span></label>
                                            <div class="custom-file input-cont">
                                                <input type="file"
                                                    class="custom-file-input form-control chk_blank chk_5mb_file_only"
                                                    name="hsc_cert" id="hsc_cert">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label class="form-label">Migration Certificate</label>
                                            <div class="custom-file input-cont">
                                                <input type="file" class="custom-file-input form-control"
                                                    name="migration_cert" id="migration_cert">
                                                <small
                                                    class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                                <label class="custom-file-label">Choose
                                                    file...</label>
                                                <span class="error-msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 text-center mt-50">
                                <button type="submit" id="button_preview"
                                    class="btn btn-primary me-1 waves-effect waves-float waves-light">Preview</button>

                            </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#same').click(function() {
            if ($(this).is(':checked')) {
                let present_district = $('#present_district').val();
                let present_pin_code = $('#present_pin_code').val();
                let present_address = $('#present_address').val();
                $('#permanent_address').text(present_address);
                $('#permanent_pin_code').val(present_pin_code);
                $("#permanent_district").val(present_district).change();
            }
        });

        $('#course_name').on('change', function() {
            if (this.value != '') {
                $('.seat-div').removeClass('d-none');
                var seat = $(this).find(':selected').data('id');

                $('#remaining_seat').val(seat)
                $('#remaining').html(seat)

            } else {
                $('.seat-div').addClass('d-none');
            }
        });
    </script>
    <script>
        $("#formData1").on('submit', function(e) {

            e.preventDefault();
            var validation = [];
            validation = $('#formData').scvalidateform({
                formId: 'formData'
            });
            if ($.inArray('false', validation) >= '0') {
                return false;

            } else {
                $(this)[0].submit();
            }
        });

        $('#hsc_total_mark, #hsc_mark').keyup(function() {
            var total_marks = parseFloat($('#hsc_total_mark').val());
            var obt_marks = parseFloat($('#hsc_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#hsc_percentage').val(prs_mark);
            }
        });
        $('#intermediate_total_mark, #intermediate_mark').keyup(function() {
            var total_marks = parseFloat($('#intermediate_total_mark').val());
            var obt_marks = parseFloat($('#intermediate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#intermediate_percentage').val(prs_mark);
            }
        });
        $('#graduate_total_mark, #graduate_mark').keyup(function() {
            var total_marks = parseFloat($('#graduate_total_mark').val());
            var obt_marks = parseFloat($('#graduate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#graduate_percentage').val(prs_mark);
            }
        });
        $('#post_graduate_total_mark, #post_graduate_mark').keyup(function() {
            var total_marks = parseFloat($('#post_graduate_total_mark').val());
            var obt_marks = parseFloat($('#post_graduate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#post_graduate_percentage').val(prs_mark);
            }
        });
        $('#other_graduate_total_mark, #other_graduate_mark').keyup(function() {
            var total_marks = parseFloat($('#other_graduate_total_mark').val());
            var obt_marks = parseFloat($('#other_graduate_mark').val());
            var prs_mark = parseFloat((obt_marks * 100) / total_marks).toFixed(2);
            if (total_marks && obt_marks) {
                $('#other_graduate_percentage').val(prs_mark);

            }

        });
    </script>
@endsection
