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
	} else {
		// this is a TEP proof of payment download	
		$payment_proof = (isset($_GET["payment_proof"])) ? $_GET["payment_proof"] : "";
		
		if (strlen($payment_proof) > 0) {
			$file = DOCUMENT_UPLOAD_PATH . $payment_proof;
			if (file_exists($file)){
				header('Content-Description: TEP Fee Proof of Payment');
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
				$_SESSION["message"] = "TEP fee proof of payment not found";
				$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			}
		}
	}

	$level = isset($_GET["l"]) ? $_GET["l"] : "";
	
	header("location: ./?l=$level");
?>