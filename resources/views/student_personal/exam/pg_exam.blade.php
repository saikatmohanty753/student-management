@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                         Regular Examination Application (UG) 
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        
                        <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                            @foreach ($courseFor as $key => $item)
                           <li class="nav-item"><a class="nav-link {{$key == 0 ? 'active' : ''}}" data-toggle="tab" href="#tab_{{$item->id}}" role="tab">{{$item->course_for}}</a></li>
                            @endforeach
                            
                        </ul>
                        <div class="tab-content p-3">
                            @foreach ($courseFor as $key => $item)
                            <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}" id="tab_{{$item->id}}" role="tabpanel" aria-labelledby="tab_{{$item->id}}"> 
                            {{-- {{ $item->course_for}}
                            {{$item->id}} --}}
                            <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Exam Type</th>
                                        <th>Semester</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- @if ()
                                    
                                @endif --}}
                                <tbody>
                                    @foreach ($ug_regular_notice as $key => $itemUG)
                                    @if (($itemUG->department_id) == ($item->id))
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$itemUG->noticeType->notice_name}}</td>
                                        <td>{{$itemUG->semester}}</td>
                                        <td>{{$itemUG->start_date->format('d-M-Y')}}</td>
                                        <td>{{$itemUG->exp_date->format('d-M-Y')}}</td>
                                        <td><a href="{{route('student_pglist')}}">Apply Student</a></td>
                                        {{-- <td><a href="{{route('apply_regular_exam')}}">Apply</a></td> --}}
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            @endforeach
                            
                        </div>

                    </div>
                </div>
            </div>

        </div>
        
    </div>


    
@endsection

