<!DOCTYPE html>
<html lang="en">
    @section('stylesheet')
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        {{-- Admin Style --}}
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />
        {{-- Mix App --}}
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @show       

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="/">Pouya Samandi</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        {{-- Main Menu --}}
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            {{-- CV --}}
                            <div class="sb-sidenav-menu-heading">CV</div>

                            <x-admin.urlAddress text="Experience" fontAwesome="fas fa-columns" route="{{ route('experience.table') }}" />
                            {{-- Education List --}}
                            <x-admin.urlAddress text="Education" fontAwesome="fas fa-book" route="{{ route('education.table') }}" />
                            {{-- Publication list --}}
                            <x-admin.urlAddress text="Publication" fontAwesome="fas fa-newspaper" route="{{ route('publication.table') }}" />
                            {{-- Interest List --}}
                            <x-admin.urlAddress text="Interest" fontAwesome="fas fa-thumbs-up" route="{{ route('interest.table') }}" />
                            {{-- Skill List --}}
                            <x-admin.urlAddress text="Skill" fontAwesome="fa fa-cogs" route="{{ route('skill.table') }}" />
                            {{-- Refree List --}}
                            <x-admin.urlAddress text="Refree" fontAwesome="fas fa-chalkboard-teacher" route="{{ route('refree.table') }}" />
                            {{-- User --}}
                            <div class="sb-sidenav-menu-heading">User</div>
                            <x-admin.urlAddress text="User" fontAwesome="fa fa-user" route="{{ route('admin.table') }}" />

                            {{-- Project List --}}
                            <div class="sb-sidenav-menu-heading">Projects</div>
                            <x-admin.urlAddress text="Project" fontAwesome="fas fa-project-diagram" route="{{ route('project.table') }}" />

                            {{-- Description List --}}
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#description" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                Description
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="description" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    {{-- Experience --}}
                                    <x-admin.urlAddress text="Experience" fontAwesome="null" route="{{ route('description.table') }}" />
                                    {{-- Project --}}
                                    <x-admin.urlAddress text="Project" fontAwesome="null" route="{{ route('description.table') }}" />
                                    {{-- Publication --}}
                                    <x-admin.urlAddress text="Publication" fontAwesome="null" route="{{ route('description.table') }}" />
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#project_title" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                                Project Titles
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="project_title" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/project/newProjectTitle">New Project Title</a>
                                    <a class="nav-link" href="/project/projectTitleList">Project Title List</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#media" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fa fa-camera-retro"></i>
                                </div>
                                Media
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="media" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/media/newMedia">New Media</a>
                                    <a class="nav-link" href="/media/mediaList">Media List</a>
                                    <a class="nav-link" href="/media/newMediaText">New Media Text</a>
                                    <a class="nav-link" href="/media/mediaTextList">Media Text List</a>
                                </nav>
                            </div>
                            {{-- Link List --}}
                            <x-admin.urlAddress text="Link" fontAwesome="fas fa-book" route="{{ route('link.table') }}" />
                            {{-- Home List --}}
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#home_setting" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                Home Setting
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="home_setting" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/setting/homeSetting">HomeSetting</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                {{-- Content --}}
                <main>
                    @yield('content')
                </main>
                {{-- Footer --}}
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; pouyasamandi.ir</div>
                            <div>
                                Privacy Policy
                                &middot;
                                Terms &amp; Conditions
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        @section('scripts')
            {{-- App Script --}}
            <script src="{{ mix('js/app.js') }}"></script>
            <script src="{{ mix('js/vendor.js') }}"></script>
            <script src="{{ mix('js/manifest.js') }}"></script>
            <script src="/js/all.min.js" crossorigin="anonymous"></script>
            <script src="/js/scripts.js"></script>
        @show      
         
    </body>
</html>
