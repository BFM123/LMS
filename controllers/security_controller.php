<?php
	function add(){
		$account_lockout_duration = $_POST["account_lockout_duration"];
		$account_lockout_threshold = $_POST["account_lockout_threshold"];
		$account_unlock_duration = $_POST["account_unlock_duration"];
		$captured_by = $_POST["captured_by"];
		
		$security = new security();
		$security->setAccountLockoutDuration($account_lockout_duration);
		$security->setAccountAutoUnlockDuration($account_unlock_duration);
		$security->setAccountLockoutThreshold($account_lockout_threshold);
		$security->setCapturedBy($captured_by);
		$security->add();
	}
?>