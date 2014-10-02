<?php

$password_reset_linkValid = false;

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$isProfileUpdateCall = "0";

$user_id =$_GET['rmsysuser'];
$user_curr_pass =$_GET['reset'];
$isProfileUpdateCall =$_GET['profileUpdateCall'];


//database connectivity
$db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');

// Check that password reset link is valid

$db->where('user_id', trim($user_id))->where('password', trim($user_curr_pass));
$userInfo = $db->getOne("user",'user_id');

if ($db->count > 0) 
{
    $password_reset_linkValid = true;
}

if (isSet($_POST['submit'])) 
{   
    //database connectivity
    $db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');
    
    $tableData['password'] = sha1(trim($_POST['password']));
    $isProfileUpdateCall =$_POST['profileUpdateCall'];

    $db->where ("user_id", trim($_POST['user_id']));
    
    // everything is good, lets update the profile
    
    $status = $db->update('user',$tableData);
    
    if ($status==true)
    {
        if ($isProfileUpdateCall=="1")
        {
            $rasUpdatePath = "/ras/profileUpdate.php";
            header("Location:".$rasUpdatePath);
        }
        else
        {
            header("Location:index.php");
        }
    }
    else
    {
        die("problem occured in password reset.");
    }
}
?>

<html>


<head>
  <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">

 <style type="text/css">
.logo {
	float:right;
	margin-top: 12px;
}

/* resize reward logo*/
.col-md-12 img
{
    width:300px !important;
    height: 300px !important;
}

    .container
    {
        width:55% !important;
    }
 </style>

 
 <title>Password Reset</title>
</head>

<body>


<?php
if ($password_reset_linkValid==true) 
{
?>
    
    
    <div class="container">
            <div class="logo"><a href="http://rmsystem.org"><img src="img/logo.png"></a></div>
        <div class="content-heading"><h3>Password Reset</h3></div><br />
        <div class="row">
           <form role="form" method="post" action="changePassword.php">
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span> = Required Field</strong></div>
                    <div class="form-group">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
    
                   <div class="form-group">
                        <label for="retypePassword">Password Again</label>
                        <div class="input-group">
                            <input type="password" name="retypePassword" class="form-control" placeholder="Confirm Password" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div style="width: 30%; float:left;" class="input-group">
                             <a class="btn btn-primary" href="../ras/profileUpdate.php">Cancel</a>
                        </div>
                        
                        <div style="width: 30%; float:left;" class="input-group">
                            <input name="user_id" type="hidden" value="<?php echo $user_id;?>" />
                            <input name="profileUpdateCall" type="hidden" value="<?php echo $isProfileUpdateCall;?>" />
                            <input type="submit" name="submit" value="Reset" class="btn btn-primary"/>
                        </div>
                    </div>
                        
                    </div>
                </div>
            </form>
            
                    
                    <div class="col-lg-5 col-md-push-1">
                <div class="col-md-12">
 
                    <div>
                        <img src="../img/rewards.jpg">
                    </div>
                </div>
            </div>
            
          </div>

    </div>
    
    <!--
    <div id="columns">
        <form name="login" method="post" action="changePassword.php">

            <table width="440" border="0" align="center" cellpadding="4" cellspacing="1" class="tableBorder">
                <tr bgcolor="#eeeeee">
                    <td colspan="2">
                        <div id="loginDetails">
                            <strong>&nbsp;&nbsp;Password reset</strong>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;&nbsp;New password</td>
                    <td>
                        <input name="password" type="password" size="30" /></td>
                </tr>

                 <tr>
                    <td>&nbsp;&nbsp;Confirm new password</td>
                    <td>
                        <input name="retypePassword" type="password" size="30" />

                    </td>
                </tr>

                <tr>
                    <td>
                        <a class="btn btn-primary" href="../ras/profileUpdate.php">Cancel</a>                        
                    </td>
                    <td>
                        <input name="user_id" type="hidden" value="<?php echo $user_id;?>" />
                        <input name="profileUpdateCall" type="hidden" value="<?php echo $isProfileUpdateCall;?>" />
                        <input type="submit" name="submit" value="Reset" class="btn btn-primary"/>
                    </td>
                </tr>
            </table>
            <br />
        </form>

    </div>
    -->
    
    
    <?php
    }
    else
    {
        echo "Password reset link is not valid. Please try it again.";
    }
?>
</body>
</html>
