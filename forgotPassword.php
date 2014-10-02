<?php


if (isSet($_POST['submit'])) 
{
    $mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

    require_once ($mysqliDbpath);
    
    
    //database connectivity
    $db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');

    // Check that requested email address is already exist in the table for another user
    $db->where('email', trim($_POST['email']));;
    
    $userInfo = $db->getOne("user",'password,user_id');

    if ($db->count > 0) 
    {
        echo "Password reset link sent. Please use it to reset your password.";
        
        $curr_pass = $userInfo["password"];
        $user_id = $userInfo["user_id"];
            
        $to      = trim($_POST['email']);
        $subject = 'SE 697 RMS account reset password link';
        $message = "Please click on following link to reset the password. \n\n https://rmsystem.org/changePassword.php?rmsysuser=" . $user_id."&reset=" .$curr_pass;
        $headers = 'From: donotreply@rmsystem.org' . "\r\n" .
           // 'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }
    else
    {
        $email_error =true;
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

#error_notification
    {
    border: 1px red solid;
    height: auto;
    padding: 4px;
    background: #F8F0F1;
    text-align: center;
    -moz-border-radius: 5px;

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

 
 <title>Forgot Password</title>

</head>

<body>

        <div class="container">
            <div class="logo"><a href="http://rmsystem.org"><img src="img/logo.png"></a></div>
        <div class="content-heading"><h3>Forgot Password</h3></div><br />
        <div class="row">
            <form name="login" method="post" action="forgotPassword.php">               
                
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span> = Required Field</strong></div>
                    <div class="form-group">
                        
                                              <?php
                        if (isSet($email_error)) 
                        {
                        ?>
                        <div id="error_notification">
                            <b>Incorrect Email Address</b><br />
                            <div style="font-size: 13px;">
                                The email address you entered is incorrect.
                                                                Please try again
                            </div>
                        </div>
                        <br/>
                        <?php
                        }
                        ?>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" placeholder="Email Address" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="width: 30%; float:left;" class="input-group">
                                 <a class="btn btn-primary" href="index.php">Cancel</a>
                            </div>

                            <div style="width: 30%; float:left;" class="input-group">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
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

</body>
</html>
