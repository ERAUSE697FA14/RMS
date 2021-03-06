<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
}
else{
      $loginPath = "login.php";
      header("Location:".$loginPath);
      exit;
}
require_once 'connectvars.php';

$mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";

require_once ($mysqliDbpath);


$db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(isset($_POST['delete'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    if(!empty($_POST['selectedRetailers'])) {
    foreach($_POST['selectedRetailers'] as $value)
{
    
    $post_id = $value;

    $db->where ("retailer_id", $post_id);
    $db->delete("retailer");
    

    }
    $retailerPath = "../MMS/retailer.php";
    header("Location:".$retailerPath);
    
}
}
else if(isset($_POST['edit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    if(!empty($_POST['selectedRetailers'])) {
            $postSelectedRetailers = $_POST['selectedRetailers'];
            session_start();
            $_SESSION['retailersArray'] = $postSelectedRetailers;
            $_SESSION['retailersfrom'] = 'retailersList';
            $editRetailerPath = '../MMS/edit_retailer.php';
            header("Location:".$editRetailerPath);
}
}
else if (isset($_POST['add'])){
   
            $addRetailerPath = '../MMS/new_retailer.php';
            header("Location:".$addRetailerPath);
}
?>


<script> 
    function delcfm() { 
        if (!confirm("Are you sure that you want to permanently delete the selected item(s)?")) { 
            window.event.returnValue = false; 
        } 
    } 
</script>
<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Retailers - List</title>
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
                <li class="section">
			<a href="retailer_function.php"><span class="icon">&#59148;</span> Retailers</a>
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
		<li><a href="admin.php"><span class="icon">&#128273;</span> Administrator</a>
			<ul class="submenu">
                                <li><a href="new_admin.php">New Administrator</a></li>
                                <li><a href="edit_admin.php">Edit Administrator</a></li>
			</ul>
                </li>
	</ul>
</nav>

                 
<section class="content" style='margin-top: 0px;'>
                           	<form method="post" action="retailer.php">
	<section class="widget">
		<header>
			<span class="icon">&#128101;</span>
			<hgroup>
				<h1>Retailers</h1>
				<h2>a list of retailers</h2>
			</hgroup>
                        <aside>
                            <!--<button class="green" name="add">Add</button>-->
                            <button class="blue" name="edit">Edit</button>
                            <button class="red" name="delete" onClick="delcfm()">Delete</button>
                        </aside>
		</header>
		<div class="content">

			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th width="10%">ID</th>
						<th>Name</th>
						<th>Key</th>
					</tr>
				</thead>
					<tbody>
                                            <?php
                                            $mysqliDbpath = $_SERVER{'DOCUMENT_ROOT'} ."/libs/MysqliDb.php";
                                            require_once ($mysqliDbpath);
                                            require_once 'connectvars.php';
                                            $db = new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                                            $retailerList = $db->get("retailer");
                                            $index = $db->count;
                                            for($index = 0;$index < $db->count;$index++){
                                                echo "<tr>";
                                                $id = $retailerList[$index]['retailer_id'];
                                                echo "<td><input type='checkbox' name='selectedRetailers[]' value= $id />" . $retailerList[$index]['retailer_id']. "</td>";
                                                echo "<td>" . $retailerList[$index]['name'] . "</td>";
                                                echo "<td>" . $retailerList[$index]['private_key'] . "</td>";
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