<?php
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
if(isset($_POST['invalid'])){
    
        if(!empty($_POST['selectedCoupon'])) {
            $postSelectedCouponID = $_POST['selectedCoupon'];
            session_start();
            $_SESSION['selectedCouponID'] = $postSelectedCouponID;
            $editCouponPath = '../MMS/edit_coupon.php';
            header("Location:".$editCouponPath);
}
}
if(isset($_POST['renew'])){
    
        if(!empty($_POST['selectedCoupon'])) {
            $postSelectedCouponID = $_POST['selectedCoupon'];
            
$code_pieces = explode("-", $postSelectedCouponID);
$code_pieces[0]=time();
$new_code = implode("-", $code_pieces);

$tableData['reward_coupon_id'] = $new_code;
require_once 'connectvars.php';
$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db ->where("reward_coupon_id", $postSelectedCouponID);
$status = $db->update('transaction',$tableData);

$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db ->where("reward_coupon_id", $new_code);
$couponQuery = $db->get("transaction");
unset($_SESSION['selectedCouponID']);
$findCoupons = $couponQuery;
$showNewCode = true;
}
}
else if($_SESSION['selectedCouponID'] != ""){
    require_once 'connectvars.php';
$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db ->where("reward_coupon_id", $_SESSION['selectedCouponID']);
$couponQuery = $db->get("transaction");
unset($_SESSION['selectedCouponID']);
$findCoupons = $couponQuery;
}
else{
    $showNewCode = false;
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if ($_POST['coupon_id'] == "" && $_POST['user_id'] == "") {
    die('no condition');
}
if ($_POST['coupon_id'] != "") 
{
   $coupon_id = $_POST['coupon_id'];  
   $couponQuery = $db->rawQuery("SELECT DISTINCT reward_coupon_id, user_id,retailer_id,is_redeemed,coupon_gen_dt  FROM transaction WHERE reward_coupon_id = '$coupon_id'");
} else if ($_POST['user_id'] != "") 
{
  $user_id = $_POST['user_id'];   
  $couponQuery = $db->rawQuery("SELECT DISTINCT reward_coupon_id, user_id,retailer_id,is_redeemed,coupon_gen_dt  FROM transaction WHERE user_id = '$user_id' AND reward_coupon_id != 0 ");

}

$findCoupons = $couponQuery;

if($db->count > 0) {
    //print_r($findCoupons);

}
else{
    die("no coupon find");
}
}
?>

<script> 
    function invcfm() { 
        if (!confirm("Are you sure that you want to permanently invalid the selected item?")) { 
            window.event.returnValue = false; 
        } 
    } 
    function renewcfm() { 
        if (!confirm("Are you sure that you want to renew the selected item?")) { 
            window.event.returnValue = false; 
        } 
    } 
</script> 
<script type='text/javascript'>
    
var show = <?php echo $showNewCode;?>;

if(show){
    var myvar = <?php echo json_encode($new_code); ?>;
    alert('New coupon Code:' + myvar);
}
</script>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Rewards - Coupons Management - Search Coupons</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
	<link rel="stylesheet" href="css/ui.css" media="all" />
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


<section class="content" style='margin-top: 0px;'>
                            <form method="post" action="search_coupons.php">
		<section class="widget">
			<header> 
				<span class="icon">&#128269;</span>
				<hgroup>
					<h1>View Coupons</h1>
					<h2>a information panel</h2>
				</hgroup>
                        <aside>
                            <button class="orange" name="renew"onClick ="renewcfm()">Renew</button>
                            <button class="red" name="invalid" onClick="invcfm()">Invalid</button>
			</aside>
			</header>

		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Coupon ID</th>
						<th width="10%">User ID</th>
                                                <th>Retailer ID</th>
                                                <th>Amount</th>
						<th>Redeemed</th>
                                                <th>Issue Time</th>
					</tr>
				</thead>
					<tbody>
                                            <?php
                                            $index = $db->count;
                                            for($index = 0;$index < $db->count;$index++){
                                                $id = $findCoupons[$index]['reward_coupon_id'];
                                                echo "<tr>";
                                                echo "<td><input type='radio' name='selectedCoupon'value= $id />" . $id . "</td>";
                                                echo "<td>" . $findCoupons[$index]['user_id'] . "</td>";
                                                
                                                echo "<td>" . $findCoupons[$index]['retailer_id'] . "</td>";
                                                $id_pieces = explode("-", $id);
                                                echo "<td>" . $id_pieces[2] . "</td>";

                                                if($findCoupons[$index]['is_redeemed'] == '1'){ echo "<td>Yes</td>" ;} else {echo "<td>No</td>" ;}
                                                echo "<td>" . $findCoupons[$index]['coupon_gen_dt'] . "</td>";
                                                echo "</tr>";
                                                }
                                            ?>
					</tbody>
				</table>
		</div>

		</section>
                                                            </form>
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
</body>
</html>