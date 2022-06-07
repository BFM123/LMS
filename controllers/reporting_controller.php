`<?php 	 
	function add(){			
		$report_acceptance_status = $_POST["report_acceptance_status"];
		$report_approval_levels = $_POST["report_approval_levels"];
		$reporting_deadline = $_POST["reporting_deadline"];
		$captured_by = $_POST["captured_by"];
	
		$reporting = new reporting();
		$reporting->setReportAcceptanceStatus($report_acceptance_status);
		$reporting->setReportApprovalLevels($report_approval_levels);
		$reporting->setReportingDeadline($reporting_deadline);
		$reporting->setCapturedBy($captured_by);
		
		$reporting->add();
	}
	
	function edit(){
		$reporting_id = $_POST["reporting_id"];
		$report_acceptance_status = $_POST["report_acceptance_status"];
		$report_approval_levels = $_POST["report_approval_levels"];
		$reporting_deadline = $_POST["reporting_deadline"];
		$last_edited_by = $_POST["last_edited_by"];
	
		$reporting = new reporting();
		$reporting->setReportingID($reporting_id);
		$reporting->setReportAcceptanceStatus($report_acceptance_status);
		$reporting->setReportApprovalLevels($report_approval_levels);
		$reporting->setReportingDeadline($reporting_deadline);
		$reporting->setLastEditedBy($last_edited_by);
	 
		$reporting->edit();
	}
	
	function delete(){
		$reporting_id = $_POST["reporting_id"];
		$deleted_by = $_POST["deleted_by"];
	
		$reporting = new reporting();
		$reporting->setReportingID($reporting_id);
		$reporting->setDeletedBy($deleted_by);
	
		$reporting->delete();
	}
?>