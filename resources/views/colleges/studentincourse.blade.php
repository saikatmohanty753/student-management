@extends('layouts.app')
@section('content')
    <div class="container-fluid px-md-5 my-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Filter Students by Batch Year</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="filter-form">
                    @csrf
                    <input type="hidden" id="course_id" name="course_id" value="{{ $course_id }}">
                    <input type="hidden" id="deprt_id" name="deprt_id" value="{{ $department_id }}">
                    <div class="form-group row">
                        <label for="from_date" class="col-sm-2 col-form-label">Start Date:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control year" id="from_date" name="from_date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="to_date" class="col-sm-2 col-form-label">End Date:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control year" id="to_date" name="to_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-grid gap-2">
                            <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
                                class="fa-solid fa-filter">Filter</button>
                            <button type="button" class="btn btn-secondary" onclick="location.reload()">
                                <i class="fa-solid fa-sync"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Students</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="studentTable" class="table table-bordered m-0 data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {{-- <script>
        $(document).ready(function() {
            var date = new Date();

            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            var _token = $('input[name="_token"]').val();
            var department = $('#deprt_id').val();
            var course = $('#course_id').val();



            fetch_data();

            function fetch_data(from_date = '', to_date = '') {

                $.ajax({
                    url: "{{ route('daterange.filterstudent') }}",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        department_id: department,
                        course_id: course,
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {


                        var output = '';
                        for (var count = 0; count < data.length; count++) {
                            output += '<tr>';
                            output += '<td>' + data[count].name + '</td>';
                            output += '</tr>';
                        }
                        $('tbody').html(output);
                    }
                })
            }

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    fetch_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                fetch_data();
            });


        });



       
    </script> --}}


    <script type="text/javascript">
        $(document).ready(function() {

            function fetch_data(from_date = '', to_date = '') {
                var _token = $('input[name="_token"]').val();
                var department = $('#deprt_id').val();
                var course = $('#course_id').val();
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('daterange.filterstudent') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            department_id: department,
                            course_id: course,
                            _token: _token
                        },
                        type: "POST",
                        dataType: "json"
                    },
                    columns: [
                        {
                            data: 'name'
                            
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return '<a href="{{ url('studentdetails-view/') }}/' + data.id + '" class="btn btn-primary"><i class="fa-solid fa-eye"></i> View</a>';

                            }
                        }
                    ]
                    
                });
            }

            fetch_data();

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    $('.data-table').DataTable().destroy();
                    fetch_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                fetch_data();
            });

        });
    </script>
@endsection
