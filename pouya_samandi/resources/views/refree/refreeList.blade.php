@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if($message = Session::get('faliure'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Refree List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Refree List</li>
        </ol>
        <form style="background-color: #e9ecef;border-radius:5px" action="/refree/refreeList/search" method="get" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <br>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-6 mb-3">
                    <label for="validationDefault03">Search in Name</label>
                    <input name="name" type="search" class="form-control" placeholder="Search...">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault03">Search in First Description</label>
                    <input name="desc" type="search" class="form-control" placeholder="Search...">
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
                        <th scope="col">name</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Link</th>
                        <th scope="col">Image</th>
                        <th scope="col">Each</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($refree as $eachRefree)
                        <tr>
                            <td>{{ $eachRefree->name }}</td>
                            <td>{{ $eachRefree ->desc }}</td>
                            <td>{{ $eachRefree ->link }}</td>
                            <td><img style="width:50px;height:55px;" src="/images/{{ $eachRefree->image }}" /></td>
                            <td><a class="btn btn-danger" href="/refree/eachRefree/{{ $eachRefree->id }}">{{ $eachRefree->id }}</a></td>
                            <td><a href="/refree/editRefree/{{ $eachRefree->id }}" class="btn btn-danger">Edit</a></td>
                            <td>
                                <form action="{{ route('refree.destroy', $eachRefree->id) }}" method="POST">
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