@extends('layouts.app')
@section('content')
    {{-- {{dd($studentdetails)}} --}}
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Preview Student Details
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="logo-2 none-2" style="text-align: center">
                            <a href="#">
                                <img src="{{ asset('backend/img/logo.jpg') }}" alt="logo">
                            </a>
                        </div>
                        <div
                            class="panel-content d-flex justify-content-md-between py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-primary-500">
                            <h6 class="text-light mb-0">
                                Personal Information
                            </h6>



                            @if ($studentdetails->regd_no)
                                <h6 class="text-light mb-0">Registration No:- <span
                                        class="badge badge-success">{{ $studentdetails->regd_no }}</span></h6>

                                <span
                                    onclick="upload_image_view('{{ asset('registration_card/' . $studentdetails->regd_no . '.pdf') }}');"
                                    class="badge badge-warning" style="cursor: pointer;" id="pdf-file">View Registration
                                    Card</span>
                            @else
                                Not Issued
                            @endif
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>


                                                <tr>
                                                    <th>Course Name:</th>
                                                    <td>{{ $studentdetails->coursename }}</td>

                                                    <th> Name: </th>
                                                    <td>{{ $studentdetails->name }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Father's Name:</th>
                                                    <td>{{ $studentdetails->father_name }}</td>

                                                    <th>Caste Category:</th>
                                                    <td>{{ $studentdetails->cast }}</td>


                                                </tr>
                                                <tr>
                                                    <th>If Specially
                                                        Abled:</th>
                                                    <td>{{ $studentdetails->specially_abled == 1 ? 'Yes' : 'No' }}</td>

                                                    <th>Mobile No:</th>
                                                    <td>{{ $studentdetails->mobile }}</td>


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
                                                    <th>Email:</th>
                                                    <td>{{ $studentdetails->email }}</td>
                                                    <th>Mother's name:</th>
                                                    <td>{{ $studentdetails->mother_name }}</td>

                                                </tr>
                                                <tr>
                                                    <th>DOB:</th>
                                                    <td>{{ $studentdetails->dob }}</td>
                                                    <th>Gender:</th>
                                                    <td>{{ $studentdetails->gender }}</td>


                                                </tr>
                                                <tr>
                                                    <th colspan="2">Aadhar No:</th>
                                                    <td>{{ $studentdetails->aadhaar_no }}</td>

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
                                            {{-- {{dd($studentdetails)}} --}}
                                            <tbody>

                                                <tr>
                                                    <th>State:</th>
                                                    <td>{{ $studentdetails->present_state }}</td>
                                                    <th>District:</th>
                                                    <td>{{ $studentdetails->present_dis }}</td>



                                                </tr>
                                                <tr>
                                                    <th>Pincode:</th>
                                                    <td>{{ $studentdetails->present_pin_code }}</td>
                                                    <th>Present Address:</th>
                                                    <td>{{ $studentdetails->present_address }}</td>

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
                                                    <th>State:</th>
                                                    <td>{{ $studentdetails->permanent_state }}</td>
                                                    <th>District:</th>
                                                    <td>{{ $studentdetails->per_district }}</td>


                                                </tr>
                                                <tr>
                                                    <th>Pincode:</th>
                                                    <td>{{ $studentdetails->permanent_pin_code }}</td>
                                                    <th>Permanent Address:</th>
                                                    <td>{{ $studentdetails->permanent_address }}</td>

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
                                                    <th>Last Attended College Name:</th>
                                                    <td>{{ $studentdetails->clg_name }}</td>
                                                    <th>Year of Passing Last Exam:</th>
                                                    <td>{{ $studentdetails->year_of_passing }}</td>


                                                </tr>
                                                <tr>
                                                    <th>Last Pursued Course Name:</th>
                                                    <td>{{ $studentdetails->course_name }}</td>
                                                    <th>Migration Certificate is availiable:</th>
                                                    <td>{{ $studentdetails->is_migration_cert == 0 ? 'No' : 'Yes' }}</td>
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


                                                @if ($studentdetails->department_id == 2 || $studentdetails->department_id == 3)
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

                                                @if ($studentdetails->department_id == 3)
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

                                <div class="col-sm-12">

                                    <div class="table-responsive">
                                        <table class="table table-bordered ">
                                            <tbody>


                                                <tr>
                                                    <th>Photo :</th>
                                                    <th>Aadhaar Card:</th>
                                                    <th>HSC Certificate:</th>
                                                    <th>Migration Certificate:</th>




                                                </tr>

                                                <tr>
                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($studentdetails->photo) }}')">
                                                            {{ !empty($studentdetails->photo) ? 'View Upload File' : 'Not Uploaded' }}</a>
                                                    </td>

                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($studentdetails->aadhaar_card) }}')">
                                                            {{ !empty($studentdetails->aadhaar_card) ? 'View Upload File' : 'Not Uploaded' }}</a>
                                                    </td>

                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($studentdetails->hsc_cert) }}')">
                                                            {{ !empty($studentdetails->hsc_cert) ? 'View Upload File' : 'Not Uploaded' }}</a>
                                                    </td>

                                                    <td><a href="javascript:void(0)"
                                                            onclick="upload_image_view('{{ asset($studentdetails->migration_cert) }}')">
                                                            {{ !empty($studentdetails->migration_cert) ? 'View Upload File' : 'Not Uploaded' }}</a>
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
    <script>
        function upload_image_view(url) {


            $('#view_upload_image').html('<embed src="' + url +
                '" frameborder="0" width="100%" id="view_upload_image" height="400px">');
            $('#upload_image_view').modal('show');

        }
    </script>
@endsection
