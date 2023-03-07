@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <span class="fw-300"><i>UUC Students</i></span>
                    </h2>
                    Admission Year &nbsp;<select name="" id="session" class="float-right">
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
                                        College
                                    </label>
                                    <select id="clg" class="form-control select2">
                                        <option value="">Choose College</option>
                                        @foreach ($college as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        Select Year
                                    </label>
                                    <input type="text" class="form-control" id="range-picker" placeholder="Select date" value="01/01/2018 - 01/15/2018">
                                </div>
                            </div> --}}
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
                        Student List
                    </h2>

                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <table class="table table-bordered m-0 uuc-student">
                            <thead>
                                <tr>
                                    {{-- <th>Sl. No</th> --}}
                                    <th>Student Name</th>
                                    <th>Admission Year</th>
                                    <th>Session</th>
                                    <th>College Name</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    {{-- <th>Regd. No.</th>
                                    <th>Roll. No.</th> --}}

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
        /* $('#range-picker').daterangepicker({
                locale: {
                    format: 'M/DD hh:mm A'
                },
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format(
                    'YYYY-MM-DD'));
            }); */

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

            var table = $('.uuc-student').DataTable({
                processing: true,
                serverSide: true,
                responsive: false,
                // orderable: false,
                // searchable: false,
                ajax: {
                    url: "{{ url('/uuc-student') }}",
                    data: function(d) {
                        d.session = $('#session').val(),
                            d.dep = $('#dep').val(),
                            d.sem = $('#dep').data('id'),
                            d.course = $('#course').val(),
                            d.clg = $('#clg').val()
                    },

                },
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'batch_year',
                        name: 'batch_year'
                    },
                    {
                        data: 'batch_year',
                        name: 'batch_year'
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
                        data: 'clg_name',
                        name: 'clg_name'
                    },
                ]
            });

            $('#dep').change(function() {
                table.draw();
            });
            $('#semester').change(function() {
                table.draw();
            });
            $('#course').change(function() {
                table.draw();
            });

        });
    </script>
@endsection
