<?php
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$name=$_POST['name'];
$private_key=$_POST['private_key'];

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        	$data = Array(
        		'name' => $name,
        		'private_key' => SHA1($private_key),
        	);
        	$insert = $db->insert ('retailer', $data);
    		if ($insert) {
    		    echo 'You have registered successfully! Please check your email address to activate your account.';
    		}
    		else{
    		    echo 'Registration Unsuccessful: ' . $db->getLastError();
    		}
                $retailerPath = "../MMS/retailer.php";
                header("Location:".$retailerPath);
?>