<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter view-job-post.php in URL.
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
                  <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> My Job Post</a></li>
                  <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Job Application</a></li>
                  <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                  <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                  <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
				  <li class="active"><a href="karyawan.php"><i class="fa fa-chain"></i> Employee Database</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
            <h2><i>Employee Database</i></h2>
            <p>In this section you can edit database employee and print form karyawan</p>
            <div class="row margin-top-20">
              <div class="col-md-12">
                <div class="box-body table-responsive no-padding">
                  <table id="example2" class="table table-hover">
                    <thead>
					<tr>
                      <th>No KTP</th>
					  <th>Nama</th>
					  <th>Agama</th>
						<th>JK</th>
						
						<th>No Telp / HP</th>
						<th>Alamat</th>
						<th>Provinsi</th>
						<th>Kabupaten</th>
                      <th>Aksi</th>
					  </tr>
                    </thead>
                    <tbody>
                    <?php
					 $id_company=$_SESSION['id_company'];
                       $sql = "SELECT * FROM karyawan WHERE location='$id_company' ";
                            $result = $conn->query($sql);

                            if($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) 
                              {     

                               // $skills = $row['skills'];
                               // $skills = explode(',', $skills);
                      ?>
                      <tr>
                        
						<td><?php echo $row['no_ktp']; ?></td>
						<td><?php echo $row['nama']; ?></td>
						<td><?php echo $row['agama']; ?></td>
						<td><?php echo $row['jk']; ?></td>
						<td><?php echo $row['contactno']; ?></td>						
						<td><?php echo $row['address']; ?></td>								
                        <td><?php echo $row['provinsi']; ?></td>
                        <td><?php echo $row['kabupaten']; ?></td>
						<td>
						<a class="btn" data-toggle="modal" data-target="#ModalCetak<?php echo $row['no_ktp'] ?>"><span class="glyphicon glyphicon-print"></span></a>
						</td>
                      </tr>
					  <!--Modal Edit Pengguna-->
        <div class="modal fade" id="ModalCetak<?php echo $row['no_ktp'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                                          
					
															
							<div class="col-md-6 latest-job ">
									 <div class="form-group">
										<label>No KTP</label>
										<input class="form-control input-lg" type="text" minlength="16"  id="xno_ktp" name="xno_ktp"  value="<?php echo $row['no_ktp']; ?>" disabled>
									  </div>
									  <div class="form-group">
									  <label>Nama</label>
										<input class="form-control input-lg" type="text" id="xnama" name="xnama" value="<?php echo $row['nama']; ?>"  disabled>
									  </div>
									  
									  <div class="form-group">
										<label>Alamat</label>
										<textarea class="form-control input-lg" rows="4" name="xaddress" disabled><?php echo $row['address']; ?></textarea>
									  </div>
									   <div class="form-group">
									   <label>Jenis Kelamin</label>
										<input class="form-control input-lg" type="text" id="xjk" name="xjk"  value="<?php echo $row['jk']; ?>"  disabled>
									  </div>
																
							</div>	

								<div class="col-md-6 latest-job ">
										
										<h2><i>Informasi data darurat</i></h2>
										
																	  <div class="form-group">
																		 <label>Nama kerabat</label>
																		<input type="text" class="form-control input-lg" id="xnama_kerabat" name="xnama_kerabat" value="<?php echo $row['nama_kerabat']; ?>"  disabled>
																	  </div>
																	  <div class="form-group">
																		 <label>Hubungan kekerabatan</label>
																		<input type="text" class="form-control input-lg" id="xhubungan_kerabat" name="xhubungan_kerabat" value="<?php echo $row['hubungan_kerabat']; ?>"  disabled>
																	  </div>
																		
																		<div class="form-group">
																		 <label>Nomor  HP/TLP </label>
																		<input type="text" class="form-control input-lg" id="xcontactno_kerabat" name="xcontactno_kerabat" value="<?php echo $row['contactno_kerabat']; ?>"  disabled>
																	  </div>
																	  
																		<form method="get" action="../laporan/f_biodatakaryawan.php" target="_blank">									
																		 <div class="form-group">
																		
																			<input type="hidden" name="no_ktp" value="<?php echo $row['no_ktp']?>">
																			<input type="hidden" name="location" value="<?php echo $row['location']?>">
																			<input type="hidden" name="nama" value="<?php echo $row['nama']?>">
																			<button class="btn btn-flat btn-success glyphicon glyphicon-print" >Cetak</button>
																		  </div>
																		 </form> 
								</div>
										  </div>
											
					</div>
                </div>
            </div>
        </div>
						
                      <?php

                        }
                      }
                      ?>
					
							
						</div>
                    </tbody>                    
                  </table>
                </div>
              </div>
            </div>
            
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
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>


<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
  });
</script>
</body>
</html>
