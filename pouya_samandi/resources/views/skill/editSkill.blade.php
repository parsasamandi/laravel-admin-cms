


@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Edit Skill</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Skill</li>
        </ol>
        <form class="baxkground_color" action="/skill/editSkill/{{ $skill->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Title</label>
                <input value="{{ $skill->title }}" name="Title" type="text" class="form-control" placeholder="Title">
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Desc</label>
                    <textarea name="desc1" class="form-control" placeholder="Description">{{ $skill->desc }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Second Desc</label>
                    <textarea name="desc2" class="form-control" placeholder="Description">{{ $skill->desc2 }}</textarea>
                </div>
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-12 mb-3">
                    <label for="validationTextarea">Third Desc</label>
                    <textarea name="desc3" class="form-control" placeholder="Description">{{ $skill->desc3 }}</textarea>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Second Title</label>
                <input value="{{ $skill->title2 }}" name="Title2" type="text" class="form-control" placeholder="Title">
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Fourth Desc</label>
                    <textarea name="desc4" class="form-control" placeholder="Description">{{ $skill->desc4 }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Fifth Desc</label>
                    <textarea name="desc5" class="form-control" placeholder="Description">{{ $skill->desc5 }}</textarea>
                </div>
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-12 mb-3">
                    <label for="validationTextarea">Sixth Desc</label>
                    <textarea name="desc6" class="form-control" placeholder="Description">{{ $skill->des63 }}</textarea>
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