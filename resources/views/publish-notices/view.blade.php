@extends('layouts.app')
@section('content')
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
						<span class="h5">Admission for {{$data->course}} from <strong>{{ Carbon\Carbon::parse($data->start_date)->format('d-m-Y') }}</strong> to <strong>{{ Carbon\Carbon::parse($data->end_date)->format('d-m-Y') }}</strong></span>

                        @php
                            $url = url('uuc-admission/'.$data->id.'/'. str_slug($data->course) .'/'.$data->department_id);
                        @endphp
                        <h6 class="mt-2">{{$data->details}}</h6> <a href="{{ $url }}" target="_blank">Click hear for admission</a>
					</div>
                </div>
            </div>
        </div>
    </div>
@endsection
