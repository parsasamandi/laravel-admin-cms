@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        @if($message = Session::get('faliure'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif
        <h1 class="mt-4">Education List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Education List</li>
        </ol>
        <form style="background-color: #e9ecef;border-radius:5px" action="/education/educationList/search" method="get" enctype="multipart/form-data">
            {{ @csrf_field() }}
            <br>
            <div style="margin-left:1px;margin-right:1px;" class="row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Search in name</label>
                    <input name="name" type="search" class="form-control" placeholder="Search...">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Search in Degree</label>
                    <input name="degree" type="search" class="form-control" placeholder="Search...">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Search in Thesis Topic</label>
                    <input name="Thesis_topic" type="search" class="form-control" placeholder="Search...">
                </div>
            </div>
            <div class="col-md-12 mb-3 text-center">
                <button style="text-align:center" class="btn btn-primary" type="submit">Search</button>
            </div>
            <br>
        </form>
        <hr>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Degree</th>
                        <th scope="col">Education Period</th>
                        <th scope="col">GPA</th>
                        <th scope="col">TOEFL</th>
                        <th scope="col">Thesis topic</th>
                        <th scope="col">University description</th>
                        <th scope="col">Each</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($education as $eachEducation)
                        <tr>
                            <td>{{ $eachEducation->name }}</td>
                            <td>{{ $eachEducation->degree }}</td>
                            <td>{{ $eachEducation->education_period }}</td>
                            <td>{{ $eachEducation->GPA }}</td>
                            <td>{{ $eachEducation->TOEFL }}</td>
                            <td>{{ $eachEducation->Thesis_topic }}</td>
                            <td>{{ $eachEducation->university_desc }}</td>
                            <td><a class="btn btn-danger" href="/education/eachEducation/{{ $eachEducation->id }}">{{ $eachEducation->id }}</a></td>
                            <td><a href="/education/editEducation/{{ $eachEducation->id }}" class="btn btn-danger">Edit</a></td>
                            <td>
                                <form action="{{ route('education.destroy', $eachEducation->id) }}" method="POST">
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