@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Filter <span class="fw-300"><i>Admission Detail</i></span>

                    </h2>


                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        From date
                                    </label>
                                    <input type="date" class="form-control" id="start_date" onchange="getAdmissionList()">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="single-placeholder">
                                        To date
                                    </label>
                                    <input type="date" class="form-control" id="to_date" onchange="getAdmissionList()">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Student Admission List</h5>
                    <div class="card-actions float-right">

                    </div>
                </div>
                <div class="card-body" id="add-list">

                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            getAdmissionList();
        });
        function getAdmissionList()
        {
            $.ajax({
                url:"{{ route('finalAdmissionListAjax') }}",
                type:"GET",
                data:{"_token":"{{ csrf_token() }}"},
                dataType:"JSON",
                success:function(res)
                {
                    $('#add-list').html(res);
                }
            })
        }
    </script>
    @endsection
@endsection
