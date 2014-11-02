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
$role = "member";
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if ($_POST['user_id'] == "" && $_POST['user_first_name'] == "" && $_POST['user_last_name'] == ""&& $_POST['email'] == ""&& $_POST['tier'] == "") {
    die('no condition');
}
if ($_POST['user_id'] != "") 
{
 $db ->where("user_id", $_POST['user_id']);
 $db->where ("role", $role);
 $membersQuery = $db->get("user");
}
else if ($_POST['email'] != "") 
{
  $db ->where("email", $_POST['email']);
     $db->where ("role", $role);
    $membersQuery = $db->get("user");
}
else {
    if ($_POST['user_first_name'] != "") 
{
 $user_first_name = $_POST['user_first_name'];
 $membersQuery = $db->rawQuery("SELECT * FROM user WHERE first_name LIKE '%$user_first_name%' AND ROLE = '$role'");
}
if ($_POST['user_last_name'] != "") 
{
 $user_last_name = $_POST['user_last_name'];
 $membersQuery = $db ->rawQuery("SELECT * FROM user WHERE last_name LIKE '%$user_last_name%'AND ROLE = '$role'");
}


if ($_POST['tier'] != "") 
{
  $db ->where("reward_tier", $_POST['tier']);
   $db->where ("role", $role);
    $membersQuery = $db->get("user");
}

}
$findMembers =$membersQuery;
    if($db->count > 0) {
            session_start();
            $_SESSION['array'] = $findMembers;
            $_SESSION['from'] = 'search';
            $_SESSION['number'] = $db->count;
            $viewMemberPath = '../MMS/view_member.php';
            header("Location:".$viewMemberPath);

}
else{
    die("no member find");
}

?>