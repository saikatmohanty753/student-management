@extends('layouts.app')
@section('content')
    <style>
        .box-body {
            padding: 30px;
        }
    </style>
  

    {{-- <form method="POST" action="{{url('/papersubtype')}}" id="myForm">
      @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Paper</label>
        @if (isset($Paper))
                    <select name="Paper" id="" class="form-control">
                        <option hidden value="">choose...</option>
                        @foreach ($Paper as $s)
                            <option value="{{ $s->id }}">{{ $s->paper_type }}</option>
                        @endforeach
                    </select>
                @endif
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Paper Type</label>
        <input type="text" class="form-control" placeholder="Enter Paper Type" name="paper_type"
                    id="paper_type">
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
    </form> --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="exampleInputEmail1">Paper</label>
                @if (isset($Paper))
                            <select name="Paper" id="" class="form-control">
                                <option hidden value="">choose...</option>
                                @foreach ($Paper as $s)
                                    <option value="{{ $s->id }}">{{ $s->paper_type }}</option>
                                @endforeach
                            </select>
                        @endif
            </div>
            <div class="col-md-4">
                <label for="exampleInputPassword1">Paper Type</label>
                <input type="text" class="form-control" placeholder="Enter Paper Type" name="paper_type"
                            id="paper_type">
            </div>
            <div class="col-md-4">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div> --}}
@endsection
