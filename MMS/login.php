<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
      $homePath = "mms.php";
      header("Location:".$homePath);
      exit;
}
else{
    if(isset($_POST['login'])){
        require_once 'session.php';
        require_once 'connectvars.php';

        $mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

        require_once ($mysqliDbpath);

        $post_username = trim($_POST['username']);
        $post_password = trim($_POST['password']);

        $role = "admin";

        $db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        $db->where ("email", $post_username);
        $db->where ("role", $role);

        $users = $db->get ("user");

        if ($db->count > 0)  
        {   
             $db->where ("email", $post_username);
             $db->where ("password", sha1($post_password));
    
             $users = $db->getOne("user",'user_id,first_name,last_name,email');
    
            if ($db->count > 0)  
                {
                $captcha= strtolower($_POST['captcha']);
                $code = $_SESSION['captchacode'];
                if($code == $captcha){
                    $login_ok = true;
                    $homePath = "../MMS/mms.php";
                    $_SESSION['admin_user_id'] = $users['user_id'];
                    $_SESSION['user_firstname'] = $users['first_name'];
                    $_SESSION['user_lastname'] = $users['last_name'];
                    $_SESSION['user_email'] = $users['email'];
                    header("Location:".$homePath);
                    exit;
                }
                else{
                    $login_error = true;
                    $error_login = $_SESSION['error_login'];
                    $error_login++;
                    $_SESSION['error_login']=$error_login;
                    ?>
                    <script>
                        var code = "<?php echo $captcha." + ". $code ?>";
                    alert("ERROR002:The captcha code you entered is incorrect.");
                    </script>
                    <?php 
                }
                } 
                else 
                {
                $login_error = true;
                $error_login = $_SESSION['error_login'];
                $error_login++;
                $_SESSION['error_login']=$error_login;
                ?>
                <script>
                alert("ERROR002:The username/password you entered is incorrect.");
                </script>
                 <?php 
                }
            } else 
            {
            $login_error = true;
                $error_login = $_SESSION['error_login'];
                $error_login++;
                $_SESSION['error_login']=$error_login;
            ?>
                <script>
                alert("ERROR001:The username/password you entered is incorrect.");
                </script>
                <?php
}
                     }
    else{
        $_SESSION['error_login'] =0;
    }
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
		<form method="post" action="login.php">
                            <div id="footer">
                       <?php 
                                               if($_SESSION['error_login'] >= 1){
                                               echo "<p>Error count: ". $_SESSION['error_login']. "</p>";}
                        ?>
                                	</div>
                        <input type="text" name="username" value="Email" AUTOCOMPLETE="off" />
			<input value="Password" name="password" type="password" />
                        <?php 
                        $click_re ="javascript:this.src='./captcha.php?tm='+Math.random();";
                        if($_SESSION['error_login'] >= 3){
                        echo "<input width='50%' value='Captcha Code' name='captcha' type='text'  style='float:left'/>";
                        echo"<img src='./captcha.php' onclick=$click_re width='50%' height = '37px' style='float:right; margin: 0 0 15px 0'/>";

                        }
                        
                        ?>
                        
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