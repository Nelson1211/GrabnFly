<?php
ob_start();
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
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
    require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_POST['destination']) && ctype_alpha($_POST['destination'])){
		$destination = stripslashes($_REQUEST['destination']); // removes backslashes
		$destination = mysqli_real_escape_string($con,$destination); //escapes special characters in a string
		
	//Checking is user existing in the database or not
        $query = "SELECT `flightNumber`,`destination`,`journey_date` FROM `flights` WHERE destination='$destination' AND seats > 0 AND journey_date >= NOW()";
		$result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $result_array = array();
        if($rows>0){
            while($row = $result->fetch_assoc())
            {
                $result_array[] = $row;
            }
        }
        $_SESSION['flight_data'] = $result_array;
        header("Location: dashboard.php");
    }
?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-26">
						Welcome <?php echo $_SESSION['username']; ?>
					</span>
					<span class="login100-form-title p-b-48">
						<img src="american.png" width="200" height="150">
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="destination">
						<span class="focus-input100" data-placeholder="Destination"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="submit">
								Find
							</button>
						</div>
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
