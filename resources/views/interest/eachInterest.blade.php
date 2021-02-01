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
                        <th scope="col">Image</th>
                        <th scope="col">Image2</th>
                        <th scope="col">Image3</th>
                        <th scope="col">Image4</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Desc2</th>
                        <th scope="col">Desc3</th>
                        <th scope="col">Desc4</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img style="width:50px;height:55px;" src="/images/{{ $eachInterest->image }}" /></td>
                        <td><img style="width:50px;height:55px;" src="/images/{{ $eachInterest->image2 }}" /></td>
                        <td><img style="width:50px;height:55px;" src="/images/{{ $eachInterest->image3 }}" /></td>
                        <td><img style="width:50px;height:55px;" src="/images/{{ $eachInterest->image4 }}" /></td>
                        <td>{{ $eachInterest->desc }}</td>
                        <td>{{ $eachInterest->desc2 }}</td>
                        <td>{{ $eachInterest->desc3 }}</td>
                        <td>{{ $eachInterest->desc4 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection