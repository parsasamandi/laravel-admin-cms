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
        <link href="/css/admin.css" rel="stylesheet" />
        {{-- Mix App --}}
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @show       

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="/">Pouya Samandi</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div> -->
                </div>
            </form>
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
                            <div class="sb-sidenav-menu-heading">CV</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Experience
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/experience/newExperience">New Experience</a>
                                    <a class="nav-link" href="/experience/experienceList">Experience List</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#education" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Education
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="education" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/education/newEducation">New Education</a>
                                    <a class="nav-link" href="/education/educationList">Education List</a>
                                    <!-- <a class="nav-link" href="/education/educationList">New University links</a> -->
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#publication" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                                Publication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="publication" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/publication/newPublication">New Publication</a>
                                    <a class="nav-link" href="/publication/publicationList">Publication List</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#interest" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                <i class="fas fa-thumbs-up"></i>
                                </div>
                                Interest
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="interest" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/interest/newInterest">New Interest</a>
                                    <a class="nav-link" href="/interest/interestList">Interest List</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#skill" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                </div>
                                Skill
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="skill" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/skill/newSkill">New Skill</a>
                                    <a class="nav-link" href="/skill/skillList">Skill List</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#refree" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                Refree
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="refree" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/refree/newRefree">New Refree</a>
                                    <a class="nav-link" href="/refree/refreeList">Refree List</a>
                                </nav>
                            </div>

                            {{-- Education List --}}
                            <div class="sb-sidenav-menu-heading">Experience</div>
                            <a class="nav-link" href="{{ route('experience.table') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-columns"></i>
                                </div>
                                Experience
                            </a>
                            {{-- Description List --}}
                            <div class="sb-sidenav-menu-heading">Description</div>
                            <a class="nav-link" href="{{ route('description.table') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fa fa-info"></i>
                                </div>
                                Description
                            </a>
                            {{-- User List --}}
                            <div class="sb-sidenav-menu-heading">User</div>
                            <a class="nav-link" href="{{ route('admin.table') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                User
                            </a>
                            {{-- Education List --}}
                            <div class="sb-sidenav-menu-heading">Education</div>
                            <a class="nav-link" href="{{ route('education.table') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                Education
                            </a>
                            {{-- Project List --}}
                            <div class="sb-sidenav-menu-heading">Projects</div>
                            <a class="nav-link collapsed" href="{{ route('project.table') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                                Project
                            </a>
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
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#link" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </div>
                                Link
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="link" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/link/newLink">New Link</a>
                                    <a class="nav-link" href="/link/linkList">Link List</a>
                                </nav>
                            </div>
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
