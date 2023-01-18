@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Applied Application Details<span class="badge badge-{{ $student->statusColor() }} position-absolute pos-right">{{ $student->applicationStatus() }}</span>
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
                                                    Course Name <strong>: {{ $student->course->name }}</strong>
                                                    </td>
                                                    <td>
                                                        Name <strong>: {{$student->name}}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Email <strong>: {{$student->email}}</strong>
                                                    </td>
                                                    <td>
                                                        Caste Category<strong>: {{$student->cast}}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        If Specially Abled<strong>:{{ $student->specially_abled == 1 ? 'Yes' : 'No' }}</strong>
                                                    </td>
                                                    <td>
                                                        Mobile No<strong>: {{$student->mobile}}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>  
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                   
                                                    <td>
                                                        Father's Name<strong>: {{$student->father_name}}</strong>
                                                    </td>

                                                    <td>
                                                        Mother's name <strong>: {{$student->mother_name}}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        DOB <strong>: {{$student->dob}}</strong>
                                                    </td>
                                                    <td>
                                                        Gender <strong>: {{$student->gender}}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Aadhar No <strong>: {{$student->aadhaar_no}}</strong>
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
                                                        State <strong>: {{$address->present_state}}</strong>
                                                    </td>
                                                    <td>
                                                        District <strong>: {{ $address->presentDistrict->district_name }}</strong>
                                                    </td>
                                                    <td>
                                                        Pincode<strong>: {{$address->present_pin_code}}</strong>
                                                    </td>
                                                    <td>

                                                        Present Address<strong>: {{$address->present_address}}</strong>
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <td>
                                                        Net:
                                                    </td>
                                                    <td>
                                                        21
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Currency:
                                                    </td>
                                                    <td>
                                                        USD
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        P.O. #
                                                    </td>
                                                    <td>
                                                        1/3-147
                                                    </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-4 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Course Name:
                                                    </td>
                                                    <td>
                                                        Culture of sadsa
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Due Date:</strong>
                                                    </td>
                                                    <td>
                                                        05/25/2019
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Net:
                                                    </td>
                                                    <td>
                                                        21
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Currency:
                                                    </td>
                                                    <td>
                                                        USD
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        P.O. #
                                                    </td>
                                                    <td>
                                                        1/3-147
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}

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
                                                        State <strong>: {{$address->permanent_state}}</strong>
                                                    </td>
                                                    <td>
                                                        District <strong>: {{ $address->permanentDistrict->district_name }}</strong>
                                                    </td>
                                                    <td>
                                                        <strong>Pincode<strong>: {{$address->permanent_pin_code}}</strong>
                                                    </td>
                                                    <td>

                                                        Permanent Address <strong>: {{$address->permanent_address}}</strong>
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
                                                        <strong>: {{$education->clg_name}}</strong>
                                                    </td>
                                                    <td>
                                                        Year of Passing Last Exam
                                                        <strong>: {{$education->year_of_passing}}</strong>
                                                    </td>
                                                    <td>
                                                        Last Pursued Course Name
                                                        <strong>: {{$education->course_name}}</strong>
                                                    </td>
                                                    <td>
                                                        Migration Certificate is availiable
                                                        <strong>: {{ $education->is_migration_cert == 0 ? 'No' : 'Yes' }}</strong>
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
                                                        Photo <strong>:  <strong>:<a href="javascript:void(0)" onclick="upload_image_view('{{ asset($documents->photo) }}')">
                                                            {{ !empty($documents->photo) ? 'View Upload File' : 'Not Uploaded' }}</a></strong></strong>
                                                    </td>
                                                    <td>
                                                        Aadhaar Card <strong>: <strong>:<a href="javascript:void(0)" onclick="upload_image_view('{{ asset($documents->aadhaar_card) }}')">
                                                            {{ !empty ($documents->aadhaar_card) ? 'View Upload File' : 'Not Uploaded' }}</a></strong></strong>
                                                    </td>
                                                    <td>
                                                        HSC Certificate<strong>: <strong>:<a href="javascript:void(0)" onclick="upload_image_view('{{ asset($documents->hsc_cert) }}')">
                                                            {{ !empty ($documents->hsc_cert) ? 'View Upload File' : 'Not Uploaded' }}</a></strong> </strong>
                                                    </td>
                                                    <td>
                                                        Migration Certificate
                                                        <strong>:<a href="javascript:void(0)" onclick="upload_image_view('{{ asset($documents->migration_cert) }}')">
                                                            {{ !empty($documents->migration_cert) ? 'View Upload File' : 'Not Uploaded' }}</a></strong>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>





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
