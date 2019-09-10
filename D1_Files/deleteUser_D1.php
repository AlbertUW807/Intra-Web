<?php

include "../include/config.php";

if(isset($_GET["deletes"])) {
	$id_delete = $_GET["deletes"];
	mysqli_query($conn, "DELETE FROM login WHERE id = '$id_delete'");
	header("location:userD1.php");
}

?>