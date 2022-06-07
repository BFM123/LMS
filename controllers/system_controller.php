<?php 	 
	function add(){	
		$title = (isset($_POST["title"])) ? $_POST["title"] : "";
		$licensee = (isset($_POST["licensee"])) ? $_POST["licensee"] : "";
		$landing_page_id = (isset($_POST["landing_page_id"])) ? $_POST["landing_page_id"] : "";
		$technical_support_contact = (isset($_POST["technical_support_contact"])) ? $_POST["technical_support_contact"] : "";
		$address = (isset($_POST["address"])) ? $_POST["address"] : "";
		$slogan = (isset($_POST["slogan"])) ? $_POST["slogan"] : "";
		$website = (isset($_POST["website"])) ? $_POST["website"] : "";
		$email = (isset($_POST["email"])) ? $_POST["email"] : "";
		$telephone = (isset($_POST["telephone"])) ? $_POST["telephone"] : "";
		$captured_by = (isset($_POST["captured_by"])) ? $_POST["captured_by"] : "";
	
		$system = new system();
		$system->setTitle($title);
		$system->setLicensee($licensee);
		$system->setSlogan($slogan);
		$system->setLandingPageID($landing_page_id);
		$system->setTechnicalSupportContact($technical_support_contact);
		$system->setAddress($address);
		$system->setWebsite($website);
		$system->setEmail($email);
		$system->setTelephone($telephone);
		$system->setCapturedBy($captured_by);
		
		$system->add();
	}
	
	function edit(){
		$system_id = (isset($_POST["system_id"])) ? $_POST["system_id"] : "";
		$title = (isset($_POST["title"])) ? $_POST["title"] : "";
		$licensee = (isset($_POST["licensee"])) ? $_POST["licensee"] : "";
		$landing_page_id = (isset($_POST["landing_page_id"])) ? $_POST["landing_page_id"] : "";
		$technical_support_contact = (isset($_POST["technical_support_contact"])) ? $_POST["technical_support_contact"] : "";
		$address = (isset($_POST["address"])) ? $_POST["address"] : "";
		$slogan = (isset($_POST["slogan"])) ? $_POST["slogan"] : "";
		$website = (isset($_POST["website"])) ? $_POST["website"] : "";
		$email = (isset($_POST["email"])) ? $_POST["email"] : "";
		$telephone = (isset($_POST["telephone"])) ? $_POST["telephone"] : "";
		$last_edited_by = (isset($_POST["last_edited_by"])) ? $_POST["last_edited_by"] : "";
	
		$system = new system();
		$system->setSystemID($system_id);
		$system->setTitle($title);
		$system->setLicensee($licensee);
		$system->setSlogan($slogan);
		$system->setLandingPageID($landing_page_id);
		$system->setTechnicalSupportContact($technical_support_contact);
		$system->setAddress($address);
		$system->setWebsite($website);
		$system->setEmail($email);
		$system->setTelephone($telephone);
		$system->setLastEditedBy($last_edited_by);
	 
		$system->edit();
	}
	
	function delete(){
		$system_id = (isset($_POST["system_id"])) ? $_POST["system_id"] : "";
		$deleted_by = (isset($_POST["deleted_by"])) ? $_POST["deleted_by"] : "";
	
		$system = new system();
		$system->setSystemID($system_id);
		$system->setDeletedBy($deleted_by);
	
		$system->delete();
	}
?>