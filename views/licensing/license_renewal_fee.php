<?php
    $asset_path = "../../";
   
    require_once $asset_path . "config/config.php";
    require_once $asset_path . "models/fee.php";
    require_once $asset_path . "models/payment.php";
    require_once "modal.php";

	$annual_income = isset($_POST["annual_income"]) ? $_POST["annual_income"] : 0;
	$currency = isset($_POST["currency"]) ? $_POST["currency"] : "";
	$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
	$fee_category = isset($_POST["fee_category"]) ? $_POST["fee_category"] : "";
	$license_renewal_fee = fee::getFees(INVOICE_TIME_YEARLY, $annual_income);

	$invoice_link = "download.php?organization_id=$organization_id&invoice_number=$fee_category&currency=$currency&amount=$license_renewal_fee";	
	$download_invoice = "
	<a href=\"#\" title=\"Download Proforma Invoice\"onclick=\"window.location.href='$invoice_link'\">
		<i class=\"fa fa-file-pdf-o fa-lg\" style=\"color:#ee0000; margin-left: 5px;\"></i>
	</a>";
	
	echo "$currency " . payment::formatLargeNumber($license_renewal_fee) . $download_invoice;
?>