@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Description</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Description  </li>
        </ol>
        <form class="background_table" action="/description/newDescription/" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="col-md-12 mb-3">
                <input type="text" name="desc1" placeholder="Description" class="form-control">
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Project Name(If your description belongs to it)</label>
                    <select name="projectBox" class="browser-default custom-select">
                        <option name="project_name" value="project_name">Null</option>
                        @foreach($project as $eachProject)
                            <option name="project" value="{{ $eachProject->project_id }}" selected>{{ $eachProject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Experience(If your description belongs to it)</label>
                    <select name="experienceBox" class="browser-default custom-select">
                        <option name="experience_url" value="experience_url">Null</option>
                        @foreach($experience as $eachExperience)
                            <option name="experience" value="{{ $eachExperience->id }}" selected>{{ $eachExperience->title }}</option>
                        @endforeach
                    </select>
                </div>  
            </div> 
            <div class="row row_style">
                <div class="col-md-12 mb-3">
                    {{-- Get col-md size from 1 to 12 --}}
                    <label for="validationTextarea">Size(Choose a number from 1 to 12)</label>
                    <input type="text" class="form-control" name="size" class="custom-file-input" placeholder="Size">
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