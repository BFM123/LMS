<?php
	session_start();
	require "config/config.php";
	require "models/system.php";

	$username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
	
	// get the application details
	$system_title = common::getFieldValue("system", "title");
	$licensee = common::getFieldValue("system", "licensee");
	
	// reset in-application messages, if they are already set
	if (isset($_SESSION["message"])) unset($_SESSION["message"]);
	if (isset($_SESSION["message_type"])) unset($_SESSION["message_type"]);	
		
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $system_title; ?></title>
		<meta name="author" content="Idias Corporation Limited | +265 211 953 052 | info@idiasmw.com | www.idiasmw.com">
		<meta name="description" content="<?php echo $system_title; ?> is a platfrom for capturing, storing, processing and reporting of NGO activities">
		<meta name="keywords" content="<?php echo $system_title; ?>, Non Governmental Organization, NGO, <?php echo $licensee; ?>">
		<link rel="shortcut icon" href="assets/images/favicon.png" type="image/png" />
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<link rel="stylesheet" href="assets/select2/select2.min.css">

		<!-- ./wrapper -->
		<script src="assets/dist/js/jquery-2.1.3.min.js"></script>
		<script src="assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

		<!-- resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>$.widget.bridge('uibutton', $.ui.button);</script>
		
		<!-- bootstrap 3.3.7 -->
		<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		
		<!-- bootstrap WYSIHTML5 -->
		<script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

		<!-- slimscroll -->
		<script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

		<!-- select2 -->		
		<script src="assets/select2/jquery.select2.js"></script>
		<script src="assets/select2/select2.min.js"></script>
		
		<script>			
			// globally override Bootstrap's behavior to force Bootstrap to accept select2
			$.fn.modal.Constructor.prototype.enforceFocus = function() {};
		   
			$(function () {
				//Initialize Select2 Elements
				$('.select2').select2()
			})
			function submitForm() {
				$('#form-login').submit();
			}

		</script>
	</head>
	
	<body class="hold-transition skin-dark-blue">		
		<div class="login-box-body skin-dark-blue">
			<div class="login-logo"></div>
			<div class="login-box">
			
				<div class="title" style="background-color: #5E5770;">
					<h3><?php echo $system_title; ?></h3>
				</div>
				
				<div class="login-box-msg">
					<?php include "views/includes/message_login.php"; ?>
				</div>
				
				<div class="form-body">			
					<form action="login.php" id="form-login" method="post">						
						<fieldset class="form-group"> 
							<label for="username" class="input-username">Username</label>
							<input type="text" class="form-control input-field" name="username" value="<?php echo $username; ?>" required="required">
						</fieldset> 
						
						<fieldset class="form-group"> 
							<label for="password" class="input-password">Password</label>
							<input type="password" class="form-control input-field" name="password" required="required">
						</fieldset> 
						<input type="hidden" name="option" value="login">		
						<button id="login" type="submit" class="btn btn-default btn-round dark-blue">Login</button>
					</form>
				</div>
				
    			<footer class="main-footer" style="border-top-color: #fff; margin-top: 20px; margin-left: 0; text-align: center;">
					<div class="row">
						<!-- display identification information -->
						myLMS
						
						<!-- print version -->
						Version 1.0
				
						<!-- display copyright information -->		
						&copy; <?php echo date("Y") . " " . $licensee; ?>.
					</div>
					
					<!-- display author information -->
					<div class="row">
						<a target = "new" title = "Idias - Software Development &amp; Hosting, Data Management, IT Consultancy" href = "http://www.idiasmw.com">
							Powered by Idias <span class="powered_by"></span>
						</a>
					</div>
			    </footer>
			</div>
		</div>
	</body>
</html>
