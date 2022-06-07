<?php
	session_start();
	$asset_path = "../../";
	require $asset_path . "config/config.php";
	require_once $asset_path . "models/user.php";
	require_once $asset_path . "models/common.php";

	// get the application details
	$system_title = common::getFieldValue("system", "title");
	$licensee = common::getFieldValue("system", "licensee");
	

	$message_login = "Invalid activation key";
	$message_login_type = MESSAGE_ERROR_TYPE;
	$username = "";
	$page_title = "Activate Your Account | $system_title";
	$email_verification_key = (isset($_GET["k"])) ? $_GET["k"] : "";
	$redirect = true;

	$modal = "
	<!DOCTYPE html>
	<html lang=\"en\">
		<head>
			<meta charset=\"utf-8\">
			<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
			<title>$page_title</title>
			<meta name=\"author\" content=\"Idias Corporation Limited | +265 211 953 052 | info@idiasmw.com | www.idiasmw.com\">
			<meta name=\"description\" content=\"$system_title\" is a platfrom for capturing, storing, processing and reporting of NGO activities\">
			<meta name=\"keywords\" content=\"$system_title, Non Governmental Organization, NGO, $licensee\">
			<link rel=\"shortcut icon\" href=\"$asset_path" . "assets/images/favicon.png\" type=\"image/png\" />
			<meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
			<link rel=\"stylesheet\" href=\"$asset_path" . "assets/bower_components/bootstrap/dist/css/bootstrap.min.css\">
			<link rel=\"stylesheet\" href=\"$asset_path" . "assets/dist/css/AdminLTE.min.css\">
			<link rel=\"stylesheet\" href=\"$asset_path" . "assets/dist/css/skins/_all-skins.min.css\">
			<link rel=\"stylesheet\" href=\"$asset_path" . "assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css\">
		</head>
		
		<body class=\"hold-transition skin-dark-blue\">
			<div class=\"login-box-body skin-dark-blue\">
				<div class=\"login-logo\"></div>
				<div class=\"login-box\">";
			
				if (strlen($email_verification_key) > 0) {
					$username = common::getFieldValue("user", "username", "email_verification_key", $email_verification_key, "email_verified IS NULL AND '1'",  "1");
					if (strlen($username) > 0) {
						$redirect = false;

						// get user details
						$user_id = common::getFieldValue("user", "user_id", "username", $username, "email_verification_key", $email_verification_key, "email_verified IS NULL AND 
														 '1'","1");
						$fullname = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $username, "email_verification_key", $email_verification_key, 
														 "email_verified IS NULL AND '1'",  "1");			
						// activate user
						$user = new user();
						$user->updateUser($username, "Yes", "email_verification_key = NULL, email_verified");
						
						// change password
						$return_url = "";
						$modal .= "
						<div class=\"title\">
							<h3>$system_title</h3>
						</div>
						
						<div class=\"form-body\">	
							<form action=\"../user/action.php\" method=\"post\" enctype=\"multipart/form-data\"
								onInput=\"confirm_password.setCustomValidity(confirm_password.value != password.value ? 'The new password fields do not match' : '');\">
		
								<fieldset class=\"form-group\">
									<h4>Welcome $fullname</h4><label>Please change your password</label>
								</fieldset>								
								
								<fieldset class=\"form-group\">
									<label class=\"required\" for=\"password\">New Password</label>
									<input type=\"password\" class=\"form-control\" name=\"password\" required>
								</fieldset>
								
								<fieldset class=\"form-group\">
									<label class=\"required\" for=\"confirm_password\">Confirm New Password</label>
									<input type=\"password\" class=\"form-control\" name=\"confirm_password\" required>
								</fieldset>
	
								<input type=\"hidden\" name=\"option\" value=\"edit\">
								<input type=\"hidden\" name=\"from_page\" value=\"user-activation\">
								<input type=\"hidden\" name=\"return_url\" value=\"$return_url\">
								<input type=\"hidden\" name=\"user_id\" value=\"$user_id\">
								<input type=\"hidden\" name=\"username\" value=\"$username\">
								<input type=\"hidden\" name=\"last_edited_by\" value=\"$username\">
								<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">Change</button>
							</form>
						</div>";
						$message_login = "Your account has been activated, you may now proceed to log in";
						$message_login_type = MESSAGE_SUCCESS_TYPE;						
					}
				}
						
				$modal .= "
				<footer class=\"main-footer\" style=\"border-top-color: #fff; margin-left: 0; text-align: center;\">
					<div class=\"row\">
						<!-- display identification information -->
						myNGO
						
						<!-- print version -->
						Version 1.0
				
						<!-- display copyright information -->		
						&copy; " . date("Y") . "<br /> $licensee
					</div>
					
					<!-- display author information -->
					<div class=\"row\">
						<a target = \"new\" title = \"Idias - Software Development &amp; Hosting, Data Management, IT Consultancy\" href = \"http://www.idiasmw.com\">
							Powered by Idias <span class=\"powered_by\"></span>
						</a>
					</div>
				</footer>
			</div>
		</body>
	</html>";
			
	echo $modal;
	
	$_SESSION["username"] = $username;
	$_SESSION["message_login"] = $message_login;
	$_SESSION["message_login_type"] = $message_login_type;
	
	echo $_SESSION["username"] . "<br />" . $_SESSION["message_login"] . "<br />" . $_SESSION["message_login_type"] . "<br />";

	if ($redirect) header("Location: $asset_path");
?>