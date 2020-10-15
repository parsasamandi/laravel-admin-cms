@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Edit Link</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Link</li>
        </ol>
        <form class="background_table" action="/link/editLink/{{ $link->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <input value="{{ $link->text }}" type="text" class="form-control" name="text" class="custom-file-input" placeholder="Text">
                </div>
                <div class="col-md-6 mb-3">
                    <input value="{{ $link->link }}" type="text" class="form-control" name="link" class="custom-file-input" placeholder="Link Url">
                </div>
                <div class="col-md-12 mb-3">
                    <select name="descriptionBox" class="browser-default custom-select">
                        @foreach($desc as $eachDesc)
                            <option name="desc" value="{{ $eachDesc->id }}" {{ $eachDesc->id == $link->desc_id ? 'selected' : '' }} required>{{ $eachDesc->desc }}</option>
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

