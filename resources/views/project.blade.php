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

    <!-- Sidebar And Navigation bar -->
    <x-sidebar>
        <x-slot name="section_id">
            @foreach($projects as $project)
                <li class="nav-item"><a class="nav-link js-scroll-trigger" onclick="goto('{{ $project->section_id }}')">{{ $project->section_id }}</a></li>
            @endforeach
        </x-slot>
    </x-sidebar>

    <!-- Page Content-->
    <div class="container-fluid p-0">
        @foreach($projects as $project)
            <section style="background-color:{{ $project->background_color }}" class="resume-section" id="{{ $project->section_id }}">
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
                                        @foreach($description->link as $link)
                                            <a class="text-primary" href="{{ $link->link }}">{{ $link->text }}</a>
                                        @endforeach
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
                                            <iframe width="100%" height="330" src="{{ $description->media->media_url }}"
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
                                        <iframe width="100%" height="400" src="{{ $eachMedia->media_url }}"
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

