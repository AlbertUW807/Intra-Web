<?php

include "../include/config.php";

if(isset($_GET["approve3"])) {
	$id_approve3 = $_GET["approve3"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve3 = '1' WHERE id = '$id_approve3'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '0' WHERE id = '$id_approve3'");

	header("location:directoryRG.php");
}

?>