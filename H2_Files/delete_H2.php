<?php

include "../include/config.php";

if(isset($_GET["deletes"])) {
	$id_delete = $_GET["deletes"];
	mysqli_query($conn, "DELETE FROM insert_voucher WHERE id = '$id_delete'");
	header("location:directoryH2.php");
}

?>