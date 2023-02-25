@extends('layouts.app')


@section('content')
    {{-- @php
dd($role);
@endphp --}}
   
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
       <br><br>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        
                        <h5 class="card-title mb-0">User Details</h5>
                        <div class="card-actions float-right">
    
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="text-fade table table-bordered display no-footer datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">Name:</th>
                                        <th style="width: 25%;">Email:</th>
                                        <th style="width: 25%;">Roles: </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $key => $value)
                                        <tr>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->userdetails->name }}</td>
                                           
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
@endsection
