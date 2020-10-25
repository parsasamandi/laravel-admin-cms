<!DOCTYPE HTML>
<html>

<head>
	<title>Pouya Samandi</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="Pouya Samandizadeh,Mechanical Engineering">
	<!-- bootstrap.all.min.css -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="css/index.css" />
	{{-- <link rel="stylesheet" href="/css/bootstrap.min.css" /> --}}
</head>
<script>
    // address diffrent parts of website
	function goto($hashtag) {
		document.location = "/#" + $hashtag;
	}
</script>

<body class="is-preload">

	<!-- Header -->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
		<a class="navbar-brand text-gray" href="/">Pouya Samandi</a>
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
				<li class="nav-item dropdown">
					<a class="nav-link text-white" href="project">Projects</a>
				</li>
				<li class="nav-item active">
					<a style="cursor: pointer;" class="nav-link text-white" onclick="goto('contact')">Contact me <span
                            class="sr-only">(current)</span>
                    </a>
				</li>
			</ul>
		</div>
	</nav>


	<!-- Intro -->
	<section style="background-image: url(/images/{{ $home_setting1 }})" id="intro" class="main style1 dark fullscreen">
		<div class="content">
			<!-- style="margin-bottom:5em;padding-left:40em;" -->
			<header>
				<h2 class="text-secondary"><span class="text-white">{{ $home_setting2 }} </span>{{ $home_setting3 }}</h2>
			</header>
			<h2 style="font-size:22px">{{ $home_setting4 }}</h2>
			<p>
				{{ $home_setting5 }}
			</p>
			<footer>
				<a onclick="goto('one')" class="button style2 down">More</a>
			</footer>
		</div>
	</section>

	<!-- One -->
	<section id="one" class="main style2 right dark fullscreen">
		<div class="content box style2">
			<header>
				<h2>LIFE GOAlS</h2>
			</header>
			<p class="justify-center">
				{{ $home_setting6 }}
			</p>
			<a href="/project" style="font-size:23px" class="btn btn-outline-primary">Projects</a>
		</div>
		<a onclick="goto('two')" class="button style2 down anchored">Next</a>
	</section>

	<!-- Two -->
	<section id="two" class="main style2 left dark fullscreen">
		<div class="content box style2">
			<header>
				<h2>Who I Am</h2>
			</header>
			<p class="justify-center">
				{{ $home_setting7 }}
			</p>
			<a href="/cv" style="font-size:23px" class="btn btn-outline-primary">CV</a>
		</div>
		<a onclick="goto('contact')" class="button style2 down anchored">Next</a>
	</section>

	<!-- Contact -->
	<section id="contact" class="main style3 secondary text-white">
		<div class="content">
			<header>
				<h2 class="text-white">Contact Me.</h2>
				<p>Feel free as long as you want to contact me; <br> <a href="mailto:p.samandizadeh.shoushtari">samandi.pouya@gmail.com</a></p>
			</header>
		</div>
	</section>

	<!-- Footer -->
	<footer id="footer">
		<!-- Icons -->
		<ul class="menu">
			E-mail: samandi.pouya@gmail.com
			<hr>
            &copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a>

		</ul>
	</footer>

	<!-- Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.poptrox.min.js"></script>
	<script src="js/jquery.scrolly.min.js"></script>
	<script src="js/jquery.scrollex.min.js"></script>
	<script src="/js/browser.min.js"></script>
	<script src="/js/breakpoints.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
		integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
		crossorigin="anonymous"></script>
	<script src="/js/util.js"></script>
	<script src="/js/main.js"></script>


</body>

</html>