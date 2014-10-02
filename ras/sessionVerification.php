<?php

//error_reporting(E_ALL ^ E_NOTICE); 
//making session verification after coming to login page

session_start(); // Start Session

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

if (!isSet($_SESSION['user_id'])) 
{
    $_SESSION['user_id'] = "";
    $userid = "";
} 
else 
{
    $userid = $_SESSION['user_id'];
}


if ($userid != "") {
    
    $db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');
    
    $db->where ("user_id", $userid);
    
    $users = $db->get("user");

    if ($db->count > 0) 
    {     
        $_SESSION['user_id'] = $userid;
    }
    else 
    {
        $_SESSION['user_id'] = "";
        $userid = "";
        session_destroy();
    }
}
?>