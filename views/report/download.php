<?php
	session_start();
	require_once "../../config/config.php";
	require_once "../../models/report.php";
	require_once "../../controllers/report_controller.php";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
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
			case "download":
				download();
				break;
			default:
				# code...
				break;
		}
	}
	header("location:./");
?>
