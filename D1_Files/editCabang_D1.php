<?php

ob_start();
session_start();
if(!isset($_SESSION['login_id'])) header("location:login.php");
include "../include/config.php";

// Tampilkan data pada form
$edit_id = $_GET["edits"];
$edit = mysqli_query($conn, "SELECT * FROM cabang_master WHERE id = '$edit_id'");
$row_edit = mysqli_fetch_array($edit);

// Proses Edit/Update
if(isset($_POST["editVoucher"])){
	$id_edit = $_POST["id_edit"];
	$kode_cabang = $_POST["kode_cabang"];
	$nama_cabang = $_POST["nama_cabang"];
	$alamat = $_POST["alamat"];
	$regional = $_POST["regional"];

	mysqli_query($conn, "UPDATE cabang_master SET id = '$kode_cabang', Nama_Cabang = '$nama_cabang', Alamat = '$alamat',
		Regional = '$regional' WHERE id = '$id_edit'");
	header("location:cabang_D1.php");
}

$string_id = $_SESSION['login_id'];
$user_id = mysqli_query($conn, "SELECT * FROM login WHERE id = '$string_id'");
$id_array = mysqli_fetch_array($user_id);
$user = $id_array["username"];
$approval_position = $id_array["ApproveLevel"];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Forum Input Data</title>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
	<div class="container_fluid">
		<div class="container">
			<!-- Row 1 of edit.php-->
			<div class="row">
				<div class = "col-md-2 bg-light">
		            <img src="../images/mutiara_logo.jpg" class = "img-fluid rounded mx-auto d-block">
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
		                    <a class="nav-link" href="directoryD1.php">Directory</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="ApprovedD1.php">Approved</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="userD1.php">User List</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="cabang_D1.php">Cabang List</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="registerD1.php">Register</a>
		                  </li>
		                </ul>
	            
		                <form class="form-inline my-2 my-lg-0">
		                	<div class="btn-group" role="group">
							    <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle my-2 my-sm-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							      <?php echo $user?> | <?php echo $approval_position?>
							    </button>
							    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							      <a class="dropdown-item" href="../logout.php" role="submit">Log Out</a>
							    </div>
							  </div>
					    </form>
		                
		              </div>
		            </nav>
		            <hr class="my-1">
		            <hr class="my-1">
		          </div>
		      </div>

		      <!-- Row 2 of edit.php-->
		      <div class="row ROW2">
		      	<div class="col-md-2"></div>
		      	<div class="col-md-8">
		      	<!-- Action for saving form inputs to 'permata_finance-insert_voucher db' of forum.html-->
		      	<!--bisa pake enctype="multipart/form-data" untuk setor gambar di database-->
		      	<form action="" method="POST">
		      		<div class="alert alert-primary mt-3" role="alert">
					  Edit Cabang
					</div>
				  <div class="form-row FRow1">
				    <div class="col-md-6 my-1">
				      <label for="validationDefault01">Kode Cabang</label>
				      <input type="text" class="form-control" id="validationDefault01" value="<?php echo $row_edit["id"]?>" 
				       name="kode_cabang" required="">
				    </div>
				    <div class="col-md-6 my-1">
				      <label for="validationDefault02">Nama Cabang</label>
				      <input type="text" class="form-control" id="validationDefault02"value="<?php echo $row_edit["Nama_Cabang"]?>" 
				      name="nama_cabang" required="">
				    </div>
				  </div>
				  <div class="form-row FRow2">
				    <div class="col-md-6 my-1">
				      <label for="validationDefault03">Alamat</label>
				      <input type="text" class="form-control" id="validationDefault03" value="<?php echo $row_edit["Alamat"]?>" 
				      name="alamat" required="">
				    </div>
				    <div class="col-md-6 my-1">
				      <label for="validationDefault04">Regional</label>
				      <input type="text" class="form-control" id="validationDefault04" value="<?php echo $row_edit["Regional"]?>"
				      name="regional" required="">
				    </div>
				  </div>

			      <div class="row FRow5 my-3 ml-1">
			      	<input type="submit" name="editVoucher" value="Edit Cabang" class="btn btn-primary">
			      	<a href="cabang_D1.php" class="btn btn-primary mx-2">Back</a>
			      	<input type="hidden" name="id_edit" value="<?php echo $row_edit["id"]?>">
			      </div>
				  
				</form>
				</div>
		      	<div class="col-md-2"></div>
		      </div>

	    </div>
	</div>

	<!-- Footer of edit.php-->
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
	    <script src="../js/jquery-3.3.1.slim.min.js"></script>
	    <script src="../js/popper.min.js"></script>
	    <script src="../js/bootstrap.min.js"></script>

</body>
</html>

<?php

mysqli_close($conn);
ob_end_flush();

?>