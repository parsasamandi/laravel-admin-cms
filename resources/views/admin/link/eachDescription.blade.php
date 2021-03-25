@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        {{-- Header --}}
        <h1 class="mt-4">Each Description</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Each Description</li>
        </ol>
        <hr>
        {{-- Each Link --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-details">{{ $link->description->desc }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection