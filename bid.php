<?php
ob_start();
require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bid</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php
    $flight = $_SESSION['flight_number'];
    $avgCost = 0;
    $seat = 0;
    $query = "SELECT `avgCost`, `seats` FROM `flights` WHERE flightNumber='$flight'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    $row = $result->fetch_assoc();
    $avgCost = $row['avgCost'];
    $seat = $row['seats'];
    $query = "SELECT MAX(`current_bid`) AS `maxBid` FROM `bids` WHERE flightNumber='$flight'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    $maxBid = 0;
    if($rows>0){
        $row = $result->fetch_assoc();
        if($row['maxBid'] != NULL)
            $maxBid = $row['maxBid'];
    }
    if (isset($_POST['accept'])) {
        $seat = $seat-1;
        $query = "UPDATE `flights` SET seats='$seat'";
        $result = mysqli_query($con,$query) or die(mysql_error());
        header("Location: index.php");
    }
    if (isset($_POST['submit'])) {
        $query = "SELECT * FROM `bids` WHERE username='".$_SESSION['username']."' AND flightNumber='$flight'";
        $result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if(rows==0){
            if((int)$_POST['bid'] > $maxBid){
                $query = "INSERT INTO `bids` VALUES ('".$_SESSION['flight_number']."', '".$_SESSION['username']."', '".$_POST['bid']."', '".$_POST['capacity']."')";
                $result = mysqli_query($con,$query);
            }
        }
        else{
            $query = "UPDATE `bids` SET current_bid='".$_POST['bid']."', capacity='".$_POST['capacity']."'";
            $result = mysqli_query($con,$query);
        }
        header("Location: bid.php");
    }
?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-26">
						Bids
					</span>
					<span class="login100-form-title p-b-48">
						<img src="american.png" width="200" height="150">
					</span>

					<span class="login100-form-title p-b-26">
                        Maximum Bid: $<?php echo $maxBid;?>
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="bid">
						<span class="focus-input100" data-placeholder="Currrent Bid"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="capacity">
						<span class="focus-input100" data-placeholder="Maximum Capacity"></span>
                    </div>

                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="submit">
                                Place Bid
							</button>
						</div>
                    </div>
                    
</br>
                    <?php
					if($avgCost > $maxBid){?>
                    <span class="login100-form-title p-b-26">
						OR
                    </span>
                    
                    <span class="login100-form-title p-b-26">
                        Pay $<?php echo $avgCost;?> and confirm your seat right now
					</span>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="accept">
                                Accept
							</button>
						</div>
                    </div>
					<?php } ?>
                    
                    <div class="text-center p-t-115">
						<a class="txt2" href="index.php">
							Home
						</a>
					</div>

					<div class="text-center p-t-115">
						<a class="txt2" href="logout.php">
							Logout
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>