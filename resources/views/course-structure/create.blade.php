@extends('layouts.app')
@section('content')
    <style>
        .box-body {
            padding: 30px;
        }

        .frame-wrap {
            margin-bottom: 1rem;
        }
    </style>
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <form method="post" action="{{ url('/academic-course-structure') }}" id="myForm">
                    @csrf

                    <div class="box-body">
                        <div class="frame-wrap">
                            <div class="d-flex p-2 bg-primary-600 text-white">Academic Course Structure</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group input-cont">
                                    <label class="form-label">Year<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control year chk_blank" placeholder="Session Year"
                                        name="year">
                                        <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group input-cont">
                                    <label class="form-label">Session Year<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control year chk_blank" placeholder="Session Year"
                                        name="session_year">
                                        <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group input-cont">
                                    <label class="form-label">Department <span class="text-danger">*</span></label>
                                    <select name="department" class="form-control  get-course chk_blank" id="">
                                        <option value="">Select Department</option>
                                        @foreach ($department as $item)
                                            <option value="{{ $item->id }}" data-id="{{ $item->semester }}">
                                                {{ $item->course_for }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group input-cont">
                                    <label class="form-label">Course Name<span class="text-danger">*</span></label>
                                    <select name="course" class="form-control select2 chk_blank" id="course">
                                        <option value="">Select Course</option>
                                    </select>
                                    <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group input-cont">
                                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                                    <select name="semester" class="form-control select2 chk_blank" id="semester">
                                        <option value="">Select Semester</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                    </select>
                                    <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group input-cont">
                                    <label class="form-label">Paper Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control chk_blank" placeholder="Paper Code" name="paper_code">
                                    <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group input-cont">
                                    <label class="form-label">Subject Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control chk_blank" placeholder="Paper Code" name="subject">
                                    <span class="error-msg"></span>
                                </div>
                            </div>
                        </div>
                        <div class="frame-wrap mt-4">
                            <div class="d-flex p-2 bg-primary-600 text-white">Mark Structure</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group input-cont">
                                    <label class="form-label">Mid Sem Marks<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control sem_mark numeric chk_blank"
                                        placeholder="Enter Mid Sem Marks" name="mid_sem_mark">
                                        <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group input-cont">
                                    <label class="form-label">End Sem Marks<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control sem_mark numeric chk_blank"
                                        placeholder="Enter Mid Sem Marks" name="end_sem_mark">
                                        <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group input-cont">
                                    <label class="form-label">Aggregate / Total Marks<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control total_marks chk_blank" placeholder="Enter Total Marks"
                                        name="total_marks" readonly>
                                        <span class="error-msg"></span>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <div class="form-group input-cont">
                                    <label class="form-label">Pass Marks<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control chk_blank" placeholder="Enter Pass Marks"
                                        name="pass_mark">
                                        <span class="error-msg"></span>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group input-cont">
                                    <label class="form-label">Total Credit<span class="text-danger">*</span></label>
                                    <select name="credit" class="form-control select2 chk_blank" id="">
                                        <option value="">Select Credit</option>
                                        @foreach ($credit as $item)
                                            <option value="{{ $item->credit }}">{{ $item->credit }}</option>
                                        @endforeach

                                    </select>
                                    <span class="error-msg"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center mt-4">

                                <a href="{{ url('colleges/') }}" class="btn btn-danger"> Cancel </a>
                                <button type="submit" class="btn btn-info pull-right">Submit</button>






                            </div>

                        </div>

                    </div>
                </form>
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
                        var html = '<option>select course</option>';
                        $.each(data, function(key, val) {
                            html += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                        $('#course').html(html);
                    }
                    if (sem > 0) {
                        console.log("hi");
                        var html1 = '<option>Select Semester</option>';
                        for (let i = 1; i <= sem; i++) {
                            html1 += '<option value="' + sem + '"> sem-' + i + '</option>';
                        }
                        $('#semester').html(html1);

                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        /* $('.mid_sem_mark numeric').keyup(function() {
            let val = $(this).val();

        });
        $('.end_sem_mark').keyup(function() {
            let val = $(this).val();
        }); */

        $(document).keyup(".sem_mark", function() {
            var sum = 0;
            $(".sem_mark").each(function() {
                sum += +$(this).val();
            });
            $(".total_marks").val(sum);
        });

        /*         $("#myForm").validate({
                    rules: {
                        course: {
                            required: true,
                            number: true,
                            min: 1,
                        },
                        year : 'required',
                        session_year : 'required',
                        department : 'required',
                        semester : 'required',
                        paper_code : 'required',
                        subject : 'required',

                    }
                }); */
    </script>

    <script>
        $("#myForm").on('submit', function(e) {
            e.preventDefault();
            
            var validation = [];
            validation = $('#myForm').scvalidateform({
                formId: 'myForm'
            });
            if ($.inArray('false', validation) >= '0') {
                return false;
            } else {
                $(this)[0].submit();
            }
        });
    </script>
@endsection
