<?php
include 'rb.php';
R::setup('mysql:host=localhost;dbname=opss_db', 'root', ''); //for both mysql or mariaDB
$id = $_GET['id'];
 $init = R::findOne('tbl_users', 'member_no = ?', [$id]);
 R::trash( $init );
 print ("<script>window.alert('Successfully Deleted ')</script>");
print ("<script>window.location.assign('students.php')</script>");
?>