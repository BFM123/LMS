<?php
	session_start();
	$asset_path = "../../";
	require_once $asset_path . "config/config.php";	
	require_once $asset_path . "models/report.php";
	require_once $asset_path . "models/common.php";
	
	$invoice_number = (isset($_GET["invoice_number"])) ? $_GET["invoice_number"] : "";
	$organization_id = (isset($_GET["organization_id"])) ? $_GET["organization_id"] : "";

	if (strlen($invoice_number) > 0) {
		// this is an invoice download
		$currency = (isset($_GET["currency"])) ? $_GET["currency"] : "";
		$printed_by = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";

		$report = new report();
		$report->setOrganizationID($organization_id);
		$report->setReportName("Invoice");
		$report->setInvoiceNumber($invoice_number);
		$report->setCurrency($currency);
		$report->setDestination(PDF_FILE_EXT);
		$report->setPrintedBy($printed_by);
		$report->generate();
	} else {
		// this is a document download			
		$document_id = (isset($_GET["document_id"])) ? $_GET["document_id"] : "";
	
		// if this request is for an annual return document, then check for the document in licensing_organization_document
		$table_name_prefix = (isset($_GET["licensing_organization_id"])) ? "licensing_" : "";
		
		if (strlen($document_id) > 0) {
			$document_name = common::getFieldValue($table_name_prefix . "organization_document", "filename", "document_id", $document_id);														
			$file = DOCUMENT_UPLOAD_PATH . $document_name;
			if (file_exists($file)){
				header('Content-Description: Document');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=' . basename($file));
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
			} else {
				$document_category = common::getFieldValue($table_name_prefix . "organization_document", "document_category", "document_id", $document_id);														
				$_SESSION["message"] = "$document_category document not found";
				$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			}
		}
	}
	
	header("location: ./");
?>