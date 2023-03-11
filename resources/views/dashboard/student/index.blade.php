@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" class="student">
                                {{-- <div class="text-center mt-2">
                                    <img src="{{ asset('backend/img/profile.png') }}"
                                        class="rounded-circle shadow-2 img-thumbnail profile" alt="profile">
                                        <i class="fal fa-home"></i>
                                </div> --}}
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                            style="background-image: url('{{ asset('backend/img/profile.png') }}');">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="mb-0 fw-700 text-center mt-1 color-info-700">
                                        {{ $student->name }}
                                        <small class="text-muted mb-0 fw-400"> <span
                                                class="color-primary-700">{{ $student->email }}</span> </small>
                                    </h5>
                                    <div class="std-details mt-2">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)" class="text-muted">Session :
                                                        {{ $student->batch_year }}</a>
                                                </div>
                                            </li>
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)" class="text-muted">Email :
                                                        {{ $student->email }}</a>
                                                </div>
                                            </li>
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)" class="text-muted">Mobile Number :
                                                        {{ $student->mobile }}</a>
                                                </div>
                                            </li>
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)" class="text-muted">Aadhaar Number :
                                                        {{ $student->aadhaar_no }}</a>
                                                </div>
                                            </li>
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)" class="text-muted">Gender :
                                                        {{ $student->gender }}</a>
                                                </div>
                                            </li>
                                            {{-- <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)"
                                                        class="text-muted">Department : {{ $student->department->course_for }}</a>
                                                </div>
                                            </li>
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)"
                                                        class="text-muted">Course : {{ $student->course->name }}</a>
                                                </div>
                                            </li> --}}
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)" class="text-muted">Father's Name :
                                                        {{ $student->father_name }}</a>
                                                </div>
                                            </li>
                                            <li class="list-group-item py-2 px-2">
                                                <div class="fs-xs">
                                                    <a href="javascript:void(0)" class="text-muted">Mother's Name :
                                                        {{ $student->mother_name }}</a>
                                                </div>
                                            </li>
                                        </ul>
                                        {{-- <p class="details"><strong>Email :</strong> {{ $student->email }}</p>
                                        <p class="details"><strong>Department:</strong>
                                            {{ $student->department->course_for }}</p>
                                        <p class="details"><strong>Course:</strong> {{ $student->course->name }}</p>
                                        <p class="details"><strong>Father's Name:</strong> {{ $student->father_name }}</p>
                                        <p class="details"><strong>Mother's Name:</strong> {{ $student->mother_name }}</p>
                                        <p class="details"><strong>Gender:</strong> {{ $student->gender }}</p>
                                        <p class="details"><strong>Date of Birth:</strong> {{ $student->dob }}</p>
                                        <p class="details"><strong>Aadhaar Card Number:</strong> {{ $student->aadhaar_no }}
                                        </p>
                                        <p class="details"><strong>Mobile Number:</strong> {{ $student->mobile }}</p>
                                        <p class="details"><strong>Caste:</strong> {{ $student->cast }}</p> --}}
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">

                            <div class="text-center">
                                <h2 class="keep-print-font fw-500 mb-4 text-primary pt-2 flex-1 position-relative">
                                    {{ $student->collegeName($student->clg_id) }}
                                </h2>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td class="htext">Department : {{ $student->department->course_for }}
                                                    </td>
                                                    {{-- <td>{{ $student->department->course_for }}</td> --}}
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
                                                    <td class="htext">Course : {{ $student->course->name }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-info-500">
                                                <tr>
                                                    <th style="width: 50%" class="text-center">Registration Number</th>
                                                    <th style="width: 50%" class="text-center">Roll Number</th>
                                                    {{-- <td>{{ $student->department->course_for }}</td> --}}
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <td style="width: 50%" class="text-center">
                                                    {{ $student->regd_no ? $student->regd_no : 'Not Issued' }}</td>
                                                <td style="width: 50%" class="text-center">
                                                    {{ $student->roll_no ? $student->roll_no : 'Not Issued' }}</td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="card" class="wid">
                                <div class="card-body">
                                    <table class="table border-0">
                                        <tbody>
                                            <tr>
                                                <th>Department:</th>
                                                <th>Course:</th>
                                                <th>College:</th>
                                            </tr>
                                            <tr>
                                                <td>{{ $student->department->course_for }}</td>
                                                <td>{{ $student->course->name }}</td>
                                                <td>{{ $student->collegeName($student->clg_id) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            // alert('hi');


            readURL(this);
        });
    </script>
@endsection
