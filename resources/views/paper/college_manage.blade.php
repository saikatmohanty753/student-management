@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Users Management</h5>
                    <div class="card-actions float-end">
                        @can('user-create')
                            <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}"> <i class="fa-solid fa-plus"></i>
                                Create New User</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="text-fade table table-bordered display no-footer datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    <label>{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('user-list')
                                                <a class="btn btn-info" href="{{ route('users.show', $user->id) }}"><i class="fa-solid fa-eye"></i></a>
                                            @endcan

                                            @can('user-edit')
                                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('user-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'waves-effect waves-light  btn  btn-danger',
                                                    'id' => 'deleteThis',
                                                ]) !!}
                                                {!! Form::close() !!}
                                            @endcan
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
