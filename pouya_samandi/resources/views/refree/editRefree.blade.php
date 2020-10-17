@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Edit Refree</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Refree</li>
        </ol>
        <form class="background_table" action="/refree/editRefree/{{ $eachRefree->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="col-md-12 mb-3">
                <input type="file" name="image">

            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <input value="{{ $eachRefree->name }}" type="text" class="form-control" name="name" class="custom-file-input" placeholder="name">
                </div>
                <div class="col-md-6 mb-3">
                    <textarea name="desc" class="form-control" placeholder="Description">{{ $eachRefree->desc }}</textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <input value="{{ $eachRefree->link }}" name="link" class="form-control" placeholder="ٌWebsite Link"></input>
            </div>
            <div class="col-md-12 mt-3 mb-2 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <br>
        </form>
        <hr>
    </div>
@endsection