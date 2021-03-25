@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if($message = Session::get('faliure'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Project List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Project List</li>
        </ol>
        <form style="background-color: #e9ecef;border-radius:5px" action="/project/projectList/search" method="get" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <br>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-12 mb-3">
                    <label for="validationDefault03">Search in Name </label>
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
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Background Color</th>
                        <th scope="col">Section Id</th>
                        <th scope="col">Project Title</th>
                        <th scope="col">Media</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project as $eachProject)
                        <tr>
                            <td>{{ $eachProject->name }}</td>
                            <td>{{ $eachProject->background_color }}</td>
                            <td>{{ $eachProject->section_id}}</td>
                            <td>
                                @foreach($eachProject->sub_project as $projectTitle)
                                    {{ $projectTitle->name}}
                                @endforeach
                            </td>
                            <td>
                                @foreach($eachProject->media as $projectMedia)
                                    <img style="width:50px;height:55px;" src="/images/{{ $projectMedia->media_url }}" />
                                @endforeach
                            </td>
                            <td>
                                @foreach($eachProject->description as $projectDesc)
                                    [ {{ $projectDesc->desc }} ]/
                                @endforeach
                            </td>
                            <td><a href="/project/editProject/{{ $eachProject->project_id }}" class="btn btn-danger">Edit</a></td>
                            <td>
                                <form action="{{ route('project.destroy', $eachProject->project_id) }}" method="POST">
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