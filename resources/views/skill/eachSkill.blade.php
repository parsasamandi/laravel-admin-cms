@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3">
        <h1 class="mt-4">Each Skill</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">each Skill</li>
        </ol>
        <hr>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Desc2</th>
                        <th scope="col">Desc3</th>
                        <th scope="col">Second Title</th>
                        <th scope="col">Desc4</th>
                        <th scope="col">Desc5</th>
                        <th scope="col">Desc6</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $eachSkill->title }}</td>
                        <td>{{ $eachSkill->desc }}</td>
                        <td>{{ $eachSkill->desc2 }}</td>
                        <td>{{ $eachSkill->desc3 }}</td>
                        <td>{{ $eachSkill->title2 }}</td>
                        <td>{{ $eachSkill->desc4 }}</td>
                        <td>{{ $eachSkill->desc5 }}</td>
                        <td>{{ $eachSkill->desc6 }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
@endsection