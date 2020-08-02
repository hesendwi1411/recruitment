<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter view-job-post.php in URL.
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files  
require_once("../db.php");
if(isset($_POST)) {
$isi_email = $_POST['isi_email'];
//echo print_r($isi_email);
			//exit;
$email_id=$_GET['email'];

$sql = "SELECT * FROM apply_job_post WHERE id_company='$_SESSION[id_company]' AND id_user='$_GET[id]' AND id_jobpost='$_GET[id_jobpost]'";
$result = $conn->query($sql);
if($result->num_rows == 0) 

{
  header("Location: index.php");
  exit();
}

						$email=  $email_id;
                        $subject = "Ameya | Recruitment Portal - Undangan Wawancara";
                        $msg =$isi_email;

mail($email,$subject,$msg);
//echo print_r($_GET[id_jobpost]);
//				exit;
$sql = "UPDATE apply_job_post SET status='3' WHERE id_company='$_SESSION[id_company]' AND id_user='$_GET[id]' AND id_jobpost='$_GET[id_jobpost]'";
if($conn->query($sql) === TRUE) {
	header("Location: job-applications.php");
	exit();
}
} else {
	//redirect them back to dashboard page if they didn't click Add Post button
	header("Location: index.php");
	exit();
}
?>