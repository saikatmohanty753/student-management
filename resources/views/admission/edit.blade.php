@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($student->status == 4)
                        <div class="alert alert-danger" role="alert">
                            <strong>Admission is backed! <a href="javascript:void(0);"
                                    onclick="view_reason('{{ $student->remarks }}')"><u> Please view the
                                        reasons.</u></a></strong>
                        </div>
                    @endif

                    <form method="post" id="formData" enctype="multipart/form-data"
                        action="{{ url('draft-student-admission') }}">
                        @csrf
                        <input type="hidden" name="hid" value="{{ $student->id }}">
                        <div class="border rounded p-2 mb-2">
                            <h2>Personal Information</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-12" style="display:none;">

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="course_name">Course Name<span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select form-control select2 chk_blank" name="course">
                                                <option value="">Select Course</option>
                                                @foreach ($course as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $student->course_id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
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
                                                id="student_name" value="{{ $student->name }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" type="text" class="form-control chk_blank chk_email"
                                                value="{{ $student->email }}">
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
                                                value="{{ $student->mother_name }}">
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
                                                value="{{ $student->father_name }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label" for="blog-edit-status">Gender <span
                                                    class="text-danger">*</span></label>
                                            {{-- <input name="father_name" type="text" class="form-control" value="{{$student->gender}}"> --}}
                                            <select class="custom-select form-control chk_blank" name="gender">
                                                <option value="Male"{{ 'Male' == $student->gender ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="Female"{{ 'Female' == $student->gender ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                                <option value="Other"{{ 'Other' == $student->gender ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">DOB <span class="text-danger">*</span></label>
                                            <input name="dob" type="text" class="form-control datepicker-2 chk_blank"
                                                value="{{ $student->dob }}">
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
                                                name="cast_category">
                                                <option value="GEN"{{ 'GEN' == $student->cast ? 'selected' : '' }}>GEN
                                                </option>
                                                <option value="ST"{{ 'ST' == $student->cast ? 'selected' : '' }}>ST
                                                </option>
                                                <option value="SC"{{ 'SC' == $student->cast ? 'selected' : '' }}>SC
                                                </option>
                                                <option value="OBC"{{ 'OBC' == $student->cast ? 'selected' : '' }}>OBC
                                                </option>
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
                                                <option
                                                    value="0"{{ '0' == $student->specially_abled ? 'selected' : '' }}>
                                                    No</option>
                                                <option
                                                    value="1"{{ '1' == $student->specially_abled ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Aadhar No <span class="text-danger">*</span></label>
                                            <input name="aadhar_no" type="text"
                                                class="form-control chk_blank chk_aadhaar "
                                                value="{{ $student->aadhaar_no }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                            <input name="mobile" type="text"
                                                class="form-control chk_blank chk_mobile" value="{{ $student->mobile }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control">
                                    </div>
                                </div> --}}

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
                                                        name="present_state">
                                                        <option
                                                            value="ODISHA"{{ 'ODISHA' == $address->present_state ? 'selected' : '' }}>
                                                            Odisha</option>
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
                                                    <select class="custom-select form-control chk_blank select2"
                                                        name="present_district" id="present_district">
                                                        @foreach ($district as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $address->present_district_id ? 'selected' : '' }}>
                                                                {{ $item->district_name }}
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
                                                    <input class="form-control chk_blank" name="present_pin_code"
                                                        id="present_pin_code" value="{{ $address->present_pin_code }}">
                                                    <span class="error-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-2">
                                                <div class="form-group input-cont">
                                                    <label class="form-label">Present Address <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control chk_blank" name="present_address" id="present_address" value="">{{ $address->present_address }}</textarea>
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
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="same">
                                                    <label class="custom-control-label color-info-400"
                                                        for="same">Click if
                                                        same with present address</label>
                                                </div>
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
                                                        name="permanent_state">
                                                        <option
                                                            value="ODISHA"{{ 'ODISHA' == $address->permanent_address ? 'selected' : '' }}>
                                                            Odisha</option>
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
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $address->present_district_id ? 'selected' : '' }}>
                                                                {{ $item->district_name }}
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
                                                    <input class="form-control chk_blank" name="permanent_pin_code"
                                                        id="permanent_pin_code"
                                                        value="{{ $address->permanent_pin_code }}">
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
                                                    <textarea class="form-control chk_blank" name="permanent_address" id="permanent_address" value="">{{ $address->permanent_address }}</textarea>
                                                    <span class="error-msg"></span>
                                                </div>
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
                                            <input name="last_collage_name" type="text" class="form-control chk_blank"
                                                value="{{ $education->clg_name }}">
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
                                                class="form-control yearPicker chk_blank"
                                                value="{{ $education->year_of_passing }}">
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="mb-2">
                                        <div class="form-group input-cont">
                                            <label class="form-label">Last Pursued Course Name <span
                                                    class="text-danger">*</span></label>
                                            <input name="last_course_name" type="text" class="form-control chk_blank"
                                                value="{{ $education->course_name }}">
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
                                                <option
                                                    value="0"{{ '0' == $education->is_migration_cert ? 'selected' : '' }}>
                                                    No</option>
                                                <option
                                                    value="1"{{ '1' == $education->is_migration_cert ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
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
                                        <div class="custom-file input-cont">
                                            <input type="file"
                                                class="custom-file-input form-control"
                                                name="profile">
                                            <label class="custom-file-label">Choose
                                                file...</label>
                                            <small class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                            <span onclick="upload_image_view('{{ asset($documents->photo) }}');"
                                                class="badge badge-primary mt-4" style="cursor: pointer;"
                                                id="pdf-file">View Upload
                                                File</span>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label">Aadhaar Card<span class="text-danger">*</span></label>
                                        <div class="custom-file input-cont">
                                            <input type="file"
                                                class="custom-file-input form-control"
                                                name="aadhaar_card">
                                            <label class="custom-file-label">Choose
                                                file...</label>
                                            <small class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                            <span onclick="upload_image_view('{{ asset($documents->aadhaar_card) }}');"
                                                class="badge badge-primary mt-4" style="cursor: pointer;"
                                                id="pdf-file">View Upload
                                                File</span>
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
                                                class="custom-file-input form-control"
                                                name="hsc_cert">
                                            <label class="custom-file-label">Choose
                                                file...</label>
                                            <small class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                            <span onclick="upload_image_view('{{ asset($documents->hsc_cert) }}');"
                                                class="badge badge-primary mt-4" style="cursor: pointer;"
                                                id="pdf-file">View Upload
                                                File</span>
                                            <span class="error-msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label">Migration Certificate</label>
                                        <div class="custom-file input-cont">
                                            <input type="file"
                                                class="custom-file-input form-control"
                                                name="migration_cert">
                                            <label class="custom-file-label">Choose
                                                file...</label>
                                            <small class="form-text text-secondary">{{ __('common.file_format') }}</small>
                                            <span onclick="upload_image_view('{{ asset($documents->migration_cert) }}');"
                                                class="badge badge-primary mt-4" style="cursor: pointer;"
                                                id="pdf-file">View Upload
                                                File</span>
                                            <span class="error-msg"></span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 text-center mt-50">
                            <button type="submit"
                                class="btn btn-info me-1 waves-effect waves-float waves-light">Preview</button>

                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="upload_image_view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="view_upload_image">
                        {{-- <img src="" alt="Upload_img" class="img-responsive card-img-top" id="view_upload_image">
                        <embed src="" frameborder="0" width="100%" id="view_upload_image" height="400px"> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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



        $("#formData").on('submit', function(e) {

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
    </script>
@endsection
