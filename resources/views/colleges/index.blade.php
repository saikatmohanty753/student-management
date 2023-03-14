@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">College List</h5>
                    {{-- <div class="card-actions float-right">
                        @can('user-create')
                            <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}"> <i class="fa-solid fa-plus"></i>
                                Create New User</a>
                        @endcan
                    </div> --}}
                    <style>
                        #no-data-message {
    color: red;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}

                    </style>

                </div>
                <div class="card-body">
                    <div>
                        <table class="table table-bordered dt-table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>College Code</th>
                                    <th>College Type</th>
                                    <th>College Name </th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Course</th>
                                    {{-- <th>Status</th> --}}
                                    @can('college-edit')
                                        <th>Create User</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($college as $key => $clg)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $clg->college_code }}</td>
                                        <td>{{ $clg->college_type_id == 1 ? 'Govt.' : 'Private' }}</td>
                                        <td>{{ $clg->name }}</td>
                                        <td>{{ $clg->address }}</td>
                                        <td>{{ $clg->cityName->city_name }}</td>
                                        <td>{{ $clg->district->district_name }}</td>
                                        <td>
                                            <a class="btn btn-outline-primary view-course" href="javascript:void(0);"
                                                data-id="{{ $clg->id }}" data-value="{{ $clg->name }}"><i
                                                    class="fa-solid fa-eye"></i></a>

                                        </td>
                                        @can('college-edit')
                                            <td>
                                                <a class="btn btn-outline-success"
                                                    href="{{ url('create-user/' . $clg->id) }}"><i
                                                        class="fa-solid fa-user-pen"></i> </a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="course-view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">



                                <label for="name-input">Course View of:</label>
                                <input type="text" name="modalTitle" id="modalTitle" class="form-control" readonly>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Strength</th>
                            </tr>
                        </thead>
                        <tbody class="add-course">
                            <div id="no-data-message"></div>

                        </tbody>
                    </table>
                </div>




            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // $(document).ready(function() {


            $('.view-course').on('click', function() {



                let course = $(this).data('value');
                // alert(course);

                // console.log(course);
                $('#modalTitle').val(course);
                // $('#course-view').modal('show');




            });

        // });
    </script>
    <script>
        $('.view-course').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                clg_id: $(this).data('id'),

            };
            var type = "POST";
            var ajaxurl = '/course-details';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.length>0) {
                        var html = '';
                        $.each(data, function(key, val) {
                            html += '<tr>';
                            html += '<td>' + val.course_code + '</td>';
                            html += '<td>' + val.name + '</td>';
                            html += '<td>' + val.strength + '</td>';
                            html += '</tr>';
                        });
                        $('.add-course').html(html);
                        $('#course-view').modal('show');
                    }else{
                        $('.add-course').html('<div id="no-data-message">No data available</div>');
                        $('#course-view').modal('show');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });

        });
    </script>

@endsection
