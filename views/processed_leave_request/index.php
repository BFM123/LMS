<?php
	require_once "../../config/config.php";
	global $APPROVAL_STATUS;
	header("Location: ../leave/?l=" . array_keys($APPROVAL_STATUS)[0]);
?>