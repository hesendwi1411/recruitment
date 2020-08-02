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

$sql = "SELECT * FROM apply_job_post WHERE id_company='$_SESSION[id_company]' AND id_user='$_GET[id]'";
$result = $conn->query($sql);
if($result->num_rows == 0) 
{
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ameya | Recruitment Portal</title>
  <link rel="shoutcut icon" href="../favicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<script src="../js/tinymce/tinymce.min.js"></script>

  <script>tinymce.init({
entity_encoding : "raw"
  selector:'#isi_email', height: 300 });</script>
 
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
     <a href="index.php" class="logo logo-bg"><img src="../img/ameyalogo-220x49.png" alt="ameyalogo">
	
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>G</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Ameya</b> Group</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                  
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="edit-company.php"><i class="fa fa-tv"></i> My Company</a></li>
                  <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Create Job Post</a></li>
                  <li class="active"><a href="my-job-post.php"><i class="fa fa-file-o"></i> My Job Post</a></li>
                  <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Job Application</a></li>
                  <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                  <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                  <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <div class="row margin-top-20">
              <div class="col-md-12">
              <?php
			
			  $sql = "SELECT * FROM users LEFT JOIN pendidikan ON  users.id_user=pendidikan.id_user LEFT JOIN pengalaman_kerja ON users.id_user=pengalaman_kerja.id_user WHERE  users.id_user='$_GET[id]'";
			  
                
				$result = $conn->query($sql);

                //If Job Post exists then display details of post
                if($result->num_rows > 0) { 
                  while($row = $result->fetch_assoc()) 
                  {
                ?>
				
                <div class="pull-left">
                  <h2><b><i><?php echo $row['firstname']. ' '.$row['lastname']; ?></i></b></h2>
                </div>
                <div class="pull-right">
                  <a href="job-applications.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-left"></i> Back</a>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div>
                  <?php
                    echo 'Email: '.$row['email'];
                    echo '<br>';
					echo 'Name: '.$row['firstname'].' '.$row['lastname'];
                    echo '<br>';
					 echo 'Age: '.$row['age'];
                    echo '<br>';
					echo 'Alamat: '.$row['address'];
                    echo '<br>';
					echo 'Domisili: '.$row['domisili'];
                    echo '<br>';
                    echo 'City: '.$row['city'];
					echo '<br>';
                
				
					echo '<br>';
					echo '-----INFORMASI PENDIDIKAN-----';
					echo '<br>';
					echo 'Nama Sekolah: '.$row['jenjang'].'-'.$row['nama_sekolah'];
                    echo '<br>';
					echo 'Jurusan: '.$row['jurusan'];
                    echo '<br>';
					echo 'Nilai/IPK: '.$row['nilai'];
					echo '<br>';
					
					echo '<br>';
					echo '-----INFORMASI PENGALAMAN KERJA-----';
					echo '<br>';
					echo 'Nama perusahaan: '.$row['jenjang'].'-'.$row['nama_perusahaan'];
                    echo '<br>';
					echo 'Jabatan: '.$row['jabatan'];
                    echo '<br>';
					
                    if($row['resume'] != "") {
                      echo '<a href="../uploads/resume/'.$row['resume'].'" class="btn btn-info" download="'.$row['firstname'].' - Resume">Download Resume</a>';
					  
                    }
                    echo '<br>';
                    echo '<br>';
                    echo '<br>';
                    echo '<br>';
                  ?>
				  
				  
				  
				  
                  <div class="row">
                    <div class="pull-left">
                      <a href="under-review.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $_GET['id_jobpost']; ?>" class="btn btn-success">Mark Under Review</a>&nbsp &nbsp  
                    </div> 
					<div class="pull-left">
                     <!--  <a href="wawancara.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $_GET['id_jobpost']; ?>" class="btn btn-warning">Wawancara</a>&nbsp &nbsp -->
					  
					  <a class="btn btn-warning"" data-toggle="modal" data-target="#myModal">Wawancara</a>&nbsp &nbsp 
                    </div>
                    <div class="pull-left">
                      <a href="reject.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $_GET['id_jobpost']; ?>" class="btn btn-danger">Reject Application</a>&nbsp &nbsp
                    </div>
                  </div>
                </div>

				
                <div>
                </div>
                <?php
                  }
                }
                ?>
              </div>
            </div>
            
          </div>
        </div>
      </div>
	  
    </section>
	
	<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
	<?php
			
			  $sql = "SELECT * FROM users LEFT JOIN pendidikan ON  users.id_user=pendidikan.id_user LEFT JOIN pengalaman_kerja ON users.id_user=pengalaman_kerja.id_user WHERE  users.id_user='$_GET[id]'";
			  
                
				$result = $conn->query($sql);

                //If Job Post exists then display details of post
                if($result->num_rows > 0) { 
                  while($row = $result->fetch_assoc()) 
                  {
                ?>	
      <!-- Modal content-->
      <div class="modal-content">
	     <form action="wawancara.php?id=<?php echo $_GET['id']; ?>&id_jobpost=<?php echo $_GET['id_jobpost']; ?>&email_id=<?php echo $row['email']; ?>" method="post">	
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Undangan Kepada Kandidat</h4>
        </div>
		
		
			
        <div class="modal-body">
		
		
			<div class="form-group">
				
					
					
				   <label></label>
                    <textarea class="form-control input-lg" rows="4" id="isi_email" name="isi_email"  > Dear  <b><?php echo stripcslashes($row['firstname'].' '.$row['lastname']); ?> </b><br />  <br />
					
					PT. Ameya Livingstyle Indonesia is one of garment manufacture in Yogyakarta that has been successfully. We continuously grow and consistent to put our value as a key of success. New branch, named PT Anggun Kreasi Garmen, has been developed since 2015. Now, We invite you to do some recruitment processes in PT Ameya Living Style Indonesia, on: <br/> <br/>
					Day / Date    : <b> </b><br/>
					Time                : <b> </b><br/>
					Location       : PT Ameya Livingstyle Indonesia, Gupakwarak, Sendangsari, Pajangan, Bantul, DI Yogyakarta<br/><br/>

					(If you come from Masjid Agung Bantul, you can go to the west until find  Bantul Jail. Then, go straight to the west approximately 1.5 km (until meet cross junction or SD Beji on your left or BNI ATM sign in the corner), then turn right. PT  Ameya was on your right.<br/>
					Agenda        : Interview <br/>
					Need           : <b>Please bring your personal file (CV, copy of KTP, graduation certificate, packlaring letter, latest salary slip, etc)</b><br/>
					Hope you will come to do this test on that day. <br/><br/>
					
					<b>Note :</b><br/>
					-   If you have trouble in finding the location, you can use GPS application by using your smartphone (we suggest you to pass Jl. Pemuda)<br/>
					<b>-   Please inform  your confirmation by reply this email or send sms / whatsapp to +62 87786582399 (format: Name_ (Position)_YES/NO). You can also asking reschedule if needed.</b><br/>
					-   Attached Form Application that need to fill. Please complete it and send back to us or bring at the time of interview</b><br/><br/><br/>
					
					
					Thanks <br/>
					Best regards<br/>
					HRD - Recruitment<br/>
							
					
					</textarea>
					
                  </div>
		
		
        </div>
		
        <div class="modal-footer">
			
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  <button type="submit" class="btn btn-default" id="kirim">KIRIM</button>

        </div>
		</form>
      </div>
      <?php
                  }
                }
                ?>
				
    </div>
  </div>
   

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2018 <a href="learningfromscratch.online">Ameya | Recruitment Portal</a>.</strong> All rights
    reserved.
    </div>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>

</body>
</html>
