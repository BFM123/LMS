<?php
	session_start();
	require "../../config/config.php";
	require "../../models/notice.php";
	require "../../controllers/notice_controller.php";
	
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

