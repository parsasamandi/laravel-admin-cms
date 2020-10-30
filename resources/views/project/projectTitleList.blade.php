@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if($message = Session::get('faliure'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Project Title List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Project Title List</li>
        </ol>
        <form style="background-color: #e9ecef;border-radius:5px" action="/project/projectTitleList/search" method="get" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <br>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-12 mb-3">
                    <label for="validationDefault03">Search in Name</label>
                    <input name="name" type="search" class="form-control" placeholder="Search...">
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
                        <th scope="col">Name</th>
                        <th scope="col">Project name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subProject as $eachSubProject)
                        <tr>
                            <td>{{ $eachSubProject->name }}</td>
                            <td>{{ $eachSubProject->project->name }}</td>
                            <td><a href="/project/editProjectTitle/{{ $eachSubProject->id }}" class="btn btn-danger">Edit</a></td>
                            <td>
                                <form action="{{ route('projectTitle.destroy', $eachSubProject->id) }}" method="POST">
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