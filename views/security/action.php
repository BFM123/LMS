<?php
	session_start();
	require "../../config/config.php";
	require "../../models/security.php";
	require "../../controllers/security_controller.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		add();
		header("location:./");
	}
?>	
