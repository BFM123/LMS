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
	 * @param string local_currency
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayTable($index, $logged_username, $access_right, $local_currency, $form_elements = array())
    {
	  	$fee_id = $form_elements["fee_id"];
        $fee_category = $form_elements["fee_category"];
        $invoice_time = $form_elements["invoice_time"];
        $based_on_income = $form_elements["based_on_income"];
        $from_income = (strlen($form_elements["from_income"]) > 0) ? number_format($form_elements["from_income"], 2) : "";
        $to_income = (strlen($form_elements["to_income"]) > 0) ? number_format($form_elements["to_income"], 2) : "";
        $original_currency = $form_elements["original_currency"];	
        $amount = $form_elements["amount"];	
        $amount_local = $form_elements["amount_local"];	
						
        $tbody = "	
		<tr>
			<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . "</td>
			<td>$fee_category</td>
			<td>$invoice_time</td>
			<td class=\"text-center\" nowrap=\"nowrap\">$based_on_income</td>										
			<td class=\"text-right\">$from_income</td>
			<td class=\"text-right\">$to_income</td>
			<td class=\"text-right\">$original_currency " . number_format($amount, 2) . "</td>
			<td class=\"text-right\">$local_currency " . number_format($amount_local, 2) . "</td>";
			
			if ($access_right === "RW") {
				 $tbody .= "
				 <td class=\"text-center\" style=\"width: 30px\">
					<a data-toggle=\"modal\" data-target=\"#" . $fee_id ."edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
					<a data-toggle=\"modal\" data-target=\"#" . $fee_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>
				</td>";
			}
		
		 $tbody .= "	
		</tr>";

		if ($access_right === "RW") {
			// display Edit Fee Modal
			$tbody .= modal::displayModal("edit", $logged_username, $local_currency, $form_elements);
	
		   	// display Delete Fee Modal
			$tbody .= modal::displayModal("delete", $logged_username, $local_currency, $form_elements);
		}

        return $tbody;
    }

    /**
     * display modal
     *
     * @param string action
	 * @param string logged_username
	 * @param string local_currency
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayModal($action, $logged_username, $local_currency, $form_elements = array())
    {
  		$fee_id = "";
        $fee_category = "";
        $invoice_time = "";
		$based_on_income_checked = "";
		$from_income_disabled = " disabled";
		$to_income_disabled = " disabled";
        $currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
        $from_income = 0;
        $to_income = 0;
		$amount = 0;

        $modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";

        if (!empty($form_elements)) {
            // form elements have values, this is an Edit Modal
			$fee_id = $form_elements["fee_id"];
			$fee_category = $form_elements["fee_category"];
			$invoice_time = $form_elements["invoice_time"];
			$based_on_income = $form_elements["based_on_income"];
			if ($based_on_income === "Yes") {
				$based_on_income_checked = " checked";
				$from_income_disabled = "";
				$to_income_disabled = "";
			} else {
				$from_income_disabled = " disabled";
				$to_income_disabled = " disabled";
			}
			
			$from_income = $form_elements["from_income"];
        	$to_income = $form_elements["to_income"];
	        $currency = $form_elements["original_currency"];	
			$amount = $form_elements["amount"];
			
            $modal_bottom = "<input type=\"hidden\" name=\"fee_id\" value=\"$fee_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";;
        }

		$from_income = number_format($from_income, 2);
       	$to_income = number_format($to_income, 2);
		$amount = number_format($amount, 2);
			
        $modal_title = ucwords("$action Fee");
		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";
		
        if ($action === "delete") {
			$tag = "div";
            $modal_title = "Are you sure you want to delete fee '$fee_category'?";

            $modal_bottom = "<input type=\"hidden\" name=\"fee_id\" value=\"$fee_id\">
							<input type=\"hidden\" name=\"fee_category\" value=\"$fee_category\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";

			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
        }

		$modal = "
		<!-- " . ucwords($action) . " Fee Modal -->
		<div class=\"modal fade\" id=\"$fee_id$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" method=\"post\">";

       					if ($action !== "delete") {
           					 // only generate this part of the modal for Add and Edit actions

           					$modal .= "             							
							<fieldset class=\"form-group\">
								<label class=\"required\" for=\"fee_category\">Fee</label>
								<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"fee_category\" id=\"fee_category\" value=\"$fee_category\" required>
							</fieldset>
						   							
							<fieldset class=\"form-group\">
								<label class=\"required\" for=\"invoice_time\">Invoice Time</label>
								<select id=\"invoice_time\" class=\"form-control\" name=\"invoice_time\" required> 
									<option value=\"\">" . OPTION_SELECT. "</option>";
									
									$times = fee::getInvoiceTimes();
									
									foreach ($times as $t) :
										$selected = ($invoice_time == $t) ? "selected" : "";										
										$modal .= " <option  value=\"$t\" $selected>$t</option>";
									endforeach;
									$modal .= "  
								</select>					
							</fieldset>
													
							<fieldset class=\"form-group form-check\">							
								<label class=\"switch\">
									<input type=\"checkbox\" name=\"based_on_income\" class=\"based_on_income\" id=\"$fee_id" . "_based_on_income\" 
									value=\"Yes\"$based_on_income_checked>
									<span class=\"slider round\" ></span>
								</label>
								<b>Based on NGO Income</b>
							</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label for=\"from_income\">Income From ($local_currency)</label>
								<input type=\"text\" class=\"form-control format-money\" maxlength=\"20\" name=\"from_income\" id=\"$fee_id"."_from_income\" value=\"$from_income\" 
								$from_income_disabled>
						  	</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label for=\"to_income\">Income To ($local_currency)</label>
								<input type=\"text\" class=\"form-control format-money\" maxlength=\"20\" name=\"to_income\" id=\"$fee_id" . "_to_income\" value=\"$to_income\" 
								$to_income_disabled>
						  	</fieldset>
							
						   	<fieldset class=\"form-group col-md-6\">
								<label class=\"required\" for=\"currency\">Currency</label>
								<select class=\"form-control select2\" id=\"currency\" name=\"currency\" style=\"width: 100%;\" required>";
									$currencies = currency::all();
									foreach ($currencies as $c):
										$selected = ($c->currency === $currency) ? "selected" : "";
										$modal .= "<option value=\"$c->currency\"$selected>$c->currency - $c->description</option>";
									endforeach;
									$modal .= "
								</select>
							</fieldset>
							
						   	<fieldset class=\"form-group col-md-6\">
								<label class=\"required\" for=\"amount\">Amount</label>
								<input type=\"text\" class=\"form-control format-money\" maxlength=\"20\" name=\"amount\" id=\"amount\" value=\"$amount\" required>
						  	</fieldset>";
						}
						$modal .= "<input type=\"hidden\" name=\"option\" value=\"$action\">
							$modal_bottom
							<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">$btn_label_save</button>
							<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">$btn_label_cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /." . ucwords($action) . " Fee Modal -->";
        return $modal;
    }
	
	/**
     * display payment modes
	 * @param string logged_ussername
	 * @param string access_right
     * @return string payment modes
     */
    public static function displayPaymentModes($logged_username, $access_right) {
		$invoice_number_prefix = common::getFieldValue("system", "invoice_number_prefix");
		$receipt_number_prefix = common::getFieldValue("system", "receipt_number_prefix");
		
        $modal = "
		<form action=\"action.php\" method=\"post\">
			<fieldset class=\"form-group\">	
				<fieldset class=\"form-group col-md-8\">
					<label for=\"payment_mode_item\">Modes of Payment </label>
					<select id=\"payment_mode_item\" class=\"form-control\" name=\"payment_mode_item\" size=\"5\" multiple=\"multiple\">";								
						$payment_modes = payment::getPaymentModes();
						$payment_mode_items = "";
						
						foreach ($payment_modes as $p) :
							$payment_mode_items .= "$p->payment_mode_id][$p->payment_mode|";
							$modal .= "<option value=\"$p->payment_mode_id][$p->payment_mode\">$p->payment_mode</option>";
						endforeach;
		
						if (strlen($payment_mode_items) > 0) $payment_mode_items = substr_replace($payment_mode_items, "", -1); // remove the last | from the string	

						$modal .= "							
					</select>";
					
					if ($access_right === "RW") {
						$modal .= "					
						<input id=\"payment_mode_items\" name=\"payment_mode_items\" type=\"hidden\" value=\"$payment_mode_items\">
						<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"new_payment_mode\" id=\"new-payment-mode\" 
						style=\"width: 350px; display: inline-block; margin: 10px 5px 10px 0px;\">					
						<button type=\"submit\" class=\"btn btn-default btn-round add-payment-mode\" id=\"add-payment-mode\" 
						style=\"margin-right: 10px; padding-right: 27px!important; padding-left: 27px!important;\">Add</button>
						<button type=\"submit\" class=\"btn btn-default btn-round remove-payment-mode\" id=\"remove-payment-mode\">Remove</button>";
					}

					$modal .= " 		
				</fieldset>			
			</fieldset>
			
			<fieldset class=\"form-group\">	
				<fieldset class=\"form-group col-md-8\" style=\"margin: 0; padding: 0;\">					
					<fieldset class=\"form-group col-md-4\" style=\"margin: 0; padding: 0;\">
						<label for=\"invoice_number_prefix\" class=\"form-control\" style=\"border: 0; background: none;\">Invoice Number Prefix</label>
					</fieldset>
					
					<fieldset class=\"form-group col-md-8\">
						<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"invoice_number_prefix\" value=\"$invoice_number_prefix\">
					</fieldset>
																
					<fieldset class=\"form-group col-md-4\" style=\"margin: 0; padding: 0;\">
						<label for=\"receipt_number_prefix\" class=\"form-control\" style=\"border: 0; background: none;\">Receipt Number Prefix</label>
					</fieldset>
					
					<fieldset class=\"form-group col-md-8\">
						<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"receipt_number_prefix\" value=\"$receipt_number_prefix\">
					</fieldset>		
				</fieldset>
			</fieldset>";
		
			if ($access_right === "RW") {
				$modal .= " 
				<input type=\"hidden\" name=\"option\" value=\"payment_settings\">
				<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">
				
				<fieldset class=\"form-group col-md-12\">
					<button type=\"submit\" class=\"btn btn-default btn-round dark-blue save-items\">Save</button>
				</fieldset>
				
				<fieldset class=\"form-group col-md-12\"></fieldset>";
			}

			$modal .= " 
		</form>";
					
        return $modal;
    }
}