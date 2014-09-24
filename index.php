
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Customer Rewards Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">RMS</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div style="margin-top: 50px;" class="container">

      <div class="starter-template">
        <h1>Customer Rewards Management System</h1>
        <p class="lead">Welcome to RMSystem.org. This website was created for a masters level software engineering capstone course at Embry-Riddle Aeronautical University.<br />
        	The RMS allows a customer to register an account and begin earning virtual reward points (arbitrarily given by the admins).</p>
      </div>

      <?php
      /*
        Simple Example querying the database for all records in the "user" table and printing the 
        user_id, first_name, and email. You can see all available functions and how to use them
        here: https://github.com/joshcam/PHP-MySQLi-Database-Class
      */
      require_once ('libs/MysqliDb.php');                                            //include the CRUD library
      $db = new MysqliDb ('rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');  //connect to the database

      $cols = Array ("user_id", "first_name", "email"); //the columns you want to return from the "user" table
      $users = $db->get ("user", null, $cols);          //pulls the columns from the "user" table
      if ($db->count > 0)                               //if records were found...
          foreach ($users as $user) {                   //cycle through each record...
                                                        //print the data
              echo "Hello ".$user[first_name].", your user_id is ".$user[user_id]." and your email address is ".$user[email]."<br />";  
          }
      ?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
