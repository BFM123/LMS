<?php
	session_start();
	require "../../config/config.php";
	require "../../models/fee.php";
	require "../../models/payment.php";
	require "../../controllers/fee_controller.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$action = $_POST["option"];
		$action();
	}
	
	header("location: ./");
?>