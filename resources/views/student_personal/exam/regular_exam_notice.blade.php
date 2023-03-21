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
                        
                        
                        
                            {{-- <div class="panel-tag">
                                Add a clean look to your tabs by adding <code>.nav-tabs-clean</code> to <code>.nav-tabs</code>
                            </div> --}}
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-home" role="tab">Exam Notices</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-profile" role="tab">Event Notice</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-time" role="tab">Other Notice</a></li>
                            </ul>
                            <div class="tab-content p-3">
                                <div class="tab-pane fade show active" id="tab-home" role="tabpanel" aria-labelledby="tab-home">
                                    <table class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>sl no</th>
                                                <th>notice type</th>
                                                <th>notice details</th>
                                                <th>End date</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stu_details as $key => $item)
                                                
                                           
                                            <tr>
                                                <td>{{$loop->iteration}} </td>
                                                <td>{{$item['notice_name']}}</td>
                                                <td>{{ $item['details'] }}</td>
                                                <td>{{ Carbon\Carbon::parse($item['end_date'])->format('d-m-Y') }}</td>
                                                <td><a href="{{route('student_apply',[$stu_id])}}">Apply Student</a></td>
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

