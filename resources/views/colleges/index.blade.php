@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">College List</h5>
                    {{-- <div class="card-actions float-right">
                        @can('user-create')
                            <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}"> <i class="fa-solid fa-plus"></i>
                                Create New User</a>
                        @endcan
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>College Name</th>
                                   <th>Create User</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($college as $key => $clg)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $clg->name }}</td>     
                                        <td>
                                            <a class="btn btn-outline-success" href="{{url('create-user/'. $clg->id)}}"><i class="fa-solid fa-eye"></i> Create User</a>
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
