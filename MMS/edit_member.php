<?php 
require_once 'session.php';
if($_SESSION['user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
$maxindex = 0;
session_start();
if($_SESSION['from'] == 'list'){
$postSelectedMembers = $_SESSION['array'];
$isIndex = true;
$maxindex = count($postSelectedMembers);
unset($_SESSION['array']);
unset($_SESSION['from']);
}
if($_SESSION['from'] == 'search'){
$findMembers = $_SESSION['array'];
$isIndex = false;
$maxindex = $_SESSION['number'];
unset($_SESSION['array']);
unset($_SESSION['from']);
unset($_SESSION['number']);
}

?> 

<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Members - Edit Members</title>
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
	<input type="text" value="search" />
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
            <li><a href="mms.php"><span class="icon">&#128711;</span> <s>Dashboard</s></a></li>
		<li>
			<a href="database.php"><span class="icon">&#128248;</span> <s>Database</s></a>
			<ul class="submenu">
                                <li><a href="redundant_database.php"><s>View Redundant Database</s></a></li>
				<li><a href="backup_restore.php"><s>Backup and Restore</s></a></li>
			</ul>	
		</li>
		<li class="section">
			<a href="member.php"><span class="icon">&#59170;</span> Members</a>
			<ul class="submenu">
				<li><a href="new_member.php">New Member</a></li>
				<li><a href="find_member.php">Edit Members</a></li>
			</ul>
		</li>
                <li>
			<a href="retailer.php"><span class="icon">&#59148;</span> Retailers</a>
			<ul class="submenu">
				<li><a href="new_retailer.php">New Retailer</a></li>
				<li><a href="find_retailer.php">Edit Retailers</a></li>
			</ul>
		</li>
                <li>
			<a href="rewards.php"><span class="icon">&#127942;</span><s> Rewards</s></a>
			<ul class="submenu">
				<li><a href="tiers_manage.php"><s>Tiers Management</s></a></li>
                                <li><a href="coupons_manage.php"><s>Coupons Management</s></a></li>
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
<section class="alert">
	<div class="green">	
                <p><?php   if($isIndex) {echo "Select";} else{echo "Find";}
                            if ($maxindex > 1) {echo " " . $maxindex . " members in the database.";}else {echo $maxindex . " member in the database.";}?></p>
		<span class="close">&#10006;</span>
	</div>
</section>
<?php
require_once 'connectvars.php';
$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if($isIndex){
         $index = 0;
         foreach($postSelectedMembers as $value)
{
             $db->where ("user_id", $value);
             $memberList = $db->getOne("user");
                 

if ($index ==0){
echo "<section class='content'>";}
else{
    echo "<section class='content' style='margin:0 0 0 210px;' >";
}
$index++;
        ?>
	<section class="widget">
		<header>
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>Selected Member</h1>
				<h2>a information panel</h2>
			</hgroup>
			<aside>
				<span>
					<a href="#">&#9881;</a>
					<ul class="settings-dd">
						<li><label>Option a</label><input type="checkbox" /></li>
						<li><label>Option b</label><input type="checkbox" checked="checked" /></li>
						<li><label>Option c</label><input type="checkbox" /></li>
					</ul>
				</span>
			</aside>
		</header>
		<div class="content">
                    <form method="post" action="mod_member.php">
                                <p>ID: <?php echo $memberList['user_id'];session_start();$_SESSION['passid'] = $memberList['user_id'];?></p>
                                <p>First Name:</p><input name="first_name" type="text" value = "<?php echo $memberList['first_name'];?>" />
                                <p>Last Name:</p><input name="last_name" type="text"value = "<?php echo $memberList['last_name'];?> "/>
                                <p>Address:</p><input name="address_line_1" type="text"value = "<?php echo $memberList['address_line_1'];?>" />
                                <p></p><input name="address_line_2" type="text"value = "<?php echo $memberList['address_line_2'];?>" />
                                <p>City:</p><input name="city" type="text"value = "<?php echo $memberList['city'];?> "/>
                                <p>State:</p><input name="state" type="text"value = "<?php echo $memberList['state'];?>" />
                                <p>Zip:</p><input name="zip" type="text"value = "<?php echo $memberList['zip'];?>" />
                                <p>Birthday:</p><input name="birth_date" type="text"value = "<?php echo $memberList['birth_date'];?>" />
                                <p>Tier:</p><input name="reward_tier" type="text"value = "<?php echo $memberList['reward_tier'];?>" />
                                <p>Email:</p><input name="email" type="text"value = "<?php echo $memberList['email'];?>" />
                                <p>Password:</p><input name="password" type="text" />
                                <p>Credit Card:</p><input name="cc_number" type="text" />
                                <p>Expired Date:</p><input name="cc_expire" type="text"/>
                                <p>CVV:</p><input name="cc_cvv" type="text" />
			<div align="right">
			<button type="add" class="green" name ="apply">Apply</button>
                        </div>
                    </form>
                        </div>
		</div>
	</section>
</section>
<?php
             }
} else{
    $memberList = $findMembers;
    for($index = 0;$index < $maxindex;$index++){
        if ($index ==0){
echo "<section class='content'>";}
else{
    echo "<section class='content' style='margin:0 0 0 210px;' >";
}
    ?>
	<section class="widget">
		<header>
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>Selected Member</h1>
				<h2>a information panel</h2>
			</hgroup>
			<aside>
				<span>
					<a href="#">&#9881;</a>
					<ul class="settings-dd">
						<li><label>Option a</label><input type="checkbox" /></li>
						<li><label>Option b</label><input type="checkbox" checked="checked" /></li>
						<li><label>Option c</label><input type="checkbox" /></li>
					</ul>
				</span>
			</aside>
		</header>
		<div class="content">
                    <form method="post" action="mod_member.php">
                                <p>ID: <?php echo $memberList[$index]['user_id'];session_start();$_SESSION['passid'] = $memberList[$index]['user_id'];?></p>
                                <p>First Name:</p><input name="first_name" type="text" value = "<?php echo $memberList[$index]['first_name'];?>" />
                                <p>Last Name:</p><input name="last_name" type="text"value = "<?php echo $memberList[$index]['last_name'];?> "/>
                                <p>Address:</p><input name="address_line_1" type="text"value = "<?php echo $memberList[$index]['address_line_1'];?>" />
                                <p></p><input name="address_line_2" type="text"value = "<?php echo $memberList[$index]['address_line_2'];?>" />
                                <p>City:</p><input name="city" type="text"value = "<?php echo $memberList[$index]['city'];?> "/>
                                <p>State:</p><input name="state" type="text"value = "<?php echo $memberList[$index]['state'];?>" />
                                <p>Zip:</p><input name="zip" type="text"value = "<?php echo $memberList[$index]['zip'];?>" />
                                <p>Birthday:</p><input name="birth_date" type="text"value = "<?php echo $memberList[$index]['birth_date'];?>" />
                                <p>Tier:</p><input name="reward_tier" type="text"value = "<?php echo $memberList[$index]['reward_tier'];?>" />
                                <p>Email:</p><input name="email" type="text"value = "<?php echo $memberList[$index]['email'];?>" />
                                <p>Password:</p><input name="password" type="text" />
                                <p>Credit Card:</p><input name="cc_number" type="text" />
                                <p>Expired Date:</p><input name="cc_expire" type="text"/>
                                <p>CVV:</p><input name="cc_cvv" type="text" />
			<div align="right">
			<button type="add" class="green" name ="apply">Apply</button>
                        </div>
                    </form>
                        </div>
		</div>
	</section>
</section>
   <?php 
}

    }
?>

    
<section class="content">
  <div class="widget-container">
  </div>
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
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
</body>
</html>