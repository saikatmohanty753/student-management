@extends('layouts.app')


@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Create New Role</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>

        </div>

    </div>

</div>


{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">


        <div class="form-group">

            <strong>Permission:</strong>

            <br />

            <div class="demo-checkbox">
                @foreach($permission as $key => $value)
                <input type="checkbox" id="md_checkbox_{{$key}}" class="filled-in chk-col-primary" value="{{$value->id}}" name="permission[]">
                <label for="md_checkbox_{{$key}}">{{ $value->name }}</label>
                <br>
                @endforeach
            </div>

            {{-- @foreach($permission as $value)

            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'filled-in chk-col-primary')) }}

                {{ $value->name }}</label>

            <br />

            @endforeach --}}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}



@endsection
