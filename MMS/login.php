<?php 
require_once 'session.php';
if($_SESSION['user_id'] != ""){
      $homePath = "mms.php";
      header("Location:".$homePath);
      exit;
}
?> 
<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Dashboard - Login</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->
</head>
<body class="login">
	<section>
		<h1><strong>MMS</strong> Dashboard</h1>
		<form method="post" action="verify.php">
                        <input type="text" name="username" value="Email" />
			<input value="Password" name="password" type="password" />
			<button name="login" class="blue">Login</button>
		</form>
		<p><a href="#">Forgot your password?</a></p>
	</section>
        <div id="footer">
                        <p>Copyright &copy; <a href="http://rmsystem.org">Rmsystem 2014</a></p>
	</div>
<script src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
// Page load delay by Curtis Henson - http://curtishenson.com/articles/quick-tip-delay-page-loading-with-jquery/
$(function(){
	$('.login button').click(function(e){ 
		// Get the url of the link 
		var toLoad = $(this).attr('href');  
 
		// Do some stuff 
		$(this).addClass("loading"); 
 
			// Stop doing stuff  
			// Wait 700ms before loading the url 
			setTimeout(function(){window.location = toLoad}, 10000);	  
 
		// Don't let the link do its natural thing 
		e.preventDefault
	});
	
	$('input').each(function() {

       var default_value = this.value;

       $(this).focus(function(){
               if(this.value == default_value) {
                       this.value = '';
               }
       });

       $(this).blur(function(){
               if(this.value == '') {
                       this.value = default_value;
               }
       });

});
});
</script>
</body>
</html>