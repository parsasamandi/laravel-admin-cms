@extends('layouts.styleScript')
@section('content')
<style>
    @media only screen and (max-width : 320px) {
        .hide-on-mobile {
            display: none;
        }
    }
</style>
<body class="is-preload">
    <!-- Sidebar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <span class="d-block d-lg-none">Pouya Samandi</span>
            <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                    src="images/pouya2.jpeg" alt="" /></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul style="font-size:16px" class="navbar-nav">
                <li style="font-size:30px;" class="text-white">Projects</li>
                @foreach($projects as $project)
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" onclick="goto('{{ $project->section_id }}')">{{ $project->section_id }}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top navBarStyle">
        <a class="navbar-brand text-white" href="#">Pouya Samandi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="cv">CV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="project">Projects</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link"  onclick="goto('footer')">Contact me </a>
                </li>
            </ul>
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2 bg-white" type="search" placeholder="Search" aria-label="Search">
                <button style="font-size:11px" class="btn bg-white" type="submit">Search</button>
            </form> --}}
        </div>
    </nav>

    <!-- Page Content-->
    <div class="container-fluid p-0">
        @foreach($projects as $project)
            <section style="margin-bottom:-2em;" class="resume-section" id="{{ $project->section_id }}">
                <div class="resume-section-content">
                    <h3 style="margin-top:1em">
                        {{ $project->name }}
                        &nbsp;<i class="fa fa-tasks"></i>
                    </h3>
                    <div class="flex-grow-1 text-justify">
                        <hr>
                        <div class="row">
                            @foreach($project->description as $description)
                                @php $secondSize = 12 - $description->size; @endphp
                                <div class="col-md-{{ $description->size }}">
                                    <p>
                                        @if(!empty($description->desc))
                                            {{ $description->desc }}
                                        @endif
                                        <br class="hide-on-mobile">
                                        <br class="hide-on-mobile">
                                    </p>
                                </div>
                                <div class="col-md-{{ $secondSize }}">
                                    @if($description->media)
                                        @if($description->media->type == 0)
                                            <img style="width:100%;height:auto" src="images/{{ $description->media->media_url }}" />
                                            <p class="justify-content text-secondary short_desc">
                                                {{ optional($description->media->mediaTextRel)->mediaText }}
                                            </p>
                                        @elseif($description->media->type == 1)
                                            {{-- <iframe width="100%" height="100%" src="https://www.youtube.com/embed/lu2r31NVulA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                            <iframe width="100%" height="100%" src="{{ $description->media->media_url }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>    
                                            <p class="justify-content text-secondary short_desc">
                                                {{ optional($description->media->mediaTextRel)->mediaText }}
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                            @foreach($project->media as $eachMedia)
                                <div class="col-md-6">
                                    @if($eachMedia->type == 0)
                                        <img style="width:100%;height:auto" src="images/{{ $eachMedia->media_url }}" />
                                        <p class="justify-content text-secondary short_desc">
                                            {{ optional($eachMedia->mediaTextRel)->mediaText }}
                                        </p>
                                    @elseif($eachMedia->type == 1)
                                        <iframe width="100%" height="100%" src="{{ $eachMedia->media_url }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                        <br>    
                                        <p class="justify-content text-secondary short_desc">
                                            {{ optional($eachMedia->mediaTextRel)->mediaText }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach 
                        </div>
                    </div>                
                </div>
            </section>
        @endforeach
    </div>
@endsection

