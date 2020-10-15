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
            <div class="container-fluid">
                <div class="col-md-12 mb-3">
                    <input type="file" name="image" class="custom-file-input">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                </div>
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="name" class="custom-file-input" placeholder="name">
                </div>
                <div class="col-md-6 mb-3">
                    <textarea name="desc" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <input name="link" class="form-control" placeholder="ٌWebsite Link"></input>
            </div>
            <div class="col-md-12 mt-3 mb-2 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <br>
        </form>
        <hr>
    </div>
@endsection

