@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Project Title</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Project Title</li>
        </ol>
        <form class="background_table" action="/project/newProjectTitle/" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="validationTextarea">Title</label>
                        <input type="text" name="name" placeholder="Title" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationTextarea">Project Name</label>
                        <select name="projectBox" class="browser-default custom-select">
                            @foreach($project as $eachProject)
                                <option name="project" value="{{ $eachProject->project_id }}" selected>{{ $eachProject->name }}</option>
                            @endforeach
                        </select>
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