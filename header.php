<?php
/**
 * Created by PhpStorm.
 * User: gabela
 * Date: 16/8/2019
 * Time: 19:53
 */
include 'constants/settings.php';
include 'constants/check-login.php';
include "rb.php";
?>

<!doctype html>
<html lang="en">
<?php

?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>OPS</title>

	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="careershtml-updated/css/bootstrap.css">
	<link rel="stylesheet" href="careershtml-updated/css/font-awesome.min.css">
	<link rel="stylesheet" href="careershtml-updated/css/flexslider.css">
	<link rel="stylesheet" href="careershtml-updated/css/style.css">
	<link rel="stylesheet" href="careershtml-updated/css/responsive.css">

	<!--[if IE 9]>
	<script src="careershtml-updated/js/media.match.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
		function update(str)
		{

			if(document.getElementById('mymail').value == "")
			{
				alert("Please enter your email");

			}else{
				document.getElementById("data").innerHTML = "Please wait...";
				var xmlhttp;

				if (window.XMLHttpRequest)
				{
					xmlhttp=new XMLHttpRequest();
				}
				else
				{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}

				xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
					{
						document.getElementById("data").innerHTML = xmlhttp.responseText;
					}
				}

				xmlhttp.open("GET","app/reset-pw.php?opt="+str, true);
				xmlhttp.send();
			}

		}

		function reset_text()
		{
			document.getElementById('mymail').value = "";
			document.getElementById("data").innerHTML = "";
		}

	</script>
</head>
<style>

	.autofit2 {
		height:70px;
		width:400px;
		object-fit:cover;
	}

	.autofit3 {
		height:80px;
		width:100px;
		object-fit:cover;
	}


</style>

<body>
<div id="main-wrapper">

	<header id="header" class="header-style-1">
		<div class="header-top-bar">
			<div class="container">

				<!-- Header Language -->
				<div class="header-language clearfix">
					<ul>
						<li ><a href="#">Ojet</a></li>
						<li><a href="#">Placement</a></li>
						<li><a href="#">System</a></li>
					</ul>
				</div> <!-- end .header-language -->
				<div class="header-language clearfix pull-right"><?php
                    if ($user_online == true) {
                        print '
						    <li style="text-decoration-line: line-through"><div class="header-register"><a href="logout.php">logout</a></div></li>
							<li><div class="header-login"><a href="'.$myrole.'">Profile</a></div></li>';
                    }
                    ?>
				</div>



			</div> <!-- end .container -->
		</div> <!-- end .header-top-bar -->
		<div id="forgotPasswordModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Restore your forgotten password</h4>
			</div>

			<div class="modal-body">
				<div class="row gap-20">

					<div class="col-sm-12 col-md-12">
						<p class="mb-20">Enter the email address associated to your account, we will send you the link to reset your password</p>
					</div>

					<div class="col-sm-12 col-md-12">

						<div class="form-group">

							<label>Email Address</label>
							<input id="mymail" autocomplete="off" name="email" class="form-control" placeholder="Enter your email address" type="email" required>
						</div>

					</div>



					<div class="col-sm-12 col-md-12">
						<div class="login-box-box-action">
							Return to <a data-dismiss="modal">Log-in</a>
							<p id="data"></p>
						</div>

					</div>

				</div>
			</div>

			<div class="modal-footer text-center">
				<button  onclick="update(mymail.value)" type="submit" class="btn btn-primary">Restore</button>
				<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
			</div>

		</div>

		<div class="header-nav-bar">
			<div class="container">

				<!-- Logo -->
				<div class="css-table logo">
					<div class="css-table-cell">
						<a href="home.php">
							<img src="images/logo.png" alt="" width="70px" height="60px">
						</a> <!-- end .logo -->
					</div>
				</div>

				<!-- Mobile Menu Toggle -->
				<a href="#" id="mobile-menu-toggle"><span></span></a>

				<!-- Primary Nav -->
				<nav>
					<ul class="primary-nav">
						<li class="">
							<a href="home.php">Home</a>
						</li>
						<li>
							<a href="job-list.php">Jobs</a>
						</li>
						<li class="">
							<a href="attaches.php">Applicants</a>
						</li>
						<li class="">
							<a href="employers.php">Companies</a>
						</li>
						<!--
						<li class="has-submenu">
							<a href="about-us.html">About Us</a>
							<ul>
								<li><a href="partners.html">Partners</a></li>
								<li><a href="contact-us.html">Contact Us</a></li>
							</ul>
						</li>
						<li><a href="register.html">Register</a></li>
						<li><a href="shortcodes.html">Shortcodes</a></li>
						-->
					</ul>
				</nav>
			</div> <!-- end .container -->

			<div id="mobile-menu-container" class="container">
				<div class="login-register"></div>
				<div class="menu"></div>
			</div>
		</div> <!-- end .header-nav-bar -->


