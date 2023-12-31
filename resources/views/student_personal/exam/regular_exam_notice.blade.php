@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Regular Examination Applications
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">



                        {{-- <div class="panel-tag">
                                Add a clean look to your tabs by adding <code>.nav-tabs-clean</code> to <code>.nav-tabs</code>
                            </div> --}}
                        <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-home"
                                    role="tab">Exam Notices</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-profile"
                                    role="tab">Event Notice</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-time" role="tab">Other
                                    Notice</a></li>
                        </ul>
                        <div class="tab-content p-3">
                            <div class="tab-pane fade show active" id="tab-home" role="tabpanel"
                                aria-labelledby="tab-home">
                                <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Notice Type</th>
                                            <th>Notice Details</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stu_details as $key => $item)
                                        @php
                                            //dd($item['notice_id']);
                                            //dd($item);
                                        @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $item['notice_name'] }}</td>
                                                <td>{{ $item['details'] }}</td>
                                                <td>{{ Carbon\Carbon::parse($item['end_date'])->format('d-m-Y') }}</td>
                                                <td>
                                                    {{-- @if ($ug_app == '')
                                                    <a href="{{ route('student_apply', [$stu_id]) }}">Apply
                                                        Student</a>
                                                    @else
                                                        @if (($ug_app->form_status == 1) && ($ug_app->notice_id != ''))
                                                            <a href="{{ route('student_app_preview', [$stu_id]) }}">complete
                                                                form</a>
                                                        @elseif(($ug_app->form_status == 2) && ($ug_app->notice_id != ''))
                                                       
                                                           
                                                            <a href="{{ route('ug_final_preview', [$stu_id]) }}">View Form</a>
                                                        @else
                                                            <a href="{{ route('student_apply', [$stu_id]) }}">Apply
                                                                Student</a>
                                                        @endif
                                                    @endif --}}
                                                
                                                {{-- @php
                                                    dd($value)
                                                @endphp --}}
                                                
                                                
                                                @if ($item['notice_present_ug_app'] == 0)
                                                <a href="{{ route('student_apply', $item['notice_id']) }}">Apply
                                                    Student</a>
                                                @else
                                               
                                                        @if (($item['form_status'] == 1))
                                                            <a href="{{ route('student_app_preview', $item['app_id'])}}">complete
                                                                form</a>
                                                        @else
                                                       
                                                        
                                                            <a href="{{ route('ug_final_preview', $item['app_id']) }}">View Form</a>
                                                       
                                                        @endif
                                                   
                                                {{-- <a href="{{ route('ug_final_preview', [$stu_id]) }}">View Form</a> --}}
                                                @endif
                                                
                                                
                                                

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab-profile" role="tabpanel" aria-labelledby="tab-profile">
                                Event Notice
                            </div>
                            <div class="tab-pane fade" id="tab-time" role="tabpanel" aria-labelledby="tab-time">
                                Other Notice
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>
@endsection
