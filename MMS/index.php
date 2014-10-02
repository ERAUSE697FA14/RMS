<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>MMS Login</title>

	<!--- CSS --->
	<link rel="stylesheet" href="../css/MMSLoginstyle.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../js/selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="../css/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form name="login" method="post" action="verify.php">
				<div class="login">LOGIN</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" name="username" value="admin" />
				</div>
				<div class="password-field">
					<input type="password" name="password" value="admin" />
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Remember me</label>
				<div class="forgot-usr-pwd">Forgot <a href="#">username</a> or <a href="#">password</a>?</div>
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
		<div id="footer">
                        Copyright &copy; <a href="http://rmsystem.org">Rmsystem 2014</a>
		</div>
                <?php
                // put your code here
                ?>
	</body>
</html>
