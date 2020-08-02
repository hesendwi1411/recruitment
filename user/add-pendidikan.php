<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//if user Actually clicked update profile button
if(isset($_POST)) {

	//Escape Special Characters
	
	
	$nama_sekolah = mysqli_real_escape_string($conn, $_POST['nama_sekolah']);
	$jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
	$nilai = mysqli_real_escape_string($conn, $_POST['nilai']);
	$jenjang = mysqli_real_escape_string($conn, $_POST['jenjang']);
	$tgl_masuk = mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
	$tgl_lulus = mysqli_real_escape_string($conn, $_POST['tgl_lulus']);
	$no_ktp = mysqli_real_escape_string($conn, $_POST['no_ktp']);


	//Update User Details Query
	

$sql = "INSERT INTO pendidikan (id_user, nama_sekolah,jurusan, nilai,jenjang,tgl_masuk,tgl_lulus,no_ktp) VALUES ('$_SESSION[id_user]', '$nama_sekolah', '$jurusan', '$nilai','$jenjang','$tgl_masuk','$tgl_lulus','$no_ktp')";


	if($conn->query($sql) === TRUE) {
		$_SESSION['name'] = $firstname.' '.$lastname;
		//If data Updated successfully then redirect to dashboard
		header("Location: edit-profile.php");
		//header("location:../media.php?module=rekam_medik&&status=$status&&kodepasien=$kode");
		exit();
	} else {
		echo "Error ". $sql . "<br>" . $conn->error;
	}
	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click update button
	header("Location: edit-profile.php");
	exit();
}