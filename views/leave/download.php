<?php
	session_start();
	$asset_path = "../../";
	require_once $asset_path . "config/config.php";
	require_once $asset_path . "models/report.php";
	require_once $asset_path . "models/common.php";
	
	// this is a document download
	$document_id = (isset($_GET["document_id"])) ? $_GET["document_id"] : "";
	$organization_id = (isset($_GET["organization_id"])) ? $_GET["organization_id"] : "";

	if (strlen($document_id) > 0 && strlen($organization_id) > 0) {
		$document_name = common::getFieldValue("document", "filename", "document_id", $document_id, "organization_id", $organization_id);														
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
			$document_category = common::getFieldValue("document", "document_category", "document_id", $document_id, "organization_id", $organization_id);														
			$_SESSION["message"] =  ucfirst(strtolower($document_category)) . " document not found";
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
	}
	$level = isset($_GET["l"]) ? $_GET["l"] : "";
	
	header("location: ./?l=$level");
?>