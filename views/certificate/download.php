<?php
	session_start();
	$asset_path = "../../";
	require_once $asset_path . "config/config.php";	
	require_once $asset_path . "models/report.php";
	require_once $asset_path . "models/common.php";
	
	$organization_id = (isset($_GET["organization_id"])) ? $_GET["organization_id"] : "";
	$certificate_id = (isset($_GET["certificate_id"])) ? $_GET["certificate_id"] : "";
	$certificate_category = (isset($_GET["certificate_category"])) ? $_GET["certificate_category"] : "";
	$printed_by = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";

	if (isset($_GET["organization_id"])) {
		$report = new report();
		$report->setCertificateID($certificate_id);
		$report->setOrganizationID($organization_id);
		$report->setReportName($certificate_category);
		$report->setDestination(PDF_FILE_EXT);
		$report->setPrintedBy($printed_by);
		$report->generate();
	}
	$level = isset($_GET["l"]) ? $_GET["l"] : "";
	
	header("location: ./?l=$level");
?>

