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
			<!-- Row 1 of forum.html-->
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
		                	<a class="btn btn-outline-success my-2 my-sm-0" href="index.html" role="submit">Log Out</a>
		                </form>
		                
		              </div>
		            </nav>
		            <hr class="my-1">
		            <hr class="my-1">
		          </div>
		      </div>

		      <!-- Row 2 of forum.html-->
		      <div class="row ROW2">
		      	<form>
				  <div class="form-row FRow1">
				    <div class="col-md-6">
				      <label for="validationDefault01">Currency</label>
				      <input type="text" class="form-control" id="validationDefault01" placeholder="Mata Uang" value="" required>
				    </div>
				    <div class="col-md-6">
				      <label for="validationDefault02">Date</label>
				      <input type="text" class="form-control" id="validationDefault02" placeholder="__ /__ /__" value="" required>
				    </div>
				  </div>
				  <div class="form-row FRow2">
				    <div class="col-md-6">
				      <label for="validationDefault03">From</label>
				      <input type="text" class="form-control" id="validationDefault03" placeholder="Dari" required>
				    </div>
				    <div class="col-md-6">
				      <label for="validationDefault04">Nomor Voucher</label>
				      <input type="text" class="form-control" id="validationDefault04" placeholder="Nomor Voucher" required>
				    </div>
				  </div>

				  <div class="form-row FRow3">
				  	<div class="col-md-12">
				  		<label for="disabledTextInput">Deskripsi</label>
			        	<input type="text" id="validationDefault05" class="form-control" placeholder="Deskripsi">
				  	</div>
			      </div>

			      <div class="form-row FRow4">
			      	<div class="col-md-12">
			      		<label for="disabledTextInput">Jumlah</label>
			        	<input type="text" id="validationDefault06" class="form-control" placeholder="Jumlah">
			      	</div>
			      </div>

			      <div class="row FRow5">
			      	<div class="col-md-6">
			      		<button class="btn btn-primary" type="submit">Insert Voucher</button>
			      	</div>
			      	<div class="col-md-6">
			      		<button class="btn btn-primary" type="submit">Cancel</button>
			      	</div>
			      </div>
				  
				</form>
		      </div>

	    </div>
	</div>