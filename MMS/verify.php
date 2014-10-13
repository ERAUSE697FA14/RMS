<?php
require_once 'session.php';
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$post_username = trim($_POST['username']);
$post_password = trim($_POST['password']);

$role = "admin";

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$db->where ("email", $post_username);
$db->where ("role", $role);

$users = $db->get ("user");

if ($db->count > 0)  
{   
    $db->where ("email", $post_username);
    $db->where ("password", sha1($post_password));
    
    $users = $db->getOne("user",'user_id,first_name,last_name,email');
    
    if ($db->count > 0)  
    {
        $login_ok = true;

        $homePath = "../MMS/mms.php";
        $_SESSION['user_id'] = $users['user_id'];
        $_SESSION['user_firstname'] = $users['first_name'];
        $_SESSION['user_lastname'] = $users['last_name'];
        $_SESSION['user_email'] = $users['email'];
        header("Location:".$homePath);
        exit;
    } 
    else 
    {
        $login_error = true;
                ?>
                <div id="error_notification">
                    <b>Incorrect Username/Password</b><br/>
                     <div style="font-size:13px;">
                         ERROR002:The username/password you entered is incorrect.
                         Please try again
                     </div>
                </div>
                 <br/>
                <?php
    }
} else 
{
    $login_error = true;
                    ?>
                <div id="error_notification">
                    <b>Incorrect Username/Password</b><br/>
                     <div style="font-size:13px;">
                         ERROR001:The username/password you entered is incorrect.
                         Please try again
                     </div>
                </div>
                 <br/>
                <?php
}
?>