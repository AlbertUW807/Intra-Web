<?php

ob_start();
session_start();
if(!isset($_SESSION['login_id'])) header("location:login.php");
include "include/config.php";

$id = $_GET["previews"];
$post = mysqli_query($conn, "SELECT * FROM insert_voucher WHERE id = '$id'");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Preview Voucher</title>

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
			
			<!-- Row 1 of preview.php-->
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
		                    <a class="nav-link" href="index.php">Insert Voucher</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="directory.php">Directory</a>
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
		      		<label>Date: <?php echo $row_post["tanggal"]?></label>
		      	</div>
		      </div>

		      <!--Row 4 of preview.php -->
		      <div class="row">
		      	<div class="col-md-6">
		      		<label>From: <?php echo $row_post["dari"]?></label>
		      	</div>
		      	<div class="col-md-6"></div>
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
					      <th scope="col" colspan="2">VERIFICATION</th>
					      <th></th>
					      <th></th>
					      <th scope="col">APPROVAL</th>
					      <th scope="col">Received By</th>
					    </tr>
					  </thead>
					<tbody>
						<tr>
							<td>Applicant</td>
							<td colspan="3">Checked & Booked by</td>
							<td>Acknowledged & Approved</td>
							<td></td>
						</tr>
						<tr>
							<td><?php echo $row_post["tahap_approve1"]?></td>
							<td><?php echo $row_post["tahap_approve2"]?></td>
							<td><?php echo $row_post["tahap_approve3"]?></td>
							<td><?php echo $row_post["tahap_approve4"]?></td>
							<td><?php echo $row_post["tahap_approve5"]?></td>
							<td></td>
						</tr>
						<tr>
							<td>Cashier</td>
							<td>FAISAL</td>
							<td>MONIKA</td>
							<td>Acc.</td>
							<td>ZAIDAN</td>
							<td></td>
						</tr>
					</tbody>
		      	</table>
		      </div>

		      <label>Bukti Voucher:</label>

		      <div class="row my-3">
		      	<img src="images/<?php echo $row_post["image"]?>" width="200" class="img-responsive" />
		      </div>

		      <div class="row my-2">
		      	<a href="approve1.php?approve1=<?php echo $row_post["id"]?>" class="btn btn-primary" name="approve">Approve</a>
		      	<a href="reject1.php?reject1=<?php echo $row_post["id"]?>" class="btn btn-primary ml-2">Reject</a>
				<a href="directory.php" class="btn btn-primary mx-2">Back</a>
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
	    <script src="js/jquery-3.3.1.slim.min.js"></script>
	    <script src="js/popper.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php

mysqli_close($conn);
ob_end_flush();

?>