<?php

include "../include/config.php";

if(isset($_GET["approve1"])) {
	$id_approve1 = $_GET["approve1"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve1 = '1' WHERE id = '$id_approve1'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '0' WHERE id = '$id_approve1'");

	header("location:directoryA1.php");
}

?>