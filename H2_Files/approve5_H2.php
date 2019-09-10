<?php

include "../include/config.php";

if(isset($_GET["approve5"])) {
	$id_approve5 = $_GET["approve5"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve5 = '1' WHERE id = '$id_approve5'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '0' WHERE id = '$id_approve5'");

	header("location:directoryH2.php");
}

?>