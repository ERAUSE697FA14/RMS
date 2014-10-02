
<?php

$sessionPath = $_SERVER{'DOCUMENT_ROOT'} ."/ras/sessionVerification.php";
require_once $sessionPath;

// Is the user already logged in? Redirect him/her to the private page

if ($_SESSION['user_id'] != "") {
    header("Location:/ras/home.php");
    exit;
}

if (isSet($_POST['submit'])) {
    $do_login = true;
    $loginPath = $_SERVER{'DOCUMENT_ROOT'} ."/ras/do_login.php";
    include_once $loginPath;
}
?>

<html >
    <head>

          <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">

 <style type="text/css">
.logo {
	float:right;
	margin-top: 12px;
}

.videoDiv
{
    	float:left;
	margin-top: 12px;
}
.videoDiv video
{
  width:350px !important;
    height: 35% !important;
}

/* resize reward logo*/
.col-md-12 img
{
    width:300px !important;
    height: 300px !important;
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
    .container
    {
        width:55% !important;
    }
    
    .register
    {
       background-color: #434D55; 
    }
 </style>

 
 <title>RMS Login</title>
    </head>

    <body>
        <div class="container">
            
            <div class="logo"><a href="http://rmsystem.org"><img src="img/logo.png"></a></div>
        <div class="content-heading"><h3>RMS Secure Login</h3></div><br />
        <div class="row">
           <form name="login" method="post" action="index.php">
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span> = Required Field</strong></div>
                    <div class="form-group">
                        
                                                                            <?php
                                                    if (isSet($login_error)) {
                                                        ?>
                                                        <div id="error_notification">
                                                            <b>Incorrect Username/Password</b><br/>
                                                            <div style="font-size:13px;">
                                                                The username/password you entered is incorrect.
                                                                Please try again
                                                            </div>
                                                        </div>
                        <br/>
                                                        <?php
                                                    }
                                                    ?>
                        
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <input type="text" name="username" class="form-control" placeholder="Email address" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
    
                   <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div style="width: 100%;" class="input-group">
                         <input type="submit" name="submit" value="Sign In" class="btn btn-primary btn-lg btn-block"/>
                        </div>
                    </div>
                        
                    <div class="form-group">                        
                        <div style="width: 90%; float:right;" class="input-group">
                           <a href="forgotPassword.php">I can't access my account help please</a>
                        </div>
                        <br/>
                    </div>
                    
                        
                    <div class="form-group">
                        <div style="width: 100%;" class="input-group">
                            <a class="btn btn-primary btn-lg btn-block register" href="registration.php">Not registered yet ?</a>
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
                        
                                  
           <div class="videoDiv">
                <video controls>
                    <source src="movie.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            </div>
            
          </div>

    </div>
       
    </body>
</html>
