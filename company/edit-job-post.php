<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");
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

  <script>tinymce.init({ selector:'#description', height: 300 });</script>
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
                  <li class="active"><a href="edit-company.php"><i class="fa fa-tv"></i> My Company</a></li>
                  <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Create Job Post</a></li>
                  <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> My Job Post</a></li>
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
            <h2><i>Edit Job Post</i></h2>
            <p>In this section you can change your job post</p>
            <div class="row">
              <form action="update-post.php" method="post" enctype="multipart/form-data">
			  
                <?php
				$sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
                
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-6 latest-job ">
				 <input type="hidden" id="id_jobpost" name="id_jobpost" value="<?php echo $row['id_jobpost']; ?>"  class="form-control input-lg">
                  <div class="form-group">
                     <label>Job Title</label>
                    <input type="text" class="form-control input-lg" name="jobtitle" value="<?php echo $row['jobtitle']; ?>">
                  </div>
                   <div class="form-group">
					<label for="contactno">Minimum Salary</label>
                    <input type="number" class="form-control input-lg" id="minimumsalary" name="minimumsalary" placeholder="Minimum Salary" value="<?php echo $row['minimumsalary']; ?>">
                  </div>
				  <div class="form-group">
					<label for="contactno">Maximum Salary</label>
                    <input type="number" class="form-control input-lg" id="maximumsalary" name="maximumsalary" placeholder="Maximum Salary" value="<?php echo $row['maximumsalary']; ?>">
                  </div>
                </div>
                <div class="col-md-6 latest-job ">
                <div class="form-group">
					<label for="contactno">Experience</label>
                    <input type="number" class="form-control input-lg" id="experience" name="experience" placeholder="Experience (in Years) Required" value="<?php echo $row['experience']; ?>">
                  </div>
                  <div class="form-group">
				   <label>Qualification Required</label>
                    <textarea class="form-control input-lg" rows="4" name="qualification"><?php echo $row['qualification']; ?></textarea>
                  </div>  
				</div>
				<div class="col-md-12">
				<div class="form-group">
				   <label>Job Description</label>
                    <textarea class="form-control input-lg" rows="4" id="description" name="description" placeholder="Job Description"> <?php echo stripcslashes($row['description']); ?></textarea>
                  </div>
				 <div class="form-group">
                    <button type="submit" name='kirim' class="btn btn-flat btn-success">Update Job</button>
                  </div>
				
				</div>
				
                    <?php
                    }
                  }
                ?>  
              </form>
            </div>
            <?php if(isset($_SESSION['uploadError'])) { ?>
            <div class="row">
              <div class="col-md-12 text-center">
                <?php echo $_SESSION['uploadError']; ?>
              </div>
            </div>
            <?php unset($_SESSION['uploadError']); } ?>
            
          </div>
        </div>
      </div>
    </section>

    

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
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
</body>
</html>
