<?php

if (!$do_login) {
    exit;
}

$post_username = trim($_POST['username']);
$post_password = trim($_POST['password']);

$db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');

$db->where ("email", $post_username);

$users = $db->get ("user");

if ($db->count > 0)  
{   
    $db->where ("email", $post_username);
    $db->where ("password", sha1($post_password));
    
    $users = $db->getOne("user",'user_id');
    
    if ($db->count > 0)  
    {
        $login_ok = true;

        $_SESSION['user_id'] = $users['user_id'];
        
        $rasHomePath = "../ras/home.php";
        header("Location:".$rasHomePath);

        exit;
    } 
    else 
    {
        $login_error = true;
    }
} else 
{
    $login_error = true;
}
?>