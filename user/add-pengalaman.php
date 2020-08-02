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
	
	
	$nama_perusahaan = mysqli_real_escape_string($conn, $_POST['nama_perusahaan']);
	$jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
	$gaji= mysqli_real_escape_string($conn, $_POST['gaji']);
	$detail = mysqli_real_escape_string($conn, $_POST['detail']);
	$tgl_masuk_kerja = mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
	$tgl_keluar_kerja = mysqli_real_escape_string($conn, $_POST['tgl_keluar']);
	$alasan_keluar = mysqli_real_escape_string($conn, $_POST['alasan_keluar']);
	$no_ktp = mysqli_real_escape_string($conn, $_POST['no_ktp']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	//Update User Details Query
	

$sql = "INSERT INTO pengalaman_kerja (id_user, nama_perusahaan,jabatan, gaji,detail,tgl_masuk,tgl_keluar,alasan_keluar,experience,no_ktp) VALUES ('$_SESSION[id_user]', '$nama_perusahaan', '$jabatan', '$gaji','$detail','$tgl_masuk_kerja','$tgl_keluar_kerja','$alasan_keluar','$experience','$no_ktp')";


	if($conn->query($sql) === TRUE) {
		$_SESSION['name'] = $firstname.' '.$lastname;
		//If data Updated successfully then redirect to dashboard
		header("Location: edit-profile.php?#tabPendidikan");
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