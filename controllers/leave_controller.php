<?php	
	function Request() {
		global $APPROVAL_STATUS;

		// Leave details
		$leave_id = isset($_POST["leave_id"]) ? $_POST["leave_id"] : "";
		$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "";
		$organization_id = isset($_SESSION["organization_id"]) ? $_SESSION["organization_id"] : "";
		$record_control= isset($_POST["record_control"]) ? $_POST["record_control"] : "";
		$start_date = isset($_POST["start_date"]) ? $_POST["start_date"] : "";
		$end_date = isset($_POST["end_date"]) ? $_POST["end_date"] : "";
		$duration = isset($_POST["num_of_days"]) ? $_POST["num_of_days"] : "";
		$leave_type = isset($_POST["leave_type"]) ? $_POST["leave_type"] : "";
		$comments = isset($_POST["comments"]) ? $_POST["comments"] : "";
		$captured_by = isset($_POST["captured_by"]) ? $_POST["captured_by"] : "";
		$requested_for = isset($_POST["requested_for"]) ? $_POST["requested_for"] : "";
		$supporting_document = isset($_FILES["supporting_document"]) ? $_FILES["supporting_document"] : array();
		$record_control = array_keys($APPROVAL_STATUS)[1];
		$documents = array("supporting_document" => $supporting_document);

		$leave = new leave();
		// Pass Leave details to Set methods
		$leave->setLeaveID($leave_id);
		$leave->setOrganizationID($organization_id);
		$leave->setUserID($user_id);
		$leave->setRecordControl($record_control);
		$leave->setStartDate($start_date);
		$leave->setEndDate($end_date);
		$leave->setDuration($duration);
		$leave->setComments($comments);
		$start_date = strtotime($start_date);		
		$end_date = strtotime($end_date);		
		$leave->setLeaveType($leave_type);
		$leave->setCapturedBy($captured_by); 
		$leave->setRequestedFor($requested_for); 
		// documents
		$leave->setDocuments($documents);

		$leave->add();
	}

	function delete() {
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$leave_id = isset($_POST["leave_id"]) ? $_POST["leave_id"] : "";
        $deleted_by = isset($_POST["deleted_by"]) ? $_POST["deleted_by"] : "";
        $deleted_for = isset($_POST["deleted_for"]) ? $_POST["deleted_for"] : "";

		$leave = new leave();
		$leave->setOrganizationID($organization_id);
		$leave->setLeaveID($leave_id);
		$leave->setDeletedBy($deleted_by);
		$leave->setDeletedFor($deleted_for);

		$leave->delete();
	}
	
	function approve(){		
		// Leave details
		$leave_id = isset($_POST["leave_id"]) ? $_POST["leave_id"] : "";
		$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "";
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$approved_by = isset($_POST["approved_by"]) ? $_POST["approved_by"] : "";
		$record_control= isset($_POST["record_control"]) ? $_POST["record_control"] : "";
		$start_date = isset($_POST["start_date"]) ? $_POST["start_date"] : "";
		$end_date = isset($_POST["end_date"]) ? $_POST["end_date"] : "";
		$leave_type = isset($_POST["leave_type"]) ? $_POST["leave_type"] : "";
		$comments = isset($_POST["comments"]) ? $_POST["comments"] : "";
		$captured_by = isset($_POST["captured_by"]) ? $_POST["captured_by"] : "";

		$action = isset($_POST["option"]) ? $_POST["option"] : "";

		$leave = new leave();
		// Pass Leave details to Set methods
		$leave->setLeaveID($leave_id);
		$leave->setUserID($user_id);
		$leave->setOrganizationID($organization_id);
		$leave->setApprovedBy($approved_by);	
		$leave->setRecordControl($record_control);
		$leave->setAction($action);
		$leave->setStartDate($start_date);
		$leave->setEndDate($end_date);
		$leave->setComments($comments);
		$start_date = strtotime($start_date);		
		$end_date = strtotime($end_date);		
		$leave->setLeaveType($leave_type);
		$leave->setCapturedBy($captured_by); 

		$leave->approve();
	}
	
	function reject(){
		approve();
	}
?>
