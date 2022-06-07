<?php
	require_once "../../config/config.php";
	global $APPROVAL_STATUS;
	header("Location: ../tep/?l=" . array_keys($APPROVAL_STATUS)[2]);
?>