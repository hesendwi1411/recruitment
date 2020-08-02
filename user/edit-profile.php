<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if(empty($_SESSION['id_user'])) {
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
          <li>
            <a href="../jobs.php">Jobs</a>
          </li>       
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
                  <li class="active"><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                  <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                  <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Jobs</a></li>
                  <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                  <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 bg-white padding-2">
			<ul class="nav nav-tabs">
					
						<li class="active"><a href="#tabProfile" data-toggle="tab"><span class="fa fa-id-badge"></span> Profile</a></li>
						<li><a href="#tabPendidikan" data-toggle="tab"><span class="fa fa-hourglass"></span> Data Pendidikan</a></li>
						
						<li><a href="#tabPengalaman" data-toggle="tab"><span class="fa fa-hourglass-o"></span> Data Pengalaman Kerja</a></li>
                          
                        <li><a href="#"><span class="fa fa-close"></span> Exit</a></li>
				</ul>
		  
					<div class="tab-content">
					  <!-- Tab Profile-->
							<div class="tab-pane active" id="tabProfile">
						
							 <h2><i>Edit Profile</i></h2>
									<form action="update-profile.php" method="post" enctype="multipart/form-data">
									<?php
									
									//Sql to get logged in user details.
									$sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
									$result = $conn->query($sql);

									//If user exists then show his details.
									if($result->num_rows > 0) {
									  while($row = $result->fetch_assoc()) {
									?>
									  <div class="row">
										<div class="col-md-6 latest-job ">
										  <div class="form-group">
											 <label for="fname">First Name</label>
											<input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="First Name" value="<?php echo $row['firstname']; ?>" required="">
										  </div>
										  <div class="form-group">
											<label for="lname">Last Name</label>
											<input type="text" class="form-control input-lg" id="lname" name="lname" placeholder="Last Name" value="<?php echo $row['lastname']; ?>" required="">
										  </div>
										  
										  <div class="form-group">
											<label for="contactno">No Identitas</label>
											<input type="text" class="form-control input-lg" id="no_ktp" name="no_ktp" placeholder="No KTP" value="<?php echo $row['no_ktp']; ?>">
										  </div>
										  <div class="form-group">
												  <label for="inputText">Status</label>
											<div class="controls">
												<select name="status" class="form-control" style="width:150px;" tabindex="2" required>
												   
													<?php
													$belumkawin="";$kawin="";$cerai="";$janda_duda="";$hidup_bersama="";$kosong="";
													if($device==""){$belumkawin="";$kawin="";$cerai="";$janda_duda="";$hidup_bersama="";$kosong='selected="selected"';}
													else if($device=="Belum Kawin"){$belumkawin='selected="selected"';$kawin="";$cerai="";$janda_duda="";$hidup_bersama="";$kosong="";}
													else if($device=="Kawin"){$belumkawin="";$kawin='selected="selected"';$cerai="";$janda_duda="";$hidup_bersama="";$kosong="";}
													else if($device=="Cerai"){ $belumkawin="";$kawin="";$cerai='selected="selected"';$janda_duda="";$hidup_bersama="";$kosong=""; }
													else if($device=="Janda / Duda"){$belumkawin="";$kawin="";$cerai="";$janda_duda='selected="selected"';$hidup_bersama="";$kosong="";}
													else if($device=="Hidup Bersama"){$belumkawin="";$kawin="";$cerai="";$janda_duda="";$hidup_bersama='selected="selected"';$kosong="";}
													
													?>
													<option value="<?php echo $row['status']; ?>" selected><?php echo $row['status'];?></option> 
													
													<option value="Belum Kawin" <?php echo $belumkawin; ?>>Belum Kawin</option>
													<option value="Kawin" <?php echo $kawin; ?>>Kawin</option>
													<option value="Cerai" <?php echo $cerai; ?>>Cerai</option>
													<option value="Janda / Duda" <?php echo $janda_duda; ?>>Janda / Duda</option>
													<option value="Hidup Bersama" <?php echo $hidup_bersama; ?>>Hidup Bersama</option>
													
													
												</select>
											</div>
										  
										 </div> 
										  
										  <div class="form-group">
											<label for="email">Email address</label>
											<input type="email" class="form-control input-lg" id="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
										  </div>
										  <div class="form-group">
											<label for="address">Address</label>
											<textarea id="address" name="address" class="form-control input-lg" rows="5" placeholder="Address"><?php echo $row['address']; ?></textarea>
										  </div>
										  <div class="form-group">
											<label for="address">Domisili</label>
											<textarea id="address" name="domisili" class="form-control input-lg" rows="5" placeholder="Domisili"><?php echo $row['domisili']; ?></textarea>
										  </div>
										  <div class="form-group">
											<label for="city">City</label>
											<input type="text" class="form-control input-lg" id="city" name="city" value="<?php echo $row['city']; ?>" placeholder="city">
										  </div>
										  <div class="form-group">
											<label for="state">State</label>
											<input type="text" class="form-control input-lg" id="state" name="state" placeholder="state" value="<?php echo $row['state']; ?>">
										  </div>
										  <div class="form-group">
											<button type="submit" class="btn btn-flat btn-success">Update Profile</button>
										  </div>
										</div>
										<div class="col-md-6 latest-job ">
										  <div class="form-group">
											<label for="contactno">Tempat Lahir</label>
											<input type="text" class="form-control input-lg" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat kelahiran" value="<?php echo $row['tempat_lahir']; ?>">
										  </div>
										  
										 <div class="form-group">
												  <label for="inputText">Jenis Kelamin</label>
											<div class="controls">
												<select name="jk" class="form-control" style="width:150px;" tabindex="2" required>
												   
													<?php
													$laki_laki="";$perempuan="";$kosong="";
													if($device==""){$laki_laki="";$perempuan="";$kosong='selected="selected"';}
													else if($device=="Laki-Laki"){$laki_laki='selected="selected"';$perempuan="";$kosong="";}
													else if($device=="Perempuan"){$laki_laki="";$perempuan='selected="selected"';$kosong="";}
													
													?>
													<option value="<?php echo $row['jk']; ?>" selected><?php echo $row['jk'];?></option> 
													
													<option value="Laki-Laki" <?php echo $laki_laki; ?>>Laki-Laki</option>
													<option value="Perempuan" <?php echo $perempuan; ?>>Perempuan</option>
													
													
													
												</select>
											</div>
										  
										 </div> 
										  
										   <div class="form-group">
										  <label class="control-label" for="inputText">Agama</label>
											<div class="controls">
											<select name="agama" class="form-control" style="width:150px;" tabindex="2" required>
													   
													<?php
													$islam="";$kristen="";$katolik="";$hindu="";$buddha="";$kong_hu_cu="";$kosong="";
													if($device==""){$islam="";$kristen="";$katolik="";$hindu="";$buddha="";$kong_hu_cu="";$kosong='selected="selected"';}
													else if($device=="Islam"){ $islam='selected="selected"';$kristen="";$katolik="";$hindu="";$buddha="";$kong_hu_cu="";$kosong="";}
													else if($device=="Kristen"){$islam="";$kristen='selected="selected"';$katolik="";$hindu="";$buddha="";$kong_hu_cu="";$kosong="";}
													else if($device=="Katolik"){ $islam="";$kristen="";$katolik='selected="selected"';$hindu="";$buddha="";$kong_hu_cu="";$kosong=""; }
													else if($device=="Hindu"){ $islam="";$kristen="";$katolik="";$hindu='selected="selected"';$buddha="";$kong_hu_cu="";$kosong=""; }
													else if($device=="Buddha"){ $islam="";$kristen="";$katolik="";$hindu="";$buddha='selected="selected"';$kong_hu_cu="";$kosong=""; }
													else if($device=="Kong Hu Cu"){ $islam="";$kristen="";$katolik="";$hindu="";$buddha="";$kong_hu_cu='selected="selected"';$kosong=""; }
													?>
													 
													
													<option value="<?php echo $row['agama']; ?>" selected><?php echo $row['agama'];?></option>
													<option value="Islam" <?php echo $islam; ?>>Islam</option>
													<option value="Kristen" <?php echo $kristen; ?>>Kristen</option>
													<option value="Katolik" <?php echo $katolik; ?>>Katolik</option>
													<option value="Hindu" <?php echo $hindu; ?>>Hindu</option>
													<option value="Buddha" <?php echo $buddha; ?>>Buddha</option>
													<option value="Kong Hu Cu" <?php echo $kong_hu_cu; ?>>Kong Hu Cu</option>
													
													
												</select>
											</div>
								 </div> 		  
										  
										  
										  
										  
										  
										  
										  
										  <div class="form-group">
											<label for="contactno">Tanggal Lahir</label>
											<input type="date" class="form-control input-lg" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" value="<?php echo $row['tgl_lahir']; ?>">
										  </div>
										
										  <div class="form-group">
											<label for="contactno">Contact Number</label>
											<input type="text" class="form-control input-lg" id="contactno" name="contactno" placeholder="Contact Number" value="<?php echo $row['contactno']; ?>">
										  </div>
										
										  <div class="form-group">
											<label for="stream">Kewarganegaraan</label>
											<input type="text" class="form-control input-lg" id="kewarganegaraan" name="kewarganegaraan" placeholder="Ex. Indonesia" value="<?php echo $row['kewarganegaraan']; ?>">
										  </div>
										  <div class="form-group">
											<label>Skills</label>
											<textarea class="form-control input-lg" rows="4" name="skills"><?php echo $row['skills']; ?></textarea>
										  </div>
										  <div class="form-group">
											<label>About Me</label>
											<textarea class="form-control input-lg" rows="4" name="aboutme"><?php echo $row['aboutme']; ?></textarea>
										  </div>
										  <div class="form-group">
											<label>Upload/Change Resume</label>
											<input type="file" name="resume" class="btn btn-default">
										  </div>
										</div>
									  </div>
									  <?php
										}
									  }
									?>   
									</form>
									<?php if(isset($_SESSION['uploadError'])) { ?>
									<div class="row">
									  <div class="col-md-12 text-center">
										<?php echo $_SESSION['uploadError']; ?>
									  </div>
									</div>
									<?php } ?>
						
							</div>
						
						
					<!-- Tab Pendidikan-->
					<div class="tab-pane" id="tabPendidikan">
							<div class="control-group">
								<h2><i>Edit Data Pendidikan</i></h2>
								<button class="btn btn-info" data-toggle="tab" href="#addPendidikan"><i class="icon-chevron-right icon-white"></i> Tambah Data Pendidikan</button>
								<table class="table table-bordered table-striped">
								<caption> Data Pendidikan</caption>
								<thead>
								<tr>
									<th>#</th>
									<th align="center">Nama Sekolah</th>
									<th align="center">Jenjang</th>
									<th align="center">Jurusan</th>
									<th align="center">Nilai / IPK</th>
									<th align="center">Tgl Masuk</th>
									<th align="center">Tgl Lulus</th>
									
									<th></th>
								</tr>
								</thead>
								<tbody>
							<?php
								
								$query=mysqli_query($conn,"SELECT * FROM pendidikan WHERE id_user='$_SESSION[id_user]' ORDER BY id_pendidikan DESC");
								$no=1;
								while($rpendidikan=mysqli_fetch_array($query)){
							?>
								<tr>
									<td><?php echo $no; ?></td>    
									<td><?php echo $rpendidikan['nama_sekolah']; ?></pre></td>    
									<td><?php echo $rpendidikan['jenjang']; ?></pre></td>    
									<td><?php echo$rpendidikan['jurusan']; ?></pre></td>    
									<td><?php echo $rpendidikan['nilai']; ?></td>    
									<td><?php echo $rpendidikan['tgl_masuk']; ?></td>    
									<td><?php echo $rpendidikan['tgl_lulus']; ?></td>
									
									<td><a href="delete-pendidikan.php?id=<?php echo $rpendidikan['id_pendidikan']; ?>"><i class="fa fa-trash"></i></a></td>
								</tr>
							<?php
									$no++;
								}
							?>
							</tbody>
								</table>
							</div>
							
					</div>
				  <!-- Add Pendidikan-->
							<div class="tab-pane" id="addPendidikan">
							
							<?php
									
									//Sql to get logged in user details.
									$sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
									$result = $conn->query($sql);

									//If user exists then show his details.
									if($result->num_rows > 0) {
									  while($row = $result->fetch_assoc()) {
									?>
							 <h2><i>Data Pendidikan</i></h2>
									<form action="add-pendidikan.php" method="post" enctype="multipart/form-data">
									
									  <div class="row">
										<div class="col-md-6 latest-job ">
										  <div class="form-group">
											 <label for="fname">Nama Sekolah</label>
											<input type="text" class="form-control input-lg" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah / Universitas" value="<?php echo $rpendidikan['nama_sekolah']; ?>" required="">
										  <input type="hidden" class="form-control input-lg" id="no_ktp" name="no_ktp" placeholder="No KTP" value="<?php echo $row['no_ktp']; ?>">
										  </div>
										  <div class="form-group">
											<label for="lname">Jurusan</label>
											<input type="text" class="form-control input-lg" id="jurusan" name="jurusan" placeholder="Ex. Teknik Informatika /IPA" value="<?php echo $rpendidikan['jurusan']; ?>" required="">
										  </div>
										  <div class="form-group">
											<label for="contactno">Tanggal Masuk</label>
											<input type="date" class="form-control input-lg" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Masuk Sekolah" value="<?php echo $rpendidikan['tgl_masuk']; ?>">
										  </div>
										  
										  <div class="form-group">
											<button type="submit" class="btn btn-flat btn-success">Add Pendidikan</button>
										  </div>
										</div>
										<div class="col-md-6 latest-job ">
										  <div class="form-group">
												  <label for="inputText">Jenjang</label>
											<div class="controls">
												<select name="jenjang" class="form-control" style="width:150px;" tabindex="2" required>
												   
													<?php
													$sma="";$smk="";$d1="";$d2="";$d3="";$s1="";$s2="";$kosong="";
													if($device==""){$sma="";$smk="";$d1="";$d2="";$d3="";$s1="";$s2="";$kosong='selected="selected"';}
													else if($device=="SMA"){$sma='selected="selected"';$smk="";$d1="";$d2="";$d3="";$s1="";$s2="";$kosong="";}
													else if($device=="SMK"){$sma="";$smk='selected="selected"';$d1="";$d2="";$d3="";$s1="";$s2="";$kosong="";}
													else if($device=="D1"){ $sma="";$smk="";$d1='selected="selected"';$d2="";$d3="";$s1="";$s2="";$kosong="";}
													else if($device=="D2"){$sma="";$smk="";$d1="";$d2='selected="selected"';$d3="";$s1="";$s2="";$kosong="";}
													else if($device=="D3"){$sma="";$smk="";$d1="";$d2="";$d3='selected="selected"';$s1="";$s2="";$kosong="";}
													else if($device=="S1"){$sma="";$smk="";$d1="";$d2="";$d3="";$s1='selected="selected"';$s2="";$kosong="";}
													else if($device=="S2"){$sma="";$smk="";$d1="";$d2="";$d3="";$s1="";$s2='selected="selected"';$kosong="";}
													?>
													<option value="<?php echo $rpendidikan['jenjang']; ?>" selected><?php echo $rpendidikan['jenjang'];?></option> 
													
													<option value="SMA" <?php echo $sma; ?>>SMA</option>
													<option value="SMK" <?php echo $smk; ?>>SMK</option>
													<option value="D1" <?php echo $d1; ?>>D1</option>
													<option value="D2" <?php echo $d2; ?>>D2</option>
													<option value="D3" <?php echo $d3; ?>>D3</option>
													<option value="S1" <?php echo $s1; ?>>S1</option>
													<option value="S2" <?php echo $s2; ?>>S2</option>
													
												</select>
											</div>
										  
										 </div>
										 <div class="form-group">
											<label for="contactno">Nilai / IPK</label>
											<input type="text" class="form-control input-lg" id="nilai" name="nilai" placeholder="Ex. 1.6 / 7.0" value="<?php echo $rpendidikan['nilai']; ?>">
										  </div>
										  <div class="form-group">
											<label for="contactno">Tanggal Lulus</label>
											<input type="date" class="form-control input-lg" id="tgl_lulus" name="tgl_lulus" placeholder="Tanggal Lulus" value="<?php echo $rpendidikan['tgl_lulus']; ?>">
										  </div>
										 
										</div>
									  </div>
									 
									</form>
																
								 <?php
										}
									  }
									?>   
							
							 
							</div>
				  
					<!-- Tab Pengalaman kerja-->
					<div class="tab-pane" id="tabPengalaman">
							<div class="control-group">
								<h2><i>Edit Data Pengalaman Kerja</i></h2>
								<button class="btn btn-info" data-toggle="tab" href="#addPengalaman"><i class="icon-chevron-right icon-white"></i> Tambah Data Pengalaman Kerja</button>
								<table class="table table-bordered table-striped">
								<caption> Data Pengalaman Kerja</caption>
								<thead>
								<tr>
									<th>#</th>
									<th align="center">Nama Perusahaan</th>
									<th align="center">Jabatan</th>
									<th align="center">Gaji</th>
									<th align="center">Detail pekerjaan</th>
									
									<th align="center">Tgl Masuk</th>
									<th align="center">Tgl Keluar</th>
									<th align="center">Alasan Resign</th>
									<th></th>
								</tr>
								</thead>
								<tbody>
							<?php
								
								$query=mysqli_query($conn,"SELECT * FROM pengalaman_kerja WHERE id_user='$_SESSION[id_user]' ORDER BY id_pengalaman DESC");
								$no=1;
								while($rpengalaman=mysqli_fetch_array($query)){
							?>
								<tr>
									<td><?php echo $no; ?></td>    
									<td><?php echo $rpengalaman['nama_perusahaan']; ?></pre></td>    
									<td><?php echo $rpengalaman['jabatan']; ?></pre></td>    
									<td><?php echo $rpengalaman['gaji']; ?></pre></td>    
									<td><?php echo $rpengalaman['detail']; ?></td>    
									<td><?php echo $rpengalaman['tgl_masuk']; ?></td>    
									<td><?php echo $rpengalaman['tgl_keluar']; ?></td>
									<td><?php echo $rpengalaman['alasan_keluar']; ?></td>   
									
									
                        <td><a href="delete-pengalaman.php?id=<?php echo $rpengalaman['id_pengalaman']; ?>"><i class="fa fa-trash"></i></a></td>
								</tr>
							<?php
									$no++;
								}
							?>
							</tbody>
								</table>
							</div>
					</div>
		  
						<!-- Add Pendidikan-->
							<div class="tab-pane" id="addPengalaman">
							
							
							 <h2><i>Data Pengalaman Kerja / Magang</i></h2>
									<form action="add-pengalaman.php" method="post" enctype="multipart/form-data">
									
									  <div class="row">
										<div class="col-md-6 latest-job ">
										  <div class="form-group">
											 <label for="fname">Nama Perusahaan</label>
											<input type="text" class="form-control input-lg" id="nama_perusahaan" name="nama_perusahaan" placeholder=" Ex. PT. Ameya " value="<?php echo $rpengalaman['nama_perusahaan']; ?>" required="">
										  </div>
										  <div class="form-group">
											<label for="lname">Jabatan</label>
											<input type="text" class="form-control input-lg" id="jabatan" name="jabatan" placeholder="Ex. Teknik Informatika /IPA" value="<?php echo $rpengalaman['jurusan']; ?>" required="">
										  </div>
										  <div class="form-group">
											<label for="contactno">Gaji Terakhir</label>
											<input type="text" class="form-control input-lg" id="gaji" name="gaji" placeholder="Ex. 5000000" value="<?php echo $rpengalaman['gaji']; ?>">
										  </div>
										  
										  <div class="form-group">
											<label for="address">Job Desc</label>
											<textarea id="detail" name="detail" class="form-control input-lg" rows="5" placeholder="Ex. Melakukan training "><?php echo $rpengalaman['detail']; ?></textarea>
										  </div>
										  <div class="form-group">
											<button type="submit" class="btn btn-flat btn-success">Add Pengalaman Kerja</button>
										  </div>
										</div>
										<div class="col-md-6 latest-job ">
										  
										 <div class="form-group">
											<label for="contactno">Tanggal Masuk</label>
											<input type="date" class="form-control input-lg" id="tgl_masuk_kerja" name="tgl_masuk_kerja" placeholder="Tanggal Masuk Sekolah" value="<?php echo $rpendidikan['tgl_masuk']; ?>">
										  </div>
										  <div class="form-group">
											<label for="contactno">Tanggal Keluar</label>
											<input type="date" class="form-control input-lg" id="tgl_keluar_kerja" name="tgl_keluar_kerja" placeholder="Tanggal Keluar" value="<?php echo $rpengalaman['tgl_keluar']; ?>">
										  </div>
										   <div class="form-group">
											<label for="address">Experience</label>
											<input class="form-control input-lg" type="text" id="experience" name="experience" placeholder="Experience" readonly>
											</div>
										 <div class="form-group">
											<label for="address">Alasan Keluar</label>
											<textarea id="alasan_keluar" name="alasan_keluar" class="form-control input-lg" rows="5" placeholder="Ex. Gaji Kurang "><?php echo $rpengalaman['alasan_keluar']; ?></textarea>
										  </div>
										</div>
									  </div>
									 
									</form>
																
							
							
							 
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
<script type="text/javascript">
  $('#tgl_keluar_kerja').on('change', function() {
    
	var keluar_kerja = new Date($('#tgl_keluar_kerja').val());
    var masuk_kerja = new Date($('#tgl_masuk_kerja').val());
    var experience = keluar_kerja.getFullYear() - masuk_kerja.getFullYear();
    var m = keluar_kerja.getMonth() - masuk_kerja.getMonth();

    if(m < 0 || (m === 0 && keluar_kerja.getDate() < masuk_kerja.getDate())) {
      experience--;
    }

    $('#experience').val(experience);
  });
</script>
<script>
  $("#registerCandidates").on("submit", function(e) {
    e.preventDefault();
    if( $('#password').val() != $('#cpassword').val() ) {
      $('#passwordError').show();
    } else {
      $(this).unbind('submit').submit();
    }
  });
</script>
<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
</body>
</html>
