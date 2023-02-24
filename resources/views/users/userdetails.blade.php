@extends('layouts.app')


@section('content')
    {{-- @php
dd($role);
@endphp --}}
    @foreach ($user as $key => $value)
        <div class="row">

            <div class="col-lg-12 margin-tb">

                <div class="pull-left">

                    <h2> Show User Details</h2>

                </div>

                <div class="pull-right">

                    <a class="btn btn-primary" href="{{ url()->previous() }}"> Back</a>

                </div>

            </div>

        </div>


        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>
                    {{ $value->name }}


                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Email:</strong>
                      {{ $value->email}}


                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Roles:</strong>
                    {{ $value->userdetails->name}}


                </div>

            </div>

        </div>
    @endforeach
@endsection
