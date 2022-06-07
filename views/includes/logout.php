<?php
	require "../../models/user.php";
	require "../../config/config.php";
	
	user::logout();
	
	header("Location: ../../");
?>