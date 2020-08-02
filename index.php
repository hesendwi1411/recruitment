<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>

<style type="text/css">
	/* style untuk link popup */
	a.popup-link {
		padding:17px 0;
		text-align: center;
		margin:10% auto;
		position: relative;
		width: 300px;
		color: #fff;
		text-decoration: none;
		background-color: #FFBA00;
		border-radius: 3px;
		box-shadow: 0 5px 0px 0px #eea900;
		display: block;
	}
	a.popup-link:hover {
		background-color: #ff9900;
		box-shadow: 0 3px 0px 0px #eea900;
		-webkit-transition:all 1s;
		transition:all 1s;
	}
	/* end link popup*/
	/* animasi popup */

	@-webkit-keyframes autopopup {
		from {opacity: 0;margin-top:-200px;}
		to {opacity: 1;}
	}
	@-moz-keyframes autopopup {
		from {opacity: 0;margin-top:-200px;}
		to {opacity: 1;}
	}
	@keyframes autopopup {
		from {opacity: 0;margin-top:-200px;}
		to {opacity: 1;}
	}
	/* end animasi popup */
	/*style untuk popup */	
	#popup {
		background-color: rgba(0,0,0,0.8);
		position: fixed;
		top:0;
		left:0;
		right:0;
		bottom:0;
		margin:0;
		-webkit-animation:autopopup 2s;
		-moz-animation:autopopup 2s;
		animation:autopopup 2s;
	}
	#popup:target {
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
		opacity: 0;
		visibility: hidden;
	}

	@media (min-width: 768px){
		.popup-container {
			width:600px;
		}
	}
	@media (max-width: 767px){
		.popup-container {
			width:100%;
		}
	}
	.popup-container {
		position: relative;
		top:100px;
		margin:7% auto;
		padding:20px 20px;
		background-color: #fafafa;
		color:#333;
		border-radius: 3px;
	}

	a.popup-close {
		position: absolute;
		top:3px;
		right:3px;
		background-color: #333;
		padding:7px 10px;
		font-size: 20px;
		text-decoration: none;
		line-height: 1;
		color:#fff;
	}
	/* end style popup */

	/* style untuk isi popup */
	.popup-form {
		margin:10px auto;
		text-align: justify;
	}
		.popup-form h2 {
			margin-bottom: 5px;
			font-size: 37px;
			text-transform: uppercase;
			color:red;
		}
		.popup-form .input-group {
			margin:10px auto;
		}
			.popup-form .input-group input {
				padding:17px;
				text-align: center;
				margin-bottom: 10px;
				border-radius:3px;
				font-size: 16px; 
				display: block;
				width: 100%;
			}
			.popup-form .input-group input:focus {
				outline-color:#FB8833; 
			}
			.popup-form .input-group input[type="email"] {
				border:0px;
				position: relative;
			}
			.popup-form .input-group input[type="submit"] {
				background-color: #FB8833;
				color: #fff;
				border: 0;
				cursor: pointer;
			}
			.popup-form .input-group input[type="submit"]:focus {
				box-shadow: inset 0 3px 7px 3px #ea7722;
			}
	/* end style isi popup */

	</style>
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


<div  class="wrapper" >
	

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
            <a href="jobs.php">Vacancies</a>
          </li>
         
          <li>
            <a href="#about">About Us</a>
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
	
    <section class="content-header bg-main">
	
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center index-head">
			
<div class="content-wrapper" id="popup">
	<div class="popup-container">
		 
		<!-- Konten popup, silahkan ganti sesuai kebutughan -->
		<form action="http://www.syakirurohman.net/2015/01/tutorial-membuat-popup-tanpa-javascript-jquery.html#" method="post" class="popup-form">
			<h2 align="center" >!..WASPADA..!</h2>
			<h3 align="center" >Penipuan Lowongan Kerja</h2>
			<p>PT. Ameya Group menghimbau kepada masyarakat untuk berhati-hati dan waspada
			terhadap segala bentuk rekrutmen dan seleksi calon karyawan yang mengatasnamakan atau menggunkan identitas  PT. Ameya Livingstyle Indonesia atau PT. Anggun Kreasi Garmen
			<br/><br/>
			Kami tidak meminta bayaran dalam bentuk apapun dan untuk alamat resmi dari kami adalah 
			<strong>recruitment@ameyaindo.com</strong> atau <strong>recruitment@anggunkreasi.com</strong></p>
			
		</form>
		<a class="popup-close" href="#popup">X</a>
			
	
	</div>
</div>
            <h2><strong>E - RECRUITMENT</strong></h2>
            <p>PT. Ameya ( Group )</p>
            <p><a class="btn btn-success btn-lg" href="jobs.php" role="button">Search Jobs</a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 latest-job margin-bottom-20">
            <h3 class="text-center">PLEASE SELECT AVAILABLE POSITION</h3>            
            <?php 
          /* Show any 4 random job post
           * 
           * Store sql query result in $result variable and loop through it if we have any rows
           * returned from database. $result->num_rows will return total number of rows returned from database.
          */
          $sql = "SELECT * FROM job_post Order By createdat desc Limit 4";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
              $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>
            <div class="attachment-block clearfix">
			<img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image">
              
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="attachment-heading pull-right">IDR <?php echo $row['minimumsalary']; ?> - <?php echo $row['maximumsalary']; ?>/Month</span></h4>
                <div class="attachment-text">
                    <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
					<div><h4> <a class="attachment-heading pull-right" href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"> Apply Now</a>  </h4></div>
                </div>
              </div>
            </div>
          <?php
              }
            }
            }
          }
          ?>

          </div>
        </div>
      </div>
    </section>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h3>OPPORTUNITIES THAT YOU WILL HAVE</h3>
            <p>PT. Ameya offers you the chance to join with us and expand your talent, professionalism and experience in garment industry</p>            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="img/browse2.jpg" alt="Browse Jobs">
              <div class="caption">
                <h1 class="text-center">INNOVATE</h1>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="img/interviewed1.jpeg" alt="Apply & Get Interviewed">
              <div class="caption">
			  <h1 class="text-center">COLLABORATE</h1>
                </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="img/career1.jpg" alt="Start A Career">
              <div class="caption">
               <h1 class="text-center">FUTURE</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	 <section id="about" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1></h1>                      
          </div>
        </div>
        <div class="row thumbnail">
          <div class="col-md-6">
            <img src="img/browse3.jpg" class="img-responsive">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
            <p> <br/><br/><br/><h1>CAREER DEVELOPMENT</h1>  <br/><h4>We Offer Dynamic Careers Professional Growth and Development</h4>
              
            </p>
          </div>
        </div>
      </div>
    </section>
	<section id="about" class="content-header">
      <div class="container">
        <div class="row ">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1></h1>                      
          </div>
        </div>
        <div class="row thumbnail">
		 <div class="col-md-6 about-text margin-bottom-20">
            <p> <br/><br/><br/><h1>COMPENSATION & BENEFIT</h1>  <br/><h4>We Offer Competitive Remuneration and Benefits</h4>
            </p>
          </div>
          <div class="col-md-6">
            <img src="img/browse4.jpg" class="img-responsive">
          </div>
         
        </div>
      </div>
    </section>
	<section id="about" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1></h1>                      
          </div>
        </div>
        <div class="row thumbnail">
          <div class="col-md-6">
            <img src="img/browse5.jpg" class="img-responsive">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
            <p> <br/><br/><br/><h1>THE BEST ENVIRONMENT TO WORK</h1>  <br/><h4>We provide an environment that encourages teamwork and productivitynt</h4>
              
            </p>
          </div>
        </div>
      </div>
    </section> 

   
   

    <section id="about" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>About US</h1>                      
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="img/browse1.jpg" class="img-responsive">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
            <p> <p>PT. Ameya Livingstyle Indonesia, established in year 2006 in Yogyakarta, is one of the garment companies in Indonesia that has been successfully operated. PT. Ameya Livingstyle Indonesia has worked for some outstanding brands, such as Levi’s, Calvin Klein, S.Oliver, H&M, Nautica, Bonita, Quicksilver, Jack Wolfskin, Tom Tailor, Guess, ESPRIT, Gerry Weber, TNF and many more. Our Success reflects out thorough concern towards excellence.</p>
            <p>
              The highest achievement was awarded in 2015 – 2016, WRAP Auditorproudly present Gold Certification of Compliance, BSCI did the certification for Good Perfomance in 2015 and we went through the BWI Code of Conduct in the same year. It proves that PT. Ameya Livingstyle Indonesia implements good company values.
              
            </p>
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
<script src="js/adminlte.min.js"></script>


</body>
</html>
