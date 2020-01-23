<?php
$db = mysqli_connect("localhost", "root", "", "opss_db");
$user= mysqli_query($db,"select * FROM  tbl_users where member_no ='$myid'");
$us= mysqli_fetch_array($user);

$avatar= $us['avatar'];
?>

<div class="GridLex-col-3_sm-4_xs-12">

	<div class="admin-sidebar">

		<div class="admin-user-item">
			<div class="image">

                <?php
                if ($avatar == null) {
                    print '<center><img class="img-circle autofit2" src="../images/default.jpg" title="'.$myfname.'" alt="image"  /></center>';
                }else{
                    ?>
					<center><img class="img-circle autofit2" alt="image" title="<?php echo "$myfname"; ?>"  src="<?php echo $avatar; ?>"/></center>
                    <?php
                }
                ?>
			</div>
			<br>


			<h4><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></h4>
			<p class="user-role"><?php echo "$mytitle"; ?></p>

		</div>

		<div class="admin-user-action text-center">

			<a target="_blank" href="my_cv" class="btn btn-primary btn-sm btn-inverse">View my CV</a>

		</div>

		<ul class="admin-user-menu clearfix">
			<li  class="active">
				<a href="./"><i class="fa fa-user"></i> Profile</a>
			</li>
			<li class="">
				<a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
			</li>
			<li>
				<a href="qualifications.php"><i class="fa fa-trophy"></i> Professional Qualifications</a>
			</li>
			<li>
				<a href="application.php"><i class="fa fa-trophy"></i>Application Letter</a>
			</li>
			<li>
				<a href="language.php"><i class="fa fa-language"></i> Language Proficiency</a>
			</li>
			<li>
				<a href="training.php"><i class="fa fa-gears"></i> Training & Workshop</a>
			</li>

			<li>
				<a href="referees.php"><i class="fa fa-users"></i> Referees</a>
			</li>

			<li>
				<a href="experience.php"><i class="fa fa-briefcase"></i> Working Experience</a>
			</li>
			<li>
				<a href="attachments.php"><i class="fa fa-folder-open"></i> Other Attachments</a>
			</li>
			<li>
				<a href="applied-jobs.php"><i class="fa fa-bookmark"></i> Applied Jobs</a>
			</li>
			<li>
				<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
			</li>
		</ul>

	</div>

</div>