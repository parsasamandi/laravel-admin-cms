@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        <h1 class="mt-4">Edit Project</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Project</li>
        </ol>
        <form class="background_table" action="/project/editProject/{{ $project->project_id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <input value="{{ $project->name }}" type="text" name="name" placeholder="Title" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input value="{{ $project->background_color }}" type="text" name="background" placeholder="Background Color" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <input  value="{{ $project->section_id }}" type="text" name="section_id" placeholder="Section Id" class="form-control">
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

