<?php
require './validatecode.php'; 
$_vc = new ValidateCode(); 
$_vc->doimg();
session_start();
$_SESSION['captchacode'] = $_vc->getCode();

?>