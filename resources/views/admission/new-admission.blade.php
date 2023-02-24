@extends('layouts.app')
@section('content')
    <div class="row mt-5">

        <div class="col-xl-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">New Admission Notices</h5>
                </div>

                <div class="card-body">
                    <table class="text-fade table table-bordered display no-footer datatable table-responsive-lg dt-table">
                        <thead>
                            <tr class="text-dark">
                                <th style="width: 10%;">Sl. No</th>
                                <th>Admission for</th>
                                <th>Details</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($notice))
                                @foreach ($notice as $key => $item)

                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>UG Students</span>
                                        </td>
                                        <td>
                                            {{ Str::limit($item->details, 30) }}
                                        </td>
                                        <td><a href="{{ url('view-notice/' . $item->id . '/' . $item->notification_id) }}"
                                                class="btn  waves-effect waves-themed btn-outline-primary">
                                                <i class="fa-solid fa-eye"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script></script>
    @endsection
