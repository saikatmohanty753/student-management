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
                    <div class="panel-content">

                        <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-academic-notice"
                                    role="tab" aria-selected="true">Admission Notices</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-college-notices"
                                    role="tab" aria-selected="false">College Notices</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-student-notices"
                                    role="tab" aria-selected="false">Student Notices</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-event-notices"
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
                                                <th>Department</th>
                                                {{-- <th>Course</th> --}}
                                                {{-- <th>Semester</th> --}}
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th>Details</th>
                                                <th>Is Verified</th>
                                                <th>Is Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notice as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td><span class="badge badge-primary">Admission Notice</span>
                                                    </td>
                                                    <td>{{ $item->department_id != '' ? $item->department->course_for : '' }}
                                                    </td>
                                                    {{-- <td>{{ $item->course_id != '' ? $item->course->name : 'N/A' }}</td> --}}
                                                    {{-- <td>{{ $item->semester != '' ? $item->semester : 'N/A' }}</td> --}}
                                                    <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->exp_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Str::limit($item->details, 40) }}</td>
                                                    <td>
                                                        {!! $item->is_verified == 0
                                                            ? '<span class="badge badge-warning">Not Verified</span>'
                                                            : '<span class="badge badge-success">Verified</span>' !!}
                                                    </td>
                                                    <td class="ispublish">
                                                        {{-- {{ $item->status == 1 ? 'Published' : 'Not Published' }} --}}
                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 1)
                                                                @if ($item->status == 0)
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input publish"
                                                                            id="customSwitch{{ $key }}"
                                                                            {{ $item->status == 1 ? 'checked disabled' : '' }}
                                                                            data-id="{{ $item->id }}">
                                                                        <label class="custom-control-label publish"
                                                                            for="customSwitch{{ $key }}"></label>
                                                                    </div>
                                                                @else
                                                                    {!! $item->noticeStatus() !!}
                                                                @endif
                                                            @else
                                                                {!! $item->noticeStatus() !!}
                                                            @endif
                                                        @else
                                                            {!! $item->noticeStatus() !!}
                                                        @endcan



                                                    </td>


                                                    <td><a href="{{ url('notice/view/' . $item->id) }}"
                                                            class="btn  waves-effect waves-themed btn-outline-primary">
                                                            <i class="fa-solid fa-eye"></i></a>

                                                        @if (Auth::user()->role_id == 11)
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary verified-status"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $item->id }}"><i
                                                                        class="fas fa-check-circle"></i></a>
                                                            @endif
                                                        @endif

                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary"
                                                                    href="{{ route('notices.edit', $item->id) }}"><i
                                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                            @endif
                                                        @endcan





                                                        @if ($item->status == 0)
                                                            @if ($item->is_verified == 0)
                                                                @can('notice-delete')
                                                                    {!! Form::open([
                                                                        'method' => 'DELETE',
                                                                        'route' => ['notices.destroy', $item->id],
                                                                        'style' => 'display:inline',
                                                                        'id' => 'deleteForm',
                                                                    ]) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-outline-danger delNotice',
                                                                        'id' => 'deleteThis',
                                                                    ]) !!} {!! Form::close() !!}
                                                                @endcan
                                                            @endif
                                                        @endif

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-college-notices" role="tabpanel"
                                aria-labelledby="tab-college-notices">
                                <div class="table-responsive">
                                    <table
                                        class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                                        <thead>
                                            <tr class="text-dark">
                                                <th style="width: 10%;">Sl. No</th>
                                                <th>Notice Type</th>
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th>Details</th>
                                                <th>Is Verified</th>
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clgNotice as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td><span class="badge badge-primary">College Notice</span>
                                                    </td>
                                                    <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->exp_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Str::limit($item->details, 40) }}</td>
                                                    <td>
                                                        {!! $item->is_verified == 0
                                                            ? '<span class="badge badge-warning">Not Verified</span>'
                                                            : '<span class="badge badge-success">Verified</span>' !!}
                                                    </td>
                                                    <td class="ispublish">
                                                        {{-- {{ $item->status == 1 ? 'Published' : 'Not Published' }} --}}
                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 1)
                                                                @if ($item->status == 0)
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input publish"
                                                                            id="customSwitch{{ $key }}"
                                                                            {{ $item->status == 1 ? 'checked disabled' : '' }}
                                                                            data-id="{{ $item->id }}">
                                                                        <label class="custom-control-label publish"
                                                                            for="customSwitch{{ $key }}"></label>
                                                                    </div>
                                                                @else
                                                                    {!! $item->noticeStatus() !!}
                                                                @endif
                                                            @else
                                                                {!! $item->noticeStatus() !!}
                                                            @endif
                                                        @else
                                                            {!! $item->noticeStatus() !!}
                                                        @endcan



                                                    </td>


                                                    <td><a href="{{ url('notice/view/' . $item->id) }}"
                                                            class="btn  waves-effect waves-themed btn-outline-primary">
                                                            <i class="fa-solid fa-eye"></i></a>

                                                        @if (Auth::user()->role_id == 11)
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary verified-status"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $item->id }}"><i
                                                                        class="fas fa-check-circle"></i></a>
                                                            @endif
                                                        @endif

                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary"
                                                                    href="{{ route('notices.edit', $item->id) }}"><i
                                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                            @endif
                                                        @endcan





                                                        @if ($item->status == 0)
                                                            @if ($item->is_verified == 0)
                                                                @can('notice-delete')
                                                                    {!! Form::open([
                                                                        'method' => 'DELETE',
                                                                        'route' => ['notices.destroy', $item->id],
                                                                        'style' => 'display:inline',
                                                                        'id' => 'deleteForm',
                                                                    ]) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-outline-danger delNotice',
                                                                        'id' => 'deleteThis',
                                                                    ]) !!} {!! Form::close() !!}
                                                                @endcan
                                                            @endif
                                                        @endif

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-student-notices" role="tabpanel"
                                aria-labelledby="tab-student-notices">
                                <div class="table-responsive">
                                    <table
                                        class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                                        <thead>
                                            <tr class="text-dark">
                                                <th style="width: 10%;">Sl. No</th>
                                                <th>Notice Type</th>
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th>Details</th>
                                                <th>Is Verified</th>
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentNotice as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td><span class="badge badge-primary">Student Notice</span>
                                                    </td>
                                                    <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->exp_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Str::limit($item->details, 40) }}</td>
                                                    <td>
                                                        {!! $item->is_verified == 0
                                                            ? '<span class="badge badge-warning">Not Verified</span>'
                                                            : '<span class="badge badge-success">Verified</span>' !!}
                                                    </td>
                                                    <td class="ispublish">
                                                        {{-- {{ $item->status == 1 ? 'Published' : 'Not Published' }} --}}
                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 1)
                                                                @if ($item->status == 0)
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input publish"
                                                                            id="customSwitch{{ $key }}"
                                                                            {{ $item->status == 1 ? 'checked disabled' : '' }}
                                                                            data-id="{{ $item->id }}">
                                                                        <label class="custom-control-label publish"
                                                                            for="customSwitch{{ $key }}"></label>
                                                                    </div>
                                                                @else
                                                                    {!! $item->noticeStatus() !!}
                                                                @endif
                                                            @else
                                                                {!! $item->noticeStatus() !!}
                                                            @endif
                                                        @else
                                                            {!! $item->noticeStatus() !!}
                                                        @endcan



                                                    </td>


                                                    <td><a href="{{ url('notice/view/' . $item->id) }}"
                                                            class="btn  waves-effect waves-themed btn-outline-primary">
                                                            <i class="fa-solid fa-eye"></i></a>

                                                        @if (Auth::user()->role_id == 11)
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary verified-status"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $item->id }}"><i
                                                                        class="fas fa-check-circle"></i></a>
                                                            @endif
                                                        @endif

                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary"
                                                                    href="{{ route('notices.edit', $item->id) }}"><i
                                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                            @endif
                                                        @endcan





                                                        @if ($item->status == 0)
                                                            @if ($item->is_verified == 0)
                                                                @can('notice-delete')
                                                                    {!! Form::open([
                                                                        'method' => 'DELETE',
                                                                        'route' => ['notices.destroy', $item->id],
                                                                        'style' => 'display:inline',
                                                                        'id' => 'deleteForm',
                                                                    ]) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-outline-danger delNotice',
                                                                        'id' => 'deleteThis',
                                                                    ]) !!} {!! Form::close() !!}
                                                                @endcan
                                                            @endif
                                                        @endif

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-event-notices" role="tabpanel"
                                aria-labelledby="tab-event-notices">
                                <div class="table-responsive">
                                    <table
                                        class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                                        <thead>
                                            <tr class="text-dark">
                                                <th style="width: 10%;">Sl. No</th>
                                                <th>Notice Type</th>
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th>Details</th>
                                                <th>Is Verified</th>
                                                <th>Status</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($eventNotice as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td><span class="badge badge-primary">Event Notice</span>
                                                    </td>
                                                    <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->exp_date)->format('d-m-Y') }}</td>
                                                    <td>{{ Str::limit($item->details, 40) }}</td>
                                                    <td>
                                                        {!! $item->is_verified == 0
                                                            ? '<span class="badge badge-warning">Not Verified</span>'
                                                            : '<span class="badge badge-success">Verified</span>' !!}
                                                    </td>
                                                    <td class="ispublish">
                                                        {{-- {{ $item->status == 1 ? 'Published' : 'Not Published' }} --}}
                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 1)
                                                                @if ($item->status == 0)
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input publish"
                                                                            id="customSwitch{{ $key }}"
                                                                            {{ $item->status == 1 ? 'checked disabled' : '' }}
                                                                            data-id="{{ $item->id }}">
                                                                        <label class="custom-control-label publish"
                                                                            for="customSwitch{{ $key }}"></label>
                                                                    </div>
                                                                @else
                                                                    {!! $item->noticeStatus() !!}
                                                                @endif
                                                            @else
                                                                {!! $item->noticeStatus() !!}
                                                            @endif
                                                        @else
                                                            {!! $item->noticeStatus() !!}
                                                        @endcan



                                                    </td>


                                                    <td><a href="{{ url('notice/view/' . $item->id) }}"
                                                            class="btn  waves-effect waves-themed btn-outline-primary">
                                                            <i class="fa-solid fa-eye"></i></a>

                                                        @if (Auth::user()->role_id == 11)
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary verified-status"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $item->id }}"><i
                                                                        class="fas fa-check-circle"></i></a>
                                                            @endif
                                                        @endif

                                                        @can('notice-edit')
                                                            @if ($item->is_verified == 0)
                                                                <a class="btn btn-outline-primary"
                                                                    href="{{ route('notices.edit', $item->id) }}"><i
                                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                            @endif
                                                        @endcan





                                                        @if ($item->status == 0)
                                                            @if ($item->is_verified == 0)
                                                                @can('notice-delete')
                                                                    {!! Form::open([
                                                                        'method' => 'DELETE',
                                                                        'route' => ['notices.destroy', $item->id],
                                                                        'style' => 'display:inline',
                                                                        'id' => 'deleteForm',
                                                                    ]) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-outline-danger delNotice',
                                                                        'id' => 'deleteThis',
                                                                    ]) !!} {!! Form::close() !!}
                                                                @endcan
                                                            @endif
                                                        @endif

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
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center"> Verified Notice</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('status') }}" method="post">
                            {{-- {{ method_field('PUT') }} --}}
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">


                                        <input type="hidden" id="id_get" value="" name="id">
                                        <label for="status">Status</label>
                                        <select name="verified" class="form-control">
                                            <option label="status">
                                            <option value="1">Verified</option>
                                            <option value="0">Not Verified</option>
                                            </option>

                                        </select>

                                    </div>

                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">





                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-danger" href="{{ url('/notices') }}">Cancel</a>
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </form>
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
                            /* publish.prop("checked")
                            publish.prop("disabled")
                            $('.publish').html('Published'); */
                            $('.ispublish').html('<span class="badge badge-success">Published</span>');
                            $('.delNotice').remove();
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

            $(document).ready(function() {
                //alert(1);

                $('.verified-status').on('click', function() {
                    let id = $(this).data('id');


                    $('#id_get').val(id);


                    $('#exampleModal').modal('show');


                });

            });
        </script>
    @endsection
