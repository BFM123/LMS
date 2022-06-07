<?php

/**
 * A class for managing modals
 */

class modal
{
	/**
     * display table
     *
     * @param int index
     * @param string logged_username
	 * @param string access_right
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayTable($index, $logged_username, $access_right, $currency, $form_elements = array())
    {
		global $APPROVAL_STATUS;
		$approved = array_keys($APPROVAL_STATUS)[2];
		
		$invoice_id = $form_elements["invoice_id"];
		$invoice_number = $form_elements["invoice_number"];
		$organization_id = $form_elements["organization_id"]; 
		$organization_name = $form_elements["organization_name"];
		//$organization_name .= " <b>Reg No: " . $form_elements["registration_number"] . " | Reg Year: " . $form_elements["registration_year"] . "</b>";
		$organization_name .= " <b>Reg No: " . $form_elements["registration_number"] . "</b>";
		$invoice_year = $form_elements["invoice_year"];
		// $annual_income = $form_elements["annual_income"];
		$invoice_time = $form_elements["invoice_time"]; // comma delimitted list of invoice times
		$invoice_time = explode(",", $invoice_time); 

		$executive_director_fullname = $form_elements["executive_director_fullname"]; 
		$telephone = $form_elements["telephone"];
		$email = $form_elements["email"];
        $contact_details = "$executive_director_fullname > $telephone > $email";
		$contact_details = str_replace(">  >", ">", $contact_details);
		if (common::startsWith($contact_details, " > ")) $contact_details = substr($contact_details, 3); // remove the first ' > ' from the string							
		if (common::endsWith($contact_details, " > ")) $contact_details = substr_replace($contact_details, "", -3); // remove the last ' > ' from the string

		$fee_category = $form_elements["fee_category"];
		$invoice_amount = (strlen($form_elements["amount"]) > 0) ? $form_elements["amount"] : 0;
		$amount_paid = common::getFieldValue("payment", "SUM(amount)", "invoice_number", $invoice_number, "record_control", $approved);
		
        if (strlen($amount_paid) == 0) $amount_paid = 0;
        $balance = $invoice_amount - $amount_paid;

		$class = ($invoice_year == date("Y")) ? " alert-info" : "";
		
		$download_invoice = "";
		if (in_array(INVOICE_TIME_REGISTRATION, $invoice_time)) {
			// get proof of payment for registration fee
			$table_name = "organization_document";
			$table_id = "organization_id";
			$table_id_value = $organization_id;
			$document_category = DOCUMENT_CATEGORY_PAYMENT_PROOF_REGISTRATION;
			$parameters = "&organization_id=$organization_id";
			
			$proof_of_payment_document_id = common::getFieldValue($table_name, "document_id", $table_id, $table_id_value, "document_category", $document_category);
			$proof_of_payment_document = common::getFieldValue($table_name, "filename", $table_id, $table_id_value, "document_id", $proof_of_payment_document_id);				
		} elseif (in_array(INVOICE_TIME_YEARLY, $invoice_time)) {
			// get proof of payment for annual license fee
			$table_name = "licensing_organization_document";
			$table_id = "licensing_organization_id";
			$licensing_organization_id = common::getFieldValue("licensing_organization", "licensing_organization_id", "organization_id", $organization_id, "reporting_year",
															  $invoice_year);
			$table_id_value = $licensing_organization_id;
			$document_category = DOCUMENT_CATEGORY_PAYMENT_PROOF_LICENSE;
			$parameters = "&organization_id=$organization_id&licensing_organization_id=$licensing_organization_id";
			
			$proof_of_payment_document_id = common::getFieldValue($table_name, "document_id", $table_id, $table_id_value, "document_category", $document_category);
			$proof_of_payment_document = common::getFieldValue($table_name, "filename", $table_id, $table_id_value, "document_id", $proof_of_payment_document_id);			
	
		} elseif (in_array(INVOICE_TIME_TEP, $invoice_time)) {
			// get proof of payment for TEP fee
			$table_name = "tep";
			$document_category = "TEP payment proof";
			
			$proof_of_payment_document_id = 0; // not necessary, assign any integer
			$proof_of_payment_document = common::getFieldValue("tep", "payment_proof", "organization_id", $organization_id, "invoice_number", $invoice_number);
			$parameters = "&organization_id=$organization_id&document_name=$proof_of_payment_document&document_category=$document_category";
		}
	
		// get document type
		$document_extension = explode(".", $proof_of_payment_document); $document_extension = strtolower(end($document_extension));
		$document_type = $document_extension;
		$icon_color = "ee0000";						
		if (in_array($document_extension, array("doc", "docx"))) {
			$document_type = "word";
			$icon_color = "0000ff";
		} elseif (in_array($document_extension, array("xls", "xlsx"))) {
			$document_type = "excel";
			$icon_color = "008800";
		}
		
		// define download proof of payment link
		$icon_download = "
		<br /><a href=\"#\" title=\"Download Proof of Payment\" onclick=\"window.location.href='download.php?document_id=$proof_of_payment_document_id$parameters'\">
			<i class=\"fa fa-file-$document_type-o fa-lg\"style=\"color:#$icon_color;margin-top:7px;\"></i> Proof of Payment
		</a>";			

		// define download invoice link
		//$fee = $invoice_amount; //fee::getFees($invoice_time, $annual_income);
	
		// $fee_category = common::getFieldValue("fee", "fee_category", "invoice_time", $invoice_time);
		//$fee_category = implode(", ", array_unique(array_column(fee::all($invoice_time), "fee_category")));
		$invoice_link = "download.php?organization_id=$organization_id&invoice_number=$invoice_number&currency=$currency";	
		$download_invoice = "
		<a href=\"#\" title=\"Download Invoice\"onclick=\"window.location.href='$invoice_link'\">
			<i class=\"fa fa-file-pdf-o fa-lg\"style=\"color:#ee0000;\"></i>
		</a>";
		
		// print download proof of payment
		$organization_name .= $icon_download;

		$tbody = "
		<tr>
			<td class=\"text-right$class\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td class=\"$class\">$organization_name</td>
			<td class=\"$class\">$fee_category</td>
			<td class=\"$class\" nowrap=\"nowrap\">$invoice_number</td>
			<!--<td class=\"text-center$class\" nowrap=\"nowrap\">$invoice_year</td>-->
			<td class=\"text-right$class\" nowrap=\"nowrap\">" . number_format($invoice_amount, 2) . "</td>
			<td class=\"text-right$class\" nowrap=\"nowrap\">" . number_format($amount_paid, 2) . "</td>
			<td class=\"text-right$class\" nowrap=\"nowrap\">" . number_format($balance, 2) . "</td>
			<td class=\"text-center$class\" nowrap=\"nowrap\">$download_invoice</td>";
				
			if ($access_right === "RW") {
				$tbody .= "
				<td class=\"text-center$class\" nowrap=\"nowrap\">
					<a title=\"Pay\" data-toggle=\"modal\" data-target=\"#" . $invoice_id . "pay\" href=\"#\"><i class=\"fa fa-usd\"></i></a>
					<a title=\"Reverse\" data-toggle=\"modal\" data-target=\"#" . $invoice_id . "reverse\" href=\"#\"><i class=\"fa fa-undo\"></i></a>
					<a title=\"Refund\" data-toggle=\"modal\" data-target=\"#" . $invoice_id . "refund\" href=\"#\"><i class=\"fa fa-refresh\"></i></a>					
				</td>";
			}			
		$tbody .= "
		</tr>";

		if ($access_right === "RW") {
			// display Make Payment Modal
			$tbody .= modal::displayModal("pay", $logged_username, $currency, $form_elements);
			
			// display Reverse Payment Modal
			$tbody .= modal::displayModal("reverse", $logged_username, $currency, $form_elements);
			
			// display Refund Payment Modal
			$tbody .= modal::displayModal("refund", $logged_username, $currency, $form_elements);
		}

        return $tbody;

    }
	
	/**
     * display modal
     *
     * @param $index
     * @param $action
     * @param $logged_username
     * @param $currency
     * @param array $form_elements
     *
     * @return string modal
     */
    public static function displayModal($action, $logged_username, $currency, $form_elements = array())
    {	
		$invoice_id = $form_elements["invoice_id"];
		$invoice_number = $form_elements["invoice_number"];
		$invoice_time = $form_elements["invoice_time"];
		$invoice_year = $form_elements["invoice_year"];
		$organization_id = $form_elements["organization_id"];
		$organization_name = $form_elements["organization_name"];
		$registration_number = $form_elements["registration_number"];
		$registration_year = $form_elements["registration_year"];
		$invoice_amount = (strlen($form_elements["amount"]) > 0) ? $form_elements["amount"] : 0;
		
        $modal_bottom = "<input type=\"hidden\" id=\"option\" name=\"option\" value=\"$action\">
						<input type=\"hidden\" id=\"invoice_number\" name=\"invoice_number\" value=\"$invoice_number\">
						<input type=\"hidden\" id=\"invoice_year\" name=\"invoice_year\" value=\"$invoice_year\">
						<input type=\"hidden\" name=\"currency\" value=\"$currency\">";       

		$btn_label_save = ucwords($action);
		$action_str = ($action === "pay") ? "make" : $action;
		$action_str = ucwords("$action_str Payment");

		$modal_title = $action_str;

		$modal = "
		<!-- $action_str Modal -->
		<div class=\"modal fade\" id=\"$invoice_id$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<h4 class=\"modal-title text-capitalize\">$modal_title</h4>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" method=\"post\">							
							<div class=\"form-group col-md-12\" style=\"margin: 0;\">
								<fieldset class=\"form-group col-md-4\">
									<label for=\"organization_name\">NGO Name</label>
								</fieldset>
								<fieldset class=\"form-group col-md-8\">$organization_name</fieldset>							
							</div>
						
							<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
								<fieldset class=\"form-group col-md-4\">
									<label for=\"registration_number\">Registration Number</label>
								</fieldset>
								<fieldset class=\"form-group col-md-8\">$registration_number</fieldset>								
							</div>
							
							<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
								<fieldset class=\"form-group col-md-4\">
									<label for=\"registration_year\">Registration Year</label>
								</fieldset>
								<fieldset class=\"form-group col-md-8\">$registration_year</fieldset>								
							</div>";
						
							if ($action === "pay") {
								$modal .= "
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"amount\">Invoiced ($currency)</label>
									</fieldset>								
									<fieldset class=\"form-group col-md-8\" id=\"amount\">" . number_format($invoice_amount, 2) . "</fieldset>
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"payment_amount\">Amount Paid ($currency)</label>
										<input type=\"text\" class=\"form-control format-money\" maxlength=\"20\" name=\"payment_amount\" id=\"payment_amount\" value=\"0.00\" 
										required>
									</fieldset>
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"payment_mode\">Mode of Payment</label>
											<select id=\"payment_mode\" class=\"form-control select2\" style=\"width: 100%;\" name=\"payment_mode\" required>";
											
											$payment_modes = payment::getPaymentModes();
											
											foreach ($payment_modes as $p) :
												$modal .= "<option value=\"$p->payment_mode\">$p->payment_mode</option>"; 
											endforeach;
											
											$modal .= "    
										</select>
									</fieldset>
								</div>
									
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"payment_reference\">Reference</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"payment_reference\" id=\"payment_reference\" value=\"\" required>
									</fieldset>
								</div>
								
								<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">
								<input type=\"hidden\" name=\"invoice_time\" value=\"$invoice_time\">
								<input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">";
							} elseif ($action === "reverse")  {
								$modal .= " 
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"reverse_details\">Reversal Amount ($currency)</label>
											<select id=\"reverse_details_test\" class=\"form-control select2\" style=\"width: 100%;\" name=\"reverse_details\" required>
											<option value=\"\">" . OPTION_SELECT . "</option>";

											$reverse_details = payment::all($invoice_number, $is_reversible = "Yes", $order_by = "captured_date DESC");
											foreach ($reverse_details as $r) :
												$payment_details = "$r->payment_id|$currency " . number_format($r->amount, 2) . " > $r->payment_mode > $r->receipt_number";
												$payment = "$currency " . number_format($r->amount, 2) . " > $r->payment_mode > $r->invoice_number > $r->receipt_number > ";
												$payment .= date_format(date_create($r->captured_date), "d-M-Y @ h:iA");
												$modal .= "<option value=\"$payment_details\">$payment</option>";
												//$modal .= "<option value=\"1\">1</option>";
											endforeach;
											$modal .= "    
										</select>
									</fieldset>
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"reason\">Reversal Reason</label>
										<textarea class=\"form-control\" maxlength=\"180\" name=\"reason\" id=\"reason\" rows=\"2\" required></textarea>
									</fieldset>
								</div>
								
								<input type=\"hidden\" name=\"reversed_by\" value=\"$logged_username\">";
							} elseif ($action === "refund")  {
								$modal .= "							
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"refund_amount\">Refund Amount ($currency)</label>
										<input type=\"text\" class=\"form-control format-money\" maxlength=\"20\" name=\"refund_amount\" id=\"refund_amount\" value=\"0.00\" 
										required>
									</fieldset>
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"reason\">Refund Reason</label>
										<textarea class=\"form-control\" maxlength=\"180\" name=\"reason\" id=\"reason\" rows=\"2\" required></textarea>
									</fieldset>
								</div>
								
								<input type=\"hidden\" name=\"refunded_by\" value=\"$logged_username\">";
							}
							$modal .= "
							$modal_bottom
							<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">$btn_label_save</button>
							<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">Cancel</a>							
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- ./ $action_str Modal -->";

        return $modal;
    }
}
