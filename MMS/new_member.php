<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
?> 
<script src="js/jquery-1.6.1.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
    
        function validateEmailInput(field, query) {
    	//If the email is valid

    	if (validateEmail(query))
    	{
            document.getElementById("add").disabled = false;
            document.getElementById("add").style.cursor = "pointer";
            $("#InputEmail").css("border","1px solid #5DACED");
    	}
    	else
    	{    alert("check email");
             document.getElementById("add").disabled = true;
             document.getElementById("add").style.cursor = "not-allowed";
             $("#InputEmail").css("border","1px solid #ed5d62");
    	}
	}
        
       function validatePassInput(field, query) {
    	//If the email is valid
    	if (checkPassword(query))
    	{               document.getElementById("add").disabled = false;
                        $("#InputPassword").css("border","1px solid #5DACED");
                        
    	}
    	else
    	{        alert("check password");
                        document.getElementById("add").disabled = true;
                    	$("#InputPassword").css("border","1px solid #ed5d62");
    	}
	}
    	//Used to validate user input email addresses.
	function validateEmail(email) { 
	    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}
	//Used to validate password is between 5 and 20 characters and only alphanumeric
	function checkPassword(password){
	    var pattern = /^[a-zA-Z0-9_-]{5,20}$/;
	    if(pattern.test(password)){
	        return true;
	    }else{
	        return false;
	    }
	} 
</script>


    <script>
    $(function() {
        $( "#birth_date" ).datepicker({
            changeYear: true,
            //yearRange: "1901:2013",
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            defaultDate: new Date(),
                            });
    });
    </script>

<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Members - New Member</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
        <link rel="stylesheet" href="css/datepicker.css" media="all" >
	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/lt-ie-9.css" media="all" /><![endif]-->
</head>
<body>
<div class="testing">
<header class="main">
	<h1><strong>MMS</strong> Dashboard</h1>
</header>
<section class="user">
	<div class="profile-img">
                    <?php
                    //Variable initialization
                    session_start();
                    $firstName = $_SESSION['user_firstname'];
                    $lastName = $_SESSION['user_lastname'];
                    $email = $_SESSION['user_email'];
                    echo "<p><img src='../img/logo.png' alt='' height='40' width='40' /> Welcome! " .$firstName." ". $lastName . " (".$email.")" . "</p>";
                ?>
	</div>
	<div class="buttons">
		<button class="ico-font">&#9206;</button>
		<span class="button">Help</span>
		<span class="button blue"><a href="logout.php">Logout</a></span>
	</div>
</section>
</div>
<nav>
	<ul>
            <li><a href="mms.php"><span class="icon">&#128711;</span> Dashboard</a></li>
		<li>
			<a href="database.php"><span class="icon">&#128248;</span> Database</a>
			<ul class="submenu">
                                <li><a href="redundant_database.php">View Redundant Database</a></li>
				<li><a href="backup_restore.php">Backup and Restore</a></li>
			</ul>	
		</li>
		<li class="section">
			<a href="member.php"><span class="icon">&#59170;</span> Members</a>
			<ul class="submenu">
				<li><a href="new_member.php">New Member</a></li>
				<li><a href="find_member.php">Find Members</a></li>
			</ul>
		</li>
                <li>
			<a href="retailer.php"><span class="icon">&#59148;</span> Retailers</a>
			<ul class="submenu">
				<li><a href="new_retailer.php">New Retailer</a></li>
				<li><a href="find_retailer.php">Find Retailers</a></li>
			</ul>
		</li>
                <li>
			<a href="rewards.php"><span class="icon">&#127942;</span> Rewards</a>
			<ul class="submenu">
				<li><a href="tiers_manage.php">Tiers Management</a></li>
                                <li><a href="coupons_manage.php">Coupons Management</a></li>
			</ul>
		</li>
                <li>
			<a href="media.php"><span class="icon">&#127916;</span> Media</a>
		</li>
		<li><a href="admin.php"><span class="icon">&#128273;</span> Administrator</a>
			<ul class="submenu">
                                <li><a href="new_admin.php">New Administrator</a></li>
                                <li><a href="edit_admin.php">Edit Administrator</a></li>
			</ul>
                </li>
	</ul>
</nav>

<section class="content" style='margin-top: 0px;'>
	<section class="widget">
		<header>
			<span class="icon">&#59136;</span>
			<hgroup>
				<h1>New Member</h1>
				<h2>a information panel</h2>
			</hgroup>
		</header>
		<div class="content">
                    <form method="post" action="add_member.php">
                                <p>First Name:</p><input name="first_name" type="text"/>
                                <p>Last Name:</p><input name="last_name" type="text"/>
                                <p>Address:</p><input name="address_line_1" type="text"/>
                                <p></p><input name="address_line_2" type="text"/>
                                <p>City:</p><input name="city" type="text"/>
                                <p>State:</p>
                                <select class ="style" name="state">
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
                                <p>Zip:</p><input name="zip" type="text"/>
                                <p>Birthday:</p><input name="birth_date" id= "birth_date" type="text"value = "" />
                                <p>Tier:</p>
                                <select class ="style" name="reward_tier">
                                    <option value="value">Value</option>
                                    <option value="gold">Gold</option>
                                    <option value="platinum">Platinum</option>
                                    <option value="prestige">Prestige</option> 
                                </select>
                                <p>Email:</p><input onChange="validateEmailInput('InputEmail', this.value)" id="InputEmail" name="email" type="text" >
                                <p>Password:</p><input onChange="validatePassInput('InputPassword', this.value)" id="InputPassword" name="password" type="password" >
                                <p>Credit Card:</p><input name="cc_number" type="text"/>
                                <p>Expired Date:</p><input name="cc_expire" type="text"/>
                                <p>CVV:</p><input name="cc_cvv" type="text"/>
                                <p>Billing Address:</p><input name="billing_address_line_1" type="text"/>
                                <p></p><input name="billing_address_line_2" type="text"/>
                                <p>City:</p><input name="billing_city" type="text"/>
                                <p>State:</p>
                                <select class ="style" name="billing_state">
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
                                <p>Zip:</p><input name="billing_zip" type="text"/>
			<div align="right">
			<button id ="add" name="add" class="green" disabled>Add</button> <button type="reset" class="">Reset</button>
                        </div>
                    </form>
                        </div>
		</div>
	</section>
</section>

<section class="content" id= "foot" style='margin-top: 0px;'>
	<div id="footer">
		Copyright &copy; <a href="http://rmsystem.org">Rmsystem 2014</a> Theme powered by John Doe
  </div>
</section>

<script src="js/jquery.wysiwyg.js"></script>
<script src="js/custom.js"></script>
<script src="js/cycle.js"></script>
<script src="js/jquery.checkbox.min.js"></script>
<!--<script src="js/flot.js"></script>
<script src="js/flot.resize.js"></script>
<script src="js/flot-time.js"></script>
<script src="js/flot-pie.js"></script>
<script src="js/flot-graphs.js"></script>
<script src="js/cycle.js"></script>-->
<script src="js/jquery.tablesorter.min.js"></script>
</body>
</html>