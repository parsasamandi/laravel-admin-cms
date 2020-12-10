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
            {{--<li class="nav-item"><a class="nav-link js-scroll-trigger" onclick="goto('{{ $project->section_id }}')">{{ $project->section_id }}</a></li>--}}
            @if(isset($section_id))
                {{ $section_id }}
            @endif
            @if(isset($cv_titles))
                {{ $cv_titles }}
            @endif
        </ul>
    </div>
</nav>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top navBarStyle">
    <a class="navbar-brand text-white" href="/">Pouya Samandi</a>
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
    </div>
</nav>
