<?php
	session_start();
	$asset_path = "../../";
	require_once $asset_path . "config/config.php";	
	require_once $asset_path . "models/report.php";
	require_once $asset_path . "models/common.php";
	
	$fee_category = (isset($_GET["invoice_number"])) ? $_GET["invoice_number"] : "";
	$organization_id = (isset($_GET["organization_id"])) ? $_GET["organization_id"] : "";

	if (isset($_GET["invoice_number"])) {
		// this is an invoice download
		$currency = (isset($_GET["currency"])) ? $_GET["currency"] : "";
		$fee_amount = (isset($_GET["amount"])) ? $_GET["amount"] : "";
		$printed_by = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
	
		$report = new report();
		$report->setOrganizationID($organization_id);
		$report->setReportName("Proforma Invoice");
		$report->setInvoiceNumber("");
		$report->setFeeCategory($fee_category);
		$report->setCurrency($currency);
		$report->setFeeAmount($fee_amount);
		$report->setDestination(PDF_FILE_EXT);
		$report->setPrintedBy($printed_by);
		$report->generate();
	} elseif (isset($_GET["form"])) {
		// this is a form download
		$form = (isset($_GET["form"])) ? $_GET["form"] : "";
		$licensing_organization_id = (isset($_GET["licensing_organization_id"])) ? $_GET["licensing_organization_id"] : "";
		$printed_by = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";

		$report = new report();
		$report->setLicensingOrganizationID($licensing_organization_id);
		$report->setReportName($form);
		$report->setDestination(PDF_FILE_EXT);
		$report->setPrintedBy($printed_by);
		$report->generate();
	} else {
		// this is a document download	
		$document_id = (isset($_GET["document_id"])) ? $_GET["document_id"] : "";
		$licensing_organization_id = (isset($_GET["licensing_organization_id"])) ? $_GET["licensing_organization_id"] : "";
		
		if (strlen($document_id) > 0 && strlen($licensing_organization_id) > 0) {
			$document_name = common::getFieldValue("licensing_organization_document", "filename", "document_id", $document_id, "licensing_organization_id", 
												   $licensing_organization_id);														
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
				$document_category = common::getFieldValue("licensing_organization_document", "document_category", "document_id", $document_id, "licensing_organization_id",
														   $licensing_organization_id);														
				$_SESSION["message"] = ucfirst(strtolower($document_category)) . " document not found";
				$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			}
		}
	}
	$level = isset($_GET["l"]) ? $_GET["l"] : "";
	
	header("location: ./?l=$level");
?>