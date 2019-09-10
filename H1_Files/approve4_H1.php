<?php

include "../include/config.php";

if(isset($_GET["approve4"])) {
	$id_approve4 = $_GET["approve4"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve4 = '1' WHERE id = '$id_approve4'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '0' WHERE id = '$id_approve4'");

	header("location:directoryH1.php");
}

?>