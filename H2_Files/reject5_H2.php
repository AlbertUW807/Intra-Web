<?php

include "../include/config.php";

if(isset($_GET["reject5"])) {
	$id_reject5 = $_GET["reject5"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve4 = '0' WHERE id = '$id_reject5'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '1' WHERE id = '$id_reject5'");

	// reject_description (alasan) sudah diurus di preview page bila tombol reject ditekan. 
	// disini hanya mengurus field bool reject_bool

	header("location:directoryH2.php");
}

?>