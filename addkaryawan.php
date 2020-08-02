<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked register button
if(isset($_POST)) {

	//Data pribadi	$firstname = mysqli_real_escape_string($conn, $_POST['fname']);	$lastname = mysqli_real_escape_string($conn, $_POST['lname']);	$address = mysqli_real_escape_string($conn, $_POST['address']);	$domisili = mysqli_real_escape_string($conn, $_POST['domisili']);	$city = mysqli_real_escape_string($conn, $_POST['city']);	$state = mysqli_real_escape_string($conn, $_POST['state']);	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);	$no_ktp = mysqli_real_escape_string($conn, $_POST['no_ktp']);	$dob = mysqli_real_escape_string($conn, $_POST['dob']);	$age = mysqli_real_escape_string($conn, $_POST['age']);	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);	$skills = mysqli_real_escape_string($conn, $_POST['skills']);	$email_id = mysqli_real_escape_string($conn, $_POST['email_id']);	$password = mysqli_real_escape_string($conn, $_POST['password']);			//Data Pendidikan	$nama_sekolah = mysqli_real_escape_string($conn, $_POST['nama_sekolah']);	$jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);	$jenjang = mysqli_real_escape_string($conn, $_POST['jenjang']);	$nilai = mysqli_real_escape_string($conn, $_POST['nilai']);	$tgl_masuk = mysqli_real_escape_string($conn, $_POST['tgl_masuk']);	$tgl_lulus = mysqli_real_escape_string($conn, $_POST['tgl_lulus']);	//Data Pengalaman kerja	$nama_perusahaan = mysqli_real_escape_string($conn, $_POST['nama_perusahaan']);	$jabatan = mysqli_real_escape_string($conn, $_POST['jurusan']);	$gaji = mysqli_real_escape_string($conn, $_POST['jenjang']);	$tgl_masuk_kerja = mysqli_real_escape_string($conn, $_POST['tgl_masuk_kerja']);	$tgl_keluar_kerja = mysqli_real_escape_string($conn, $_POST['tgl_keluar_kerja']);	$experience = mysqli_real_escape_string($conn, $_POST['experience']);	$detail = mysqli_real_escape_string($conn, $_POST['detail']);	$alasan_keluar = mysqli_real_escape_string($conn, $_POST['alasan_keluar']);
	
	//Data pribadi
	$xno_ktp = mysqli_real_escape_string($conn, $_POST['xno_ktp']);
	$xnama = mysqli_real_escape_string($conn, $_POST['xnama']);
	$xjk = mysqli_real_escape_string($conn, $_POST['xjk']);
	$xagama = mysqli_real_escape_string($conn, $_POST['xagama']);
	$xstatus = mysqli_real_escape_string($conn, $_POST['xstatus']);
	$xtempat_lahir = mysqli_real_escape_string($conn, $_POST['xtempat_lahir']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	
	$country = mysqli_real_escape_string($conn, $_POST['country']);
	$xprovinsi = mysqli_real_escape_string($conn, $_POST['xprovinsi']);
	$xkabupaten = mysqli_real_escape_string($conn, $_POST['xkabupaten']);
	$xdesa = mysqli_real_escape_string($conn, $_POST['xdesa']);
	$xaddress = mysqli_real_escape_string($conn, $_POST['xaddress']);
	$xrt = mysqli_real_escape_string($conn, $_POST['xrt']);
	$xrw = mysqli_real_escape_string($conn, $_POST['xrw']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$xemail_id = mysqli_real_escape_string($conn, $_POST['xemail_id']);
	$xlocation = mysqli_real_escape_string($conn, $_POST['xlocation']);
	//Data Keluarga
	$xkeluarga = mysqli_real_escape_string($conn, $_POST['xkeluarga']);
	$xnama_keluarga = mysqli_real_escape_string($conn, $_POST['xnama_keluarga']);
	$xagama_keluarga = mysqli_real_escape_string($conn, $_POST['xagama_keluarga']);
	$xaddress_keluarga = mysqli_real_escape_string($conn, $_POST['xaddress_keluarga']);
	$xpekerjaan_keluarga = mysqli_real_escape_string($conn, $_POST['xpekerjaan_keluarga']);
	
	//Data informasi keadaan darurat
	$xnama_kerabat = mysqli_real_escape_string($conn, $_POST['xnama_kerabat']);
	$xhubungan_kerabat = mysqli_real_escape_string($conn, $_POST['xhubungan_kerabat']);
	$xcontactno_kerabat = mysqli_real_escape_string($conn, $_POST['xcontactno_kerabat']);
	$xaddress_kerabat = mysqli_real_escape_string($conn, $_POST['xaddress_kerabat']);
	
	//Data Pendidikan
	$xnama_sekolah = mysqli_real_escape_string($conn, $_POST['xnama_sekolah']);
	$xjurusan = mysqli_real_escape_string($conn, $_POST['xjurusan']);
	$xjenjang = mysqli_real_escape_string($conn, $_POST['xjenjang']);
	$xnilai = mysqli_real_escape_string($conn, $_POST['xnilai']);
	$xtanggal_masuk_sekolah = mysqli_real_escape_string($conn, $_POST['xtanggal_masuk_sekolah']);
	$xtanggal_lulus_sekolah = mysqli_real_escape_string($conn, $_POST['xtanggal_lulus_sekolah']);


	//Data Pengalaman kerja
	$xnama_perusahaan = mysqli_real_escape_string($conn, $_POST['xnama_perusahaan']);
	$xjabatan = mysqli_real_escape_string($conn, $_POST['xjabatan']);
	$tanggal_masuk_kerja = mysqli_real_escape_string($conn, $_POST['tanggal_masuk_kerja']);
	$tanggal_keluar_kerja = mysqli_real_escape_string($conn, $_POST['tanggal_keluar_kerja']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	
	
	
	//sql query to check if email already exists or not
	$sql = "SELECT no_ktp FROM karyawan WHERE no_ktp='$xno_ktp'";
	$result = $conn->query($sql);

	//if email not found then we can insert new data
	if($result->num_rows == 0) {
	//echo print_r($xno_ktp.'-'.$xnama);
	//		exit;
	$sql = "INSERT INTO karyawan (no_ktp,nama,jk,agama,status,tempat_lahir,dob,age,country,provinsi,kabupaten,desa,address,rt,rw,contactno,email_id,keluarga,nama_keluarga,agama_keluarga,address_keluarga,nama_kerabat,hubungan_kerabat,contactno_kerabat,nama_sekolah,jurusan,jenjang,nilai,tanggal_masuk_sekolah,tanggal_lulus_sekolah,nama_perusahaan,jabatan,tanggal_masuk_kerja,tanggal_keluar_kerja,experience,location,pekerjaan_keluarga,address_kerabat) VALUES ('$xno_ktp', '$xnama', '$xjk','$xagama','$xstatus','$xtempat_lahir','$dob','$age','$country','$xprovinsi','$xkabupaten','$xdesa','$xaddress','$xrt','$xrw','$contactno','$xemail_id','$xkeluarga','$xnama_keluarga','$xagama_keluarga','$xaddress_keluarga','$xnama_kerabat','$xhubungan_kerabat','$xcontactno_kerabat','$xnama_sekolah','$xjurusan','$xjenjang','$xnilai','$xtanggal_masuk_sekolah','$xtanggal_lulus_sekolah','$xnama_perusahaan','$xjabatan','$tanggal_masuk_kerja','$tanggal_keluar_kerja','$experience','$xlocation','$xpekerjaan_keluarga','$xaddress_kerabat')";	
	//$sql = "INSERT INTO karyawan (no_ktp,nama) VALUES ('$xno_ktp', '$xnama')";	
	
	if($conn->query($sql) === TRUE) {
		$_SESSION['no_ktp'] = $xno_ktp;
		$_SESSION['location'] = $xlocation;
		$_SESSION['registerCompleted'] = true;
			 	header("Location: biodatakaryawan.php");
				exit();
		exit();
	} else {
		echo "Error ". $sql . "<br>" . $conn->error;
	}
	//Close database connection. Not compulsory but good practice.
	$conn->close();

	
	} else {
			//File not copied to temp location error.
			//$_SESSION['registerError'] = "No KTP sudah ada !.";
			$_SESSION['registerError'] = true;
				header("Location: form.php");
				exit();
		}
}else {
	//redirect them back to dashboard page if they didn't click update button
	header("Location: index.php");
	exit();
}		