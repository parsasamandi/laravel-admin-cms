@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if($message = Session::get('faliure'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Media List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Media List</li>
        </ol>
        <form style="background-color: #e9ecef;border-radius:5px" action="/media/mediaList/search" method="get" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <br>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-12 mb-3">
                    <label for="validationDefault03">Search in Height or Width:</label>
                    <input name="media_hw" type="search" class="form-control" placeholder="Search...">
                </div>
            </div>
            <div class="col-md-12 mb-3 text-center">
                <button style="text-align:center" class="btn btn-primary" type="submit">Search</button>
            </div>
            <br>
        </form>
        <hr>
        <div class="table-responsive text-nowrap">
            <table id="experience_table" class="table table-striped table-bordered text-center">
            <!-- class="thead-dark" -->
                <thead>
                    <tr>
                        <th scope="col">Media</th>
                        <th scope="col">Media Text</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($media as $eachMedia)
                        <tr>
                            @if($eachMedia->type == 0)
                                <td><img style="width:50px;height:55px;" src="/images/{{ $eachMedia->media_url }}" /></td>
                            @endif
                            @if($eachMedia->type == 1)
                                <td>{{ $eachMedia->media_url }}</td>
                            @endif
                            <td>{{ optional($eachMedia->mediaTextRel)->mediaText }}</td>
                            <td><a href="/media/editMedia/{{ $eachMedia->id }}" class="btn btn-danger">Edit</a></td>
                            <td>
                                <form action="{{ route('media.destroy', $eachMedia->id) }}" method="POST">
                                    {{ @csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection