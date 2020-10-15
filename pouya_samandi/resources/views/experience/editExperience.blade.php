@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Edit Experience</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Experience</li>
        </ol>
        <form class="background_table" action="/experience/editExperience/{{ $experience->id }}" method="POST" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <br>
            <div class="col-md-12 mb-3">
                <label for="validationDefault03">Title</label>
                <input value="{{ $experience->title }}" name="Title" type="text" class="form-control" placeholder="Title">
            </div>  
            <div style="margin-left:10px;margin-right:10px;" class="row">
                <div class="col-md-6 mb-3">
                    <input type="file" name="image" class="custom-file-input" required>
                    <label style="margin-left:5px;margin-right:5px;" class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                </div>
                <div class="col-md-2 mb-3">
                    <img style="width:50px;height:55px;" src="/images/{{ $experience->image }}"/>
                </div>
            </div>
            <div class="col-md-12 mb-3 mt-3 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <br>
        </form>
        <hr>
    </div>
@endsection