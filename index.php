<?php

ob_start();
session_start();
if(!isset($_SESSION['login_id'])) header("location:login.php");
include "include/config.php";

$string_id = $_SESSION['login_id'];
$cabang = mysqli_query($conn, "SELECT Nama_Cabang FROM login WHERE id = '$string_id'");
$nama_cabang = mysqli_fetch_array($cabang);

$user_id = mysqli_query($conn, "SELECT * FROM login WHERE id = '$string_id'");
$id_array = mysqli_fetch_array($user_id);
$user = $id_array["username"];
$approval_position = $id_array["ApproveLevel"];
$cabang_name = $id_array["Nama_Cabang"];

// Proses Input data form ke database
if(isset($_POST["Submit"])) { // 'submit' is name of input type = "submit" button
	// based on designated names of input types
	$currencys = $_POST["currency"];
	$tanggals = date("Y-m-d");
	$last_edited = date("Y-m-d");
	$daris = $_POST["dari"];
	$nomorVouchers = $_POST["nomorVoucher"];
	$deskripsis = $_POST["deskripsi"];
	$jumlahs = $_POST["jumlah"];

	$file_name = $_FILES["file"]["name"];
	$tmp_name = $_FILES["file"]["tmp_name"];
	move_uploaded_file($tmp_name, "../images/".$file_name);

	$nama_cabang = $_POST["nama_cabang"];

	// kalo perlu, pake variable untuk nampung data gambar
	// $file_name = $_FILES["file"]["name"];
	// $tmp_name = $_FILES["file"]["tmp_name"];
	// move_uploaded_file($tmp_name, "../images/".$file_name);

	// input data sql
	mysqli_query($conn, "INSERT INTO insert_voucher VALUES('','$currencys','$tanggals','$last_edited','$daris','$nomorVouchers','$deskripsis',
		'$jumlahs','$file_name','','','','','','','','$nama_cabang','','')");
	header("location:index.php");
}

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
			<!-- Row 1 of index.php-->
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
		                    <a class="nav-link" href="A1_Files/dashboardA1.php">Dashboard</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="index.php">Insert Voucher</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="A1_Files/directoryA1.php">Pending</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="A1_Files/ApprovedA1.php">Approved</a>
		                  </li>
		                </ul>
	            
		                <form class="form-inline my-2 my-lg-0">
		                	<div class="btn-group" role="group">
							    <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle my-2 my-sm-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							      <?php echo $user?> | <?php echo $approval_position?> | <?php echo $cabang_name?>
							    </button>
							    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							      <a class="dropdown-item" href="logout.php" role="submit">Log Out</a>
							    </div>
							  </div>
					    </form>
		                
		              </div>
		            </nav>
		            <hr class="my-1">
		            <hr class="my-1">
		          </div>
		      </div>

		      <!-- Row 2 of index.php-->
		      <div class="row ROW2">
		      	<div class="col-md-2"></div>
		      	<div class="col-md-8">
		      	<!-- Action for saving form inputs to 'permata_finance-insert_voucher db' of forum.html-->
		      	<!--bisa pake enctype="multipart/form-data" untuk setor gambar di database-->
		      	<form action="" method="POST" enctype="multipart/form-data">

		      		<div>
		      			<div class="col-md-6 my-1">
					      <label for="disabledTextInput">Cabang</label>
					      <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $nama_cabang["Nama_Cabang"]?>" name="nama_cabang" readonly>
					    </div>
		      		</div>

				  <div class="form-row FRow1">
				    <div class="col-md-6 my-1">
				      <label for="validationDefault01">Currency</label>
				      <input type="text" class="form-control" id="validationDefault01" placeholder="Mata Uang" value="" 
				       name="currency" required="">
				    </div>
				    <div class="col-md-6 my-1">
				      <label for="validationDefault02">Tanggal</label>
				      <input type="text" class="form-control" id="validationDefault02" placeholder="__ /__ /__" value="" 
				      name="tanggal" required="">
				    </div>
				  </div>
				  <div class="form-row FRow2">
				    <div class="col-md-6 my-1">
				      <label for="validationDefault03">Dari</label>
				      <input type="text" class="form-control" id="validationDefault03" placeholder="Dari" 
				      name="dari" required="">
				    </div>
				    <div class="col-md-6 my-1">
				      <label for="validationDefault04">Nomor Voucher</label>
				      <input type="text" class="form-control" id="validationDefault04" placeholder="Nomor Voucher" 
				      name="nomorVoucher" required="">
				    </div>
				  </div>

				  <div class="form-row FRow3">
				  	<div class="col-md-12 my-1">
				  		<label for="disabledTextInput">Deskripsi</label>
			        	<input type="text" id="validationDefault05" class="form-control" placeholder="Deskripsi" name="deskripsi" required="">
				  	</div>
			      </div>

			      <div class="form-row FRow4">
			      	<div class="col-md-12 my-1">
			      		<label for="disabledTextInput">Jumlah</label>
			        	<input type="text" id="validationDefault06" class="form-control" placeholder="Jumlah" name="jumlah" required="">
			      	</div>
			      </div>

			      <div class="form-group my-2">
			      	<label>Image</label>
			      	<input type="file" name="file" />
			      </div>

			      <div class="row FRow5 my-2 ml-1">
			      	<input type="submit" name="Submit" value="Insert Voucher" class="btn btn-primary">
			      </div>
				  
				</form>
				</div>
		      	<div class="col-md-2"></div>
		      </div>

	    </div>
	</div>

	<!-- Footer of index.php-->
	<div class="container">
        <div class="row">
          <div class="col-md-12 bg-light text-center COND">
            <hr class="my-1">
            <hr class="my-1">
            <p class="my-2">Copyright &copy; PT. Mutiara Multi Finance</p> <!--or use pt-3 -->
            <hr class="my-1">
            <hr class="my-1">
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