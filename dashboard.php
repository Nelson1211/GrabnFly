<?php
ob_start();
require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Options</title>
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Something posted
        foreach($_SESSION['flight_data'] as $row) {
            if (isset($_POST[$row['flightNumber']])) {
                $_SESSION['flight_number'] = $row['flightNumber'];
                header("Location: bid.php");
            } 
        } 
    }
?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-table100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-26">
            Available Options
					</span>
					<span class="login100-form-title p-b-48">
						<img src="american.png" width="200" height="150">
					</span>

					<div class="login100-form p-b-26">
            <?php
              if(count($_SESSION['flight_data']) == 0){
                  ?><p>No flights available<?php
              }
              else{
              ?>
              <table width="700" cellspacing="60">
              <col width="80">
              <col width="130">
              <col width="250">
              <col width="80">
                <thead>
                  <tr>
                    <th>Flight Number</th>
                    <th>Destination</th>
                    <th>Journey Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  foreach($_SESSION['flight_data'] as $row) {
                      ?><tr><?php
                      foreach ($row as $cell) {
                          ?><td><?php echo $cell;?></td><?php
                      }
                      ?><td>
                        <div class="container-login100-form-btn">
                          <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="select-form-btn" name="<?php echo $row['flightNumber']; ?>" type="submit" value="Select">
                              Select
                            </button>
                          </div>
                        </div>
                        </td><?php
                  }
                ?></tr>
                </tbody>
              </table>
              <?php
              }
              ?>
					</div>

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