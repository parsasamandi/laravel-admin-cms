@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        {{-- Header --}}
        <h1 class="mt-4">Each Experience</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">each Experience</li>
        </ol>
        <hr>
        {{-- Each Link --}}
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $eachInterest->desc }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection