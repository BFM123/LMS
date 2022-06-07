<?php
	session_start();
	require "../../config/config.php";
	require "../../models/user.php";
	require "../../controllers/user_controller.php";
	
	$return_url = "./";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		switch ($_POST["option"]) {
			case "add":
				add();
				break;
			case "edit":
				edit();
				$return_url = isset($_POST["return_url"]) ? "../../" . $_POST["return_url"] : "./";
				break;
			case "delete":
				delete();
				break;
	
			default:
				# code...
				break;
		}
	}
	
	header("location:$return_url");
?>