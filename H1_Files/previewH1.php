<?php

ob_start();
session_start();
if(!isset($_SESSION['login_id'])) header("location:login.php");
include "../include/config.php";

$string_id = $_SESSION['login_id'];
$user_id = mysqli_query($conn, "SELECT * FROM login WHERE id = '$string_id'");
$id_array = mysqli_fetch_array($user_id);
$user = $id_array["username"];
$approval_position = $id_array["ApproveLevel"];
$cabang_name = $id_array["Nama_Cabang"];

$id = $_GET["previews"];
$post = mysqli_query($conn, "SELECT id, currency, tanggal, last_edited, dari, nomorVoucher, deskripsi, jumlah, image,
															    case WHEN tahap_approve1 = '0' THEN 'Belum'
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
																 FROM insert_voucher WHERE id = '$id'");

if (isset($_POST["rejectVoucher"])) {
	$alasan_reject = $_POST["reject_voucher"];
	//INSERT INTO insert_voucher VALUES('','','','','','','','','','','','','','','','','','','$alasan_reject')

	mysqli_query($conn, "UPDATE insert_voucher SET reject_description = '$alasan_reject' WHERE id = '$id'");
	header("location: directoryH1.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Preview Voucher</title>

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
			
			<!-- Row 1 of preview.php-->
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
		                    <a class="nav-link" href="dashboardH1.php">Dashboard</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="directoryH1.php">Pending</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="ApprovedH1.php">Approved</a>
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

		      <?php $row_post = mysqli_fetch_array($post) ?>

		      <!--Row 2 of preview.php -->
		      <div class="row mt-3">
		      	<div class="col-md-6">
		      		<label>Paid to: ____________________</label>
		      	</div>
		      	<div class="col-md-6">
		      		<label>No reff: ____________________</label>
		      	</div>
		      </div>

		      <!--Row 3 of preview.php -->
		      <div class="row">
		      	<div class="col-md-6">
		      		<label>Currency: <?php echo $row_post["currency"]?></label>
		      	</div>
		      	<div class="col-md-6">
		      		<label>From: <?php echo $row_post["dari"]?></label>
		      	</div>
		      </div>

		      <!--Row 4 of preview.php -->
		      <div class="row">
		      	<div class="col-md-6">
		      		<label>Date Inserted: <?php echo $row_post["tanggal"]?></label>
		      	</div>
		      	<div class="col-md-6">
		      		<label>Last Edited: <?php echo $row_post["last_edited"]?></label>
		      	</div>
		      </div>

		      <!--Row 5 of preview.php -->
		      <div class="row mt-3">
		      	<table class="table" border="1px;">
				  <thead>
				    <tr>
				      <th scope="col">COA</th>
				      <th scope="col" colspan="2">Description</th>
				      <th scope="col">Amount</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td></td>
				      <td><?php echo $row_post["nomorVoucher"]?></td>
				      <td><?php echo $row_post["deskripsi"]?></td>
				      <td><?php echo $row_post["jumlah"]?></td>
				    </tr>
				    <tr>
				    	<th>Total</th>
				    	<td></td>
				    	<td></td>
				    	<td><?php echo $row_post["jumlah"]?></td>
				    </tr>
				  </tbody>
				</table>

				<label>In Words: _________________________________________________________________________</label>

		      </div>

		      <!--Row 6 of preview.php -->
		      <div class="row mt-3">
		      	<table class="table" border="1px;">
		      		<thead>
					    <tr>
					      <th scope="col">VERIFICATION</th>
					      <th></th>
					      <th></th>
					      <th></th>
					      <th></th>
					      <th scope="col">APPROVAL</th>
					      <th></th>
					    </tr>
					  </thead>
					<tbody>
						<tr>
							<td><b>Applicant</b></td>
							<td colspan="4"><b>Checked & Booked by</b></td>
							<td><b>Acknowledged & Approved</b></td>
							<td><b>Payment Status</b></td>
						</tr>
						<tr>
							<td><b>Treasury</b></td>
							<td><b>BFM</b></td>
							<td><b>Regional</b></td>
							<td><b>SPV_HO</b></td>
							<td><b>Manager_HO</b></td>
							<td><b>Direktur</b></td>
							<td><b>Acc.</b></td>
						</tr>
						<tr>
							<td><i><?php echo $row_post["tahap_approve1"]?></i></td>
							<td><i><?php echo $row_post["tahap_approve2"]?></i></td>
							<td><i><?php echo $row_post["tahap_approve3"]?></i></td>
							<td><i><?php echo $row_post["tahap_approve4"]?></i></td>
							<td><i><?php echo $row_post["tahap_approve5"]?></i></td>
							<td><i><?php echo $row_post["tahap_approve6"]?></i></td>
							<td><i><?php echo $row_post["tahap_approve7"]?></i></td>
						</tr>
					</tbody>
		      	</table>
		      </div>

		      <label>Bukti Voucher:</label>

		      <div class="row my-3">
		      	<img src="../images/<?php echo $row_post["image"]?>" width="200" class="img-responsive" />
		      </div>

		      <div class="row my-2">
		      	<a href="approve4_H1.php?approve4=<?php echo $row_post["id"]?>" class="btn btn-primary" name="approve">Approve</a>
		      	<a href="reject4_H1.php?reject4=<?php echo $row_post["id"]?>" class="btn btn-primary ml-2">Reject</a>
		      	<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#exampleModal">
				  Alasan Reject Voucher
				</button>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Alasan reject voucher</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<form action="" method="POST" >
				      		<div class="form-row FRow4">
					      	<div class="col-md-12 my-3">
					      		<label>Alasan Reject</label>
					        	<input type="text" id="validationDefault06" class="form-control" name="reject_voucher" required="">
					        	<small id="emailHelp" class="form-text text-muted">Hanya Perlu Diisi Bila Ingin Reject Voucher.</small>
					      	</div>
					      </div>
				      	
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <input type="submit" name="rejectVoucher" value="Save Changes" class="btn btn-primary">
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				<a href="directoryH1.php" class="btn btn-primary mx-2">Back</a>
		      </div>

		</div>
	</div>

	<!-- Footer of preview.php-->
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