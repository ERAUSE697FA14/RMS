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
$user_id = $_SESSION['passid'];
unset($_SESSION['passid']);
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if (isSet($_POST['apply'])) 
{
    // Get Post form data
    $tableData['first_name'] = trim($_POST['first_name']);
    $tableData['last_name'] = trim($_POST['last_name']);
    $tableData['address_line_1'] = trim($_POST['address_line_1']);
    $tableData['address_line_2'] = trim($_POST['address_line_2']);
    $tableData['city'] = trim($_POST['city']);
    $tableData['state'] = trim($_POST['state']);
    $tableData['zip_code'] = trim($_POST['zip']);
    $tableData['email'] = trim($_POST['email']);
    $tableData['birth_date'] = trim($_POST['birth_date']);
    
    if( isset($_POST['password']) )
    {
        $tableData['password'] = SHA1(trim($_POST['password']));;
    }
    
    if( isset($_POST['cc_cvv']) )
    {
        $tableData['cc_cvv'] = trim($_POST['cc_cvv']);
    }
    
    if( isset($_POST['cc_expire']) )
    {
        $tableData['cc_expire'] = trim($_POST['cc_expire']);
    }

    if( isset($_POST['cc_number']) )
    {
        $tableData['cc_number'] = SHA1(trim($_POST['cc_number']));
    }
    
    if( isset($_POST['reward_tier']) )
    {
        $tableData['reward_tier'] = trim($_POST['reward_tier']);
    }
    // Check that requested email address is already exist in the table for another user
    $db->where ("user_id", $user_id,'<>')->where('email', $tableData['email']);;
    
    $userInfo = $db->getOne("user",'email');

    if ($db->count > 0) 
    {
        // error- another user having same email
        die('email id exist!');
    }
    else
    {
        echo $user_id;
        echo $tableData['first_name'];
        $db->where ("user_id", $user_id);
        
        // everything is good, lets update the profile
        
        $status = $db->update('user',$tableData);

        if ($status==true)
        {
            $memberPath = "../MMS/member.php";
            header("Location:".$memberPath);
        }
    }
}

?>