<?php
include 'rb.php';
R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB
$id = $_GET['id'];
 $init = R::findOne('tbl_job_applications', 'id = ?', [$id]);
 R::trash( $init );
 print ("<script>window.alert('Successfully Deleted ')</script>");
print ("<script>window.location.assign('applications.php')</script>");
?>