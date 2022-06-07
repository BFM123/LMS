<?php
	function download(){
		$certificate_id = isset($_POST["certificate_id"]) ? $_POST["certificate_id"] : "";
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$certificate_category = isset($_POST["certificate_category"]) ? $_POST["certificate_category"] : "";
		$printed_by = isset($_POST["printed_by"]) ? $_POST["printed_by"] : "";
		
		$certificates = new certificate();		
		$certificates->setCertificateID($certificate_id);
		$certificates->setOrganizationID($organization_id);
		$certificates->setCategory($certificate_category);
		$certificates->setPrintedBy($printed_by);
	
		$certificates->download();
	}
?>