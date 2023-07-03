@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Filter <span class="fw-300"><i>Course Details</i></span>

                    </h2>
                    <select name="session" id="session" class="float-right">
                        @for ($i = date('Y') - 4; $i <= date('Y') + 1; $i++)
                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}
                            </option>
                        @endfor
                    </select>


                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        Department
                                    </label>

                                    <select name="dep" id="dep" class="form-control select2 get-course">
                                        <option value="">Choose Department</option>
                                        @foreach ($department as $item)
                                            <option value="{{ $item->id }}" data-id="{{ $item->semester }}">
                                                {{ $item->course_for }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        Course
                                    </label>
                                    <select name="course" id="course" class="form-control select2">
                                        <option value="">Choose Course</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student Admission List</h5>
                    <div class="card-actions float-right">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-fade table table-bordered display no-footer data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Student Name</th>
                                    <th>Gender</th>
                                    <th>Contact No</th>
                                    <th>Application Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('studentadmissionList') }}',
                    data: function(d) {
                        d.dep = $('#dep').val();
                        d.course = $('#course').val();
                        d.session = $('#session').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'course_for',
                        name: 'course_for'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'personal_information.name',
                        name: 'personal_information.name',
                        render: function(data) {
                            return data ? data : '-'; // Show '-' if name is null/empty
                        }
                    },
                    {
                        data: 'personal_information.gender',
                        name: 'personal_information.gender',
                        render: function(data) {
                            return data ? data : '-'; // Show '-' if gender is null/empty
                        }
                    },
                    {
                        data: 'personal_information.mobile',
                        name: 'personal_information.mobile',
                        render: function(data) {
                            return data ? data : '-'; // Show '-' if mobile is null/empty
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',

                    },
                    {
                            data: null,
                            render: function(data, type, row) {
                                return '<a href="{{ url('student-admission/applied-application/') }}/' + data.id +
                                    '" class="btn btn-primary"><i class="fa-solid fa-eye"></i> View</a>';

                            }

                        }

                ]


            });

            $('#session').change(function() {
                table.draw();
            });
            $('#dep').change(function() {
                table.draw();
            });
            $('#course').change(function() {
                table.draw();
            });
        });
    </script>
@endsection
