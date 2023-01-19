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

                <form method="post" action="{{ url('/store-user') }}" id="myForm">
                    @csrf
                    <input type="hidden" id="hid" value="{{ $id }}" name="college_id">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name">
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Email" name="email">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number"
                                        name="mob_no">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Role <span class="text-danger">*</span></label>
                                    <select class="form-select form-control" aria-label="Default select example"
                                        name="role">
                                        <option value=""> Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
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
    <div class="row mt-5">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                            <thead>
                                <tr class="text-dark">
                                    <th style="">Sl. No</th>
                                    <th>Name</th>
                                    <th>College Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Role</th>
                                    <th>Action</th>

                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $clg)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $clg->name }}</td>
                                        <td>{{ $clg->clg_name }}</td>
                                        <td>{{ $clg->email }}</td>
                                        <td>{{ $clg->mob_no }}</td>
                                        <td>{{ $clg->role_name }}</td>
                                        <td>
                                             {{-- @can('user-list')
                                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}"><i
                                                        class="fa-solid fa-eye"></i></a>
                                            @endcan --}}

                                            <a class="btn btn-primary waves-effect waves-themed" href="{{ route('college-users.edit',$clg->id) }}"><i class="fa fa-edit"></i></a>

                                            <a class="btn btn-primary waves-effect waves-themed" href="{{ route('college-users.delete',$clg->id) }}"><i class="fa fa-trash"></i></a>
                                           
                                            
                                        </td>

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
