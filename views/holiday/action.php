<?php
	session_start();
	require "../../config/config.php";
	require "../../models/holiday.php";
	require "../../controllers/holiday_controller.php";
	
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
	
		switch ($_POST["option"]) {
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

