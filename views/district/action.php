<?php
	session_start();
	require "../../config/config.php";
	require "../../models/district.php";
	require "../../controllers/district_controller.php";

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
			break;
	}
	
	header("location:./");
?>	
