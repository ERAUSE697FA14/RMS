<?php
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
if(isset($_POST['delete'])){
    
        if(!empty($_POST['selectedTransaction'])) {
            $postSelectedTransactionID = $_POST['selectedTransaction'];

    $db->where ("transaction_id", $postSelectedTransactionID);
    $db->delete("transaction");

    }
    $coupons_managePath = "../MMS/coupons_manage.php";
    header("Location:".$coupons_managePath);
    
}
            
else{
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);
$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if ($_POST['transaction_id'] == "" && $_POST['user_id'] == "") {
    die('no condition');
}
if ($_POST['transaction_id'] != "") 
{
 $db ->where("transaction_id", $_POST['transaction_id']);
 $transactionQuery = $db->get("transaction");
} else if ($_POST['user_id'] != "") 
{
  $db ->where("user_id", $_POST['user_id']);
  $transactionQuery = $db->get("transaction");
}

$findTransactions = $transactionQuery;

if($db->count > 0) {

}
else{
    die("no transaction find");
}
}
?>


<script> 
    function delcfm() { 
        if (!confirm("Are you sure that you want to permanently delete the selected item?")) { 
            window.event.returnValue = false; 
        } 
    } 
</script>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Rewards - Coupons Management - Search Transactions</title>
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
                            <form method="post" action="search_transactions.php">
		<section class="widget">
			<header> 
				<span class="icon">&#128269;</span>
				<hgroup>
					<h1>View Coupons</h1>
					<h2>a information panel</h2>
				</hgroup>
                        <aside>
                                    <button class="red" name="delete" onClick="delcfm()">Delete</button>
			</aside>
			</header>

		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Transaction ID</th>
						<th width="10%">User ID</th>
                                                <th>Retailer ID</th>
                                                <th>Amount</th>
						<th>Coupon</th>
                                                <th>Redeemed</th>
                                                <th>Issue Time</th>
					</tr>
				</thead>
					<tbody>
                                            <?php
                                            $index = $db->count;
                                            for($index = 0;$index < $db->count;$index++){
                                                $id = $findTransactions[$index]['transaction_id'];
                                                echo "<tr>";
                                                echo "<td><input type='radio' name='selectedTransaction'value= $id />" . $id . "</td>";
                                                echo "<td>" . $findTransactions[$index]['user_id'] . "</td>";
                                                
                                                echo "<td>" . $findTransactions[$index]['retailer_id'] . "</td>";
                                                $id_pieces = explode("-", $id);
                                                echo "<td>" . $id_pieces[2] . "</td>";

                                                if($findTransactions[$index]['reward_coupon_id'] == '0'){ echo "<td>No</td>" ;} else {echo "<td>Yes</td>" ;}
                                                if($findTransactions[$index]['is_redeemed'] == '1'){ echo "<td>Yes</td>" ;} else {echo "<td>No</td>" ;}
                                                echo "<td>" . $findTransactions[$index]['coupon_gen_dt'] . "</td>";
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