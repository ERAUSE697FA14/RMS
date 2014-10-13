<?php

//error_reporting(E_ALL ^ E_NOTICE); 
//making session verification after coming to login page

session_start(); // Start Session

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);
require_once 'connectvars.php';

if (!isSet($_SESSION['user_id'])) 
{
    $_SESSION['user_id'] = "";
    $user_id = "";
} 
else 
{
    $user_id = $_SESSION['user_id'];
}


if ($user_id != "") {
    $db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    
    $db->where ("user_id", $userid);
    
    $users = $db->get("user");

    if ($db->count > 0) 
    {
        $_SESSION['user_id'] = $user_id;
    }
    else 
    {
        $_SESSION['user_id'] = "";
        $user_id = "";
        session_destroy();
    }
}
?>