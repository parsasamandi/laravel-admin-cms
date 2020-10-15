@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Education</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Eduction</li>
        </ol>
        <form class="background_table" action="/education/newEducation" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">name</label>
                <input name="name" type="text" class="form-control" placeholder="Name">
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Degree</label>
                    <textarea name="degree" class="form-control" placeholder="Degree"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">TOEFL</label>
                    <textarea name="toefl" class="form-control" placeholder="TOEFL"></textarea>
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">GPA</label>
                    <textarea name="GPA" class="form-control" placeholder="GPA"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">education period</label>
                    <textarea name="period" class="form-control" placeholder="Period"></textarea>
                </div>
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">university description</label>
                    <textarea name="university_description" class="form-control" placeholder="University description"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Thesis topic</label>
                    <textarea name="thesis_topic" class="form-control" placeholder="Thesis topic"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-2 mt-3 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <br>
        </form>
        <hr>
    </div>
@endsection