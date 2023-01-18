@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Preview Application Details
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        
                        <div
                            class="panel-content d-flex py-2 mt-2 border-faded border-left-0 border-right-0 text-muted bg-success-500">
                            <h6 class="text-light">
                                Notice Details
                            </h6>
                        </div>
                        <div class="panel-tag border-left-0">
                            <div class="row">

                                <div class="col-sm-12 d-flex">

                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Notice Type <strong>: {{$data->notice_type == 1 ? 'Admission Notice' : 'Exam Notice'}} </strong>
                                                    </td>
                                                    <td>
                                                        Department <strong>: {{$data->course}}</strong>
                                                    </td>
                                                    {{-- <td>
                                                        Course<strong> : {{$data->couse_name}} </strong> 
                                                    </td> --}}
                                                    <td>
                                                        Start date<strong> : 
                                                            {{ Carbon\Carbon::parse($data->start_date)->format('d-m-Y') }}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- <td>Semester <strong>: {{$data->semester}}</strong></td> --}}
                                                    <td>
                                                        End date<strong> : {{ Carbon\Carbon::parse($data->exp_date)->format('d-m-Y') }}</strong>
                                                    </td>
                                                    <td>
                                                        Details <strong>: {{$data->details}}</strong>
                                                    </td>
                                                </tr>
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
