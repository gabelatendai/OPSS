<!doctype html>
<html lang="en">

<?php

include "rb.php";


R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB


if (isset($_POST['login'])) {
    $_SESSION['last_login_timestamp'] = time();

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $activity = "Log in";
    $Time = time();


    $init = R::findOne('tbl_users', 'email = ? AND login = ?', [$email, $password]);

    if ($init == null) {
        //   $message = "invalid details";
        print ("<script>window.alert('invalid details')</script>");
        print ("<script>window.location.assign('index.php')</script>");


    } else {
        session_start();
        $role = $init['role'];
        $_SESSION['logged'] = true;
        $_SESSION['myid'] = $init['member_no'];
        $_SESSION['myfname'] = $init['first_name'];
        $_SESSION['mylname'] = $init['last_name'];
        $_SESSION['myemail'] = $init['email'];
        $_SESSION['mydate'] = $init['bdate'];
        $_SESSION['mymonth'] = $init['bmonth'];
        $_SESSION['myyear'] = $init['byear'];
        $_SESSION['myphone'] = $init['phone'];
        $_SESSION['myedu'] = $init['education'];
        $_SESSION['mytitle'] = $init['title'];
        $_SESSION['mycity'] = $init['city'];
        $_SESSION['mystreet'] = $init['street'];
        $_SESSION['myzip'] = $init['zip'];
        $_SESSION['mytown'] = $init['town'];
        $_SESSION['mydesc'] = $init['about'];
        $_SESSION['avatar'] = $init['avatar'];
        $_SESSION['lastlogin'] = $init['last_login'];
        $_SESSION['avatar'] = $init['avatar'];
        $_SESSION['gender'] = $init['avatar'];
        $_SESSION['role'] = $role;

        $_SESSION['myid'] = $init['member_no'];
        $_SESSION['compname'] = $init['first_name'];
        $_SESSION['established'] = $init['byear'];
        $_SESSION['myemail'] = $init['email'];
        $_SESSION['myphone'] = $init['phone'];
        $_SESSION['comptype'] = $init['title'];
        $_SESSION['mycity'] = $init['city'];
        $_SESSION['mystreet'] = $init['street'];
        $_SESSION['myzip'] = $init['zip'];
        $_SESSION['mytown'] = $init['town'];
        $_SESSION['mydesc'] = $init['about'];
        $_SESSION['avatar'] = $init['avatar'];
        $_SESSION['myserv'] = $init['services'];
        $_SESSION['myexp'] = $init['expertise'];
        $_SESSION['lastlogin'] = $init['last_login'];
        $_SESSION['website'] = $init['website'];
        $_SESSION['people'] = $init['people'];

        echo '
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center justify-content-start">
        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
        <span><strong> </strong>login successfull !!!</span>
    </div><!-- d-flex -->
</div>';

        if ($role == 'employee') {
            echo '
<h2 align="center">
  <meta content="2;employee/index.php" http-equiv="refresh"/>
</h2> ';

        }
		elseif($role == 'employer'){
            echo '
<h2 align="center">
  <meta content="2;employer/index.php" http-equiv="refresh"/>
</h2> ';

        }
        elseif($role == 'admin'){
            echo '
<h2 align="center">
  <meta content="2;admin/index.php" http-equiv="refresh"/>
</h2> ';

        }
    }
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
														<label>Email Address</label>
														<input class="form-control" placeholder="Enter your email address" name="email" required type="text">
													</div>

												</div>

												<div class="col-sm-12 col-md-12">

													<div class="form-group">
														<label>Password</label>
														<input class="form-control" placeholder="Enter your password" name="password" required type="password">
													</div>

												</div>



												<div class="col-sm-12 col-md-12">
													<div class="login-box-link-action">
														<a data-toggle="modal" onclick = "reset_text()" href="#forgotPasswordModal">Forgot password?</a>
													</div>
												</div>




											</div>

										</div>

										<div class="modal-footer text-center">
											<button type="submit" name="login" class="btn btn-primary">Login</button>

										</div>
										<div class="col-sm-6 col-md-6">
											<a href="register.php?p=Employer" class="btn btn-facebook btn-block mb-5-xs">Register as Employer</a>
										</div>
										<div class="col-sm-6 col-md-6">
											<a href="register.php?p=Employee" class="btn btn-facebook btn-block mb-5-xs">Register as Employee</a>
										</div>

									</div>
								</form>

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

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

<?php
include "employer/footer.php"
?>