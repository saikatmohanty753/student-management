@extends('layouts.app')
@section('content')
    <style>
        .box-body {
            padding: 30px;
        }
    </style>
    {{-- <div class="container">
        <div class="row">
            <div class="col">Paper</div>
            <div class="col"><label class="form-label">Paper Type <span class="text-danger">*</span></label></div>
            <div class="w-100"></div>
            <div class="col">
                @if (isset($Paper))
                    <select name="Paper" id="">
                        <option hidden value="">choose...</option>
                        @foreach ($Paper as $s)
                            <option value="{{ $s->id }}">{{ $s->paper_type }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="col"><input type="text" class="form-control" placeholder="Enter Paper Type" name="paper_type"
                    id="paper_type"></div>
            <div class="col-md-4 mt-4">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </div>
        </div>
    </div> --}}

    <form method="POST" action="{{url('/papersubtype')}}" id="myForm">
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
    </form>
@endsection
