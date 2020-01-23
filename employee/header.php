<?php
/**
 * Created by PhpStorm.
 * User: gabela
 * Date: 20/8/2019
 * Time: 16:03
 */
?>
<!doctype html>
<html lang="en">
<?php
require '../constants/settings.php';
require 'constants/check-login.php';

if ($user_online == "true") {
    if ($myrole == "employee") {
    }else{
        header("location:../");
    }
}else{
    header("location:../");
}
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OPSS|Employee Profile</title>
    <meta name="description" content="Online Job Management / Job Portal" />
    <meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
    <meta name="author" content="BwireSoft">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:image" content="http://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:secure_url" content="https://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Ministry of labor Jobs" />
    <meta property="og:description" content="Online Job Management / Job Portal" />

    <link rel="shortcut icon" href="../images/logo.png">

    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" media="screen">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/component.css" rel="stylesheet">

    <link rel="stylesheet" href="../icons/linearicons/style.css">
    <link rel="stylesheet" href="../icons/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../icons/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../icons/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="../icons/rivolicons/style.css">
    <link rel="stylesheet" href="../icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
    <link rel="stylesheet" href="../icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
    <link rel="stylesheet" href="../icons/flaticon-thick-icons/flaticon-thick.css">
    <link rel="stylesheet" href="../icons/flaticon-ventures/flaticon-ventures.css">

    <link href="../css/style.css" rel="stylesheet">

</head>
<style>

    .autofit2 {
        height:80px;
        width:100px;
        object-fit:cover;
    }

</style>

<body class="not-transparent-header">

<div class="container-wrapper">

	<header id="header">


		<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

			<div class="container">

				<div class="logo-wrapper">
					<div class="logo">
						<a href="../home.php"><img src="../images/logo.png" alt="Logo" width="40px" height="40px" /></a>
					</div>
				</div>

				<div id="navbar" class="navbar-nav-wrapper navbar-arrow">

					<ul class="nav navbar-nav" id="responsive-menu">
						<li class="">
							<a href="../home.php">Home</a>
						</li>
						<li>
							<a href="../job-list.php">Jobs</a>
						</li>

						<li class="">
							<a href="../employers.php">Companies</a>
						</li>
					</ul>

				</div>

				<div class="nav-mini-wrapper">
					<ul class="nav-mini sign-in">
                        <?php
                        if ($user_online == true) {
                            print '
						    <li><a href="../logout.php">logout</a></li>
							<li><a href="'.$myrole.'">Profile</a></li>';
                        }else{
                            print '
							<li><a href="login.php">login</a></li>
							<li><a data-toggle="modal" href="#registerModal">register</a></li>';
                        }

                        ?>

					</ul>
				</div>

			</div>

			<div id="slicknav-mobile"></div>

		</nav>


		<div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Create your account for free</h4>
			</div>

			<div class="modal-body">

				<div class="row gap-20">

					<div class="col-sm-6 col-md-6">
						<a href="register.php?p=Employer" class="btn btn-facebook btn-block mb-5-xs">Register as Employer</a>
					</div>
					<div class="col-sm-6 col-md-6">
						<a href="register.php?p=Employee" class="btn btn-facebook btn-block mb-5-xs">Register as Employee</a>
					</div>

				</div>

			</div>

			<div class="modal-footer text-center">
				<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
			</div>

		</div>

	</header>
