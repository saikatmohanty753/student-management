@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Add Paper Sub Type</h5>

        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/papersubtype') }}" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Paper Type</label>
                            @if (isset($Paper))
                                <select name="Paper" id="" class="form-control">
                                    <option hidden value="">choose...</option>
                                    @foreach ($Paper as $s)
                                        <option value="{{ $s->id }}">{{ $s->paper_type }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Paper Sub Type</label>
                            <input type="text" class="form-control" placeholder="Enter Paper Sub Type" name="paper_type"
                                id="paper_type">
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
