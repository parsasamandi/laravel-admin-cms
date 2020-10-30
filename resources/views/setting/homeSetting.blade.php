@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Home Setting</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Home Setting</li>
        </ol>
        <form class="background_table" action="/setting/homeSetting/" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h5>Header</h5>
                    <hr style="margin-top:0em">
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" class="custom-file-input">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    </div>
                    <img class="mb-3" style="width:105px;height:110px;" src="/images/{{ $home_setting1 }}" />
                </div>
            </div>
            <div class="row row_Style">
                <div class="col-md-3 mb-3">
                    <label>First Name</label>
                    <input value="{{ $home_setting2 }}" type="text" class="form-control" name="first_name" class="custom-file-input" placeholder="First Name">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Last Name</label>
                    <input value="{{ $home_setting3 }}" type="text" class="form-control" name="last_name" class="custom-file-input" placeholder="Last Name">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Slogan</label>
                    <input value="{{ $home_setting4 }}" type="text" class="form-control" name="slogan" class="custom-file-input" placeholder="slogan">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Description</label>
                    <textarea type="text" class="form-control" name="short_desc" class="custom-file-input" placeholder="Short description">{{ $home_setting5 }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5>Life Goals</h5>
                    <hr style="margin-top:0em">
                    <label>Life Goals</label>
                    <textarea rows="5" cols="50" type="text" class="form-control" name="life_goals" class="custom-file-input" placeholder="Life Goals">{{ $home_setting6 }}</textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <h5>About Me</h5>
                    <hr style="margin-top:0em">
                    <label>About Me</label>
                    <textarea rows="5" cols="50" type="text" class="form-control" name="about_me" class="custom-file-input" placeholder="About Me">{{ $home_setting7 }}</textarea>
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