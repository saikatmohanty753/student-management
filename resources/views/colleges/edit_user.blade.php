@extends('layouts.app')
@section('content')
    <div class="row">
        <style>
            .box-body {
                padding: 30px;
            }
        </style>
        <div class="col-xl-12">
            <div class="card">


                @if (count($errors) > 0)
                    <div class="alert alert-danger">

                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>
                @endif

                <form method="post" action="{{ url('/update-user') }}" id="myForm">
                    @csrf
                    
                    <input type="hidden" id="hid" value="{{ $user->id }}" name="hid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$user->email}}">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number"
                                        name="mob_no" value="{{$user->mob_no}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Role <span class="text-danger">*</span></label>
                                    <select class="form-select form-control" aria-label="Default select example"
                                        name="role">
                                        <option value=""> Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{$role->id == $user->role_id ? 'selected' : ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" placeholder="Enter password"
                                        name="password">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Comfirm Pasword <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" placeholder="Enter Confirm Pasword"
                                        name="comfirm_password">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"
                                    style="margin-right: 8px;">Cancel</button>
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>

                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
