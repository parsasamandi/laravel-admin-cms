@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Edit Interest</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Interest</li>
        </ol>
        <form class="background_table" action="/interest/editInterest/{{ $interest->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="container-fluid">
                <div class="col-md-12 mb-3">
                    <input type="file" name="image" class="custom-file-input">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row row_style">
                    <div class="col-md-4 mb-3">
                        <input type="file" name="image2" class="custom-file-input">
                        <label class="custom-file-label" for="validatedCustomFile">Choose Third file...</label>
                    </div>
                    <div class="col-md-4 mb-3">
                        <textarea name="desc" class="form-control" placeholder="Description">{{ $interest->desc }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <textarea name="desc2" class="form-control" placeholder="Description">{{ $interest->desc2 }}</textarea>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row row_style">
                    <div class="col-md-4 mb-3">
                        <input type="file" name="image3" class="custom-file-input">
                        <label class="custom-file-label" for="validatedCustomFile">Choose Third file...</label>
                    </div>
                    <div class="col-md-4 mb-3">
                        <textarea name="desc3" class="form-control" placeholder="Description">{{ $interest->desc3 }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <textarea name="desc4" class="form-control" placeholder="Description">{{ $interest->desc4 }}</textarea>
                    </div>
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