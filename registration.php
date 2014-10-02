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
    <!-- jQuery UI Theme for Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<div class="bigContainer">
    <div class="container" style="width: 49%; float: left;">
    
    <!--<div class="content-heading"><h1>SE 697 Rewards Program Registration</h1></div><br />-->

        <div class="row">
            <form role="form" id="register-form">
                <div class="col-lg-11">
                    <div class="well well-sm" style="margin-bottom: 5px; margin-top: 8px;"><strong><span class="glyphicon glyphicon-asterisk"></span> = Required Field</strong></div>
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
                        <label for="InputPasswordSecond">Confirm Password</label>
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
                        <div style="width: 41%; float:left;" class="input-group">
                            <input type="text" class="form-control" id="InputCity" name="InputCity" placeholder="City" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 19%; float:left; margin-left: 1%; margin-top:7px;" class="input-group">
                            <select name="InputState" id="InputState">
                                <option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District Of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option> 
                            </select>
                            <!--<input type="text" class="form-control" id="InputState" name="InputState" placeholder="State" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>-->
                        </div>
                        <div style="width: 23%; float:right; margin-left: 1%;" class="input-group">
                            <input type="text" class="form-control" id="InputZip" name="InputZip" placeholder="Zip" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <div class="form-group" style="clear:both;">
                        <label style="margin-top: 14px; clear:both;" for="InputTier">Rewards Level</label>
                        <div class="input-group">
                            <select name="tier" id="tierselect">
                                <option value="value">Value (Free! 1X point multiplier)</option>
                                <option value="gold">Gold ($50/year, 2X point multiplier)</option>
                                <option value="platinum">Platinum ($100/year, 3X point multiplier)</option>
                                <option value="prestige">Prestige ($150/year, 4X point multiplier)</option> 
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

                    <label for="InputCC">Credit Card (Visa, Mastercard, or Discover)</label>
                    <div class="form-group">
                        <div style="width: 50%; float:left;" class="input-group">
                            <input type="text" class="form-control" id="InputCC" name="InputCC" placeholder="CC Number" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 27%; float:left; margin-left: 1%;" class="input-group">
                            <input type="text" class="form-control" id="InputCCExpire" name="InputCCExpire" placeholder="Expire" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                        <div style="width: 21%; float:left; margin-left: 1%;" class="input-group">
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
                    <div class="form-group">
                        <label style="margin-top: 14px;" for="AlreadyMember">Please type the code below:</label>
                        <div>
                            <?php 
                            	require_once('libs/recaptchalib.php');
								$publickey = "6LdW8_oSAAAAALZWluUE1ETMF5_RFhgK2PTZB2Hd"; // you got this from the signup page
								echo recaptcha_get_html($publickey, $error = null, $use_ssl = true);
                            ?>
                        </div>
                    </div>





                    <input type="submit" name="submit" id="submit" value="Submit" style="clear: both;" class="btn btn-primary btn-lg btn-block">
                </div>
            </form>
            <!--<div class="col-lg-5 col-md-push-1">
                <div class="col-md-12">
                    <div>
                        <img src="img/rewards.jpg">
                    </div>
                </div>
            </div>-->
        </div>


        <footer style="margin: 10px 0px 10px 0px; text-align: center; background-color: #dff0d8;">
            Copyright &copy; <a href="http://rmsystem.org">Rmsystem 2014</a>
        </footer>

    </div>

    <div class="logo"><a href="http://rmsystem.org"><img src="img/logo.png"></a></div>

    <div style="float:right; width:49%;">
        <img src="img/rewards.jpg">
    </div>
</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="/js/submitscript.js"></script>
    <!-- Script for Credit card validator -->
    <script src="/js/jquery.creditCardValidator.js"></script>

    <!-- For the birthdate field datepicker -->
    <script>
    $(function() {
        $( "#InputBirthdateFirst" ).datepicker({changeYear: true, yearRange: "1901:2012"});
    });
    </script>

    <script>
        $( "#InputCC" ).validateCreditCard(function(result)
            {
                //If credit card is mastercard
                if (result.card_type.name == 'mastercard')
                {
                    //Show the mastercard image
                    $("#InputCC").css("background-position","2px -247px, 260px -87px");
                }
                else if (result.card_type.name == 'visa')
                {
                	//show the visa image
                    $("#InputCC").css("background-position","2px -163px, 260px -87px");
                }
                else if (result.card_type.name == 'discover')
                {
                	//show the discover image
                    $("#InputCC").css("background-position","2px -331px, 260px -87px");
                }
            });

    </script>

  </body>
</html>