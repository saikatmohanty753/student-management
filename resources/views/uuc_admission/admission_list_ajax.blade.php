<div class="table-responsive">
    <table class="text-fade table table-bordered display no-footer data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Department</th>
                <th>Application No.</th>
                <th>Course</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Contact No</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($student_data))
            @foreach ($student_data as $key=>$student)
            @php
                $student_details = DB::table('student_details')->where('student_id',$student->id)->first();
            @endphp
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $department[$student->department_id] }}</td>
                <td>{{ $student->application_no }}</td>
                <td>{{ $course[$student->course_id] }}</td>
                <td>{{ @$student_details->name }}</td>
                <td>{{ @$student_details->gender }}</td>
                <td>{{ @$student_details->mobile }}</td>
                <td>
                    <a href="{{ route('admissionDetails',[$student->id]) }}" target="__blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
