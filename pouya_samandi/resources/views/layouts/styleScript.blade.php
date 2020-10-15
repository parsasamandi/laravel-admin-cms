<!DOCTYPE html>
<html lang="en">

@section('stylesheet')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pouya Samandi</title>
    <link rel="stylesheet" href="/css/index.css" />
    <!-- Google fonts-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet"
        type="text/css" /> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/cvProj.css" rel="stylesheet" />
@show

<script>

    // address diffrent parts of website
    function goto($hashtag) {
        document.location = "#" + $hashtag;
    }

    function SidebarCollapse() {
        $('.menu-collapsed').toggleClass('d-none');
        $('.sidebar-submenu').toggleClass('d-none');
        $('.submenu-icon').toggleClass('d-none');
        $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

        // Treating d-flex/d-none on separators with title
        var SeparatorTitle = $('.sidebar-separator-title');
        if (SeparatorTitle.hasClass('d-flex')) {
            SeparatorTitle.removeClass('d-flex');
        } else {
            SeparatorTitle.addClass('d-flex');
        }

        // Collapse/Expand icon
        $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
    }

</script>
<!-- justify-center for all must be asked -->

<body class="is-preload">
   
    @yield('content')
    
    <!-- Footer -->
    <footer id="footer">
        <!-- Icons -->
        <ul class="icons">
            <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
        </ul>
        <!-- Menu -->
        <ul class="menu">
            E-mail: samandi.pouya@gmail.com
            <!-- <li>&copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li> -->
        </ul>
    </footer>
    @section('script')
        <script src="/js/jquery.min.js" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery.poptrox.min.js"></script>
        <script src="/js/jquery.scrolly.min.js"></script>
        <script src="/js/jquery.scrollex.min.js"></script>
        <script src="/js/browser.min.js"></script>
        <script src="/js/breakpoints.min.js"></script>
        <script src="/js/util.js"></script>
        <script src="/js/main.js"></script>
    @show
</body>

</html>