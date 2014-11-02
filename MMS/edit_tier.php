<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
if(isset($_POST['apply'])){
session_start();
$tier_id = $_SESSION['tierpassid'];
unset($_SESSION['tierpassid']);
require_once 'connectvars.php';
$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db->where ("tier_id", $tier_id);
$tier = $db -> getOne("tier");
   if($_POST['multiplier'] !="" ){
            $tableData['multiplier'] = trim($_POST['multiplier']);
    }
   if($_POST['enroll_bonus'] !="" ){
            $tableData['enroll_bonus'] = trim($_POST['enroll_bonus']);
    }
    if($_POST['yearly_fee'] !="" ){
            $tableData['yearly_fee'] = trim($_POST['yearly_fee']);
    }
     $db->where ("tier_id", $tier_id);
        $status = $db->update('tier',$tableData);
        if ($status==true)
        {
            $tierPath = "../MMS/tiers_manage.php";
            header("Location:".$tierPath);
        }
        else{
            die(error);
        }
}
else
{
session_start();
$selectedTier = $_SESSION['selectedTier'];
unset($_SESSION['selectedTier']);
}
?> 

<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Rewards - Tiers Management - Edit Tier</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
        <link rel="stylesheet" href="css/ui.css" media="all" />
	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->

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
                <li class="section">
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

<?php
require_once 'connectvars.php';
$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
             $db->where ("tier_id", $selectedTier.$value);
             $tier = $db->getOne("tier");
    ?>
<section class="content" style='margin-top: 0px;' >
	<section class="widget">
		<header>
			<span class="icon">&#127942;</span>
			<hgroup>
				<h1>Selected Tier</h1>
				<h2>a information panel</h2>
			</hgroup>
		</header>
		<div class="content">
                    <form method="post" action="edit_tier.php">
                                <p>Name: <?php echo $tier['name'];session_start();$_SESSION['tierpassid'] = $tier['tier_id'];?></p>
                                <p>Multiplier:</p><input name="multiplier" type="text"value = "<?php echo $tier['multiplier'];?> "/>
                                <p>Enroll Bonus:</p><input name="enroll_bonus" type="text"value = "<?php echo $tier['enroll_bonus'];?> "/>
                                <p>Yearly Fee:</p><input name="yearly_fee" type="text"value = "<?php echo $tier['yearly_fee'];?> "/>
                                
			<div align="right">
			<button type="add" class="green" name ="apply">Apply</button>
                        </div>
                    </form>
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
<!--<script src="js/cycle.js"></script>-->
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