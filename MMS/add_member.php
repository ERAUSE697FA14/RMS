<?php
require_once 'session.php';
if($_SESSION['user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$password=$_POST['password'];
$address_line_1=$_POST['address_line_1'];
$address_line_2=$_POST['address_line_2'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$tier=$_POST['tier'];
$birthdate=$_POST['birthdate'];
$cc_number=$_POST['cc_number'];
$cc_expire=$_POST['cc_expire'];
$cc_cvv=$_POST['cc_cvv'];

$role = "member";

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$activation = md5(uniqid(rand(), true));
        	$data = Array(
        		'first_name' => $first_name,
        		'last_name' => $last_name,
        		'address_line_1' => $address_line_1,
        		'address_line_2' => $address_line_2,
        		'city' => $city,
        		'state' => $state,
        		'zip_code' => $zip,
        		'birth_date' => $birthdate,
        		'reward_tier' => $tier,
        		'email' => $email,
        		'password' => SHA1($password),
        		'cc_number' => SHA1($cc_number),
        		'cc_expire' => $cc_expire,
        		'cc_cvv' => $cc_cvv,
                'activation' => $activation,
        	);
        	$insert = $db->insert ('user', $data);
    		if ($insert) {
    			echo 'We got here';
                $message = " To activate your account, please click the link below:\n\n";
                $message .= 'http://rmsystem.org/activate.php?email=' . urlencode($email) . "&key=$activation";
                mail($email, 'Rewards System Registration Confirmation', $message, 'From:'.NOREPLY);
   
                  // Flush the buffered output.

    		    echo 'You have registered successfully! Please check your email address to activate your account.';
    		}
    		else{
    		    echo 'Registration Unsuccessful: ' . $db->getLastError();
    		}
                $memberPath = "../MMS/member.php";
                header("Location:".$memberPath);
?>