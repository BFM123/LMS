<?php
	// check for login validity
	// start session if not started already
	if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	include_once $asset_path . "models/session.php";
	include_once $asset_path . "config/config.php";
	
	$is_valid_session = session::isValidSession($page_id);
	$session_result = $is_valid_session[0];
	$to_page = $is_valid_session[1];
	$access_right = $is_valid_session[2]; 
	
	if ($session_result !== "valid") {
		header("Location: $to_page");
	}
?>

