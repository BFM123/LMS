<?php
	require_once "../../config/config.php";
	global $APPROVAL_STATUS;
	header("Location: ../registration/?l=" . array_keys($APPROVAL_STATUS)[4]);
?>