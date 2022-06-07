<?php
	session_start();
	require "../../config/config.php";
	require "../../models/role.php";
	require "../../controllers/role_controller.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$action = $_POST["option"];
	
		switch ($action) {
			case "add":
				add();
				break;
			case "edit":
				edit();
				break;
			case "delete":
				delete();
				break;
			default:
				# code...
				break;
		}
	}
	
	header("location:./");
?>