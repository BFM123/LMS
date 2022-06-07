<?php
	session_start();
	require "../../config/config.php";
	require "../../models/menu.php";
	require "../../controllers/menu_controller.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$action = $_POST["option"];
	
		switch ($action) {
			case "add":
				add();
				header("location:./");
				break;
			case "edit":
				edit();
				header("location:./");
				break;
			case "delete":
				delete();
				header("location:./");
				break;
			default:
				# code...
				break;
		}
	}
?>

