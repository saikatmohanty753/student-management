@extends('layouts.app')
@section('content')
    @if ($data->notice_sub_type == 1)
        <div class="card-body">
            <div class="alert alert-primary">
                <div class="d-flex flex-start w-100">
                    <div class="d-flex align-center mr-2 hidden-sm-down">
                        <span class="icon-stack icon-stack-lg">
                            <i class="fa-solid fa-comments-dollar color-primary-400 icon-stack-2x"></i>

                        </span>
                    </div>
                    <div class="d-flex flex-fill">
                        <div class="flex-fill">
                            <span class="h5">Admission for {{ $data->course }} from
                                <strong>{{ Carbon\Carbon::parse($data->start_date)->format('d-m-Y') }}</strong> to
                                <strong>{{ Carbon\Carbon::parse($data->exp_date)->format('d-m-Y') }}</strong></span>

                            @php
                                $url = url('uuc-admission/' . $data->id . '/' . str_slug($data->course) . '/' . $data->department_id);
                            @endphp
                            <h6 class="mt-2">{{ $data->details }}</h6> <a href="{{ $url }}" target="_blank">Click
                                hear for admission</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($data->notice_sub_type == 2 || $data->notice_sub_type == 4)
        <div class="card-body">
            <div class="alert alert-primary">
                <div class="d-flex flex-start w-100">
                    <div class="d-flex align-center mr-2 hidden-sm-down">
                        <span class="icon-stack icon-stack-lg">
                            <i class="fa-solid fa-comments-dollar color-primary-400 icon-stack-2x"></i>

                        </span>
                    </div>
                    <div class="d-flex flex-fill">
                        <div class="flex-fill">
                            <span class="h5">Notice </span>
                            <h6 class="mt-2">{{ $data->details }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif
@endsection
