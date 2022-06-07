<?php			 
	function generate() {			
		$organization_id = isset($_POST["organization_id"]) ?  $_POST["organization_id"] : "";
		$fee_category = isset($_POST["fee_category"]) ?  $_POST["fee_category"] : "";
		$invoice_year = isset($_POST["invoice_year"]) ?  $_POST["invoice_year"] : "";
		$captured_by = isset($_POST["captured_by"]) ?  $_POST["captured_by"] : "";
				 
		$invoice = new invoice();
		$invoice->setOrganizationID($organization_id);
		$invoice->setFeeCategory($fee_category);
		$invoice->setInvoiceYear($invoice_year);													
		$invoice->setCapturedBy($captured_by);
		
		$invoice->generate();
	}
?>