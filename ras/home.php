<?php
   
require_once 'sessionVerification.php';


if ($_SESSION['user_id'] == "") 
{      //if there is nothing in session i.e logout then direct to login page
    header("Location:https://www.rmsystem.org/index.php");
    exit;
}

$firsName = "";
$lastName = "";
$current_points = 0;
$ready_points = 0;
$barcodeData = "";
$email = "";

$db = new MysqliDb('www.rmsystem.org', 'se697', 'LZR8AzJ5E9dbRGdq', 'rmsystem');

$db->where ("user_id", $_SESSION['user_id']); //->where ("reward_points", 5000,">=");

$userInfo = $db->getOne("user",'first_name,last_name,reward_points,email,ready_reward_points');

if ($db->count > 0) 
{    
    $firstName = $userInfo["first_name"];
    $lastName = $userInfo["last_name"];
    $current_points = round($userInfo["reward_points"]); // Apply rounding
    $ready_points= round($userInfo["ready_reward_points"]); // Apply Rounding
    $email = $userInfo['email'];
}

$barcodeData = time()."-".$_SESSION['user_id']."-".$current_points;

?>

<html>
<head>
    <meta charset="UTF-8">
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        /* resize reward logo*/
        .col-md-12 img {
            width: 200px !important;
            height: 200px !important;
        }

        .container {
            width: 500px !important;
        }
        
        /*.navbar-default {
background-color: #0D18E5;
border-color: #e7e7e7;
}*/
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function ()
        {
            // on page load, set iframe content for printing purpose
            var content = document.getElementById("printCoupon");
            var printWindow = document.getElementById("ifmcontentstoprint").contentWindow;
            printWindow.document.open();
            printWindow.document.write(content.innerHTML);
            printWindow.document.close();


        });

        function processCoupon()
        {
            var barcode = "<?php echo $barcodeData;?>";

            // Ajax call
            $.ajax({
                type: 'POST',
                url: "serviceProvider.php?method=processCoupon",
                data: { coupon_barcode: barcode },
                success: function (data)
                {
                    var data = JSON.parse(data);

                    if (data.success == true) {
                        // Refresh the webpage
                        location.reload();
                    }
                    else
                    {
                        // error occured while emailing coupon
                        alert("Failed to process coupon, Error - " + data.message);
                    }
                }
            });
        }

        function emailCoupon()
        {
            var confirmation = confirm("Do you want to email reward coupon ?");

            if (confirmation == true)
            {
                var sendData = {
                    coupon_barcode: "<?php echo $barcodeData;?>",
                    coupon_points: "<?php echo $current_points;?>",
                    email: "<?php echo $email;?>",
                };

                // Ajax call to sent email
                $.ajax({
                    type: 'POST',
                    url: "serviceProvider.php?method=emailCoupon",
                    data: sendData,
                    success: function (data) 
                    {
                        var data = JSON.parse(data);
      
                        if (data.success == true)
                        {
                            alert("Coupon has been sent successfully to your email address.");
                            processCoupon();
                        }
                        else
                        {
                            // error occured while emailing coupon
                            alert("Failed to email coupon - "+data.message);
                        }
                    }
                });

            }
        }

        function printCoupon() 
        {
            // Process coupon
            processCoupon();

            // Print the iframe window content
            var printWindow = document.getElementById("ifmcontentstoprint").contentWindow;
            printWindow.focus();
            printWindow.print();
        }

    </script>

    <title>RAS Home</title>
</head>
<body>

    <div class="header">
        <h1>Welcome to RMS</h1>
    </div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php">Home</a></li>
                    <li><a href="viewTransactions.php">View Transactions</a></li>
                    <li><a href="profileUpdate.php">Update Profile</a></li>
                      <li><a href="reprintCoupons.php">Reprint Coupons</a></li>
                    <li><a href="profileView.php">View Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

            <div id="printCoupon">
                <div class="row">
                    <div class="form-group">
                    <?php if ($current_points<5000) {?>
                    
                         <div class="content-heading">
                            <h5>Reward coupon will be ready after 5000 points</h5>
                        </div>
                        
                    <?php }?>
                        <div class="content-heading">
                            <h4>SE 697's Reward Coupon: Available Points = <?php echo $current_points;?></h4>
                        </div>
                    </div>

                     <?php if ($current_points>=5000) {?>
                    <div class="form-group" style="clear: both;">
                        <div class="col-lg-5 col-md-push-1">
                            <div class="col-md-12">

                                <div>
                                    <img src="https://www.rmsystem.org/img/rewards.jpg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <IMG SRC="https://www.rmsystem.org/ras/barcode.php?barcode=<?php echo $barcodeData;?>&width=450&height=75"/>
                    </div>
                            <?php }?>
                </div>
            </div>


            <?php if ($current_points>=5000) 
            {
            ?>
            <div class="form-group" style="clear: both;">
                <div style="width: 42.5%; float: left;" class="input-group">
                    <input  value="Email Coupon" style="clear: both;" class="btn btn-primary btn-block" onclick="emailCoupon();">
                </div>
                <div style="width: 42%; float: right; margin-left: 1%;" class="input-group">
                    <input value="Print Coupon" style="clear: both;" class="btn btn-primary btn-block" onclick="printCoupon()" />
                </div>
            </div>
             <?php }?>

    </div>

    <iframe id="ifmcontentstoprint" style="position: absolute" hidden></iframe>

    <footer style="margin: 10px 0 10px 0; text-align: center; background-color: #dff0d8;">
        Copyright &copy; <a href="http://www.rmsystem.org">Rmsystem 2014</a>
    </footer>

</body>
</html>
