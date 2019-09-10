<?php

include "../include/config.php";

if(isset($_GET["deletes"])) {
	$id_delete = $_GET["deletes"];
	mysqli_query($conn, "DELETE FROM cabang_master WHERE id = '$id_delete'");
	header("location:cabang_D1.php");
}

?>