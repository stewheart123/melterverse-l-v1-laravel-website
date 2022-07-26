@extends('layouts.app')
@section('uploadfiles')
<div class="container">
    <div class="row">
        <div class="col-lg-8 card bg-dark bg-gradient text-white">
        <h5>Upload the File</h5>
<hr>
<form action="/uploadfile" method="post" enctype="multipart/form-data">
     {{ csrf_field() }}
          <div class="form-group row">
             <label for="file" class="col-sm-2 col form-label" style="font-weight: bold;">Unity Asset File</label>
              <div class="col-sm-4">
                <input type="file" class="form-control form-control-sm" name="file">
                 
              </div>
          </div> 
          @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <button type="submit" class="btn btn-primary btn-sm">Submit</button>
  </form>
  {{ !empty($message) }}
        </div>
    </div>
</div>

@endsection