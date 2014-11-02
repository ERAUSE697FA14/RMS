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
$retailer_id = $_SESSION['retailerpassid'];
unset($_SESSION['retailerpassid']);
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$db->where ("retailer_id", $retailer_id);
$retailer = $db -> getOne("retailer");

if (isSet($_POST['apply'])) 
{

    if($_POST['name'] !="" ){
            $tableData['name'] = trim($_POST['name']);

    }
    else{
            $tableData['name'] = $retailer["name"];
    }
    if($_POST['private_key'] !="" ){
        $tableData['private_key'] = trim($_POST['private_key']);
    }    else{
            $tableData['private_key'] = $retailer["private_key"];
    }
        $db->where ("retailer_id", $retailer_id);
        $status = $db->update('retailer',$tableData);
        if ($status==true)
        {
            $retailerPath = "../MMS/retailer.php";
            header("Location:".$retailerPath);
        }
        else{
            die(error);
        }
    }

?>