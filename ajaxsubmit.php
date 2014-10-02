<?php

    //Verify Captcha
    require_once('libs/recaptchalib.php');
    $privatekey = "6LdW8_oSAAAAAMvgFdPspoYneb2sXhorPVaqvmrz";
    $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
    } else {

    	require_once ('libs/MysqliDb.php');                                            //include the CRUD library
        $db = new MysqliDb ('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');  //connect to the database
        /*
            This file processes the registration request from registration.php
        */
        //Fetching Values passed in from javascript
    	$first_name=$_POST['FirstName'];
    	$last_name=$_POST['InputLastName'];
    	$email=$_POST['InputEmail'];
    	$email2=$_POST['InputEmailSecond'];
    	$password=$_POST['InputPassword'];
    	$password2=$_POST['InputPasswordSecond'];
    	$address_line1=$_POST['InputAddress'];
    	$address_line2=$_POST['InputAddress2'];
    	$city=$_POST['InputCity'];
    	$state=$_POST['InputState'];
    	$zip=$_POST['InputZip'];
    	$tier=$_POST['tier'];
    	$birthdate=$_POST['InputBirthdate'];
    	$cc_number=$_POST['InputCC'];
    	$cc_expire=$_POST['InputCCExpire'];
    	$cc_cvv=$_POST['InputCCCVV'];

        // Create a unique  activation code:
        $activation = md5(uniqid(rand(), true));

    	//Check if the user's email address already exists:
        $db->where ("email", $email); //select all records that have the entered email...
        $users = $db->get ("user");          //pulls the records from the "user" table
        if ($db->count > 0) {
        	die ("Email address already in use. Please use a different email.");
        }
        //Else, insert them into the database!
        else {
        	$data = Array(
        		'first_name' => $first_name,
        		'last_name' => $last_name,
        		'address_line_1' => $address_line1,
        		'address_line_2' => $address_line2,
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
                $message = " To activate your account, please click the link below:\n\n";
                $message .= 'http://rmsystem.org/activate.php?email=' . urlencode($email) . "&key=$activation";
                mail($email, 'Rewards System Registration Confirmation', $message, 'From:'.NOREPLY);
   
                  // Flush the buffered output.

    		    echo 'You have registered successfully! Please check your email address to activate your account.';
    		}
    		else{
    		    echo 'Registration Unsuccessful: ' . $db->getLastError();
    		}
    	}
    }
?>