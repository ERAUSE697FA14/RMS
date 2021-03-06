<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}

if(isset($_POST['add'])){
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);

$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$password=$_POST['password'];

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$activation = md5(uniqid(rand(), true));
        	$data = Array(
        		'first_name' => $first_name,
        		'last_name' => $last_name,
        		'email' => $email,
        		'password' => SHA1($password),
                        'activation' => $activation,
        	);
        	$insert = $db->insert ('user', $data);
                $tableData['role'] = "admin";
                $db->where ("email", $email);
                $status = $db->update('user',$tableData);
                
                if ($insert) {
    		echo 'We got here';
                $message = " To activate your account, please click the link below:\n\n";
                $message .= 'http://rmsystem.org/activate.php?email=' . urlencode($email) . "&key=$activation";
                mail($email, 'Rewards System Registration Confirmation', $message, 'From:'.NOREPLY);
   
                  // Flush the buffered output.
                if($status){
                echo 'You have registered as Admin successfully! Please check your email address to activate your account.';
                }
                else{
                    echo 'You have registered successfully! Permission changing incorrect. Please check your email address to activate your account and contect with system admin.';
                }
    		}
    		else{
    		    echo 'Registration Unsuccessful: ' . $db->getLastError();
    		}
                $adminPath = "../MMS/admin.php";
                header("Location:".$adminPath);
}
?> 

<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Administrator - New Administrator</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
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
                    $id = $_SESSION['user_id'];
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
		<li>
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
		<li class="section"><a href="admin.php"><span class="icon">&#128273;</span> Administrator</a>
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
				<h1>New Administrator</h1>
				<h2>a information panel</h2>
			</hgroup>
		</header>
		<div class="content">
                    <form method="post" action="new_admin.php">
                                <p>First Name:</p><input name="first_name" type="text"/>
                                <p>Last Name:</p><input name="last_name" type="text"/>
                                <p>Email:</p><input name="email" type="text"/>
                                <p>Password:</p><input name="password" type="text"/>
			<div align="right">
			<button name="add" class="green">Add</button> <button type="reset" class="">Reset</button>
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
<script src="js/jquery-1.6.1.min.js"></script>
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
<script type="text/javascript">

</script>
</body>
</html>