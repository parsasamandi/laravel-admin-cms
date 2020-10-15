@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        <h1 class="mt-4">Each Refree</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">each Refree</li>
        </ol>
        <hr>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">name</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $eachRefree->name }}</td>
                        <td>{{ $eachRefree->desc }}</td>
                        <td><img style="width:50px;height:55px;" src="/images/{{ $eachRefree->image }}" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
@endsection