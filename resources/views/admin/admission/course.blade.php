@extends('layouts.app')
@section('content')
  <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Course wise admission application of <b>{{ $clg_name }}</b></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>College Name</th>
                                    <th>Course Name</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $clg_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><a href="{{ url('/applied-admission-list/'.$dep.'/'.$clg_id.'/'.$item->id) }}" class="btn btn-info btn-sm">View</a></td>
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
