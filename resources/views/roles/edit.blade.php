@extends('layouts.app')

@section('content')



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Role Permission ({{$role->name}})</h5>
                <div class="card-actions float-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}">
                        <i class="fa-solid fa-left-long"></i> Back</a>
                </div>
            </div>
            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id], 'class' => 'form-horizontal form-element']) !!}
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label for="inputRole" class="col-sm-4 form-label">Role Name</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" placeholder="Enter New Role Name" value="{{$role->name}}">
                    </div>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Module</th>
                        <th>List</th>
                        <th>Create</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach ($permission->chunk(5) as $chunk)
                    <tr>
                        @foreach ( $chunk as $key => $value)
                        <td><input type="checkbox" id="md_checkbox_{{$key}}" class="filled-in chk-col-primary"
                                value="{{$value->id}}" name="permission[]" {{in_array($value->id, $rolePermissions) ?
                            'checked' : ''}}>
                            <label for="md_checkbox_{{$key}}">{{ ($key % 5 == 0) ? $value->name : '' }}</label>
                        </td>
                        @endforeach
                    </tr>

                    @endforeach

                </table>
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <button type="submit" class="btn btn-primary float-end mb-4">Submit</button>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
