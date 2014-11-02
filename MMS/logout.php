<?php
session_start();

$_SESSION['admin_user_id'] = "";
$_SESSION['user_firstname'] = "";
$_SESSION['user_lastname'] = "";
$_SESSION['user_email'] = "";
session_destroy();

$mmsHomePath = "../MMS/login.php";
header("location:".$mmsHomePath);
?>