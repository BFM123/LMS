<?php
	require_once "../../config/config.php";
	global $APPROVAL_STATUS;
	header("Location: ../licensing/?l=" . array_keys($APPROVAL_STATUS)[2]);
?>