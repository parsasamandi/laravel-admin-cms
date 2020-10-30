@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Skill</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Skill</li>
        </ol>
        <form class="background_table" action="/skill/newSkill/" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Title</label>
                <input name="Title" type="text" class="form-control" placeholder="Title">
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Desc</label>
                    <textarea rows="4" name="desc1" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Second Desc</label>
                    <textarea rows="4" name="desc2" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-12 mb-3">
                    <label for="validationTextarea">Third Desc</label>
                    <textarea rows="4" name="desc3" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Second Title</label>
                <input name="Title2" type="text" class="form-control" placeholder="Title">
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Fourth Desc</label>
                    <textarea rows="4" name="desc4" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTextarea">Fifth Desc</label>
                    <textarea rows="4" name="desc5" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-12 mb-3">
                    <label for="validationTextarea">Sixth Desc</label>
                    <textarea rows="4" name="desc6" class="form-control" placeholder="Description"></textarea>
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