<?php
	session_start();
	require "../../config/config.php";
	require "../../models/payment.php";
	require "../../controllers/payment_controller.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$action = $_POST["option"];
		$action();
	}
	
	$level = (isset($_POST["l"]) && $action === "approval") ? $_POST["l"] : "";	
	
	header("location: ./?l=$level");
?>