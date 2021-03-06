<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked register button
if(isset($_POST)) {

	//Data pribadi
	$firstname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lname']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$domisili = mysqli_real_escape_string($conn, $_POST['domisili']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$no_ktp = mysqli_real_escape_string($conn, $_POST['no_ktp']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
	$skills = mysqli_real_escape_string($conn, $_POST['skills']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	
	//Data Pendidikan
	$nama_sekolah = mysqli_real_escape_string($conn, $_POST['nama_sekolah']);
	$jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
	$jenjang = mysqli_real_escape_string($conn, $_POST['jenjang']);
	$nilai = mysqli_real_escape_string($conn, $_POST['nilai']);
	$tgl_masuk = mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
	$tgl_lulus = mysqli_real_escape_string($conn, $_POST['tgl_lulus']);


	//Data Pengalaman kerja
	$nama_perusahaan = mysqli_real_escape_string($conn, $_POST['nama_perusahaan']);
	$jabatan = mysqli_real_escape_string($conn, $_POST['jurusan']);
	$gaji = mysqli_real_escape_string($conn, $_POST['jenjang']);
	$tgl_masuk_kerja = mysqli_real_escape_string($conn, $_POST['tgl_masuk_kerja']);
	$tgl_keluar_kerja = mysqli_real_escape_string($conn, $_POST['tgl_keluar_kerja']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$detail = mysqli_real_escape_string($conn, $_POST['detail']);
	$alasan_keluar = mysqli_real_escape_string($conn, $_POST['alasan_keluar']);
	
	
	
	
	
	
	
	
	
	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	//sql query to check if email already exists or not
	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = $conn->query($sql);

	//if email not found then we can insert new data
	if($result->num_rows == 0) {

			//This variable is used to catch errors doing upload process. False means there is some error and we need to notify that user.
	$uploadOk = true;

	//Folder where you want to save your resume. THIS FOLDER MUST BE CREATED BEFORE TRYING
	$folder_dir = "uploads/resume/";

	//Getting Basename of file. So if your file location is Documents/New Folder/myResume.pdf then base name will return myResume.pdf
	$base = basename($_FILES['resume']['name']); 

	//This will get us extension of your file. So myResume.pdf will return pdf. If it was resume.doc then this will return doc.
	$resumeFileType = pathinfo($base, PATHINFO_EXTENSION); 

	//Setting a random non repeatable file name. Uniqid will create a unique name based on current timestamp. We are using this because no two files can be of same name as it will overwrite.
	$file = uniqid() . "." . $resumeFileType;   

	//This is where your files will be saved so in this case it will be uploads/resume/newfilename
	$filename = $folder_dir .$file;  

	//We check if file is saved to our temp location or not.
	if(file_exists($_FILES['resume']['tmp_name'])) { 

		//Next we need to check if file type is of our allowed extention or not. I have only allowed pdf. You can allow doc, jpg etc. 
		if($resumeFileType == "pdf")  {

			//Next we need to check file size with our limit size. I have set the limit size to 5MB. Note if you set higher than 2MB then you must change your php.ini configuration and change upload_max_filesize and restart your server
			if($_FILES['resume']['size'] < 500000) { // File size is less than 5MB

				//If all above condition are met then copy file from server temp location to uploads folder.
				move_uploaded_file($_FILES["resume"]["tmp_name"], $filename);

			} else {
				//Size Error
				$_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
				$uploadOk = false;
			}
		} else {
			//Format Error
			$_SESSION['uploadError'] = "Wrong Format. Only PDF Allowed";
			$uploadOk = false;
		}
	} else {
			//File not copied to temp location error.
			$_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
			$uploadOk = false;
		}

	//If there is any error then redirect back.
	if($uploadOk == false) {
		header("Location: register-candidates.php");
		exit();
	}

		$hash = md5(uniqid());


		//sql users
		$sql = "INSERT INTO users(firstname, lastname, email, password, address, city, state, contactno, no_ktp,  dob, age,  resume, hash, aboutme, skills,domisili) VALUES ('$firstname', '$lastname', '$email', '$password', '$address', '$city', '$state', '$contactno',  '$no_ktp', '$dob', '$age', '$file', '$hash', '$aboutme', '$skills', '$domisili');";
		
		$sql .= "INSERT INTO pendidikan (nama_sekolah,jurusan, nilai,jenjang,tgl_masuk,tgl_lulus,no_ktp) VALUES ('$nama_sekolah', '$jurusan', '$nilai','$jenjang','$tgl_masuk','$tgl_lulus','$no_ktp');";
		
		$sql .= "UPDATE pendidikan,users SET pendidikan.id_user=users.id_user WHERE users.no_ktp='$no_ktp' and users.email='$email';";
	
		$sql .= "INSERT INTO pengalaman_kerja (nama_perusahaan,jabatan, gaji,detail,tgl_masuk,tgl_keluar,alasan_keluar,experience,no_ktp) VALUES ('$nama_perusahaan', '$jabatan', '$gaji','$detail','$tgl_masuk_kerja','$tgl_keluar_kerja','$alasan_keluar','$experience','$no_ktp');";
		
		$sql .= "UPDATE pengalaman_kerja,users SET pengalaman_kerja.id_user=users.id_user WHERE users.no_ktp='$no_ktp' and users.email='$email'";
		
		
		//Update User Details Query
		//				$sSql = "UPDATE pendidikan SET id_user='54' WHERE no_ktp='$no_ktp'";
	//if($conn->query($sSql) === true) {
		//header("Location: index.php");
		//exit();
	//} else {
	//	echo $conn->error;
	//}	

		
		
		if($conn->multi_query($sql)===TRUE ) {
			
			
			
			require('phpmailer/classes/class.phpmailer.php');
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = TRUE;
			$mail->SMTPSecure = "";
			$mail->Port     = 587;  
			$mail->Username = "hesen@ameyaindo.com";
			$mail->Password = "yatmmiko";
			$mail->Host     = "lokal.ameyaindo.com";
			$mail->Mailer   = "smtp";
			$mail->SetFrom("hesen@ameyaindo.com", "Ameya | Recruitment Portal");
			//$mail->AddReplyTo("from email", "Infokoding");
			$to = $email; $mail->AddAddress($to);
			$mail->Subject = "Ameya | Recruitment Portal - Confirm Your Email Address";
			$mail->WordWrap   = 80;
			$message = '
 
				Thanks for signing up! <br>
				Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. <br>
				 
				------------------------<br>
				Username: '.$email.'<br>
				Password: '.$password.' <br>
				------------------------<br>
				 
				Please click this link to activate your account:<br>
				http://localhost/recruitment/verify.php?email='.$email.'&hash='.$hash.'
				 
				'; // Our message above including the link
									 
				$mail->MsgHTML($message);
			
			$mail->IsHTML(true);
			
			
			if(!$mail->Send()) 
			echo "Problem sending email.";
			else 
			echo "email sent.";
		
			
		
			 if($result === TRUE) {

			 	//If data inserted successfully then Set some session variables for easy reference and redirect to login
				$_SESSION['registerCompleted'] = true;
			 	header("Location: login.php");
				exit();

			 }

			 //If data inserted successfully then Set some session variables for easy reference and redirect to login
			$_SESSION['registerCompleted'] = true;
			header("Location: login-candidates.php");
			exit();
		} else {
			//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//if email found in database then show email already exists error.
		$_SESSION['registerError'] = true;
		header("Location: register-candidates.php");
		exit();
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to register page if they didn't click register button
	header("Location: register-candidates.php");
	exit();
}