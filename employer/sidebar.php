<?php
/**
 * Created by PhpStorm.
 * User: gabela
 * Date: 11/10/2019
 * Time: 22:43
 */

$db = mysqli_connect("localhost", "root", "", "opss_db");
$user= mysqli_query($db,"select * FROM  tbl_users where member_no ='$myid'");
$us= mysqli_fetch_array($user);

$avatar= $us['avatar'];
?>
<div class="GridLex-col-3_sm-4_xs-12">

    <div class="admin-sidebar">


        <div class="admin-user-item for-employer">

            <div class="image">
                <?php
                if ($avatar == null) {
                    print '<center>Company Logo Here</center>';
                }else{
                    ?>
                    <center><img alt="image" title="<?php echo $compname; ?>" width="180" height="100" src="<?php echo $avatar; ?>"/></center>
                <?php	}
                ?><br>
            </div>

            <h4><?php echo "$compname"; ?></h4>

        </div>

        <div class="admin-user-action text-center">

            <a href="post-job.php" class="btn btn-primary btn-sm btn-inverse">Post a Job</a>

        </div>

        <ul class="admin-user-menu clearfix">
            <li  class="active">
                <a href="./"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li class="">
                <a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
            </li>

            <li>
                <a href="../company.php?ref=<?php echo "$myid"; ?>"><i class="fa fa-briefcase"></i> Company Overview</a>
            </li>
            <li>
                <a href="my-jobs.php"><i class="fa fa-bookmark"></i> Posted Jobs</a>
            </li>
            <li>
                <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
            </li>
        </ul>

    </div>

</div>
