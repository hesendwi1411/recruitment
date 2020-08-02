<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_user'])) {
	header("Location: index.php");
	exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked apply button
if(isset($_GET)) {

	$sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
	  $result = $conn->query($sql);
	  if($result->num_rows > 0) 
	  {
	    	$row = $result->fetch_assoc();
	    	$id_company = $row['id_company'];
			$jobtitle = $row['jobtitle'];
	   }

	
	
	//Check if user has applied to job post or not. If not then add his details to apply_job_post table.
	$sql1 = "SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
    $result1 = $conn->query($sql1);
	
	   //Data user.
	$sql2 = "SELECT * FROM users INNER JOIN pendidikan ON pendidikan.id_user=users.id_user WHERE users.id_user='$_SESSION[id_user]' ";
    $result2 = $conn->query($sql2);
	  if($result2->num_rows > 0) 
	  {
	    	$row = $result2->fetch_assoc();
	    	$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$age = $row['age'];
			$address = $row['address'];
			$domisili = $row['domisili'];
			$nama_sekolah = $row['nama_sekolah'];
			$jenjang = $row['jenjang'];
			$jurusan = $row['jurusan'];
			$nilai = $row['nilai'];
	   }
	   
	    //data company
	$sql3 = "SELECT * FROM company WHERE id_company='$id_company' ";
    $result3 = $conn->query($sql3);
	  if($result3->num_rows > 0) 
	  {
	    	$row = $result3->fetch_assoc();
	    	
			$companyname = $row['companyname'];
	   }
				
    if($result1->num_rows == 0) {  
    	
    	$sql = "INSERT INTO apply_job_post(id_jobpost, id_company, id_user) VALUES ('$_GET[id]', '$id_company', '$_SESSION[id_user]')";
		//data confirmasi to candidate
				if($id_company==1){
					$mail_id='recruitmentameyaindo@gmail.com';
				}else{
					$mail_id='recruitmentanggunkreasi@gmail.com';
				}
					//echo print_r($email_id);
			//exit;
				$email=  $mail_id;
				//echo print_r($email_id);
			//exit;
                $subject = 'Ameya | Recruitment Portal -Candidat:'.$firstname.' '.$lastname.' | Posisi:'.$jobtitle .'';
                $msg =' 
 
				Dear '.$companyname.'
				Dibawah ini data pelamar.
				
				------------------------
				Nama: '.$firstname.' '.$lastname.'
				Alamat: '.$address.' 
				Domisili: '.$domisili.' 
				
				Pendidikan: '.$nama_sekolah.' 
				Jurusan: '.$jenjang.'-'.$jurusan.' 
				Nilai: '.$nilai.' 
				Umur: '.$age.' 
				
				Posisi yang dipilih: '.$jobtitle.' 
				 ------------------------
				 
				Silahkan login / klik tautan dibawah ini untuk proses lebih lanjut:
				http://recruitment.ameyaindo.com/login-company.php
				 
				';	
			//echo print_r($msg);
			//exit;
			mail($email,$subject,$msg);  	
			
		
		if($conn->query($sql)===TRUE) {
			
			
			$_SESSION['jobApplySuccess'] = true;
			header("Location: user/index.php");
			exit();
		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

    }  else {
		header("Location: jobs.php");
		exit();
	}
	

} else {
	header("Location: jobs.php");
	exit();
}