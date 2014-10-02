<?php
	require_once ('libs/MysqliDb.php');                                            //include the CRUD library
    $db = new MysqliDb ('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');  //connect to the database
	
	if (isset($_GET['email'])) {
	 $email = $_GET['email'];
	}
	if (isset($_GET['key']) && (strlen($_GET['key']) == 32))
	 //The Activation key will always be 32 since it is MD5 Hash
	{
	 $key = $_GET['key'];
	}

	if (isset($email) && isset($key)) {

		// Update the database to set the "activation" field to null
		$data = Array (
			'email' => urldecode($email),
			'activation' => '',
		);

		$db->where ('email', urldecode($email));
		$db->where ('activation', $key);
		$db->update ('user', $data);
		//if update query was successfull
		if ($db->count > 0)
		 {
		 echo '<div>Thank you for verifying your email. Your account is now active. You may now <a href="index.php">Log in</a></div>';

		 } else {
		 echo '<div>Your account could not be activated. Please recheck the link or contact the system administrator.</div>';
		 }

	} else {
	 echo '<div>Error Occured .</div>';
	}
?>