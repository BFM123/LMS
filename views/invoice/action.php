<?php
	session_start();
	require "../../config/config.php";
	require "../../models/invoice.php";
	require "../../controllers/invoice_controller.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$action = $_POST["option"];
		$action();
	}
	
	header("location: ./");
?>