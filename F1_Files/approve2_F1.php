<?php

include "../include/config.php";

if(isset($_GET["approve2"])) {
	$id_approve2 = $_GET["approve2"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve2 = '1' WHERE id = '$id_approve2'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '0' WHERE id = '$id_approve2'");

	header("location:directoryF1.php");
}

?>