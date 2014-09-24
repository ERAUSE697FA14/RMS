<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Customer Rewards Management System - Registration</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
    <div class="logo"><a href="http://rmsystem.org"><img src="img/logo.png"></a></div>
    <div class="content-heading"><h1>SE 697 Rewards Program Registration</h1></div><br />
        <div class="row">
            <form role="form" id="register-form">
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span> = Required Field</strong></div>
                    <div class="form-group">
                        <label style="display: block;" for="InputName">Name</label>
                        <div style="width: 49%; float: left" class="input-group">
                            <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="First Name" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 50%; float:left; margin-left: 1%; margin-bottom: 14px;" class="input-group">
                            <input type="text" class="form-control" id="InputLastName" name="InputLastName" placeholder="Last Name" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <div style="clear:both;" class="form-group">
                        <label for="InputEmail">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="InputEmailFirst" name="InputEmail" placeholder="Enter Email" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputEmailSecond">Confirm Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="InputEmailSecond" name="InputEmailSecond" placeholder="Confirm Email" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="InputPasswordFirst" name="InputPassword" placeholder="Enter Password" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputPasswordSecond">Password Again</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="InputPasswordSecond" name="InputPasswordSecond" placeholder="Confirm Password" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputAddress">Address</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputAddress" name="InputAddress" placeholder="Address Line 1" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputAddress2" name="InputAddress2" placeholder="Address Line 2">
                            <span style="padding-left:26px;" class="input-group-addon"></span>
                        </div>
                    </div>

                    <!--City,state,zip-->
                    <div class="form-group">
                        <div style="width: 50%; float:left;" class="input-group">
                            <input type="text" class="form-control" id="InputCity" name="InputCity" placeholder="City" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 19%; float:left; margin-left: 1%;" class="input-group">
                            <input type="text" class="form-control" id="InputState" name="InputState" placeholder="State" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 29%; float:left; margin-left: 1%;" class="input-group">
                            <input type="text" class="form-control" id="InputZip" name="InputZip" placeholder="Zip Code" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="margin-top: 14px;" for="InputTier">Rewards Level</label>
                        <div class="input-group">
                            <select name="tier" id="tierselect">
                                <option value="basic">Basic (Free! 1X point multiplier)</option>
                                <option value="beginner">Beginner ($50/year, 2X point multiplier)</option>
                                <option value="pro">Professional ($100/year, 3X point multiplier)</option>
                                <option value="extreme">Extreme ($150/year, 4X point multiplier)</option> 
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="InputBirthdate">Date of Birth</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputBirthdateFirst" name="InputBirthdate" placeholder="Enter Birthdate" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <label for="InputCC">Credit Card</label>
                    <div class="form-group">
                        <div style="width: 50%; float:left;" class="input-group">
                            <input type="text" class="form-control" id="InputCC" name="InputCC" placeholder="CC Number" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 29%; float:left; margin-left: 1%;" class="input-group">
                            <input type="text" class="form-control" id="InputCCExpire" name="InputCCExpire" placeholder="Expire" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 19%; float:left; margin-left: 1%;" class="input-group">
                            <input type="text" class="form-control" id="InputCCCVV" name="InputCCCVV" placeholder="CVV" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="margin-top: 14px;" for="AlreadyMember">Already a Member?</label>
                        <div>
                            <a href="/login.php">Login Here!</a>
                        </div>
                    </div>





                    <input type="submit" name="submit" id="submit" value="Submit" style="clear: both;" class="btn btn-primary btn-lg btn-block">
                </div>
            </form>
            <div class="col-lg-5 col-md-push-1">
                <div class="col-md-12">
                    <!--<div class="alert alert-success">
                        <strong><span class="glyphicon glyphicon-ok"></span> Success! Message sent.</strong>
                    </div>
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-remove"></span><strong> Error! Please check all page inputs.</strong>
                    </div>-->
                    <div>
                        <img src="img/rewards.jpg">
                    </div>
                </div>
            </div>
        </div>


        <footer style="margin: 10px 0px 10px 0px; text-align: center; background-color: #dff0d8;">
            Copyright &copy; <a href="http://rmsystem.org">Rmsystem 2014</a>
        </footer>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/submitscript.js"></script>
  </body>
</html>
