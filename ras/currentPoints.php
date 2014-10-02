<?php
//session_start();    
  require_once 'sessionVerification.php';

  if ($_SESSION['user_id'] == "")      //if there is nothing in session i.e logout then direct to login page
  {
      header("Location:login.php");
      exit;
  }
?> 

<html>
    <head>
        <meta charset="UTF-8">
  
        <link rel="stylesheet" type="text/css" href="../css/ras.css" />

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
                    <li  class="selectedTab"><a href="currentPoints.php">View Current Points</a></li>
                    <li><a href="profileView.php">View Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div class="mainContent">

            </div>

            <div class="footer" align="center">
                
            </div>

        </div>


    </body>
</html>
