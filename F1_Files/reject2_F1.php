<?php

include "../include/config.php";

if(isset($_GET["reject2"])) {
	$id_reject2 = $_GET["reject2"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve1 = '0' WHERE id = '$id_reject2'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '1' WHERE id = '$id_reject2'");

	// reject_description (alasan) sudah diurus di preview page bila tombol reject ditekan. 
	// disini hanya mengurus field bool reject_bool

	header("location:directoryF1.php");
}	

?>