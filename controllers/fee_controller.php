<?php			 
	function add() {
		$fee_category = isset($_POST["fee_category"]) ? $_POST["fee_category"] : "";
		$invoice_time = isset($_POST["invoice_time"]) ? $_POST["invoice_time"] : "";
		$based_on_income = isset($_POST["based_on_income"]) ? $_POST["based_on_income"] : "No";
		$from_income = isset($_POST["from_income"]) ? $_POST["from_income"] : "";
		$from_income = str_replace(",", "", $from_income); // remove commas
		$to_income = isset($_POST["to_income"]) ? $_POST["to_income"] : "";
		$to_income = str_replace(",", "", $to_income); // remove commas
		$amount = isset($_POST["amount"]) ? $_POST["amount"] : "";
		$amount = str_replace(",", "", $amount); // remove commas
		$currency = isset($_POST["currency"]) ? $_POST["currency"] : "";
		$captured_by = isset($_POST["captured_by"]) ? $_POST["captured_by"] : "";
	
		$fee = new fee();
		$fee->setFeeCategory($fee_category);
		$fee->setInvoiceTime($invoice_time);
		$fee->setBasedOnIncome($based_on_income);
		$fee->setFromIncome($from_income);
		$fee->setToIncome($to_income);
		$fee->setCurrency($currency);
		$fee->setAmount($amount);
		$fee->setCapturedBy($captured_by);
		
		$fee->add();
	}
	
	function edit() {
		$fee_id = isset($_POST["fee_id"]) ? $_POST["fee_id"] : "";
		$fee_category = isset($_POST["fee_category"]) ? $_POST["fee_category"] : "";
		$invoice_time = isset($_POST["invoice_time"]) ? $_POST["invoice_time"] : "";
		$based_on_income = isset($_POST["based_on_income"]) ? $_POST["based_on_income"] : "No";
		$from_income = isset($_POST["from_income"]) ? $_POST["from_income"] : "";
		$from_income = str_replace(",", "", $from_income); // remove commas
		$to_income = isset($_POST["to_income"]) ? $_POST["to_income"] : "";
		$to_income = str_replace(",", "", $to_income); // remove commas
		$amount = isset($_POST["amount"]) ? $_POST["amount"] : "";
		$amount = str_replace(",", "", $amount); // remove commas
		$currency = isset($_POST["currency"]) ? $_POST["currency"] : "";
		$last_edited_by = isset($_POST["last_edited_by"]) ? $_POST["last_edited_by"] : "";
	
		$fee = new fee();
		$fee->setFeeID($fee_id);
		$fee->setFeeCategory($fee_category);
		$fee->setInvoiceTime($invoice_time);
		$fee->setBasedOnIncome($based_on_income);
		$fee->setFromIncome($from_income);
		$fee->setToIncome($to_income);
		$fee->setCurrency($currency);
		$fee->setAmount($amount);		
		$fee->setLastEditedBy($last_edited_by);
	 
		$fee->edit();
	}
	
	function delete() {
		$fee_id = isset($_POST["fee_id"]) ? $_POST["fee_id"] : "";
		$fee_category = isset($_POST["fee_category"]) ? $_POST["fee_category"] : "";
		$deleted_by = isset($_POST["deleted_by"]) ? $_POST["deleted_by"] : "";
	
		$fee = new fee();
		$fee->setFeeID($fee_id);
		$fee->setFeeCategory($fee_category);
		$fee->setDeletedBy($deleted_by);
	
		$fee->delete();
	}
	
	function payment_settings(){
		$payment_mode_items = isset($_POST["payment_mode_items"]) ? $_POST["payment_mode_items"] : "";
		$invoice_number_prefix = isset($_POST["invoice_number_prefix"]) ? $_POST["invoice_number_prefix"] : "";		
		$invoice_number_format = isset($_POST["invoice_number_format"]) ? $_POST["invoice_number_format"] : "";		
		$receipt_number_prefix = isset($_POST["receipt_number_prefix"]) ? $_POST["receipt_number_prefix"] : "";
		$receipt_number_format = isset($_POST["receipt_number_format"]) ? $_POST["receipt_number_format"] : "";		
		
		$captured_by = isset($_POST["captured_by"]) ? $_POST["captured_by"] : "";
		
		$payment = new payment();
		$payment->setPaymentModesItems($payment_mode_items);
		$payment->setInvoiceNumberPrefix($invoice_number_prefix);
		$payment->setInvoiceNumberFormat($invoice_number_format);
		$payment->setReceiptNumberPrefix($receipt_number_prefix);
		$payment->setReceiptNumberFormat($receipt_number_format);
		$payment->setCapturedBy($captured_by);
	
		$payment->payment_settings();
	}
?>