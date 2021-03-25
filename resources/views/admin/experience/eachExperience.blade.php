@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        <h1 class="mt-4">Each Experience</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">each Experience</li>
        </ol>
        <hr>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $experience->title }}</td>
                        @foreach($experience->description as $desc)
                            <td>{{ $desc->desc }}</td>
                        @endforeach
                        <td><img style="width:50px;height:55px;" src="/images/{{ $experience->image }}" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
@endsection