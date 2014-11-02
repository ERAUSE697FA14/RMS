<?php 
require_once 'session.php';
if($_SESSION['admin_user_id'] != ""){
    
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
//unset($_SESSION['array']);
//unset($_SESSION['from']);
}
if($_SESSION['from'] == 'search'){
$findMembers = $_SESSION['array'];
$isIndex = false;
$maxindex = $_SESSION['number'];
//unset($_SESSION['array']);
//unset($_SESSION['from']);
//unset($_SESSION['number']);
}
?> 

<script type="text/javascript">  
    function openNewWin(url, title)  
    {  
        window.open(url, title, "height=800, width=760, scrollbars=yes, resizable=yes, toolbar=no, menubar=no,  status=no");  
    }  
</script>  

<script>  
    var lastProfile = 1;
    function loadNew()
    {  
        document.getElementById("profile"+lastProfile).style.display= "block";
        lastProfile++;
        $("nav").height($(document).height());
        if(!(lastProfile < <?php echo $maxindex?>)){
            document.getElementById("loadButton").style.display= "none";
            document.getElementById("nomore").style.display= "block";
        }
    }
    function closeSearch(){
                $(".content").delay(300).animate({"marginTop" : 0});
                $("#listInfo").fadeOut(500);
                $("#nav").height($("#nav").height() -  $("#listInfo").height());
    }
</script>  
    
<html lang="">
<head>
	<meta charset="utf-8">
	<title>MMS Members - View Members</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
        <link rel="stylesheet" href="css/ui.css" media="all" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" media="all" />
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
<nav id = "nav">
	<ul>
            <li><a href="mms.php"><span class="icon">&#128711;</span> Dashboard</a></li>
		<li>
			<a href="database.php"><span class="icon">&#128248;</span> Database</a>
			<ul class="submenu">
                                <li><a href="redundant_database.php">View Redundant Database</a></li>
				<li><a href="backup_restore.php">Backup and Restore</a></li>
			</ul>	
		</li>
		<li class="section">
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
		<li><a href="admin.php"><span class="icon">&#128273;</span> Administrator</a>
			<ul class="submenu">
                                <li><a href="new_admin.php">New Administrator</a></li>
                                <li><a href="edit_admin.php">Edit Administrator</a></li>
			</ul>
                </li>
	</ul>
</nav>
<section class="top" id='listInfo'>
	<div class="green">

                <p><?php   if($isIndex) {echo "Select ";} else{echo "Find ";}
                            if ($maxindex > 1) {echo " " . $maxindex . " members in the database.";}elseif ($maxindex == 1) {echo $maxindex . " member in the database.";} else {echo $maxindex . " 0 member in the database.";}?></p>
		<span class="close" id= "listInfoClose" onclick="closeSearch()">&#10006;</span>
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
                 
$profileId = 'profile'.$index;
if ($index ==0){
echo "<section class='content' id ='$profileId'>";}
else{
    echo "<section class='content' id ='$profileId' style='margin-top: 0px; display: none;'>";
}
$index++;
        ?>
	<section class="widget">
		<header>
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>Selected Member # <?php echo $index;?></h1>
				<h2>a information panel</h2>
			</hgroup>
                        
                        <aside>
                        <button type="edit" class="orange" name ="edit" onClick="openNewWin('<?php echo"edit_member.php?memberid=". $memberList['user_id'] ?>', 'MMS Members - Edit Members')">Edit</button>
                        <button class="closeProfile" name ="close">Close</button>
                        </aside>
		</header>
		<div class="content">

                                <p>ID: <?php echo $memberList['user_id'];?></p>
                                <p>First Name:</p><input name="first_name" type="text" value = "<?php echo $memberList['first_name'];?>" disabled >
                                <p>Last Name:</p><input name="last_name" type="text"value = "<?php echo $memberList['last_name'];?> "disabled >
                                <p>Address:</p><input name="address_line_1" type="text"value = "<?php echo $memberList['address_line_1'];?>" disabled >
                                <p></p><input name="address_line_2" type="text"value = "<?php echo $memberList['address_line_2'];?>" disabled >
                                <p>City:</p><input name="city" type="text"value = "<?php echo $memberList['city'];?> " disabled >
                                <p>State:</p><input name="state" type="text"value = "<?php echo $memberList['state']?>"disabled >
                                <p>Zip:</p><input name="zip" type="text"value = "<?php echo $memberList['zip_code'];?>" disabled >
                                <p>Birthday:</p><input name="birth_date" id= "birth_date" type="text"value = "<?php echo $memberList['birth_date'];?>" disabled >
                                <p>Tier:</p><input name="reward_tier" type="text"value = "<?php echo $memberList['reward_tier'];?>" disabled>
                                <p>Email:</p><input name="email" type="text"value = "<?php echo $memberList['email'];?>" disabled >
                                <p>Password (SHA1):</p><input name="password" type="text" value = "<?php echo $memberList['password'];?>"disabled >
                                <p>Credit Card (SHA1):</p><input name="cc_number" type="text" value = "<?php echo $memberList['cc_number'];?>" disabled >
                                <p>Expired Date:</p><input name="cc_expire" type="text" value = "<?php echo $memberList['cc_expire'];?>" disabled >
                                <p>CVV:</p><input name="cc_cvv" type="text"value = "<?php echo $memberList['cc_cvv'];?>" disabled >
                                <p>Billing Address:</p><input name="billing_address_line_1" type="text"value = "<?php echo $memberList['billing_address_line_1'];?>" disabled >
                                <p></p><input name="billing_address_line_2" type="text"value = "<?php echo $memberList['billing_address_line_2'];?>" disabled >
                                <p>City:</p><input name="billing_city" type="text"value = "<?php echo $memberList['billing_city'];?> "disabled >
                                <p>State:</p><input name="billing_state" type="text"value = "<?php echo $memberList['billing_state']?>"disabled >
                                <p>Zip:</p><input name="billing_zip" type="text"value = "<?php echo $memberList['billing_zip'];?>" disabled >
                        </div>
            
	</section>
</section>
<?php
             }
} else{
    $memberList = $findMembers;
    for($index = 0;$index < $maxindex;$index++){
            $profileId = 'profile'.$index;
        if ($index ==0){
echo "<section class='content' id ='$profileId'>";}
else{
    echo "<section class='content' id ='$profileId' style='margin-top: 0px; display: none;' >";
}
    ?>
	<section class="widget">
            <div>
		<header>
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>Selected Member # <?php echo $index+1;?></h1>
				<h2>a information panel</h2>
			</hgroup>
                        <aside>
                        <button type="edit" class="orange" name ="edit" onClick="openNewWin('<?php echo"edit_member.php?memberid=". $memberList[$index]['user_id'] ?>', 'MMS Members - Edit Members')">Edit</button>
                        <button class="closeProfile" name ="close">Close</button>
                        </aside>
		</header>
		<div class="content">
                    <form method="post" action="edit_member.php">
                                <p>ID: <?php echo $memberList[$index]['user_id'];?></p>
                                <p>First Name:</p><input name="first_name" type="text" value = "<?php echo $memberList[$index]['first_name'];?>" disabled >
                                <p>Last Name:</p><input name="last_name" type="text"value = "<?php echo $memberList[$index]['last_name'];?> " disabled >
                                <p>Address:</p><input name="address_line_1" type="text"value = "<?php echo $memberList[$index]['address_line_1'];?>" disabled >
                                <p></p><input name="address_line_2" type="text"value = "<?php echo $memberList[$index]['address_line_2'];?>" disabled >
                                <p>City:</p><input name="city" type="text"value = "<?php echo $memberList[$index]['city'];?> "disabled >
                                <p>State:</p><input name="state" type="text"value = "<?php echo $memberList[$index]['state']?>"disabled >
                                <p>Zip:</p><input name="zip" type="text"value = "<?php echo $memberList[$index]['zip_code'];?>" disabled >
                                <p>Birthday:</p><input  name="birth_date" id= "birth_date" type="text"value = "<?php echo $memberList[$index]['birth_date'];?>" disabled >
                                <p>Tier:</p><input name="reward_tier" type="text"value = "<?php echo $memberList[$index]['reward_tier'];?>" disabled>
                                <p>Email:</p><input name="email" type="text"value = "<?php echo $memberList[$index]['email'];?>" disabled >
                                <p>Password (SHA1):</p><input name="password" type="text" value = "<?php echo $memberList[$index]['password'];?>"disabled >
                                <p>Credit Card (SHA1):</p><input name="cc_number" type="text" value = "<?php echo $memberList[$index]['cc_number'];?>" disabled >
                                <p>Expired Date:</p><input name="cc_expire" type="text" value = "<?php echo $memberList[$index]['cc_expire'];?>" disabled >
                                <p>CVV:</p><input name="cc_cvv" type="text"value = "<?php echo $memberList[$index]['cc_cvv'];?>" disabled >
                                <p>Billing Address:</p><input name="billing_address_line_1" type="text"value = "<?php echo $memberList[$index]['billing_address_line_1'];?>" disabled >
                                <p></p><input name="billing_address_line_2" type="text"value = "<?php echo $memberList[$index]['billing_address_line_2'];?>" disabled >
                                <p>City:</p><input name="billing_city" type="text"value = "<?php echo $memberList[$index]['billing_city'];?> "disabled >
                                <p>State:</p><input name="billing_state" type="text"value = "<?php echo $memberList[$index]['billing_state'];?>" disabled >
                                <p>Zip:</p><input name="billing_zip" type="text"value = "<?php echo $memberList[$index]['billing_zip'];?>" disabled >
                    </form>
                        </div>
		</div>
	</section>
</section>
   <?php 
}

    }
?>
<section class="content" style='margin-top: 0px;'>
    	<div style="text-align:center;">
<?php 
if($maxindex>1){
    echo "<button class='green' id = 'loadButton' name='loadButton' onClick='loadNew()'>Load more results...</button>";
    echo "<p id = 'nomore' name='nomore' style ='display: none'>No more result.</p>";
}
?>
              </div>
</section>
    
<section class="content" style='margin-top: 0px;'>
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
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="js/jquery.tablesorter.min.js"></script>
<script>
        $(".closeProfile").click(function(){
		$(this).parent().parent().parent().parent().fadeOut(500);
		$(".content").delay(300).animate({"marginTop" : 0});
                $("#listInfo").fadeOut(500);
                $("#nav").height($("#nav").height() - $(this).parent().parent().parent().parent().height() - $("#listInfo").height());
	});

</script>
</body>
</html>