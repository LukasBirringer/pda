<?php 
include_once 'assets/db_connect.php';
include_once 'assets/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
	$logged = 'in';
} else {
	echo "STOPP";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Patrona Download-Area</title>
		<link rel="stylesheet" href="css/main.css">
		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
	</head>
	<body>
		<?php 
		if (isset($_GET['error'])) {
			echo 'Error Logging In!';
		}
		?>
		<div class="login">
		<div id="top">
				<img src="img/logo.png" alt="">
			<div id="title">
				Download-Area
			</div>
		</div>
		<div id="line"></div>
		<form action="assets/process_login.php" method="post" name="login_form">
			<input type="text" class="user" autocomplete="off" name="email">
			<input type="password" class="pass" autocomplete="off" name="password" id="password">			
			<input type="button" class="button" value="login" onclick="formhash(this.form, this.form.password);" >
		</form>			
		</div>
		<p>You are currently logged <?php echo $logged ?></p>
	</body>
</html>