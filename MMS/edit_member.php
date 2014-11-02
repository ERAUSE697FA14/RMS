<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}

if(isset($_POST['apply_top'])){
    $pass="<script type=text/javascript>document.getElementById('apply_top').disabled</script>";
if($pass){
session_start();
$user_id = $_SESSION['passid'];
unset($_SESSION['passid']);
    require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    // Get Post form data
    $tableData['first_name'] = trim($_POST['first_name']);
    $tableData['last_name'] = trim($_POST['last_name']);
    $tableData['address_line_1'] = trim($_POST['address_line_1']);
    $tableData['address_line_2'] = trim($_POST['address_line_2']);
    $tableData['city'] = trim($_POST['city']);
    $tableData['state'] = trim($_POST['state']);
    $tableData['zip_code'] = trim($_POST['zip']);
    
    $tableData['billing_address_line_1'] = trim($_POST['billing_address_line_1']);
    

    $tableData['billing_address_line_2'] = trim($_POST['billing_address_line_2']);
    $tableData['billing_city'] = trim($_POST['billing_city']);
    $tableData['billing_state'] = trim($_POST['billing_state']);
    $tableData['billing_zip'] = trim($_POST['billing_zip']);
    
    $tableData['email'] = trim($_POST['email']);
    $tableData['birth_date'] = trim($_POST['birth_date']);
    
    if( isset($_POST['password']) )
    {
        $tableData['password'] = SHA1(trim($_POST['password']));;
    }
    
    if( isset($_POST['cc_cvv']) )
    {
        $tableData['cc_cvv'] = trim($_POST['cc_cvv']);
    }
    
    if( isset($_POST['cc_expire']) )
    {
        $tableData['cc_expire'] = trim($_POST['cc_expire']);
    }

    if( isset($_POST['cc_number']) )
    {
        $tableData['cc_number'] = SHA1(trim($_POST['cc_number']));
    }
    
    if( isset($_POST['reward_tier']) )
    {
        $tableData['reward_tier'] = trim($_POST['reward_tier']);
    }
    
    
    
    // Check that requested email address is already exist in the table for another user
    $db->where ("user_id", $user_id,'<>')->where('email', $tableData['email']);
    
    $userInfo = $db->getOne("user",'email');

    if ($db->count > 0) 
    {
        // error- another user having same email
        die('email id exist!');
    }
    else
    {
        $db->where ("user_id", $user_id);
        
        // everything is good, lets update the profile
        
        $status = $db->update('user',$tableData);

    }
    echo "<script type='text/javascript'>window.close();</script>";
    echo "<script type='text/javascript'>window.opener.location.reload();</script>";

}
else
    {
    echo "<script type='text/javascript'>alert('check inputs');</script>";
    }
}
else if (isset ($_POST['close'])){
    
    echo "<script type='text/javascript'>window.close();</script>";
}
else{
$user_id = $_GET['memberid'];
require_once 'connectvars.php';
$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db->where ("user_id", $user_id);
$member = $db->getOne("user");              

}

?> 

<script>
function selectValue(sId,value){  
    var s = document.getElementById(sId);  
    var ops = s.options;  
    for(var i=0;i<ops.length; i++){  
        var tempValue = ops[i].value;  
        if(tempValue == value)  
        {  
            ops[i].selected = true;  
        }  
    }  
}  
  
        function validateEmailInput(field, query) {
    	//If the email is valid

    	if (validateEmail(query))
    	{
            document.getElementById("apply_top").disabled = false;
            document.getElementById("apply_top").style.cursor = "pointer";
            $("#InputEmail").css("border","1px solid #5DACED");
    	}
    	else
    	{    alert("check email");
             document.getElementById("apply_top").disabled = true;
             document.getElementById("apply_top").style.cursor = "not-allowed";
             $("#InputEmail").css("border","1px solid #ed5d62");
    	}
	}
        
       function validatePassInput(field, query) {
    	//If the email is valid
    	if (checkPassword(query))
    	{               document.getElementById("apply_top").disabled = false;
                        document.getElementById("apply_top").style.cursor = "pointer";
                        $("#InputPassword").css("border","1px solid #5DACED");
                        
    	}
    	else
    	{        alert("check password");
                        document.getElementById("apply_top").disabled = true;
                        document.getElementById("apply_top").style.cursor = "not-allowed";
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
    function editcfm() { 
        if (!confirm("Are you sure that you want to submit?")) { 
            window.event.returnValue = false; 
        } 
    } 
</script>

<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Members - Edit Members</title>
	<meta name="description" content="" >
	<meta name="keywords" content="" >
	<meta name="robots" content="" >
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" >
        <link rel="stylesheet" href="css/ui.css" media="all" >
        <link rel="stylesheet" href="css/datepicker.css" media="all" >
	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->
</head>
<body>
<form method="post" action="edit_member.php">
<div class="testing">
<header class="main">
	<h1><strong>Edit</strong> Member</h1>
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
            <button class="button green" name="apply_top" onClick="editcfm()" id="apply_top">Apply </button>
		<button class="button blue" name="close">Close </button>
	</div>
</section>
</div>
<section class="content" style='margin: 0px;'>
	<section class="widget">
		<header>
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>Selected Member</h1>
				<h2>a information panel</h2>
			</hgroup>

		</header>
		<div class="content">
                                <p>ID: <?php echo $member['user_id'];session_start(); $_SESSION['passid'] = $member['user_id'];?></p>
                                <p>First Name:</p><input name="first_name" type="text" value = "<?php echo $member['first_name'];?>" />
                                <p>Last Name:</p><input name="last_name" type="text"value = "<?php echo $member['last_name'];?> "/>
                                <p>Address:</p><input name="address_line_1" type="text"value = "<?php echo$member['address_line_1'];?>" />
                                <p></p><input name="address_line_2" type="text"value = "<?php echo $member['address_line_2'];?>" />
                                <p>City:</p><input name="city" type="text"value = "<?php echo $member['city'];?> "/>
                                 <p>State:</p>
                                <select class ="style" name="state" id="InputState<?php echo $member['user_id']?>">
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
                                <script>
                                    selectValue('InputState<?php echo $member['user_id']?>','<?php echo $member['state'];?>');  
                                </script>
                                <p>Zip:</p><input name="zip" type="text"value = "<?php echo $member['zip_code'];?>" />
                                <p>Birthday:</p><input name="birth_date" id= "birth_date" type="text"value = "<?php echo $member['birth_date'];?>" />
                                <p>Tier:</p>
                                <select class ="style" name="reward_tier" id="InputTier<?php echo $member['user_id'];?>">
                                    <option value="value">Value (Free! 1X points)</option>
                                    <option value="gold">Gold ($50/year, 2X points)</option>
                                    <option value="platinum">Platinum ($100/year, 3X points)</option>
                                    <option value="prestige">Prestige ($150/year, 4X points)</option> 
                                </select>
                                <script>
                                    selectValue('InputTier<?php echo $member['user_id']?>','<?php echo $member['reward_tier'];?>');  
                                </script>
                                <p>Email:</p><input onChange="validateEmailInput('InputEmail', this.value)" id="InputEmail" name="email" type="text"value = "<?php echo $member['email'];?>" >
                                <p>Password:</p><input onChange="validatePassInput('InputPassword', this.value)" id="InputPassword" name="password" type="password" >
                                <p>Credit Card:</p><input id="InputCC" name="cc_number" type="text" >
                                <p>Expired Date:</p><input name="cc_expire" type="text" value = "<?php echo $member['cc_expire'];?>" >
                                <p>CVV:</p><input name="cc_cvv" type="text"value = "<?php echo $member['cc_cvv'];?>" >
                                <p>Billing Address:</p><input name="billing_address_line_1" type="text"value = "<?php echo $member['billing_address_line_1'];?>"  >
                                <p></p><input name="billing_address_line_2" type="text"value = "<?php echo $member['billing_address_line_2'];?>" >
                                <p>City:</p><input name="billing_city" type="text"value = "<?php echo $member['billing_city'];?> " >
                                <p>State:</p>
                                <select class ="style" name="billing_state" id="billingState<?php echo $member['user_id']?>">
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
                                <script>
                                    selectValue('billingState<?php echo $member['user_id']?>','<?php echo $member['billing_state'];?>');  
                                </script>
                                <p>Zip:</p><input name="billing_zip" type="text"value = "<?php echo $member['billing_zip'];?>" />
                        </div>
		</div>
	</section>
    </section>
</form>

<section class="content" style='margin-top: 0px;'>
	<div id="footer">
		Copyright &copy; <a href="http://rmsystem.org">Rmsystem 2014</a> Theme powered by John Doe
  </div>
</section>
<script src="js/jquery-1.6.1.min.js"></script>
<script src="js/jquery.wysiwyg.js"></script>
<script src="js/custom.js"></script>
<!--<script src="js/cycle.js"></script>-->
<script src="js/jquery.checkbox.min.js"></script>
<!--<script src="js/flot.js"></script>
<script src="js/flot.resize.js"></script>
<script src="js/flot-time.js"></script>
<script src="js/flot-pie.js"></script>
<script src="js/flot-graphs.js"></script>
<script src="js/cycle.js"></script>-->
<script src="js/jquery.tablesorter.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="../js/jquery.creditCardValidator.js"></script>
    <script>
    $(function() {
        $( "#birth_date" ).datepicker({
            changeYear: true,
            //yearRange: "1901:2013",
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            defaultDate: $( "#birth_date" ).value,
                            });
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
        <script>
             window.resizeTo(800, 760);
        </script>
</body>

</html>

