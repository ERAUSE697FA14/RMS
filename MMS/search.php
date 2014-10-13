<?php
require_once 'session.php';
if($_SESSION['user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}

require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);
$role = "member";
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db->where ("role", $role);
if ($_POST['user_id'] == "" && $_POST['email'] == ""&& $_POST['tier'] == "") {
    die('no condition');
}
if ($_POST['user_id'] != "") 
{
 $db ->where("user_id", $_POST['user_id']);
}
if ($_POST['email'] != "") 
{
  $db ->where("email", $_POST['email']);
}
if ($_POST['tier'] != "") 
{
  $db ->where("reward_tier", $_POST['tier']);
}

$findMembers = $db->get("user");

    if($db->count > 0) {
            session_start();
            $_SESSION['array'] = $findMembers;
            $_SESSION['from'] = 'search';
            $_SESSION['number'] = $db->count;
            $editMemberPath = '../MMS/edit_member.php';
            header("Location:".$editMemberPath);

}
else{
    die("no member find");
}

?>