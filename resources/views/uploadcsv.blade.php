@extends('template.master')
@section('content')

@if($errors->any())
<div class="alert alert-danger">
        <strong>Whoops!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
</div>
@endif
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Files Upload form </h4>
        <p class="card-description">
            Files Upload form
        </p>
        <form class="forms-sample" method="POST" action="{{route('fileUpload')}}" enctype="multipart/form-data">
            @csrf

    
          <div class="form-group">
            <label>File upload</label>
            <input type="file" name="file">
          </div> 
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
      </div>
    </div>
  </div>    
@endsection

{{-- @section('ajaxscript')


    
@endsection --}}