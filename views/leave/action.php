<?php
	session_start();
	require "../../config/config.php";
	require "../../models/leave.php";
	require "../../controllers/leave_controller.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$action = $_POST["option"];
		$action();
	}
	$level = isset($_POST["l"]) ? $_POST["l"] : "";
	
	header("location: ./?l=$level");
?>