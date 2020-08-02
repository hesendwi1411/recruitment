<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//if user Actually clicked update profile button
if(isset($_POST['kirim'])) {

	//Escape Special Characters
	
	$id_jobpost = mysqli_real_escape_string($conn, $_POST['id_jobpost']);
	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary = mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	
	//Update User Details Query
	

	$sql =mysqli_query($conn, "UPDATE job_post SET jobtitle='$jobtitle', description='$description', minimumsalary='$minimumsalary', maximumsalary='$maximumsalary', experience='$experience', qualification='$qualification' WHERE id_jobpost='$id_jobpost'");
	
	header('location:../company/edit-job-post.php?id='.$id_jobpost);
						
	
	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click update button
	header("Location: edit-job-post.php");
	exit();
}
 ?> 