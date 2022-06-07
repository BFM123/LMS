<?php
	//show all types of errors but notices, warnings and deprecated messages
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

  	$asset_path = "../../";
	include "login_check.php";
	
	header("Cache-Control","no-cache,post-check=0,pre-check=0");
	header("Pragma","no-cache");
  	header("Expires","Thu,01Dec199416:00:00GMT");
	
	// set the default time zone to be that for Malawi
	date_default_timezone_set("Africa/Blantyre");
	
	// get the application details
	$system_title = common::getFieldValue("system", "title");
	$licensee = common::getFieldValue("system", "licensee");	
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
	<link rel="shortcut icon" href="<?php echo $asset_path ?>assets/images/favicon.png" type="image/png" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/dist/css/w3.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="<?php echo $asset_path; ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $asset_path ?>assets/country-picker-master/css/countrypicker.css">
	<link rel="stylesheet" href="<?php echo $asset_path ?>assets/select2/select2.min.css">
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>	<!-- hide news article text after read more button -->
	<style type="text/css">
		.show-read-more .more-text {
			display: none;
		}
		
		/* CSS for another version of read more */
        .addReadMore.showlesscontent .SecSec, .addReadMore.showlesscontent .readLess, .addReadMore.showmorecontent .readMore {
            display: none;
        }

        .addReadMore .readMore,
        .addReadMore .readLess {
			margin-left: 2px;
			cursor: pointer;
			font-style: italic;
			color: #aa0000!important;
        }
		
        .addReadMoreWrapTxt.showmorecontent .SecSec, .addReadMoreWrapTxt.showmorecontent .readLess {
            display: block;
			white-space: pre;
        }		
	</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="../" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">            
            <!-- User Account: style can be found in dropdown.less -->
			<li class="dropdown user user-menu">
				<?php
					// print user details
					$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
					$logged_user_id = (isset($_SESSION["user_id"])) ? $_SESSION["user_id"] : "";
					$logged_fullname = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $logged_username);
					$logged_role_id = common::getFieldValue("user", "role_id", "username", $logged_username);
					$logged_role_name = common::getFieldValue("role", "role_name", "role_id", $logged_role_id);
					$logged_organization_id = common::getFieldValue("user", "organization_id", "username", $logged_username);
					$logged_district_id = common::getFieldValue("user", "district_id", "username", $logged_username);
					$logged_district = common::getFieldValue("district", "district_name", "district_id", $logged_district_id);
					$logged_photo = common::getFieldValue("user", "photo", "username", $logged_username);
					$user_since = (isset($_SESSION["user_since"])) ? $_SESSION["user_since"] : "";
					
					$photo_display_sm = "";
					$photo_display_lg = "";
					
					if (strlen($logged_photo) > 0) {
						$photo_display_sm = "<img src=\"" . PHOTO_PATH . "$logged_photo\" alt=\"\" class=\"";
						$photo_display_lg = $photo_display_sm;
						$photo_display_sm .= "user-image\">";
						$photo_display_lg .= "img-circle\">";
					}

				?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $photo_display_sm; ?>
                <span class="hidden-xs"><?php echo $logged_fullname; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
					<?php echo $photo_display_lg; ?>
					<h4><?php echo $logged_fullname; ?></h4>
					<h5><?php echo $logged_role_name; ?></h5>
					<h5><?php echo $logged_organization_name; ?></h5>
					<small>User since <?php echo $user_since; ?></small>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
					<a data-toggle="modal" data-target="#user-account" href="#" class="btn btn-default btn-round">Account</a>					
                  </div>
                  <div class="pull-right">
					<input type="hidden" id="path" name="path" value="../includes">
                    <a href="#" id="logout" class="btn btn-default btn-round clicked-button">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
	
	<!-- /. User Account Modal -->
	<div class="modal fade" id="user-account" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Account Details</h4>
				</div>
				<div class="modal-body">
					<form action="/<?php echo SYS_DIR; ?>/views/user/action.php" method="post" 
						onInput="confirm_password.setCustomValidity(confirm_password.value != password.value ? 'The password fields do not match' : '');"
						enctype="multipart/form-data">

						<fieldset class="form-group col-md-4" style="margin: 0;">
							<label for="fullname">Name</label>
						</fieldset>								
						<fieldset class="form-group col-md-8" style="margin: 0;">
							<?php echo "$logged_fullname ($logged_username)"; ?>
						</fieldset>							
						<fieldset class="form-group col-md-12" style="margin: 0;"></fieldset>
						
						<fieldset class="form-group col-md-4" style="margin: 0;">
							<label for="fullname">Organization</label>
						</fieldset>								
						<fieldset class="form-group col-md-8" style="margin: 0;">
							<?php echo $logged_organization_name; ?>
						</fieldset>							
						<fieldset class="form-group col-md-12" style="margin: 0;"></fieldset>
						
						<fieldset class="form-group col-md-4" style="margin: 0;">
							<label for="fullname">District</label>
						</fieldset>								
						<fieldset class="form-group col-md-8" style="margin: 0;">
							<?php echo $logged_district; ?>
						</fieldset>							
						<fieldset class="form-group col-md-12"></fieldset>

						<fieldset class="form-group col-md-6">
							<label for="photo">Photo</label>
							<input type="file" class="form-control-file border" name="photo" id="photo" value="">
						</fieldset>
						
						<fieldset class="form-group col-md-6">
							<label class="required" for="old_password">Password</label>
							<input type="password" class="form-control" name="old_password" value="" required>
						</fieldset>
						
						<fieldset class="form-group col-md-6">
							<label for="password">New Password</label>
							<input type="password" class="form-control" name="password" value="">
						</fieldset>
						
						<fieldset class="form-group col-md-6">
							<label for="confirm_password">Confirm New Password</label>
							<input type="password" class="form-control" name="confirm_password" value="">
						</fieldset>
						
						<?php
							$url = str_replace("\\", "/", strtolower(getcwd()));
							$parameters = (common::startsWith(basename($_SERVER["REQUEST_URI"]), "?")) ? basename($_SERVER["REQUEST_URI"]) : "";
							
							$pos = strpos($url, strtolower(SYS_DIR)) + strlen(SYS_DIR) + 1;
							$return_url = substr($url, $pos) . "/" . $parameters;
						
						?>
						<input type="hidden" name="option" value="edit">
						<input type="hidden" name="from_page" value="user-account">
						<input type="hidden" name="return_url" value="<?php echo $return_url; ?>">
						<input type="hidden" name="user_id" value="<?php echo $logged_user_id; ?>">
						<input type="hidden" name="username" value="<?php echo $logged_username; ?>">
						<input type="hidden" name="last_edited_by" value="<?php echo $logged_username; ?>">
					   
						<button type="submit" class="btn btn-default btn-round dark-blue">Save</button>
						<a data-dismiss="modal" class="btn btn-default btn-round">Cancel</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /. User Account Modal -->
    <!-- Left side column. contains the logo and sidebar -->

    <?php require "menu.php"; ?>