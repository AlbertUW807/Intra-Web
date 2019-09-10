<?php

ob_start();
session_start();
if(isset($_SESSION['login_username'])) header("location:login.php");
include "include/config.php";

//proses login
if(isset($_POST["newSubmit"])){
	$newUsername = $_POST["newUsername"];
	$newPassword = md5($_POST["newPassword"]);
	$newEmail = $_POST["newEmail"];
	$sql_newLogin = mysqli_query($conn, "SELECT * FROM login WHERE username = '$newUsername' AND password = '$newPassword' 
		AND email = '$newEmail'");
	if(mysqli_num_rows($sql_newLogin)>0){
		header("location:sign_up.php?failed");
	} else {
		// input data sql
		mysqli_query($conn, "INSERT INTO login VALUES('','$newUsername','$newPassword','$newEmail','','','')");
		header("location:login.php");
	}
}

// proses cancel
if(isset($_POST["cancel"])) header("location:login.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Forum Input Data</title>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class="container_fluid">
		<div class="container">
			<!-- Row 1 of sign_up.php-->
			<div class="row">
				<div class = "col-md-2 bg-light">
		            <img src="images/mutiara_logo.jpg" class = "img-fluid rounded mx-auto d-block">
		          </div>

		          <div class = "col-md-10 bg-light set TRO">
		            <!-- Class 'set'-->
		            <hr class="my-1">
		            <hr class="my-1">
		            <nav class="navbar navbar-expand-lg navbar-light">
		              <a class="navbar-brand" href="#">PT. Mutiara Multi Finance</a>
		              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		                <span class="navbar-toggler-icon"></span>
		              </button>
		              <div class="collapse navbar-collapse" id="navbarNavDropdown">
		                <ul class="navbar-nav mr-auto">
		                  <li class="nav-item">
		                    <a class="nav-link" href="forum.html">Insert Voucher</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="directory.html">Directory</a>
		                  </li>
		                </ul>
	            
		                <form class="form-inline my-2 my-lg-0">
		                	<a class="btn btn-outline-success my-2 my-sm-0" href="logout.php" role="submit">Log Out</a>
		                </form>
		                
		              </div>
		            </nav>
		            <hr class="my-1">
		            <hr class="my-1">
		          </div>
		      </div>

		      <!-- Row 2 of forum.html-->
		      <div class="row ROW2">
		      	<!-- Action for saving form inputs to 'permata_finance-insert_voucher db' of forum.html-->
		      	<!--bisa pake enctype="multipart/form-data" untuk setor gambar di database-->

		      	<div class="col-md-2"></div>
		      	<div class="col-md-8">
			      	<form action="" method="POST">

			      	  <div class="form-row">
			      	  	<div class="col-md-5"></div>
					  	<div class="col-md-7">
					  		<?php if(isset($_GET["failed"])) {?>
			                    <div class="alert alert-danger alert-dismissable">
			                        <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
			                        Username atau Password Anda Salah Atau Anda sudah memiliki akun. Silakan hubungi Administrator.
			                    </div>
			                <?php } ?>   
					  	</div>
				      </div>

					  <div class="form-row FRow3">
					  	<div class="col-md-12 my-1">
					  		<label for="disabledTextInput">New Username</label>
				        	<input type="text" id="validationDefault05" class="form-control" placeholder="New Username..." name="newUsername" required="true">
				        	<small id="emailHelp" class="form-text text-muted">Enter in your new username!</small>
					  	</div>
				      </div>

				      <div class="form-row FRow4">
				      	<div class="col-md-12 my-1">
				      		<label for="disabledTextInput">New Password</label>
				        	<input type="text" id="validationDefault06" class="form-control" placeholder="New Password..." name="newPassword" required="true">
				        	<small id="emailHelp" class="form-text text-muted">Enter in your new password!</small>
				      	</div>
				      </div>

				      <div class="form-row FRow5">
				      	<div class="col-md-12 my-1">
				      		<label for="disabledTextInput">Email Address</label>
				        	<input type="email" id="validationDefault06" class="form-control" placeholder="Email Address..." name="newEmail" required="true">
				        	<small id="emailHelp" class="form-text text-muted">Enter in your email address!</small>
				      	</div>
				      </div>

				      <div class="row FRow6 my-2 ml-1">
				      	<input type="submit" name="newSubmit" value="Create your new account!" class="btn btn-primary">
				      	<a class="btn btn-primary mx-2" href="login.php" role="button">Cancel</a>
				      </div>
					  
					</form>
				</div>
		      	<div class="col-md-2"></div>
		      </div>

	    </div>
	</div>

	<!-- Footer of sign_up.php-->
	<div class="container">
        <div class="row">
          <div class="col-md-12 bg-light text-center COND">
            <hr class="my-1">
            <hr class="my-1">
            <p class="pp my-2">Copyright &copy; PT. Mutiara Multi Finance</p>
            <hr class="my-1">
            <hr class="my-1">
          </div>
        </div>
    </div>

</body>
</html>

<?php

mysqli_close($conn);
ob_end_flush();

?>