<?php			 
	function pay() {
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$invoice_number = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
		$invoice_year = isset($_POST["invoice_year"]) ? $_POST["invoice_year"] : "";
		$invoice_time = isset($_POST["invoice_time"]) ? $_POST["invoice_time"] : "";
		$payment_mode = isset($_POST["payment_mode"]) ? $_POST["payment_mode"] : "";
		$payment_reference = isset($_POST["payment_reference"]) ? $_POST["payment_reference"] : "";
		$payment_amount = isset($_POST["payment_amount"]) ? $_POST["payment_amount"] : "";
		$payment_amount = str_replace(",", "", $payment_amount); // remove commas
		$currency = isset($_POST["currency"]) ? $_POST["currency"] : "";
		$captured_by = isset($_POST["captured_by"]) ? $_POST["captured_by"] : "";
		
		$payment = new payment();
		$payment->setOrganizationID($organization_id);
		$payment->setInvoiceNumber($invoice_number);
		$payment->setInvoiceYear($invoice_year);
		$payment->setInvoiceTime($invoice_time);
		$payment->setPaymentMode($payment_mode);
		$payment->setPaymentReference($payment_reference);
		$payment->setPaymentAmount($payment_amount);
		$payment->setCurrency($currency);
		$payment->setCapturedBy($captured_by);
		
		$payment->pay();
	}
	
	function reverse() {
		$invoice_number = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
		$reverse_details = isset($_POST["reverse_details"]) ? $_POST["reverse_details"] : "";
		$reason = isset($_POST["reason"]) ? $_POST["reason"] : "";
		$reversed_by = isset($_POST["reversed_by"]) ? $_POST["reversed_by"] : "";
	
		$payment = new payment();
		$payment->setInvoiceNumber($invoice_number);
		$payment->setReverseDetails($reverse_details);
		$payment->setPaymentReference($reason);
		$payment->setReversedBy($reversed_by);
		$payment->reverse();
	}
	
	function refund() {
		$invoice_number = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
		$currency = isset($_POST["currency"]) ? $_POST["currency"] : "";
		$refund_amount = isset($_POST["refund_amount"]) ? $_POST["refund_amount"] : "";
		$refund_amount = str_replace(",", "", $refund_amount); // remove commas
		$reason = isset($_POST["reason"]) ? $_POST["reason"] : "";
		$refunded_by = isset($_POST["refunded_by"]) ? $_POST["refunded_by"] : "";
	
		$payment = new payment();
		$payment->setInvoiceNumber($invoice_number);
		$payment->setCurrency($currency);
		$payment->setRefundAmount($refund_amount);
		$payment->setPaymentReference($reason);
		$payment->setRefundedBy($refunded_by);
		$payment->refund();
	}
	
	function approval() {
		$action = isset($_POST["action"]) ? $_POST["action"] : "";
		$level = isset($_POST["l"]) ? $_POST["l"] : "";
		$payment_id = isset($_POST["payment_id"]) ? $_POST["payment_id"] : "";
		$invoice_number = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
		$receipt_number = isset($_POST["receipt_number"]) ? $_POST["receipt_number"] : "";
		$request = isset($_POST["request"]) ? $_POST["request"] : "";
		$approval_comments = isset($_POST["approval_comments"]) ? $_POST["approval_comments"] : "";
		$record_control = isset($_POST["record_control"]) ? $_POST["record_control"] : "";
		$currency = isset($_POST["currency"]) ? $_POST["currency"] : "";
		$captured_by = isset($_POST["captured_by"]) ? $_POST["captured_by"] : "";
	
		$payment = new payment();
		$payment->setAction($action);
		$payment->setLevel($level);
		$payment->setPaymentID($payment_id);
		$payment->setInvoiceNumber($invoice_number);
		$payment->setReceiptNumber($receipt_number);
		$payment->setRequest($request);
		$payment->setPaymentReference($approval_comments);
		$payment->setRecordControl($record_control);
		$payment->setCurrency($currency);
		$payment->setCapturedBy($captured_by);
		$payment->approval();
	}
?>