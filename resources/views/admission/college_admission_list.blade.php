@extends('layouts.app')
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
                                    <th>Sl. No.</th>
                                    <th>College Name </th>
                                    <th>No. of Approved Student</th>
                                    <th>No. of Rejected Student</th>
                                    <th>No. of not verified</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($colleges) && $colleges->count() > 0)
                                @foreach ($colleges as $key => $clg)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $clg->name }}</td>
                                        <td>{{ getAdmissionCountSatatus($clg->id,2) }}</td>
                                        <td>{{ getAdmissionCountSatatus($clg->id,3) }}</td>
                                        <td>{{ getAdmissionCountSatatus($clg->id,1) }}</td>
                                        <td><a href="{{ route('applied-admission-list-ad',[$clg->id]) }}" class="btn btn-info btn-sm">View</a></td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
