<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
session_start();
$selectedCouponID = $_SESSION['selectedCouponID'];


require_once 'connectvars.php';
$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db->rawQuery("UPDATE transaction SET is_redeemed = '1' WHERE reward_coupon_id = '$selectedCouponID' ");

            //$couponsManagePath = "../MMS/coupons_manage.php";
            //header("Location:".$couponsManagePath);
            $searchCouponPath = '../MMS/search_coupons.php';
            header("Location:".$searchCouponPath);

?> 