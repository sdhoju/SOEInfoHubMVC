<html lang="en">
<head>
    <meta charset='UTF-8'>
    <meta name='keywords' content='academic, university, universities, Mississippi, University of Mississippi, The University of Mississippi, Ole Miss, college, colleges, Oxford' />
    <meta name='description' content=<?php $text ?>/>
    <meta name='author' content='University of Mississippi - School of Engineering' />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" /> -->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />-->

	<title><?php $title ?></title>

	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' />
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' />
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' />

	<script src='https://code.jquery.com/jquery-2.1.4.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
	<link rel='stylesheet' href='<?php echo URL; ?>_css/style.css'>
	<link rel='stylesheet' href='<?php echo URL; ?>_css/imagemodal.css'>

	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   

	<link rel='stylesheet' href='<?php echo URL; ?>custom.css'>
	<link rel='stylesheet' href='<?php echo URL; ?>_css/dashboard.css'>

</head>
<body class='secondary'>
	
<header>
		<div id="watermark"></div>
			<nav style="margin:0; background-color: #14213d;" class="navbar navbar-default">
			<div class="container-fluid">
		<div class="navbar-header">
				<!--<a class="navbar-brand hidden-md hidden-sm hidden-xs" style=" background-image: url('/Content/Images/FirstImage.png'); background-repeat: no-repeat;" href='@Url.Action("Index", "Home")'></a>-->
				<a class="navbar-brand hidden-sm visible-xs" style="color:white;" href="#">Who Are You?</a>

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				<li><a href="/future/" style="color:white;">Prospective Student</a></li>
				<li><a href="/undergraduate/" style="color:white;">Current Student</a></li>
				<li><a href="/faculty_staff/dean.html" style="color:white;">Faculty &amp; Staff</a></li>
				<li><a href="https://www.olemiss.edu/audience/parents.html" style="color:white;">Parents &amp; Families</a></li>
				<li><a href="/alumni_friends/" style="color:white;">Alumni &amp; Friends</a></li>
				<!--<li style='border-bottom: 1px solid red;'><a href='https://admissions.olemiss.edu/visit/' style='color:white;'>Visitors</a></li>-->
				<li style="border-bottom: 1px solid red;"><a href="https://secure25.olemiss.edu/visit/engineering" style="color:white;">Visitors</a></li>
				</ul>
			</div>
			</div>
		</nav>

		<!--<nav id="constituencies">
			<dl class="audience">
				<dt><span><a href='/audience'>Who Are You?</a></span></dt>
				<dd><a href="/future/">Prospective Students</a></dd>
				<dd><a href="/undergraduate/">Current Students</a></dd>
				<dd><a href="/faculty_staff/dean.html">Faculty &amp; Staff</a></dd>
				<dd><a href="http://www.olemiss.edu/audience/parents.html" target='_blank'>Parents &amp; Families</a></dd>
				<dd><a href="/alumni_friends/">Alumni &amp; Friends</a></dd>
				<dd><a href='https://secure25.olemiss.edu/visit/engineering' style='background-color:red; text-shadow:none;'>Visitors</a></dd>
			</dl>
		</nav>
		<div id='constituencies-push'></div>-->
		<section class="hero">
			<div class=" umlogo">
				<h1><a href="http://engineering.olemiss.edu">The University of Mississippi Engineering</a></h1>
			</div>
			<div class="searchbox">
				<form onsubmit="return makeSearch()">
					<!--<label>
						<input type="submit" class="icons-main-search" value="">
					</label>-->
					<label>
						<span class="hidetext">Search the UM website</span>
						<input type="text" placeholder="Search UM" id="q">
					</label>
				</form>
			</div>
		</section>
	</header>
	<nav id="main" class="showmore">
		<div class="bg"><!-- Needed for screen-width bgcolor --></div>
		<div class="top">
			<ul>
				<li><h2 id="aboutum" class="top"><a href="/about/">About Engineering</a></h2></li>
				<li><h2 id="academics" class="top"><a href="/programs/index.html">Academics</a></h2></li>
				<li><h2 id="campuslife" class="top"><a href="/research/index.html">Research</a></h2></li>
				<li><h2 id="newsevents" class="top"><a href="/news/all">News &amp; Events</a></h2></li>
			</ul>
		</div>
		<div class="sublinks above">
			<ul>
			
				<li><h3><a href="http://www.olemiss.edu" target="_blank"><span class="xtra">Ole Miss</span><span class="noxtra">UM</span> Home</a></h3></li>
				<li><h3><a href="/partners/map/">International</a></h3></li>
				<li><h3><a href="/community/">Community<span class="xtra"> &amp; Service</span></a></h3></li>
				<li><h3><a href="/news/newsletter/">Newsletter</a></h3></li>
				<li><h3><a href="/studentservices/">Student<span class="xtra"> Services</span></a></h3></li>
				<li><h3><a href="http://www.umfoundation.com/giving/landing.php?school=engineering" class="support" target="_blank">Support <span class="noxtra">SoE</span><span class="xtra">Engineering</span></a></h3></li>
			</ul>
			<div class="subpush">
				<div id="moresublinks">MORE LINKS</div>
				<div id="fewersublinks">FEWER LINKS</div>
			</div>
		</div>
	</nav>

	<br>