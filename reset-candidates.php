
<?php
	if(!empty($_POST["forgot-password"])){
		$conn = mysqli_connect("localhost", "root", "managersql", "db_recruitment");
		
		$condition = "";
		if(!empty($_POST["email_id"])) 
			$condition = "email = '" . $_POST["email_id"] . "'";
		if(!empty($_POST["no_ktp"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " no_ktp = '" . $_POST["no_ktp"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "Select * from users " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			require_once("password-recovery-mail.php");
		} else {
			$error_message = 'No User Found';
		}
	}
?>
<script>
function validate_forgot() {
	if((document.getElementById("email_id").value == "") && (document.getElementById("no_ktp").value == "")) {
		document.getElementById("validation-message").innerHTML = "Login name or No KTP is required!"
		return false;
	}
	return true
}
</script>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  
    <a href="index.php"><img src="img/ameyalogo-220x49.png" alt="ameyalogo"></a>
	
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    

   <form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
<h1>Forgot Password?</h1>
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>


	<div class="form-group has-feedback">
		<div><label for="email">Email</label></div>
		<div><input type="text" name="email_id" id="email_id" class="form-control"></div>
	</div>
	<div class="form-group has-feedback">
		<div><label for="username">No KTP</label></div>
		<div><input type="text" name="no_ktp" id="no_ktp" class="form-control"> </div>
	</div>
	<div class="field-group">
		<div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="btn btn-primary btn-block btn-flat"></div>
	</div>	
</form>

    <br>

    <?php 
    //If User have successfully registered then show them this success message
    //Todo: Remove Success Message without reload?
    if(isset($_SESSION['registerCompleted'])) {
      ?>
      <div>
        <p id="successMessage" class="text-center">You Have Registered Successfully! Your Account Approval Is Pending By Admin</p>
      </div>
    <?php
     unset($_SESSION['registerCompleted']); }
    ?>   
    <?php 
    //If User Failed To log in then show error message.
    if(isset($_SESSION['loginError'])) {
      ?>
      <div>
        <p class="text-center">Invalid Email/Password! Try Again!</p>
      </div>
    <?php
     unset($_SESSION['loginError']); }
    ?>      

    <?php 
    //If User Failed To log in then show error message.
    if(isset($_SESSION['userActivated'])) {
      ?>
      <div>
        <p class="text-center">Your Account Is Active. You Can Login</p>
      </div>
    <?php
     unset($_SESSION['userActivated']); }
    ?>    

     <?php 
    //If User Failed To log in then show error message.
    if(isset($_SESSION['loginActiveError'])) {
      ?>
      <div>
        <p class="text-center"><?php echo $_SESSION['loginActiveError']; ?></p>
      </div>
    <?php
     unset($_SESSION['loginActiveError']); }
    ?>   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script type="text/javascript">
      $(function() {
        $("#successMessage:visible").fadeOut(8000);
      });
    </script>
</body>
</html>
