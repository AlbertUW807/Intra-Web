<?php

ob_start();
session_start();
if(!isset($_SESSION['login_id'])) header("location:login.php");
include "../include/config.php";

$filter_id = $_GET["Filter"];
$filter = mysqli_query($conn, "SELECT * FROM insert_voucher WHERE Nama_Cabang = '$filter_id'");
$row_filter = mysqli_fetch_array($filter);
$field_filter = $row_filter["Nama_Cabang"];

$string_id = $_SESSION['login_id'];
$regional = mysqli_query($conn, "SELECT Regional FROM login WHERE id = '$string_id'");
$nama_regional = mysqli_fetch_array($regional);
$field_regional = $nama_regional["Regional"];

/** PAGINATION **/
$per_page = 15; //jumlah data ditampilkan
$cur_page = 1; // jumlah halaman aktif
if (isset($_GET["page"])) {
	$cur_page = $_GET["page"];
	$cur_page = ($cur_page > 1) ? $cur_page : 1;
}
$total_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM insert_voucher WHERE tahap_approve5 = '1' AND Nama_Cabang = '$field_filter'"));
$total_page = ceil($total_data/$per_page); //round up value
$offset = ($cur_page - 1) * $per_page;
// END OF PAGINATION

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
																else 'Setuju' end tahap_approve7
														 FROM insert_voucher WHERE tahap_approve5 = '1' AND Nama_Cabang = '$field_filter' ORDER BY id DESC
														 LIMIT $per_page OFFSET $offset");

// post untuk list dropdown
$dropdown_post = mysqli_query($conn, "SELECT * FROM cabang_master ORDER BY id ASC");

$user_id = mysqli_query($conn, "SELECT * FROM login WHERE id = '$string_id'");
$id_array = mysqli_fetch_array($user_id);
$user = $id_array["username"];
$approval_position = $id_array["ApproveLevel"];

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
		                    <a class="nav-link" href="dashboardH2.php">Dashboard</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="directoryH2.php">Pending</a>
		                  </li>
		                  <li class="nav-item">
		                    <a class="nav-link" href="ApprovedH2.php">Approved</a>
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

		      <!-- Row 2 of directory.php-->
		      <div class="row">

		      	<label class="mx-1 my-1">Filter Cabang: </label>
				<a href="ApprovedH2.php" class="badge badge-info mx-1 my-1">All</a>

	    		<?php if(mysqli_num_rows($dropdown_post)) {?>
	    		<?php while($row_dropdown_post = mysqli_fetch_array($dropdown_post)) {?>

	    			<a href="ApprovedH2_filter.php?Filter=<?php echo $row_dropdown_post["id"]?>" class="badge badge-info mx-1 my-1"><?php echo $row_dropdown_post["id"]?></a>
				    
				<?php }?>
				<?php }?>

		      	<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Cabang</th>
					      <th scope="col">Nomor Voucher</th>
					      <th scope="col">Action</th>
					      <th colspan="7" scope="col">Approval Status</th>
					    </tr>
					    <tr>
					    	<th></th>
					    	<th></th>
					    	<th></th>
					    	<th></th>
					    	<th>Treasury</th>
					    	<th>BFM</th>
					    	<th>Regional</th>
					    	<th>SPV_HO.</th>
					    	<th>Manager_HO</th>
					    	<th>Direktur</th>
					    	<th>Acc.</th>
					    </tr>
					  </thead>
					  <tbody>

					  	<?php if(mysqli_num_rows($post)) {?>
					  		<?php $counter = 1; ?>
					  		<?php while($row_post = mysqli_fetch_array($post)) {?>
						    <tr>
						      <th scope="row"><?php echo $counter ?></th>
						      <td><?php echo $row_post["Nama_Cabang"]?></td>
						      <td><?php echo $row_post["nomorVoucher"]?></td>
						      <td>
						      	<a href="previewH2_approved.php?previews=<?php echo $row_post["id"]?>" class="btn btn-primary mb-1">Preview</a>
						      	<a href="deleteApproved_H2.php?deletes=?<?php echo $row_post["id"]?>" class="btn btn-primary mb-1">Delete</a>
						      </td>
						      <td><?php echo $row_post["tahap_approve1"]?></td>
					      	  <td><?php echo $row_post["tahap_approve2"]?></td>
					      	  <td><?php echo $row_post["tahap_approve3"]?></td>
					      	  <td><?php echo $row_post["tahap_approve4"]?></td>
					      	  <td><?php echo $row_post["tahap_approve5"]?></td>
					      	  <td><?php echo $row_post["tahap_approve6"]?></td>
					      	  <td><?php echo $row_post["tahap_approve7"]?></td>
						    </tr>
							<?php $counter++; }?>
						<?php }?>
					  </tbody>
					</table>

					<!--PAGINATION-->
					<?php if(isset($total_page)) {?>
						<?php if($total_page > 1) {?>
							<nav aria-label="Page navigation example text-center">
							  <ul class="pagination">
							  	<?php if($cur_page > 1) {?>
								    <li class="page-item">
								    	<a href="ApprovedH2_filter.php?page=<?php echo ($cur_page - 1)."&Filter=".$filter_id?>" class="page-link" aria-label="Previous">
											<span aria-hidden="true">Prev</span>
										</a>
								    </li>
							    <?php }?>
								<?php if($cur_page < $total_page) {?>
								    <li class="page-item">
								    	<a href="ApprovedH2_filter.php?page=<?php echo ($cur_page + 1)."&Filter=".$filter_id?>" class="page-link" aria-label="Next">
										<span aria-hidden="true">Next</span>
									</a>
								    </li>
							    <?php }?>
							  </ul>
							</nav>
						<?php }?>
					<?php }?>

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