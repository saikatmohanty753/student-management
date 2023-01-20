@extends('layouts.app')
@section('content')
    <div class="row mt-5">

        <div class="col-xl-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Academic Notices List</h5>
                </div>

                <div class="card-body">
                    <div class="panel-content">

                        <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-academic-notice"
                                    role="tab" aria-selected="true">Academic Notices </a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-other-notices"
                                    role="tab" aria-selected="false">Other Notices</a></li>

                        </ul>
                        <div class="tab-content p-3">
                            <div class="tab-pane fade active show" id="tab-academic-notice" role="tabpanel"
                                aria-labelledby="tab-academic-notice">
                                <div class="table-responsive">
                                    <table
                                        class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                                        <thead>
                                            <tr class="text-dark">
                                                <th style="width: 10%;">Sl. No</th>
                                                <th>Notice Type</th>
                                                <th>Department</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($OtherNotice))
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
                                                        <td><span
                                                                class="badge {{ $color }}">{{ $notice_type }}</span>
                                                        </td>
                                                        <td>{{ $item->department_id != '' ? $item->department->course_for : '' }}
                                                        </td>
                                                        <td><a href="{{ url('view-notice/' . $item->id . '/' . $item->notification_id) }}"
                                                                class="btn  waves-effect waves-themed btn-outline-primary">
                                                                <i class="fa-solid fa-eye"></i></a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-other-notices" role="tabpanel"
                                aria-labelledby="tab-other-notices">
                                <div class="table-responsive">
                                    <table
                                        class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                                        <thead>
                                            <tr class="text-dark">
                                                <th style="width: 10%;">Sl. No</th>
                                                <th>Notice Type</th>
                                                <th>Details</th>
                                                <th>View Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (!empty($OtherNotice))
                                                @foreach ($OtherNotice as $key => $item)
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
                                                        <td><span
                                                                class="badge {{ $color }}">{{ $notice_type }}</span>
                                                        </td>
                                                        <td>
                                                            {{ Str::limit($item->details, 30) }}
                                                        </td>
                                                        <td><a href="{{ url('view-notice/' . $item->id . '/' . $item->notification_id) }}"
                                                                class="btn  waves-effect waves-themed btn-outline-primary">
                                                                <i class="fa-solid fa-eye"></i></a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>



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
