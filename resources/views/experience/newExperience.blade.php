@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Experience</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Experience</li>
        </ol>
        <form class="background_table" action="/experience/newExperience" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault03">Title</label>
                    <input name="Title" type="text" class="form-control" placeholder="Title">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault03">Description</label>
                    <input name="Title" type="text" class="form-control" placeholder="Insert New Description In Description Section" disabled>
                </div>
            </div>
            <div style="margin-left:15px;margin-right:10px;" class="col-md-8 mb-3">
                <input type="file" name="image" class="custom-file-input">
                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
            </div>
            <div class="col-md-12 mb-3 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <br>
        </form>
        <hr>
    </div>
@endsection