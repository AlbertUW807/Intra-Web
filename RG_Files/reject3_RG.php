<?php

include "../include/config.php";

if(isset($_GET["reject3"])) {
	$id_reject3 = $_GET["reject3"];
	mysqli_query($conn, "UPDATE insert_voucher SET tahap_approve2 = '0' WHERE id = '$id_reject3'");
	mysqli_query($conn, "UPDATE insert_voucher SET reject_bool = '1' WHERE id = '$id_reject3'");

	// reject_description (alasan) sudah diurus di preview page bila tombol reject ditekan. 
	// disini hanya mengurus field bool reject_bool

	header("location:directoryRG.php");
}

?>