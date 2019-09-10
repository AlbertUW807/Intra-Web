<?php

ob_start();
session_start();
if(!isset($_SESSION['login_id'])) header("location:login.php");
include "../include/config.php";

$string_id = $_SESSION['login_id'];
$cabang = mysqli_query($conn, "SELECT Nama_Cabang FROM login WHERE id = '$string_id'");
$nama_cabang = mysqli_fetch_array($cabang);
$field_cabang = $nama_cabang["Nama_Cabang"];

$user_id = mysqli_query($conn, "SELECT * FROM login WHERE id = '$string_id'");
$id_array = mysqli_fetch_array($user_id);
$user = $id_array["username"];
$approval_position = $id_array["ApproveLevel"];
$cabang_name = $id_array["Nama_Cabang"];

$post = mysqli_query($conn, "SELECT id, tanggal, nomorVoucher, Nama_Cabang, case WHEN tahap_approve1 = '0' THEN 'Belum'
																else 'Setuju' end tahap_approve1,
																case WHEN tahap_approve2 = '0' THEN 'Belum'
																else 'Setuju' end tahap_approve2,
																case WHEN tahap_approve3 = '0' THEN 'Belum'
																else 'Setuju' end tahap_approve3,
																case WHEN tahap_approve4 = '0' THEN 'Belum'
																else 'Setuju' end tahap_approve4,
																case WHEN tahap_approve5 = '0' THEN 'Belum'
																else 'Setuju' end tahap_approve5,
																case WHEN tahap_approve6 = '0' THEN 'Belum'
																else 'Setuju' end tahap_approve6,
																case WHEN tahap_approve7 = '0' THEN 'Belum'
																else 'Sudah' end tahap_approve7
														 FROM insert_voucher WHERE tahap_approve2 = '0' AND tahap_approve1 = '1' AND Nama_Cabang = '$field_cabang' ORDER BY id DESC");

$reject_query = mysqli_query($conn,"SELECT * FROM insert_voucher WHERE tahap_approve2 = '0' AND tahap_approve1 = '1' AND Nama_Cabang = '$field_cabang' AND reject_bool = '1' ORDER BY id DESC");


?>

<!DOCTYPE html>
<html>
<head>
	<title>Voucher Directory</title>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
	<div class="container-fluid">
		<div class="container">

			<!-- Row 1 of directory.php-->
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
		                    <a class="nav-link" href="dashboardF1.php">Dashboard</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="directoryF1.php">Pending</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="ApprovedF1.php">Approved</a>
		                  </li>
		                </ul>
	            
		                <form class="form-inline my-2 my-lg-0">
		                	<div class="btn-group" role="group">
							    <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle my-2 my-sm-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							      <?php echo $user?> | <?php echo $approval_position?> | <?php echo $cabang_name?>
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

		      <!-- Row 2 of directory.php-->
		      <div class="row">
		      	<div class="col-md-1"></div>
		      	<div class="col-md-10">

		      		<div class="jumbotron my-2">
					  <h1 class="display-4">Rejected Vouchers:</h1>
					  <hr class="my-4">
					  <?php while ($row_reject_query = mysqli_fetch_array($reject_query)){?>
					      	<div class="alert alert-danger my-2" role="alert">
							  Voucher <?php echo $row_reject_query["nomorVoucher"]?> telah di Reject.
							  <br><br>
							  Alasan : <?php echo $row_reject_query["reject_description"]?>
							</div>
						<?php }?>
						<div class="alert alert-dark my-2" role="alert">
						  No more Rejected Vouchers.
						</div>
					</div>
		      		
		      	</div>
		      	<div class="col-md-1"></div>
		      </div>  
		</div>
	</div>

	<!-- Footer of directory.php-->
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