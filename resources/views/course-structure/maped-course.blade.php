@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Filter <span class="fw-300"><i>Course Details</i></span>
                    </h2>
                    <select name="" id="session" class="float-right">
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
                                    <select name="" id="dep" class="form-control select2 get-course">
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
                                    <select name="" id="course" class="form-control select2">
                                        <option value="">Choose Course</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        Semester
                                    </label>
                                    <select name="" id="semester" class="form-control select2">
                                        <option value="">Choose Semester</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}">Sem- {{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="panel-4" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Filtered Courses
                    </h2>

                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <table class="table table-bordered m-0 maped-course">
                            <thead>
                                <tr>
                                    {{-- <th>Sl. No</th> --}}
                                    <th>Year</th>
                                    <th>Session</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Paper</th>
                                    <th>Subject</th>
                                    <th>Paper Type</th>
                                    <th>Paper Sub Type</th>
                                    <th>Mid Sem Marks</th>
                                    <th>End Sem Marks</th>
                                    <th>Aggregate(Total)</th>
                                    <th>Pass Marks</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.get-course').change(function(e) {
            e.preventDefault();
            let sem = $(this).find(':selected').data('id');
            let course = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                dep_id: $(this).val(),
            };
            var type = "POST";
            var ajaxurl = '/get-course';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        var html = '<option value="">select course</option>';
                        $.each(data, function(key, val) {
                            html += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                        $('#course').html(html);
                    }
                    if (sem > 0) {
                        console.log("hi");
                        var html1 = '<option value="">Select Semester</option>';
                        for (let i = 1; i <= sem; i++) {
                            html1 += '<option value="' + i + '"> sem-' + i + '</option>';
                        }
                        $('#semester').html(html1);

                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });

        });



        $(function() {

            var table = $('.maped-course').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                // orderable: false,
                // searchable: false,
                ajax: {
                    url: "{{ url('/filter-course') }}",
                    data: function(d) {
                        d.session = $('#session').val(),
                            d.dep = $('#dep').val(),
                            d.course = $('#course').val(),
                            d.sem = $('#semester').val()
                    },

                },
                columns: [{
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'session_year',
                        name: 'session_year'
                    },
                    {
                        data: 'dep_name',
                        name: 'dep_name'
                    },
                    {
                        data: 'course_name',
                        name: 'course_name'
                    },
                    {
                        data: 'semester',
                        name: 'semester'
                    },
                    {
                        data: 'paper_code',
                        name: 'paper_code',
                    },
                    {
                        data: 'subject',
                        name: 'subject',
                    },
                    {
                        data: 'paper_type',
                        name: 'paper_type',
                    },
                    {
                        data: 'paper_sub_type',
                        name: 'paper_sub_type',
                    },
                    {
                        data: 'mid_sem_mark',
                        name: 'mid_sem_mark',
                    },
                    {
                        data: 'end_sem_mark',
                        name: 'end_sem_mark',
                    },
                    {
                        data: 'total_marks',
                        name: 'total_marks',
                    },
                    {
                        data: 'pass_mark',
                        name: 'pass_mark',
                    },
                    {
                        data: 'credit',
                        name: 'credit',
                    },
                ]
            });

            $('#session').change(function() {
                table.draw();
            });
            $('#dep').change(function() {
                table.draw();
            });
            $('#semester').change(function() {
                table.draw();
            });
            $('#course').change(function() {
                console.log($('#course').val());
                table.draw();
            });

        });
    </script>
@endsection
