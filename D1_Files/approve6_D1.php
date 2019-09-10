<?php

include "../include/config.php";

if(isset($_GET["approve6"])) {
	$id_approve6 = $_GET["approve6"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve6 = '1' WHERE id = '$id_approve6'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '0' WHERE id = '$id_approve6'");

	header("location:directoryD1.php");
}

?>