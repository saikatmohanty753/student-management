@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Preview Application Details
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
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                Personal Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">
                                <div class="col-sm-6 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                {{-- <tr>
                                                    <td>
                                                        Department Name:
                                                    </td>
                                                    <td>
                                                        <strong>PG</strong>
                                                    </td>
                                                </tr> --}}
                                                <tr>

                                                    <td>
                                                        <strong>Course Name: {{ $std_app->course->name }}</strong>
                                                    </td>
                                                    <td>
                                                        Name <strong>: {{ $personal_information->name }}</strong>
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td>
                                                        Father's Name<strong>:
                                                            {{ $personal_information->father_name }}</strong>
                                                    </td>

                                                    <td>
                                                        Caste Category<strong>: {{ $personal_information->cast }}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        If Specially
                                                        Abled<strong>:{{ $personal_information->specially_abled == 1 ? 'Yes' : 'No' }}</strong>
                                                    </td>
                                                    <td>
                                                        Mobile No<strong>: {{ $personal_information->mobile }}</strong>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-6 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Email <strong>: {{ $personal_information->email }}</strong>
                                                    </td>
                                                    <td>
                                                        Mother's name <strong>:
                                                            {{ $personal_information->mother_name }}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        DOB <strong>: {{ $personal_information->dob }}</strong>
                                                    </td>
                                                    <td>
                                                        Gender <strong>: {{ $personal_information->gender }}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Aadhar No <strong>:
                                                            {{ $personal_information->aadhaar_no }}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                Present Address Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12 d-flex">

                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        State <strong>: {{ $present_address->present_state }}</strong>
                                                    </td>
                                                    <td>
                                                        District <strong>: {{ $present_address->district }}</strong>
                                                    </td>
                                                    <td>
                                                        Pincode<strong>: {{ $present_address->present_pin_code }}</strong>
                                                    </td>
                                                    <td>

                                                        Present Address<strong>:
                                                            {{ $present_address->present_address }}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                Permanent Address Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12 d-flex">

                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        State <strong>: {{ $permanent_address->permanent_state }}</strong>
                                                    </td>
                                                    <td>
                                                        District <strong>: {{ $present_address->district }}</strong>
                                                    </td>
                                                    <td>
                                                        <strong>Pincode<strong>:
                                                                {{ $permanent_address->permanent_pin_code }}</strong>
                                                    </td>
                                                    <td>

                                                        Permanent Address <strong>:
                                                            {{ $permanent_address->permanent_address }}</strong>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                College Information
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12 d-flex">

                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Last Attended College Name
                                                        <strong>: {{ $prv_clg_info->clg_name }}</strong>
                                                    </td>
                                                    <td>
                                                        Year of Passing Last Exam
                                                        <strong>: {{ $prv_clg_info->year_of_passing }}</strong>
                                                    </td>
                                                    <td>
                                                        Last Pursued Course Name
                                                        <strong>: {{ $prv_clg_info->course_name }}</strong>
                                                    </td>
                                                    <td>
                                                        Migration Certificate is availiable
                                                        <strong>:
                                                            {{ $prv_clg_info->is_migration_cert == 0 ? 'No' : 'Yes' }}</strong>
                                                    </td>
                                                </tr>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                Qualification Details

                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12 d-flex">

                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Name of the Examinations
                                                        Passed

                                                    </th>
                                                    <th>
                                                        University/
                                                        Council / Board

                                                    </th>
                                                    <th>
                                                        Year of Passing

                                                    </th>
                                                    <th>
                                                        Divn. and Distn.

                                                    </th>
                                                    <th>
                                                        Marks secured

                                                    </th>
                                                    <th>
                                                        Maximum marks

                                                    </th>
                                                    <th>
                                                        % of Marks

                                                    </th>
                                                </tr>

                                                <tr>
                                                    <td>

                                                        <strong> {{ $qualification_details->hsc->course }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong> {{ $qualification_details->hsc->board }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong> {{ $qualification_details->hsc->passing_year }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->hsc->division }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->hsc->mark }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->hsc->total }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->hsc->percentage }}</strong>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->intermediate->course }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong> {{ $qualification_details->intermediate->board }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->intermediate->passing_year }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->intermediate->division }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->intermediate->mark }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->intermediate->total }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->intermediate->percentage }}</strong>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>

                                                        <strong> {{ $qualification_details->graduate->course }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong> {{ $qualification_details->graduate->board }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->graduate->passing_year }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->graduate->division }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->graduate->mark }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->graduate->total }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->graduate->percentage }}</strong>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>

                                                        <strong>{{ $qualification_details->postGraduate->course }}
                                                        </strong>
                                                    </td>
                                                    <td>

                                                        <strong> {{ $qualification_details->postGraduate->board }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->postGraduate->passing_year }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->postGraduate->division }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->postGraduate->mark }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->postGraduate->total }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->postGraduate->percentage }}</strong>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>

                                                        <strong>{{ $qualification_details->other->course }} </strong>
                                                    </td>
                                                    <td>

                                                        <strong> {{ $qualification_details->other->board }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong> {{ $qualification_details->other->passing_year }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->other->division }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->other->mark }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->other->total }}</strong>
                                                    </td>
                                                    <td>

                                                        <strong>
                                                            {{ $qualification_details->other->percentage }}</strong>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>








                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
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
                                                    <td>
                                                        Photo <strong>: <strong>:<a href="javascript:void(0)"
                                                                    onclick="upload_image_view('{{ asset($documents->profile) }}')">
                                                                    {{ !empty($documents->profile) ? 'View Upload File' : 'Not Uploaded' }}</a></strong></strong>
                                                    </td>
                                                    <td>
                                                        Aadhaar Card <strong>: <strong>:<a href="javascript:void(0)"
                                                                    onclick="upload_image_view('{{ asset($documents->aadhaar_card) }}')">
                                                                    {{ !empty($documents->aadhaar_card) ? 'View Upload File' : 'Not Uploaded' }}</a></strong></strong>
                                                    </td>
                                                    <td>
                                                        HSC Certificate<strong>: <strong>:<a href="javascript:void(0)"
                                                                    onclick="upload_image_view('{{ asset($documents->hsc_cert) }}')">
                                                                    {{ !empty($documents->hsc_cert) ? 'View Upload File' : 'Not Uploaded' }}</a></strong>
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        Migration Certificate
                                                        <strong>:
                                                            @if (!empty($documents->migration_cert))
                                                                <a href="javascript:void(0)"
                                                                    onclick="upload_image_view('{{ asset($documents->migration_cert) }}')"></a>
                                                            @else
                                                            Not Uploaded
                                                            @endif
                                                        </strong>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <form action="{{ url('student-admission/apply') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $std_app->id }}">
                            <div
                                class="panel-content border-faded border-top-0 border-left-0 border-right-0 border-bottom-0 d-flex flex-row justify-content-center">
                                <a href="{{ url('student-admission/edit/' . $std_app->id) }}"
                                    class="btn  waves-effect waves-themed btn-outline-primary" type="submit">Edit
                                </a>
                                <button class="btn btn-outline-success waves-effect waves-themed ml-4" type="submit">Submit
                                </button>
                            </div>
                        </form>


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
@endsection
