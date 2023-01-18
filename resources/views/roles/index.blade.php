@extends ('layouts.app') @section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Role Management</h5>
                    <div class="card-actions float-right">
                        @can('role-create')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#info-alert-modal"><i class="fa-solid fa-plus"></i> New Role</button>

                            {{-- <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">
                        <i class="fa-solid fa-plus"></i> Create New Role</a> --}}
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>

                             <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a class="btn btn-outline-info" href="{{ route('roles.show', $role->id) }}"><i
                                                    class="fa-solid fa-eye"></i></a>
                                            {{-- @can('role-edit') --}}
                                                <a class="btn btn-outline-primary"
                                                    href="{{ route('roles.edit', $role->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            {{-- @endcan --}}
                                            @can('role-delete')
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['roles.destroy', $role->id],
                                                    'style' => 'display:inline',
                                                    'id' => 'deleteForm',
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-outline-danger',
                                                    'id' => 'deleteThis',
                                                ]) !!} {!! Form::close() !!}
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


    <!-- Add New Role Modal -->

    <div class="modal fade" id="info-alert-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-horizontal form-element" method="post" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center">
                            {{-- <i class="fa-solid fa-face-rolling-eyes text-info fs-36"></i> --}}
                            {{-- <h4 class="mt-2">Create New Role</h4> --}}
                            <div class="box mt-2">
                                <div class="box-header with-border">
                                    <h4 class="box-title text-info">Create New Role</h4>
                                </div>

                                <div class="box-body">
                                    <div class="form-group row">
                                        <label for="inputRole" class="col-sm-4 form-label">Role Name</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter New Role Name">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('submit', '[id^=deleteForm]', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure to delete this?",
                text: "You won't be able to revert this again!",
                type: "warning",
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this)[0].submit();
                }
            });
        });
    </script>
@endsection
