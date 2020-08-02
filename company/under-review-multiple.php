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

$id_jobpost= $_POST['id_jobpost'];

$sql = "SELECT * FROM apply_job_post WHERE id_company='$_SESSION[id_company]' AND id_jobpost='$id_jobpost'";
$result = $conn->query($sql);
//echo print_r($sql);
//		exit;
if($result->num_rows == 0) 
{
 header("Location: index.php");
 exit();
}

$id_user = $_POST['pilih'];
$jumlah_dipilih = count($id_user);

for($x=0;$x<$jumlah_dipilih;$x++){

$sql = "UPDATE apply_job_post SET status='2' WHERE id_company='$_SESSION[id_company]' AND id_jobpost='$id_jobpost' and id_user='".$id_user[$x]."'";

$result = $conn->query($sql);

}
header("Location: job-applications.php");
exit();

?>