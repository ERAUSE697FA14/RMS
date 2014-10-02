<?php
session_start();
session_destroy();
$_SESSION['user_id'] = "";

$rasHomePath = "../index.php";
header("location:".$rasHomePath);
?>