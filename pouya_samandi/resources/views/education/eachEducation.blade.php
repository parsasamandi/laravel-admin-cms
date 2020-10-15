@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        <h1 class="mt-4">Each Education</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">each Education</li>
        </ol>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $publication->name }}</td>
                        <td>{{ $education->degree }}</td>
                        <td>{{ $education->education_period }}</td>
                        <td>{{ $education->GPA }}</td>
                        <td>{{ $education->TOEFL }}</td>
                        <td>{{ $education->Thesis_topic }}</td>
                        <td>{{ $education->university_desc }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
@endsection