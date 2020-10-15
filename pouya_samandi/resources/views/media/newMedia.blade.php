@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Media</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Media</li>
        </ol>
        <form class="background_table" action="/media/newMedia/" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="youtube_url" class="custom-file-input" placeholder="Youtube Url">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="file" name="image" class="custom-file-input">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Media Text</label>
                    <select name="mediaTextBox" class="browser-default custom-select">
                        <option name="mediaText_null" value="mediaText_null">Null</option>
                        @foreach($media_text as $eachMediaText)
                            <option name="media" value="{{ $eachMediaText->id }}">{{ $eachMediaText->mediaText }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Description</label>
                    <select name="descriptionBox" class="browser-default custom-select">
                        <option name="description_null" value="description_null">Null</option>
                        @foreach($description as $eachDescription)
                            <option value="{{ $eachDescription->id }}">{{ $eachDescription->desc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-12 mb-3">
                    <hr>
                    <label for="validationTextarea">Project(Put Two Medias in a row)</label>
                    <select name="projectBox" class="browser-default custom-select">
                        <option name="project_null" value="project_null">Null</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->project_id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
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

