<?php
	if(!empty($_POST["forgot-password"])){
		$conn = mysqli_connect("localhost", "root", "managersql", "db_recruitment");
		
		$condition = "";
		if(!empty($_POST["no_ktp"])) 
			$condition = " no_ktp = '" . $_POST["no_ktp"] . "'";
		if(!empty($_POST["email_id"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " email = '" . $_POST["email_id"] . "'";
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