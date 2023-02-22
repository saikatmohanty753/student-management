@extends('layouts.app')
@section('content')
    <div class="row mt-5">

        <div class="col-xl-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Academic Course List</h5>
                    <div class="card-actions float-right">

                            <a class="btn btn-primary btn-sm" href="{{ url('/academic-course-structure/create') }}">
                                <i class="fa-solid fa-plus"></i> Add Course Structure</a>

                    </div>
                </div>

                <div class="card-body">


                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script>

        </script>
    @endsection
