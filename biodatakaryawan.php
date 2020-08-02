<?php 

session_start();
if(empty($_SESSION['no_ktp']) && empty($_SESSION['location'])) {
  header("Location: ../index.php");
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
          <h1 class="text-center margin-bottom-20">BIODATA KARYAWAN</h1>
   
		<?php
                $sql = "SELECT * FROM karyawan WHERE no_ktp='$_SESSION[no_ktp]'";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                ?>
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
										  
										 	<form method="get" action="laporan/f_biodatakaryawan.php" target="_blank">									
											 <div class="form-group">
											
												<input type="hidden" name="no_ktp" value="<?php echo $row['no_ktp']?>">
												<input type="hidden" name="location" value="<?php echo $row['location']?>">
												<input type="hidden" name="nama" value="<?php echo $row['nama']?>">
												<button class="btn btn-flat btn-success glyphicon glyphicon-print" >Cetak</button>
											  </div>
											 </form> 
	</div>
			  </div>
                    <?php
                    }
                  }
                ?>  
          
          
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
  $('#tanggal_keluar_kerja').on('change', function() {
    
	var keluar_kerja = new Date($('#tanggal_keluar_kerja').val());
    var masuk_kerja = new Date($('#tanggal_masuk_kerja').val());
    var experience = keluar_kerja.getFullYear() - masuk_kerja.getFullYear();
    var m = keluar_kerja.getMonth() - masuk_kerja.getMonth();

    if(m < 0 || (m === 0 && keluar_kerja.getDate() < masuk_kerja.getDate())) {
      experience--;
    }

    $('#experience').val(experience);
  });
</script>
<script>
  $("#registerKaryawan").on("submit", function(e) {
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
