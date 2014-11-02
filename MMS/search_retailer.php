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
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if ($_POST['retailer_id'] == "" && $_POST['retailer_name'] == "") {
    die('no condition');
}
if ($_POST['retailer_id'] != "") 
{
 $db ->where("retailer_id", $_POST['retailer_id']);
 $retailQuery = $db->get("retailer");
} else if ($_POST['retailer_name'] != "") 
{
  $retailer_name = $_POST['retailer_name'];   
  $retailQuery = $db->rawQuery("SELECT * FROM retailer WHERE name LIKE '%$retailer_name%'");
}



$findRetailers = $retailQuery;

if($db->count > 0) {
            session_start();
            $_SESSION['retailersArray'] = $findRetailers;
            $_SESSION['retailersfrom'] = 'retailersSearch';
            $_SESSION['retailersnumber'] = $db->count;
            $editRetailerPath = '../MMS/edit_retailer.php';
            header("Location:".$editRetailerPath);

}
else{
    die("no retailer find");
}

?>