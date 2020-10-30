@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Project</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Project</li>
        </ol>
        <form class="background_table" action="/project/newProject/" method="POST" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <br>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <input type="text" name="name" placeholder="Title" class="form-control">
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <input type="text" name="background" placeholder="Background-color" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" name="section_id" placeholder="Section Id" class="form-control" required>
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