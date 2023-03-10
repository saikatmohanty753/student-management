@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>Student Profile of {{ $collegeName }}</h4>
       
       
    </div>

    <div class="row">
        <div class="col-md-3">
            <br><br><br>
            <div class="card" class="student">
                <img src="{{ asset('backend/img/demo/authors/jovanni.png') }}" alt="profile Pic" height="200" width="200">
                <div class="card-body">
                    <h5 class="card-title">{{ $student->name }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Department:</strong> {{ $student->department->course_for }}</p>
                    <p><strong>Course:</strong> {{ $student->course->name }}</p>
                    <p><strong>Father's Name:</strong> {{ $student->father_name }}</p>
                    <p><strong>Mother's Name:</strong> {{ $student->mother_name }}</p>
                    <p><strong>Gender:</strong> {{ $student->gender }}</p>
                    <p><strong>Date of Birth:</strong> {{ $student->dob }}</p>
                    <p><strong>Aadhaar Card Number:</strong> {{ $student->aadhaar_no }}</p>
                    <p><strong>Mobile Number:</strong> {{ $student->mobile }}</p>
                    <p><strong>Caste:</strong> {{ $student->cast }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <br><br><br><br><br><br>
            <div class="card" class="wid">
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
                                <td>{{ $collegeName }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>




            </div>
            {{-- <br><br><br><br><br><br><br><br><br> --}}
            <div class="card" class="wid">

                <div class="card-header bg-info">
                    <h5 class="card-title">Message to Parent</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    {{-- <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                    </div> --}}
                </div>
                <button type="submit" class="btn btn-primary">Send</button>


            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
