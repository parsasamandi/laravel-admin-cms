@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Edit Publication</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Publication</li>
        </ol>
        <form class="background_table" action="/publication/editPublication/{{ $publication->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Title</label>
                <input value="{{ $publication->title }}" name="Title" type="text" class="form-control" placeholder="Title">
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Desc</label>
                    <textarea name="desc1" class="form-control" placeholder="Description">{{ $publication->desc}}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Second Desc</label>
                    <textarea name="desc2" class="form-control" placeholder="Description">{{ $publication->desc2 }}</textarea>
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Third Desc</label>
                    <textarea name="desc3" class="form-control" placeholder="Description">{{ $publication->desc3 }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Fourth Desc</label>
                    <textarea name="desc4" class="form-control" placeholder="Description">{{ $publication->desc4 }}</textarea>
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">fifth Desc</label>
                    <textarea name="desc5" class="form-control" placeholder="Description">{{ $publication->desc5 }}</textarea>
                </div>
            </div>
            <div class="col-md-12 mt-3 mb-2 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <br>
        </form>
        <hr>
    </div>
@endsection