<?php

include "../include/config.php";

if(isset($_GET["approve7"])) {
	$id_approve7 = $_GET["approve7"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve7 = '1' WHERE id = '$id_approve7'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '0' WHERE id = '$id_approve7'");

	header("location:directoryL1.php");
}

?>