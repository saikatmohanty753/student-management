@extends('layouts.app')
@section('content')
    <div class="row mt-5">

        <div class="col-xl-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Notice List</h5>
                    <div class="card-actions float-right">
                        @can('notice-create')
                            <a class="btn btn-primary btn-sm" href="{{ url('/add-notices') }}">
                                <i class="fa-solid fa-plus"></i> Create Notice</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                            <thead>
                                <tr class="text-dark">
                                    <th style="width: 10%;">Sl. No</th>
                                    <th>Notice Type</th>
                                    <th>Department</th>
                                    {{-- <th>Course</th> --}}
                                    {{-- <th>Semester</th> --}}
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notice as $key => $item)
                                    @php
                                        if ($item->notice_type == 1) {
                                            $notice_type = 'Admission Notice';
                                            $color = 'badge-primary';
                                        } elseif ($item->notice_type == 2) {
                                            $notice_type = 'Exam Notice';
                                            $color = 'badge-success';
                                        } else {
                                            $notice_type = 'Other Notice';
                                            $color = 'badge-info';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><span class="badge {{ $color }}">{{ $notice_type }}</span></td>
                                        <td>{{ $item->department_id != '' ? $item->department->course_for : '' }}</td>
                                        {{-- <td>{{ $item->course_id != '' ? $item->course->name : 'N/A' }}</td> --}}
                                        {{-- <td>{{ $item->semester != '' ? $item->semester : 'N/A' }}</td> --}}
                                        <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->exp_date)->format('d-m-Y') }}</td>
                                        <td>{{ $item->details }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input publish"
                                                    id="customSwitch{{ $key }}"
                                                    {{ $item->status == 1 ? 'checked' : '' }}
                                                    data-id="{{ $item->id }}">
                                                <label class="custom-control-label publish"
                                                    for="customSwitch{{ $key }}">{{ $item->status == 1 ? 'Published' : 'Not Publish' }}</label>
                                            </div>
                                        </td>

                                        <td><a href="{{ url('notice/view/' . $item->id) }}"
                                                class="btn  waves-effect waves-themed btn-outline-primary">
                                                <i class="fa-solid fa-eye"></i></a>
                                        </td>

                                    </tr>
                                @endforeach

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
        $('.publish').on('change', function() {
            if ($(this).is(':checked')) {
                var publish = $(this);
                var postData = new FormData();
                postData.append('id', $(this).data('id'));
                var url = "/publish-notice";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    async: true,
                    type: "post",
                    contentType: false,
                    url: url,
                    data: postData,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        publish.prop("checked")
                        $('.publish').html('Published');
                        /* $("#course_name").append('<option value="">Select Course</option>');
                        $.each(response, function(key, value) {
                            $("#course_name").append('<option value=' + value.id + '>' + value
                                .name +
                                '</option>');
                        }); */
                    }
                });
            }


        });
    </script>
@endsection
