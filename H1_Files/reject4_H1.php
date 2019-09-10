<?php

include "../include/config.php";

if(isset($_GET["reject4"])) {
	$id_reject4 = $_GET["reject4"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve3 = '0' WHERE id = '$id_reject4'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '1' WHERE id = '$id_reject4'");

	// reject_description (alasan) sudah diurus di preview page bila tombol reject ditekan. 
	// disini hanya mengurus field bool reject_bool

	header("location:directoryH1.php");
}

?>