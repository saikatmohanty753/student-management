@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">View Permission Assign to  {{ucfirst($role->name)}}</h5>
                <div class="card-actions float-end">
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}">
                        <i class="fa-solid fa-left-long"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
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
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
