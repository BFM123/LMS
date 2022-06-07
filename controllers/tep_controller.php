<?php	
	function request(){
		global $APPROVAL_STATUS;
		$draft = array_keys($APPROVAL_STATUS)[0];
		$awaiting_approval_level2 = array_keys($APPROVAL_STATUS)[2];

		$organization_id  = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$organization_name  = isset($_POST["organization_name"]) ? $_POST["organization_name"] : "";
		$invoice_number  = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
		$tep_fullname = isset($_POST["tep_fullname"]) ? $_POST["tep_fullname"] : array();
		$tep_nationality = isset($_POST["tep_nationality"]) ? $_POST["tep_nationality"] : array();
		$tep_passport_number = isset($_POST["tep_passport_number"]) ? $_POST["tep_passport_number"] : array();
		$payment_proof = isset($_FILES["payment_proof"]) ? $_FILES["payment_proof"] : "";
		
		$action = isset($_POST["option"]) ? $_POST["option"] : "";
		$user_action = "request";
		$record_control = $awaiting_approval_level2;
		if (isset($_POST["draft"])) {
			$record_control = $draft;
			$user_action = "update";
		}
		
		$tep = new tep();
		$tep->setOrganizationID($organization_id);
		$tep->setOrganizationName($organization_name);
		$tep->setInvoiceNumber($invoice_number);
		$tep->setFullname($tep_fullname);
		$tep->setNationality($tep_nationality);
		$tep->setPassportNumber($tep_passport_number);
		$tep->setPaymentProof($payment_proof);		
		$tep->setAction($action);
		$tep->setUserAction($user_action);

		if ($action === "edit") {
			$tep_id = isset($_POST["tep_id"]) ? $_POST["tep_id"] : array();			 			
			$last_edited_by = isset($_POST["last_edited_by"]) ? $_POST["last_edited_by"] : "";
			$record_control = isset($_POST["record_control"]) ? $_POST["record_control"] : "";
		
			$tep->setTEPID($tep_id);
			$tep->setLastEditedBy($last_edited_by);
			$tep->setRecordControl($record_control);
			
			$tep->edit();
		} else {
			$tep->setRecordControl($record_control);
			$captured_by = isset($_POST["captured_by"]) ? $_POST["captured_by"] : "";
			$tep->setCapturedBy($captured_by);
			
			$tep->request();
		}
	}

	function edit(){
		request();
	}

	function approve(){				
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$organization_name = isset($_POST["organization_name"]) ? $_POST["organization_name"] : "";
		$invoice_number = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
		$approved_by = isset($_POST["approved_by"]) ? $_POST["approved_by"] : "";
		$record_control = isset($_POST["record_control"]) ? $_POST["record_control"] : "";
		$rejected_comments = isset($_POST["rejected_comments"]) ? $_POST["rejected_comments"] : "";
		$action = isset($_POST["option"]) ? $_POST["option"] : "";
		
		$tep = new tep();		
		$tep->setOrganizationID($organization_id);	
		$tep->setOrganizationName($organization_name);	
		$tep->setInvoiceNumber($invoice_number);
		$tep->setApprovedBy($approved_by);	
		$tep->setRecordControl($record_control);
		$tep->setRejectedComments($rejected_comments);
		$tep->setAction($action);
		
		$tep->approve();			
	}
	
	function reject(){
		approve();
	}

	function delete() {			
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$invoice_number = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
        $organization_name = isset($_POST["organization_name"]) ? $_POST["organization_name"] : "";
        $payment_proof = isset($_POST["payment_proof"]) ? $_POST["payment_proof"] : "";
        $deleted_by = isset($_POST["deleted_by"]) ? $_POST["deleted_by"] : "";

		$tep = new tep();
		$tep->setOrganizationID($organization_id);
		$tep->setInvoiceNumber($invoice_number);
        $tep->setOrganizationName($organization_name);
		$tep->setPaymentProof($payment_proof);		
		$tep->setDeletedBy($deleted_by);

		$tep->delete();
	}
?>
