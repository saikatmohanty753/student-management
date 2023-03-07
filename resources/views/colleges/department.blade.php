{{-- @extends('layouts.app')
@section('content')


  <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">College List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-table">
                            <thead>
                                <tr>
                                    
                                    <th>Department</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departmentview as $key => $item)
                                    <tr>
                                        
                                        <td>{{ $item->department->course_for }}</td>
                                       
                                        <td><a href="{{ url('course-view/'. $item->department_id) }}"
                                            class="btn  waves-effect waves-themed btn-outline-primary">
                                            <i class="fa-solid fa-eye"></i></a></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
