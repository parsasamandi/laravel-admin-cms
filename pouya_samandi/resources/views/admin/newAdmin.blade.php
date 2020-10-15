@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">New Admin</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">New Admin</li>
        </ol>
        <form class="background_table" action="/admin/newAdmin" method="POST" id="regForm">
            {{ csrf_field() }}
            <br>
            <div class="col-md-6 mb-3">
                <input type="text" id="inputName" name="name" class="form-control" placeholder="Full name" autofocus>
                @if ($errors->has('name'))
                    <span class="error">{{ $errors->first('name') }}</span>
                @endif 
            </div>
            <div class="row row_style">
                <div class="col-md-6 mb-3">
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address">
                    @if ($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                    @endif 
                </div>
                <div class="col-md-6 mb-3">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="error">{{ $errors->first('password') }}</span>
                    @endif 
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



