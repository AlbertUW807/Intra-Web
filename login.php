<?php

ob_start();
session_start();
if(isset($_SESSION['login_username'])) header("location:index.php");
include "include/config.php";

//proses login
if(isset($_POST["submit_login"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql_login = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username' AND password = '$password'");
	$approve_login = mysqli_query($conn, "SELECT ApproveLevel FROM login WHERE username = '$username' AND password = '$password'");

	// check for duplicate entries
	if(mysqli_num_rows($sql_login)>0){
		$row_login = mysqli_fetch_array($sql_login);
		$col_login = mysqli_fetch_array($approve_login);
		$_SESSION['login_id'] = $row_login["id"];
		$_SESSION['login_username'] = $row_login["username"];
		$login_level = $col_login["ApproveLevel"];

		if($login_level == "D1"){
			header("location:D1_Files/directoryD1.php");
		} elseif ($login_level == "RG") {
			header("location:RG_Files/dashboardRG.php");
		} elseif ($login_level == "F1") {
			header("location:F1_Files/dashboardF1.php");
		} elseif ($login_level == "H1") {
			header("location:H1_Files/dashboardH1.php");
		} elseif ($login_level == "H2") {
			header("location:H2_Files/dashboardH2.php");
		} elseif ($login_level == "L1") {
			header("location:L1_Files/directoryL1.php");
		} elseif ($login_level == "V1") {
			header("location:V1_Files/directoryV1.php");
		} else {
			header("location:A1_Files/dashboardA1.php?");
		}
	} else {
		header("location:login.php?failed");
	}
}

?>

<!doctype hmtl>
<html lang="en">
	<head>
		<!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    	<!-- Bootstrap CSS -->
    	<link rel="stylesheet" href="css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="css/custom.css">

	</head>
	<body>
		<div class="container-fluid">
			<div class="container">

				<div class="row row2">
					<div class="col-md-4"></div>
					<div class="col-md-4">

						<div class="mx-auto text-center mt-5 mb-2">
						  <img src="images/mutiara_logo.jpg" class="img-fluid">
						</div>

						<form action="" method="post">
						  <div class="form-group form1">
						  	<hr class="my-1">
	            			<hr class="my-1">

	            			<div class="form-row">
							  	<div class="col-md-12">
							  		<?php if(isset($_GET["failed"])) {?>
					                    <div class="alert alert-danger alert-dismissable">
					                        <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
					                        Username atau Password Anda Salah Atau Anda sudah memiliki akun. Silakan hubungi Administrator.
					                    </div>
					                <?php } ?>   
							  	</div>
						      </div>

						    <label for="exampleInputEmail1">Username</label>
						    <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Enter username" name="username">
						    <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">Password</label>
						    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
						  </div>

						  <input type="submit" name="submit_login" value="Login" class="btn btn-primary mb-2">

						  <hr class="my-1">
	            		  <hr class="my-1">	
						</form>

					</div>
					<div class="col-md-4"></div>
				</div>

				<div class="row row3">
					<div class="col-md-12"></div>
				</div>

			</div>
		</div>

		<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="js/jquery-3.3.1.slim.min.js"></script>
	    <script src="js/popper.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	</body>
</html>

<?php

mysqli_close($conn);
ob_end_flush();

?>
