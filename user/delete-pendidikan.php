<?php

session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}



require_once("../db.php");

if(isset($_GET)) {

	//Delete Company using id and redirect
	$sql = "DELETE FROM pendidikan WHERE id_pendidikan='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: edit-profile.php");
		exit();
	} else {
		echo "Error";
	}
}