<!doctype html>
<html lang="en">

<?php

include "rb.php";


R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB

$db = mysqli_connect("localhost", "root", "", "opss_db");


if (isset($_POST['login'])) {

    $password = md5($_POST['password']);


    mysqli_query ($db,"UPDATE `tbl_users` SET `login`='$password'");


}
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>OPSS| Login</title>

	<meta name="description" content="Online Job Management / Job Portal" />
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="500" />
	<meta property="og:image:height" content="300" />
	<meta property="og:image:alt" content="Ministry of labor Jobs" />
	<meta property="og:description" content="Online Job Management / Job Portal" />

	<link rel="shortcut icon" href="images/logo.png">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">

	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="icons/flaticon-ventures/flaticon-ventures.css">

	<link href="css/style.css" rel="stylesheet">

</head>


<body class="not-transparent-header">

<div class="container-wrapper">



	<div class="main-wrapper">


		<div class="login-container-wrapper">

			<div class="container">

				<div class="row">

					<div class="col-md-10 col-md-offset-1">

						<div class="row">

							<div class="col-sm-6 col-sm-offset-3">
                                <?php
                                include 'constants/check_reply.php';
                                ?>
								<form name="frm" action="" method="POST" autocomplete="off">
									<div class="login-box-wrapper">

										<div class="modal-header">
											<h4 class="modal-title text-center">Access your account</h4>
										</div>

										<div class="modal-body">

											<div class="row gap-20">



												<div class="col-sm-12 col-md-12">

													<div class="form-group">
														<label>Password</label>
														<input class="form-control" placeholder="Enter your password" name="password" required type="password">
													</div>

												</div>

											</div>

										</div>

										<div class="modal-footer text-center">
											<button type="submit" name="login" class="btn btn-primary">Update All Passwords</button>

										</div>
									</div>
								</form>
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

<?php
include "employer/footer.php"
?>