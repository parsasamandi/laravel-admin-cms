@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Refree</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Refree</li>
        </ol>
        <form class="background_table" action="/refree/newRefree/" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="col-md-12 mb-3">
                <label for="validationTextarea">Image</label>
                <br>
                <input type="file" name="image" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Name</label>
                    <input type="text" class="form-control" name="name" class="custom-file-input" placeholder="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Description</label>
                    <textarea rows="5" cols="50" name="desc" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="validationTextarea">Website Link</label>
                <input type="url" name="link" class="form-control" placeholder="ٌWebsite Link"></input>
                @if($errors->has('link'))
                    <span class="error">{{ $errors->first('link') }}</span>
                @endif
            </div>
            <div class="col-md-12 mt-3 mb-2 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <br>
        </form>
        <hr>
    </div>
@endsection

