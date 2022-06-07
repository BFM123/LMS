<?php
	function add() {
		$username = (isset($_POST["username"])) ? $_POST["username"] : "";
		$password = (isset($_POST["password"])) ? $_POST["password"] : "";
		$confirm_password = (isset($_POST["confirm_password"])) ? $_POST["confirm_password"] : "";
		$firstname = (isset($_POST["firstname"])) ? $_POST["firstname"] : "";
		$lastname = (isset($_POST["lastname"])) ? $_POST["lastname"] : "";
		$position = (isset($_POST["position"])) ? $_POST["position"] : "";
		$email = (isset($_POST["email"])) ? $_POST["email"] : "";
		$organization_id = (isset($_POST["organization_id"])) ? $_POST["organization_id"] : "";
		$district_id = (isset($_POST["district_id"])) ? $_POST["district_id"] : "";
		$role_id = (isset($_POST["role_id"])) ? $_POST["role_id"] : "";
		$photo = $_FILES["photo"];
		$change_password = (isset($_POST["change_password"])) ? $_POST["change_password"] : "No";
		$account_disabled = (isset($_POST["account_disabled"])) ? $_POST["account_disabled"] : "No";
		$account_locked = (isset($_POST["account_locked"])) ? $_POST["account_locked"] : "No";
		$is_ngo_user = (isset($_POST["is_ngo_user"])) ? $_POST["is_ngo_user"] : "No";
		$captured_by = (isset($_POST["captured_by"])) ? $_POST["captured_by"] : "";
		
		$user = new user();
		$user->setUsername($username);
		$user->setPassword($password);
		$user->setConfirmPassword($confirm_password);
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setPosition($position);
		$user->setEmail($email);
		$user->setOrganizationID($organization_id);
		$user->setDistrictID($district_id);
		$user->setRoleID($role_id);
		$user->setPhoto($photo);
		$user->setChangePassword($change_password);
		$user->setAccountDisabled($account_disabled);
		$user->setAccountLocked($account_locked);
		$user->setIsNGOUser($is_ngo_user);
		$user->setCapturedBy($captured_by);
		$user->add();
	}
	
	function edit() {
		$from_page = (isset($_POST["from_page"])) ? $_POST["from_page"] : "";		
		$user_id = (isset($_POST["user_id"])) ? $_POST["user_id"] : "";
		$role_id = (isset($_POST["role_id"])) ? $_POST["role_id"] : "";
       	$username = (isset($_POST["username"])) ? $_POST["username"] : "";
		$old_password = (isset($_POST["old_password"])) ? $_POST["old_password"] : "";		
		$password = (isset($_POST["password"])) ? $_POST["password"] : "";
		$confirm_password = (isset($_POST["confirm_password"])) ? $_POST["confirm_password"] : "";
		$firstname = (isset($_POST["firstname"])) ? $_POST["firstname"] : "";
		$lastname = (isset($_POST["lastname"])) ? $_POST["lastname"] : "";
		$organization_id = (isset($_POST["organization_id"])) ? $_POST["organization_id"] : "";
		$position = (isset($_POST["position"])) ? $_POST["position"] : "";
		$email = (isset($_POST["email"])) ? $_POST["email"] : "";
		$district_id = (isset($_POST["district_id"])) ? $_POST["district_id"] : "";
		if (in_array($from_page, array("user-account", "user-activation"))) {
			$photo = (isset($_FILES["photo"])) ? $_FILES["photo"] : ""; // this check is to take care of requests from acocunt verifications via email
		} else {
			$photo = $_FILES["photo"];
		}
		$change_password = (isset($_POST["change_password"])) ? $_POST["change_password"] : "No";
		$account_disabled = (isset($_POST["account_disabled"])) ? $_POST["account_disabled"] : "No";
		$account_locked = (isset($_POST["account_locked"])) ? $_POST["account_locked"] : "No";
		$is_ngo_user = (isset($_POST["is_ngo_user"])) ? $_POST["is_ngo_user"] : "No";
		$send_activation_email = (isset($_POST["send_activation_email"])) ? $_POST["send_activation_email"] : "No";
		$last_edited_by = (isset($_POST["last_edited_by"])) ? $_POST["last_edited_by"] : "";
		
		$user = new user();
		$user->setUserID($user_id);
		$user->setFromPage($from_page);
		$user->setUsername($username);
		$user->setOldPassword($old_password);
		$user->setPassword($password);
		$user->setConfirmPassword($confirm_password);
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setPosition($position);
		$user->setEmail($email);
		$user->setOrganizationID($organization_id);
		$user->setDistrictID($district_id);
		$user->setRoleID($role_id);		
		if (is_array($photo)) {
			// this check is to take care of requests from acocunt verifications via email
			$user->setPhoto($photo);
		}
		$user->setChangePassword($change_password);
		$user->setAccountDisabled($account_disabled);
		$user->setAccountLocked($account_locked);
		$user->setIsNGOUser($is_ngo_user);
		$user->setSendActivationEmail($send_activation_email);
		$user->setLastEditedBy($last_edited_by);
		$user->edit();
	}
	
	function delete(){
		$user_id = (isset($_POST["user_id"])) ? $_POST["user_id"] : "";
		$username = (isset($_POST["username"])) ? $_POST["username"] : "";
		$photo = $_POST["photo"];
		$deleted_by = (isset($_POST["deleted_by"])) ? $_POST["deleted_by"] : "";
	
		$user = new user();
		$user->setUserID($user_id);
		$user->setUsername($username);
		$user->setPhoto($photo);
		$user->setDeletedBy($deleted_by);
		$user->delete();
	}
	
	function login(){		
		$username = (isset($_POST["username"])) ? $_POST["username"] : "";
		$password = (isset($_POST["password"])) ? $_POST["password"] : "";
		
		$user = new user();
		$user->setUsername($username);
		$user->setPassword($password);
		$user->login();
	}
?>