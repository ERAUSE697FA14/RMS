<?php
//session_start();    
require_once 'sessionVerification.php';

$update_error = "";

if ($_SESSION['user_id'] == "") 
{      //if there is nothing in session i.e logout then direct to login page
    header("Location:login.php");
    exit;
}

if (isSet($_POST['submit'])) 
{
    $user_id = $_SESSION['user_id'];
    
    // Get Post form data
    $tableData['first_name'] = trim($_POST['first_name']);
    $tableData['last_name'] = trim($_POST['last_name']);
    $tableData['address_line_1'] = trim($_POST['address_line_1']);
    $tableData['address_line_2'] = trim($_POST['address_line_2']);
    $tableData['city'] = trim($_POST['city']);
    $tableData['state'] = trim($_POST['state']);
    $tableData['zip_code'] = trim($_POST['zip_code']);
    $tableData['email'] = trim($_POST['email']);
    $tableData['birth_date'] = trim($_POST['dob']);
    
    
    //database connectivity
    $db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');
    
    // Check that requested email address is already exist in the table for another user
    $db->where ("user_id", $user_id,'<>')->where('email', $tableData['email']);;
    
    $userInfo = $db->getOne("user",'email');

    if ($db->count > 0) 
    {
        // error- another user having same email
        die('email id exist!');
    }
    else
    {
        $db->where ("user_id", $user_id);
        
        // everything is good, lets update the profile
        
        $status = $db->update('user',$tableData);

        if ($status==true)
        {
            header("Location:profileUpdate.php");
        }
    }
}

?> 

<html>
    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="../css/ras.css" />
        <link rel="stylesheet" type="text/css" href="../css/profileView.css"/>
           <!-- jQuery UI Theme for Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       
         <script src="../js/profileUpdateSubmit.js"></script>         

                         <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
                <!-- For the birthdate field datepicker -->
                <script>
                    $(function () {
                        $("#InputBirthdateFirst").datepicker({ changeMonth:true,changeYear: true, yearRange: "1901:2012" });
                    });
                </script>

        <title>RAS Home</title>
    </head>
    <body>

        <div id="wrap">

            <div class="header">
                <h1>welcome to RMS</h1>
            </div>

            <div id="menu">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="viewTransactions.php">View Transactions</a></li>
                    <li class="selectedTab"><a href="profileUpdate.php">Update Profile</a></li>
                    <li><a href="currentPoints.php">View Current Points</a></li>
                    <li><a href="profileView.php">View Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div class="mainContent">

                <?php
                    //Variable initialization
                
                    $firstName = "N/A";
                    $lastName = "N/A";
                    $email = "N/A";
                    $dob="N/A";
                    $addressline1="N/A";
                    $addressline2="N/A";
                    $city="N/A";
                    $state="N/A";
                    $zip="N/A";
                    $password = "default";     
                    
     
                    // fetch data from database
          
                    $db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');
    
                    $db->where ("user_id", $_SESSION['user_id']);
                    
                    $userInfo = $db->getOne("user",'password,first_name,last_name,email,birth_date,address_line_1,address_line_2, city,state, zip_code');

                    if ($db->count > 0) 
                    {    
                        $firstName = $userInfo["first_name"];
                        $lastName = $userInfo["last_name"];
                        $email = $userInfo["email"];
                        $dob = $userInfo["birth_date"];
                        $addressline1=$userInfo["address_line_1"];
                        $addressline2=$userInfo["address_line_2"];
                        $city=$userInfo["city"];
                        $state=$userInfo["state"];
                        $zip=$userInfo["zip_code"];
                        $password=$userInfo["password"];
                    }
                ?>
                
                <form role="form" method="post">

                <!---Account info-->
                <div class="section-container">
                    <div class="section-title">
                        <span>Account Info</span>
                    </div>

                    <div class="section-contents" data-bind="with:userData">


                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">First Name</span>
                                <div class="input">
                                    <input type="text" class="texbox" name="first_name" id="FirstName" value="<?php echo $firstName?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Last Name</span>
                                <div class="input">
                                    <input type="text" class="texbox" name="last_name" id="InputLastName" value="<?php echo $lastName?>" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Home Address</span>
                                <div class="input">
                                     <input type="text" class="texbox" name="address_line_1" id="InputAddress" value="<?php echo $addressline1;?>" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                   <input type="text" class="texbox" name="address_line_2" id="InputAddress2" value="<?php echo $addressline2?>" />

                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                    <input type="text" class="texbox" name="city" id="InputCity" value="<?php echo $city?>"/>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                   <!--<input type="text" class="texbox" name="state" id="InputState" value="<?php echo $state?>"/>-->

                              <select id="InputState" name="state">
                                <option value="AL" <?php if (!empty($state) && $state == 'AL')  echo 'selected = "selected"'; ?>>Alabama</option>
								<option value="AK" <?php if (!empty($state) && $state == 'AK')  echo 'selected = "selected"'; ?>>Alaska</option>
								<option value="AZ" <?php if (!empty($state) && $state == 'AZ')  echo 'selected = "selected"'; ?>>Arizona</option>
								<option value="AR" <?php if (!empty($state) && $state == 'AR')  echo 'selected = "selected"'; ?>>Arkansas</option>
								<option value="CA" <?php if (!empty($state) && $state == 'CA')  echo 'selected = "selected"'; ?>>California</option>
								<option value="CO" <?php if (!empty($state) && $state == 'CO')  echo 'selected = "selected"'; ?>>Colorado</option>
								<option value="CT" <?php if (!empty($state) && $state == 'CT')  echo 'selected = "selected"'; ?>>Connecticut</option>
								<option value="DE" <?php if (!empty($state) && $state == 'CE')  echo 'selected = "selected"'; ?>>Delaware</option>
								<option value="DC" <?php if (!empty($state) && $state == 'DC')  echo 'selected = "selected"'; ?>>District Of Columbia</option>
								<option value="FL" <?php if (!empty($state) && $state == 'FL')  echo 'selected = "selected"'; ?>>Florida</option>
								<option value="GA" <?php if (!empty($state) && $state == 'GA')  echo 'selected = "selected"'; ?>>Georgia</option>
								<option value="HI" <?php if (!empty($state) && $state == 'HI')  echo 'selected = "selected"'; ?>>Hawaii</option>
								<option value="ID" <?php if (!empty($state) && $state == 'ID')  echo 'selected = "selected"'; ?>>Idaho</option>
								<option value="IL" <?php if (!empty($state) && $state == 'IL')  echo 'selected = "selected"'; ?>>Illinois</option>
								<option value="IN" <?php if (!empty($state) && $state == 'IN')  echo 'selected = "selected"'; ?>>Indiana</option>
								<option value="IA" <?php if (!empty($state) && $state == 'IA')  echo 'selected = "selected"'; ?>>Iowa</option>
								<option value="KS" <?php if (!empty($state) && $state == 'KS')  echo 'selected = "selected"'; ?>>Kansas</option>
								<option value="KY" <?php if (!empty($state) && $state == 'KY')  echo 'selected = "selected"'; ?>>Kentucky</option>
								<option value="LA" <?php if (!empty($state) && $state == 'LA')  echo 'selected = "selected"'; ?>>Louisiana</option>
								<option value="ME" <?php if (!empty($state) && $state == 'ME')  echo 'selected = "selected"'; ?>>Maine</option>
								<option value="MD" <?php if (!empty($state) && $state == 'MD')  echo 'selected = "selected"'; ?>>Maryland</option>
								<option value="MA" <?php if (!empty($state) && $state == 'MA')  echo 'selected = "selected"'; ?>>Massachusetts</option>
								<option value="MI" <?php if (!empty($state) && $state == 'MI')  echo 'selected = "selected"'; ?>>Michigan</option>
								<option value="MN" <?php if (!empty($state) && $state == 'MN')  echo 'selected = "selected"'; ?>>Minnesota</option>
								<option value="MS" <?php if (!empty($state) && $state == 'MS')  echo 'selected = "selected"'; ?>>Mississippi</option>
								<option value="MO" <?php if (!empty($state) && $state == 'MO')  echo 'selected = "selected"'; ?>>Missouri</option>
								<option value="MT" <?php if (!empty($state) && $state == 'MT')  echo 'selected = "selected"'; ?>>Montana</option>
								<option value="NE" <?php if (!empty($state) && $state == 'NE')  echo 'selected = "selected"'; ?>>Nebraska</option>
								<option value="NV" <?php if (!empty($state) && $state == 'NV')  echo 'selected = "selected"'; ?>>Nevada</option>
								<option value="NH" <?php if (!empty($state) && $state == 'NH')  echo 'selected = "selected"'; ?>>New Hampshire</option>
								<option value="NJ" <?php if (!empty($state) && $state == 'NJ')  echo 'selected = "selected"'; ?>>New Jersey</option>
								<option value="NM" <?php if (!empty($state) && $state == 'NM')  echo 'selected = "selected"'; ?>>New Mexico</option>
								<option value="NY" <?php if (!empty($state) && $state == 'NY')  echo 'selected = "selected"'; ?>>New York</option>
								<option value="NC" <?php if (!empty($state) && $state == 'NC')  echo 'selected = "selected"'; ?>>North Carolina</option>
								<option value="ND" <?php if (!empty($state) && $state == 'ND')  echo 'selected = "selected"'; ?>>North Dakota</option>
								<option value="OH" <?php if (!empty($state) && $state == 'OH')  echo 'selected = "selected"'; ?>>Ohio</option>
								<option value="OK" <?php if (!empty($state) && $state == 'OK')  echo 'selected = "selected"'; ?>>Oklahoma</option>
								<option value="OR" <?php if (!empty($state) && $state == 'OR')  echo 'selected = "selected"'; ?>>Oregon</option>
								<option value="PA" <?php if (!empty($state) && $state == 'PA')  echo 'selected = "selected"'; ?>>Pennsylvania</option>
								<option value="RI" <?php if (!empty($state) && $state == 'RI')  echo 'selected = "selected"'; ?>>Rhode Island</option>
								<option value="SC" <?php if (!empty($state) && $state == 'SC')  echo 'selected = "selected"'; ?>>South Carolina</option>
								<option value="SD" <?php if (!empty($state) && $state == 'SD')  echo 'selected = "selected"'; ?>>South Dakota</option>
								<option value="TN" <?php if (!empty($state) && $state == 'TN')  echo 'selected = "selected"'; ?>>Tennessee</option>
								<option value="TX" <?php if (!empty($state) && $state == 'TX')  echo 'selected = "selected"'; ?>>Texas</option>
								<option value="UT" <?php if (!empty($state) && $state == 'UT')  echo 'selected = "selected"'; ?>>Utah</option>
								<option value="VT" <?php if (!empty($state) && $state == 'VT')  echo 'selected = "selected"'; ?>>Vermont</option>
								<option value="VA" <?php if (!empty($state) && $state == 'VA')  echo 'selected = "selected"'; ?>>Virginia</option>
								<option value="WA" <?php if (!empty($state) && $state == 'WA')  echo 'selected = "selected"'; ?>>Washington</option>
								<option value="WV" <?php if (!empty($state) && $state == 'WV')  echo 'selected = "selected"'; ?>>West Virginia</option>
								<option value="WI" <?php if (!empty($state) && $state == 'WI')  echo 'selected = "selected"'; ?>>Wisconsin</option>
								<option value="WY" <?php if (!empty($state) && $state == 'WY')  echo 'selected = "selected"'; ?>>Wyoming</option> 
                            </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                    <input type="text" class="texbox" name="zip_code" id="InputZip" value="<?php echo $zip?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Date Of Birth</span>
                                <div class="input">
                                  <input type="text" id="InputBirthdateFirst" name="dob" value="<?php echo $dob?>" placeholder="Enter Birthdate" required>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!---Sign in info-->

                <div class="section-container">
                    <div class="section-title">
                        <span>Sign In Info</span>
                    </div>

                    <div class="section-contents">

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Email Address</span>
                                <div class="input">
                                    <input type="text" class="texbox" name="email" id="InputEmailFirst" value="<?php echo $email?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Change Password</span>
                                <div class="input">
                                  <a href="../changePassword.php?rmsysuser=<?php echo $_SESSION['user_id'];?>&reset=<?php echo $password;?>&profileUpdateCall=1">Click here</a>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                    <input type="submit" name="submit" value="Submit"  onclick="return formvalidation();">

                    </form>
            </div>

      

            <div class="footer" align="center">

            </div>

        </div>


    </body>
</html>
