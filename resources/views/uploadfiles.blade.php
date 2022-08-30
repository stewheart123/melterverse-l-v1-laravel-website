@extends('layouts.app')
@section('uploadfiles')
<div class="container">
    <div class="row">
        <div class="p-3 col-lg-8 card bg-dark bg-gradient text-white">
        <h5 class="m-0">Upload to the Marketplace</h5>
        <p>This feature is still at an experimental stage, tutorial will accompany this eventually.</p>
    <hr>
    <form action="/uploadfile" method="post" enctype="multipart/form-data" class="d-none">
     {{ csrf_field() }}
          <div class="form-group row">
              <div class="col-lg-12 p-3">

                <label for="folder" class="col-sm-12 col form-label" style="font-weight: bold;">Pack Name</label>
                <input class="mb-3" type="text" class="form-control form-control-sm" name="folder">
                <label for="file" class="col-sm-12 col form-label" style="font-weight: bold;">Unity Asset File</label>
                <input class="mb-3" type="file" class="form-control form-control-sm" name="file">
                <label for="image" class="col-sm-12 col form-label" style="font-weight: bold;">Marketplace photo</label>
                <input class="mb-3" type="file" class="form-control form-control-sm" name="image">
                <label for="description" class="col-sm-12 col form-label" style="font-weight: bold;">Unity Asset File</label>
                <textarea class="mb-3 h-25 col-lg-9" type="text" class="form-control form-control-sm" name="description" ></textarea>
            
                <select class="ms-3" name="availability">
                @foreach($availability as $status)
                    <option value="{{$status}}">{{$status}}
                    </option>
                @endforeach
                </select>

                 
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
  @if (!empty($message)) 
  {{ $message }}
  @endif
        </div>
    </div>
</div>

@endsection