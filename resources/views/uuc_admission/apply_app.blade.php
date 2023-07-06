@extends('layouts.app')
@section('content')
<style>
    .photo{
        border: 1px solid #000;
        border-width: 3px;
        height: 157px;
        width: 156px;
        margin-top: -2px;
    }
</style>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Applied Application Details<span
                            class="badge badge-{{ $student->statusColor() }} position-absolute pos-right">{{ $student->applicationStatus() }}</span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="logo-2 none-2" style="text-align: center">
                            <a href="login-25.html">
                                <img src="{{ asset('backend/img/logo.jpg') }}" alt="logo">
                            </a>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Personal Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">
                                {{-- <div class="col-sm-12 mb-2">
                                    <div class="photo">
                                        <img src="{{ asset($documents->profile) }}" width="150" height="150">
                                    </div>
                                </div> --}}
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                {{-- <tr>
                                                    <td rowspan="2">
                                                        <div class="photo">
                                                            <img src="{{ asset($documents->profile) }}" width="150" height="150">
                                                        </div>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <th style="width:25%;">Course Name:</th>
                                                    <td style="width:25%;">{{ $std_app->course->name }}</td>
                                                    <th style="width:25%;">Name:</th>
                                                    <td style="width:25%;">{{ $personal_information->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Father's Name:</th>
                                                    <td>{{ $personal_information->father_name }}</td>
                                                    <th>Caste Category:</th>
                                                    <td>{{ $personal_information->cast }}</td>
                                                </tr>


                                                <tr>
                                                    <th>If Specially
                                                        Abled:</th>
                                                    <td>{{ $personal_information->specially_abled == 1 ? 'Yes' : 'No' }}
                                                    </td>
                                                    <th>Mobile No:</th>
                                                    <td>{{ $personal_information->mobile }}</td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width:25%;">Email:</th>
                                                    <td style="width:25%;">{{ $personal_information->email }}</td>
                                                    <th style="width:25%;">Mother's name:</th>
                                                    <td style="width:25%;">{{ $personal_information->mother_name }}</td>

                                                </tr>
                                                <tr>
                                                    <th>DOB:</th>
                                                    <td>{{ Carbon\Carbon::parse($personal_information->dob)->format('d-m-Y') }}
                                                    </td>
                                                    <th>Gender:</th>
                                                    <td>{{ $personal_information->gender }}</td>

                                                </tr>
                                                <tr>
                                                    <th>Aadhar No:</th>
                                                    <td>{{ $personal_information->aadhaar_no }}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Present Address Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width:25%;">State:</th>
                                                    <td style="width:25%;">{{ $present_address->present_state }}</td>
                                                    <th style="width:25%;">District:</th>
                                                    <td style="width:25%;">{{ $present_address->district }}</td>

                                                </tr>
                                                <tr>
                                                    <th>Pincode:</th>
                                                    <td>{{ $present_address->present_pin_code }}</td>
                                                    <th>Present Address:</th>
                                                    <td>{{ $present_address->present_address }}</td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Permanent Address Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width:25%;">State:</th>
                                                    <td style="width:25%;">{{ $permanent_address->permanent_state }}</td>
                                                    <th style="width:25%;">District:</th>
                                                    <td style="width:25%;">{{ $present_address->district }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pincode:</th>
                                                    <td>{{ $permanent_address->permanent_pin_code }}</td>
                                                    <th>Permanent Address:</th>
                                                    <td>{{ $permanent_address->permanent_address }}</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                College Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width:25%;">Last Attended College Name:</th>
                                                    <td style="width:25%;">{{ $prv_clg_info->clg_name }}</td>
                                                    <th style="width:25%;">Year of Passing Last Exam:</th>
                                                    <td style="width:25%;">{{ $prv_clg_info->year_of_passing }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Pursued Course Name:</th>
                                                    <td>{{ $prv_clg_info->course_name }}</td>
                                                    <th>Migration Certificate is availiable:</th>
                                                    <td>{{ $prv_clg_info->is_migration_cert == 0 ? 'No' : 'Yes' }}</td>
                                                </tr>




                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Qualification Details

                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Name of the Examinations Passed</th>
                                                    <th>University/School/College</th>
                                                    <th>Year of Passing</th>
                                                    <th>Passing Month</th>
                                                    <th>Roll no</th>
                                                    <th>Divn. and Distn.</th>
                                                    <th>Marks secured</th>
                                                    <th>Maximum marks</th>
                                                    <th>% of Marks</th>


                                                </tr>

                                                <tr>
                                                    <td>{{ isset($qualification_details->hsc->course) ? $qualification_details->hsc->course : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->board) ? $qualification_details->hsc->board : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->passing_year) ? $qualification_details->hsc->passing_year : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->month) ? $qualification_details->hsc->month : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->roll) ? $qualification_details->hsc->roll : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->division) ? $qualification_details->hsc->division : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->mark) ? $qualification_details->hsc->mark : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->total) ? $qualification_details->hsc->total : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->hsc->percentage) ? $qualification_details->hsc->percentage : 'N/A' }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>{{ isset($qualification_details->intermediate->course) ? $qualification_details->intermediate->course : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->intermediate->board) ? $qualification_details->intermediate->board : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->intermediate->passing_year) ? $qualification_details->intermediate->passing_year : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->intermediate->month) ? $qualification_details->intermediate->month : 'N/A' }}
                                                    </td>
                                                    <td> {{ isset($qualification_details->intermediate->roll) ? $qualification_details->intermediate->roll : 'N/A' }}
                                                    </td>
                                                    <td> {{ isset($qualification_details->intermediate->division) ? $qualification_details->intermediate->division : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->intermediate->mark) ? $qualification_details->intermediate->mark : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->intermediate->total) ? $qualification_details->intermediate->total : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->intermediate->percentage) ? $qualification_details->intermediate->percentage : 'N/A' }}
                                                    </td>
                                                </tr>


                                                @if ($std_app->department_id == 2 || $std_app->department_id == 3)
                                                    <tr>
                                                        <td>{{ isset($qualification_details->graduate->course) ? $qualification_details->graduate->course : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->board) ? $qualification_details->graduate->board : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->passing_year) ? $qualification_details->graduate->passing_year : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->month) ? $qualification_details->graduate->month : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->roll) ? $qualification_details->graduate->roll : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->division) ? $qualification_details->graduate->division : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->mark) ? $qualification_details->graduate->mark : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->total) ? $qualification_details->graduate->total : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->graduate->percentage) ? $qualification_details->graduate->percentage : 'N/A' }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($std_app->department_id == 3)
                                                    <tr>
                                                        <td>{{ isset($qualification_details->postGraduate->course) ? $qualification_details->postGraduate->course : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->board) ? $qualification_details->postGraduate->board : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->passing_year) ? $qualification_details->postGraduate->passing_year : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->month) ? $qualification_details->postGraduate->month : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->roll) ? $qualification_details->postGraduate->roll : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->division) ? $qualification_details->postGraduate->division : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->mark) ? $qualification_details->postGraduate->mark : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->total) ? $qualification_details->postGraduate->total : 'N/A' }}
                                                        </td>
                                                        <td>{{ isset($qualification_details->postGraduate->percentage) ? $qualification_details->postGraduate->percentage : 'N/A' }}b
                                                        </td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td>{{ isset($qualification_details->other->course) ? $qualification_details->other->course : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->other->board) ? $qualification_details->other->board : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->other->passing_year) ? $qualification_details->other->passing_year : 'N/A' }}
                                                    </td>
                                                    <td> {{ isset($qualification_details->other->month) ? $qualification_details->other->month : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->other->roll) ? $qualification_details->other->roll : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->other->division) ? $qualification_details->other->division : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->other->mark) ? $qualification_details->other->mark : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->other->total) ? $qualification_details->other->total : 'N/A' }}
                                                    </td>
                                                    <td>{{ isset($qualification_details->other->percentage) ? $qualification_details->other->percentage : 'N/A' }}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Document
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12 d-flex">

                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <th style="width:25%;">Photo</th>
                                                    <th style="width:25%;">Signature</th>
                                                    <th style="width:25%;">Aadhaar Card:</th>
                                                    <th style="width:25%;">HSC Certificate:</th>
                                                    <th style="width:25%;">Migration Certificate:</th>

                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($documents->profile) }}')">
                                                            {{ !empty($documents->profile) ? 'View Upload File' : 'Not Uploaded' }}</a>
                                                    </td>
                                                    <td>
                                                        @if(!empty($documents->signature))
                                                        <a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($documents->signature) }}')">
                                                            {{ !empty($documents->signature) ? 'View Upload File' : 'Not Uploaded' }}
                                                        </a>
                                                        @else
                                                        Not Uploaded
                                                        @endif
                                                    </td>
                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($documents->aadhaar_card) }}')">
                                                            {{ !empty($documents->aadhaar_card) ? 'View Upload File' : 'Not Uploaded' }}</a>
                                                    </td>
                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($documents->hsc_cert) }}')">
                                                            {{ !empty($documents->hsc_cert) ? 'View Upload File' : 'Not Uploaded' }}</a>
                                                    </td>
                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($documents->migration_cert) }}')">
                                                            {{ !empty($documents->migration_cert) ? 'View Upload File' : 'Not Uploaded' }}</a>
                                                    </td>
                                                    {{-- <td>
                                                        <div class="photo">
                                                            <img src="{{ asset($documents->profile) }}" width="150" height="150">
                                                        </div>
                                                    </td> --}}
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- Code UUC colledge Only --}}
                        @if($std_app->is_university == 1)
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light">
                                Application Status
                            </h6>
                        </div>
                        @if($std_app->status == 5)
                        <div class="panel-tag border-left-0">
                            <form action="{{ url('university-student-approval') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $std_app->id }}">
                                <input type="hidden" name="course_id" value="{{ $std_app->course_id }}">
                                <div class="row">
                                    <div class="col-sm-12 d-flex">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="">Select</option>
                                                    <option value="6">Approved</option>
                                                    <option value="3">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Remarks</label>
                                                <textarea name="remarks" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="panel-content border-faded border-top-0 border-left-0 border-right-0 border-bottom-0 d-flex flex-row justify-content-center">
                                    <a href="{{ url('uuc-pg-admission') }}" class="btn btn-secondary"
                                        data-dismiss="modal">Back</a>

                                    <button class="btn btn-outline-success waves-effect waves-themed ml-4"
                                        type="submit">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="panel-tag border-left-0">
                            <form action="{{ url('university-student-final-approval') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $std_app->id }}">
                                <input type="hidden" name="course_id" value="{{ $std_app->course_id }}">
                                <div class="row">
                                    <div class="col-sm-12 d-flex">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select class="form-control" name="status" id="regStatus" required>
                                                    <option value="">Select</option>
                                                    <option value="2">Verified</option>
                                                    <option value="3">Rejected</option>
                                                    <option value="4">Backed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Remarks</label>
                                                <textarea name="remarks" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-none regIssue">
                                            <div class="form-group">
                                                <label for="">Registration Number Issued</label>
                                                <select class="form-control" name="issued" id="">
                                                    <option value="">Select</option>
                                                    <option value="0">Not-Issued</option>
                                                    <option value="1">Issued</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="panel-content border-faded border-top-0 border-left-0 border-right-0 border-bottom-0 d-flex flex-row justify-content-center">
                                    <a href="{{ url('uuc-pg-admission') }}" class="btn btn-secondary"
                                        data-dismiss="modal">Back</a>

                                    <button class="btn btn-outline-success waves-effect waves-themed ml-4"
                                        type="submit">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endif
                        @endif
                        {{-- Ends here --}}

                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- // upload image view -->
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
    $('#regStatus').change(function() {
        if ($(this).val() == 2) {
            $('.regIssue').removeClass('d-none');
        } else {
            $('.regIssue').addClass('d-none');

        }
    })
</script>
@endsection
