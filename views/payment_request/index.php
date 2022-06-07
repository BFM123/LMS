<?php
	require_once "../../config/config.php";
	global $APPROVAL_STATUS;
	header("Location: ../payment_approval/?l=" . array_keys($APPROVAL_STATUS)[0]);
?>