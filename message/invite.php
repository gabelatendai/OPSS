<?php
/**
 * Created by PhpStorm.
 * User: gabela
 * Date: 15/9/2019
 * Time: 01:29
 */
include "../rb.php";
$db = mysqli_connect("localhost", "root", "", "opss_db");
$db2= R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB

if (isset($_POST['invite'])) {

    $member_no = $_POST['member_no'];
    $jobId = $_POST['jobId'];
    $typ = 1;
    $date = $_POST['date'];
    $sms = $_POST['sms'];

    //$check=  mysqli_query ($db,"Select * from `tbl_job_applications` WHERE `status`='$typ' AND `member_no`='$member_no' AND `job_id`='$jobId'");


    $init = R::findOne('tbl_job_applications', 'member_no = ? AND job_id = ? AND status = ?', [$member_no, $jobId, $typ]);

    if ($init==null) {


        mysqli_query($db, "UPDATE `tbl_job_applications` SET `status`='$typ',`interview_date`='$date',`sms`='$sms' WHERE `member_no`='$member_no' AND `job_id`='$jobId'");

        ?>
        <script>
			alert(' Successfully Invited');
			window.location.assign('../employer/my-jobs.php');
        </script>
        <?php

    } else {
        ?>
        <script>
			alert('You Have already Invited This member To Interview');
			window.location.assign('../employer/my-jobs.php');
        </script>
        <?php

    }
}
?>