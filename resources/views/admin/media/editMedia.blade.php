@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-block">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <h1 class="mt-4">Edit Media</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Media</li>
        </ol>
        <form class="background_table" action="/media/editMedia/{{ $media->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row">
                <div class="col-md-6 mb-3">
                    @if($media->type == 1)
                        <input value="{{ $media->media_url }}" type="text" class="form-control" name="youtube_url" class="custom-file-input" placeholder="Youtube Url">
                    @else
                        <input type="text" class="form-control" name="youtube_url" class="custom-file-input" placeholder="Youtube Url">
                    @endif
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
                        <option value="">Null</option>
                        @foreach($media_text as $eachMediaText)
                            <option value="{{ $eachMediaText->id }}" {{ $eachMediaText->id == $media->mediaText_id ? 'selected' : '' }}>{{ $eachMediaText->mediaText }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Description</label>
                    <select name="descriptionBox" class="browser-default custom-select">
                        <option value="">Null</option>
                        @foreach($description as $description)
                            <option value="{{ $description->id }}" {{ $description->id == $media->desc_id ? 'selected' : '' }} required>{{ $description->desc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-12 mb-3">
                    <hr>
                    <label for="validationTextarea">Project(Put Two Medias in a row)</label>
                    <select name="projectBox" class="browser-default custom-select">
                        <option value="">Null</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->project_id }}" {{ $project->project_id == $media->project_id ? 'selected' : '' }} >{{ $project->name }}</option>
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


