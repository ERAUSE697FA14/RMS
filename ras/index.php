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
    $loginPath = $_SERVER{'DOCUMENT_ROOT'}."/ras/do_login.php";
    include_once $loginPath;
}
?>

<html>
<head>

    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="js/html5lightbox.js"></script>

    <style type="text/css">
        
        
        .logo {
            float: right;
            margin-top: 12px;
        }

        .videoDiv {
            float: left;
            margin-top: 12px;
        }

            .videoDiv video {
                width: 350px !important;
                height: 35% !important;
            }

        /* resize reward logo*/
        .col-md-12 img {
            width: 300px !important;
            height: 300px !important;
        }

        .error_notification {
            border: 1px red solid;
            height: auto;
            padding: 4px;
            background: #F8F0F1;
            text-align: center;
            -moz-border-radius: 5px;
        }

        .container {
            width: 55% !important;
        }

        .register {
            background-color: #434D55;
        }
    </style>


    <title>RMS Login</title>
</head>

<body style="
	background-image: url('/img/subtle_white_mini_waves.png');
        background-color: #cccccc;
        ">
    

    <div class="container"  >
        
     <div class="row">
        <div class="logo"><a href="http://www.rmsystem.org">
            <img src="img/rewards.png"></a></div>
        <div>

                    <div>
                        <iframe width="560" height="315" src="//www.youtube.com/embed/videoseries?list=PLQOa26lW-uI_gaJ6TIprR9PiXVuKoVRot&autoplay=1" frameborder="0" allowfullscreen></iframe>
                        <!--<img src="../img/rewards.jpg">-->
                    </div>
                </div>
       <br/>
              <div style=" border: 6px solid gray !important">
         <div class="content-heading">
             <h3><b>RMS Secure Login</b></h3>
        </div>
     
        <br />
        <div class="row" >
            <form name="login" method="post" action="index.php">
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>= Required Field</strong></div>
                    
                 <div class="form-group">

                         <?php
                        if (isSet($login_username_error)) 
                        {
                            ?>
                            <div class="error_notification">
                                <b>Incorrect Username</b><br />
                                <div style="font-size: 13px;">
                                    The username you entered is incorrect. Please try again.
                                </div>
                            </div>
                            <br />
                            <?php
                        }
                        ?>

                        <?php
                        if (isSet($login_error)) 
                        {
                            ?>
                            <div class="error_notification">
                                <b>Incorrect Password</b><br />
                                <div style="font-size: 13px;">
                                    The password you entered is incorrect. Please try again.
                                </div>
                            </div>
                            <br />
                            <?php
                        }
                        ?>

                        <?php
                        if (isSet($login_activation_error)) 
                        {
                            ?>
                            <div class="error_notification">
                                <b>Account not activated</b><br />
                                <div style="font-size: 13px;">
                                    Account is not activated yet. Please activate it. Check your email.
                                </div>
                            </div>
                            <br />
                            <?php
                        }
                        ?>

                       <?php
                        if (isSet($login_role_error)) 
                        {
                            ?>
                            <div class="error_notification">
                                <b>Role Error</b><br />
                                <div style="font-size: 13px;">
                                    Admin user not allowed to login here.
                                </div>
                            </div>
                            <br />
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
                                <input type="submit" name="submit" value="Sign In" class="btn btn-primary btn-lg btn-block" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="width: 90%; float: right;" class="input-group">
                                <a href="forgotPassword.php">I can't access my account help please</a>
                            </div>
                            <br />
                        </div>

                        <div class="form-group">
                            <div style="width: 100%;" class="input-group">
                                <a class="btn btn-primary btn-lg btn-block register" href="registration.php">Not registered yet ?</a>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            <div class="col-md-push-1" style="float:right; width:100%;">
                <div class="videoDiv">
                    <!--<video controls>
                        <source src="movie.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>-->
                   <a href="JavaScript:html5Lightbox.showLightbox(2, 'movie.mp4', 'RMS Help', 480, 270);">    RMS Help ?</a>
                </div>   
            </div>

        </div>
        </div>
    </div>
    </div>

         <footer style="margin: 10px 0 10px 0; text-align: center; background-color: #dff0d8;">
            Copyright &copy; <a href="http://www.rmsystem.org">Rmsystem 2014</a>
        </footer>
</body>
</html>
