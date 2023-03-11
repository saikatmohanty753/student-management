@extends('layouts.app')
@section('content')

    @if (Auth::user()->role_id != 3)
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
                                        role="tab" aria-selected="true">Notices </a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-other-notices"
                                        role="tab" aria-selected="false">Event Notices</a></li>

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
                                                    <th>Published Date</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($notice))
                                                    @foreach ($notice as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td><span class="badge badge-primary">College Notice</span>
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($item->published_date)->format('d-m-Y') }}
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
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td><span class="badge badge-primary">Event Notice</span>
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($item->published_date)->format('d-m-Y') }}
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
    @else
        <div class="row mt-5">

            <div class="col-xl-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Notices</h5>
                    </div>

                    <div class="card-body">
                        <table
                            class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                            <thead>
                                <tr class="text-dark">
                                    <th style="width: 10%;">Sl. No</th>
                                    <th>Published Date</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($studentNotice))
                                    @foreach ($studentNotice as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->published_date)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ $item->details }}</td>
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
    @endif
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
                        // console.log(response);
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
