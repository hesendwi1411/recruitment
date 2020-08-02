<?php 

session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  
  exit();
}
require_once("db.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ameya | Recruitment Portal</title>
   <link rel="shoutcut icon" href="favicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
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
     <a href="index.php" class="logo logo-bg"><img src="img/ameyalogo-220x49.png" alt="ameyalogo">
	
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
            <a href="jobs.php">Jobs</a>
          </li>
          <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
          <li>
            <a href="login.php">Login</a>
          </li>
          <li>
            <a href="sign-up.php">Sign Up</a>
          </li>  
          <?php } else { 

            if(isset($_SESSION['id_user'])) { 
          ?>        
          <li>
            <a href="user/index.php">Dashboard</a>
          </li>
          <?php
          } else if(isset($_SESSION['id_company'])) { 
          ?>        
          <li>
            <a href="company/index.php">Dashboard</a>
          </li>
          <?php } ?>
          <li>
            <a href="logout.php">Logout</a>
          </li>
          <?php } ?>          
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="content-header">
      <div class="container">
        <div class="row latest-job margin-top-50 margin-bottom-20 bg-white">
          <h1 class="text-center margin-bottom-20">CREATE YOUR PROFILE</h1>
          <form method="post" id="registerCandidates" action="adduser.php" enctype="multipart/form-data">
            <div class="col-md-6 latest-job ">
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="fname" name="fname" placeholder="First Name *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="lname" name="lname" placeholder="Last Name *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="email_id" name="email_id" placeholder="Email *" required>
              </div>
               <div class="form-group">
                <input class="form-control input-lg" type="text" id="contactno" name="contactno" minlength="11" maxlength="20" onkeypress="return validatePhone(event);" placeholder="Phone Number *" required>
              </div>
			  <div class="form-group">
                <input class="form-control input-lg" type="text" minlength="16"  id="no_ktp" name="no_ktp" placeholder="No KTP *" required>
              </div>
			  
										  <div class="form-group">
											
											<input type="text" class="form-control input-lg" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat kelahiran"  required>
										  </div>
										  
              <div class="form-group">
                <label>Date Of Birth</label>
                <input class="form-control input-lg" type="date" id="dob" min="1960-01-01" max="1999-01-31" name="dob" placeholder="Date Of Birth " required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="age" name="age" placeholder="Age" readonly>
              </div>
                 
				 <div class="form-group">
                <select class="form-control  input-lg" id="country" name="country" required>
                <option selected="" value="">Pilih Negara</option>
                <?php
                  $sql="SELECT * FROM countries";
                  $result=$conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['name']."' data-id='".$row['id']."'>".$row['name']."</option>";
                    }
                  }
                ?>
                  
                </select>
              </div>  
              <div id="stateDiv" class="form-group" style="display: none;">
                <select class="form-control  input-lg" id="state" name="state" required>
                  <option value="" selected="">Pilih Provinsi</option>
                </select>
              </div>   
              <div id="cityDiv" class="form-group" style="display: none;">
                <select class="form-control  input-lg" id="city" name="city" required>
                  <option selected="">Pilih Kecamatan</option>
                </select>
              </div>
				<div class="form-group">
                <textarea class="form-control input-lg" rows="4" id="address" name="address" placeholder="Address"></textarea>
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" rows="4" id="domisili" name="domisili" placeholder="Domisili"></textarea>
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
													<option value="" selected>-STATUS-</option> 
													
													<option value="Belum Kawin" <?php echo $belumkawin; ?>>Belum Kawin</option>
													<option value="Kawin" <?php echo $kawin; ?>>Kawin</option>
													<option value="Cerai" <?php echo $cerai; ?>>Cerai</option>
													<option value="Janda / Duda" <?php echo $janda_duda; ?>>Janda / Duda</option>
													<option value="Hidup Bersama" <?php echo $hidup_bersama; ?>>Hidup Bersama</option>
													
													
												</select>
											</div>
										  
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
													<option value="" selected>-JK-</option> 
													
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
													 
													
													<option value="" selected>-AGAMA-</option>
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
                <textarea class="form-control input-lg" rows="4" id="aboutme" name="aboutme" placeholder="Brief intro about yourself *" required></textarea>
              </div>
              <div class="form-group">
                <textarea class="form-control input-lg" rows="4" id="skills" name="skills" placeholder="Enter Skills"></textarea>
              </div>              
              
              <div class="form-group">
                <label style="color: red;">File Format PDF Only!</label>
                <input type="file" name="resume" class="btn btn-flat btn-danger" required>
              </div>

				
             
              <?php 
              //If User already registered with this email then show error message.
              if(isset($_SESSION['registerError'])) {
                ?>
                <div class="form-group">
                  <label style="color: red;">Email Already Exists! Choose A Different Email!</label>
                </div>
              <?php
               unset($_SESSION['registerError']); }
              ?> 

              <?php if(isset($_SESSION['uploadError'])) { ?>
              <div class="form-group">
                  <label style="color: red;"><?php echo $_SESSION['uploadError']; ?></label>
              </div>
              <?php unset($_SESSION['uploadError']); } ?>     

            </div>            
            <div class="col-md-6 latest-job ">
			<h2><i>Data Pendidikan</i></h2>
									<form action="add-pendidikan.php" method="post" enctype="multipart/form-data">
									
									  <div class="row">
										<div class="col-md-6 latest-job ">
										  <div class="form-group">
											 <label for="fname">Nama Sekolah</label>
											<input type="text" class="form-control input-lg" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah / Universitas *"  required>
										  </div>
										  <div class="form-group">
											<label for="lname">Jurusan</label>
											<input type="text" class="form-control input-lg" id="jurusan" name="jurusan" placeholder="Ex. Teknik Informatika /IPA *"  required>
										  </div>
										  <div class="form-group">
											<label for="contactno">Tanggal Masuk</label>
											<input type="date" class="form-control input-lg" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Masuk Sekolah" required>
										  </div>
										  <div class="form-group">
											<label for="contactno">Tanggal Lulus</label>
											<input type="date" class="form-control input-lg" id="tgl_lulus" name="tgl_lulus" placeholder="Tanggal Lulus" required>
										  </div>
										  <div class="form-group">
											
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
													<option value="" selected>-PILIH-</option> 
													
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
											<input type="text" class="form-control input-lg" id="nilai" name="nilai" placeholder="Ex. 1.6 / 7.0" required>
										  </div>
										  
										 
										</div>
									  </div>
				<h2><i>Data Pengalaman Kerja / Magang</i></h2>
									<form action="add-pengalaman.php" method="post" enctype="multipart/form-data">
									
									  <div class="row">
										<div class="col-md-6 latest-job ">
										  <div class="form-group">
											 <label for="fname">Nama Perusahaan</label>
											<input type="text" class="form-control input-lg" id="nama_perusahaan" name="nama_perusahaan" placeholder=" Ex. PT. Ameya "  required="">
										  </div>
										  <div class="form-group">
											<label for="lname">Jabatan</label>
											<input type="text" class="form-control input-lg" id="jabatan" name="jabatan" placeholder="Ex. Teknik Informatika /IPA"  required="">
										  </div>
										  <div class="form-group">
											<label for="contactno">Gaji Terakhir</label>
											<input type="text" class="form-control input-lg" id="gaji" name="gaji" placeholder="Ex. 5000000" required>
										  </div>
										  
										  <div class="form-group">
											<label for="address">Job Desc</label>
											<textarea id="detail" name="detail" class="form-control input-lg" rows="5" placeholder="Ex. Melakukan training "required></textarea>
										  </div>
										
										</div>
										<div class="col-md-6 latest-job ">
										  
										 <div class="form-group">
											<label for="contactno">Tanggal Masuk</label>
											<input type="date" class="form-control input-lg" id="tgl_masuk_kerja" name="tgl_masuk_kerja" placeholder="Tanggal Masuk " required>
										  </div>
										  <div class="form-group">
											<label for="contactno">Tanggal Keluar</label>
											<input type="date" class="form-control input-lg" id="tgl_keluar_kerja" name="tgl_keluar_kerja" placeholder="Tanggal Keluar / Isikan Tanggal sekarang jika masih bekerja" required >
										  </div>
										  <div class="form-group">
											<label for="address">Experience</label>
											<input class="form-control input-lg" type="text" id="experience" name="experience" placeholder="Experience" readonly>
											</div>
										 <div class="form-group">
											<label for="address">Alasan Keluar</label>
											<textarea id="alasan_keluar" name="alasan_keluar" class="form-control input-lg" rows="5" placeholder="Ex. Gaji Kurang " required></textarea>
										  </div>
										  
										  
										</div>
									  </div>					  
									  
              <div class="form-group">
                <input class="form-control input-lg" type="password" id="password" name="password" placeholder="Password *" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="password" id="cpassword" name="cpassword" placeholder="Confirm Password *" required>
              </div>
              <div id="passwordError" class="btn btn-flat btn-danger hide-me" >
                    Password Mismatch!! 
                  </div>
				
				
            
			  
			  
			   <div class="form-group checkbox">
                <label><input type="checkbox"> I accept terms & conditions</label>
              </div>
              <div class="form-group">
                <button class="btn btn-flat btn-success">Register</button>
              </div>
			  
            </div>
          </form>
          
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
<script src="js/adminlte.min.js"></script>

<script type="text/javascript">
      function validatePhone(event) {

        //event.keycode will return unicode for characters and numbers like a, b, c, 5 etc.
        //event.which will return key for mouse events and other events like ctrl alt etc. 
        var key = window.event ? event.keyCode : event.which;

        if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
          // 8 means Backspace
          //46 means Delete
          // 37 means left arrow
          // 39 means right arrow
          return true;
        } else if( key < 48 || key > 57 ) {
          // 48-57 is 0-9 numbers on your keyboard.
          return false;
        } else return true;
      }
</script>

<script type="text/javascript">
  $('#dob').on('change', function() {
    var today = new Date();
    var birthDate = new Date($(this).val());
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();

    if(m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }

    $('#age').val(age);
  });
</script>
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
<script>
  $("#country").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#state").find('option:not(:first)').remove();
    if(id != '') {
      $.post("state.php", {id: id}).done(function(data) {
        $("#state").append(data);
      });
      $('#stateDiv').show();
    } else {
      $('#stateDiv').hide();
      $('#cityDiv').hide();
    }
  });
</script>

<script>
  $("#state").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#city").find('option:not(:first)').remove();
    if(id != '') {
      $.post("city.php", {id: id}).done(function(data) {
        $("#city").append(data);
      });
      $('#cityDiv').show();
    } else {
      $('#cityDiv').hide();
    }
  });
</script>
</body>
</html>
