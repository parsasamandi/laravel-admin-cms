@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        <h1 class="mt-4">Each Publication</h1>
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
                        <th scope="col">Desc1</th>
                        <th scope="col">Desc2</th>
                        <th scope="col">Desc3</th>
                        <th scope="col">Desc4</th>
                        <th scope="col">Desc5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $publication->title }}</td>
                        <td>{{ $publication->desc1 }}</td>
                        <td>{{ $publication->desc2 }}</td>
                        <td>{{ $publication->desc3 }}</td>
                        <td>{{ $publication->desc4 }}</td>
                        <td>{{ $publication->desc5 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
@endsection