<?php
//session_start();    
require_once 'sessionVerification.php';

if ($_SESSION['user_id'] == "") {      //if there is nothing in session i.e logout then direct to login page
    header("Location:login.php");
    exit;
}
?> 

<html>
    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="../css/ras.css" />
        <link rel="stylesheet" type="text/css" href="../css/profileView.css"/>
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
                    <li><a href="profileUpdate.php">Update Profile</a></li>
                    <li><a href="currentPoints.php">View Current Points</a></li>
                    <li class="selectedTab"><a href="profileView.php">View Profile</a></li>
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
                            
                    
     
                    // fetch data from database
          
                    $db = new MysqliDb('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');
    
                    $db->where ("user_id", $_SESSION['user_id']);
                    
                    $userInfo = $db->getOne("user",'first_name,last_name,email,birth_date,address_line_1,address_line_2, city,state, zip_code');

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
                    }
                ?>

                <!---Account info-->
                <div class="section-container">
                    <div class="section-title">
                        <span>Account Info</span>
                    </div>

                    <div class="section-contents">


                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">First Name</span>
                                <div class="input">
                                    <span><?php echo $firstName?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Last Name</span>
                                <div class="input">

                                    <span><?php echo $lastName?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Home Address</span>
                                <div class="input">
                                    <span><?php echo $addressline1?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                    <span><?php echo $addressline2?></span>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                    <span><?php echo $city?></span>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                    <span><?php echo $state?></span>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label"></span>
                                <div class="input">
                                    <span><?php echo $zip?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Date Of Birth</span>
                                <div class="input">
                                    <span><?php echo $dob?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!---Account info-->
                <div class="section-container">
                    <div class="section-title">
                        <span>Sign In Info</span>
                    </div>

                    <div class="section-contents">




                        <div class="row">
                            <div class="col singleCol form">
                                <span class="label">Email Address</span>
                                <div class="input">
                                    <span><?php echo $email?></span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>



            </div>

            <div class="footer" align="center">

            </div>

        </div>


    </body>
</html>
