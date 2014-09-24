<?php

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

	//Check if the user's email address already exists:
    $db->where ("email", $email); //select all records that have the entered email...
    $users = $db->get ("user");          //pulls the records from the "user" table
    if ($db->count > 0) {
    	echo "Email address already in use.";
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
    		'zip_code' => $zip_code,
    		'birth_date' => $birthdate,
    		'reward_tier' => $tier,
    		'email' => $email,
    		'password' => SHA1($password),
    		'cc_number' => SHA1($cc_number),
    		'cc_expire' => $cc_expire,
    		'cc_cvv' => $cc_cvv,
    	);
    	$insert = $db->insert ('user', $data);
		if ($insert) {
		    echo 'You have registered successfully! Welcome ' . $first_name;
		}
		else{
		    echo 'Registration Unsuccessful: ' . $db->getLastError();
		}
	}
?>