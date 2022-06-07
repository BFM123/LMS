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
	 * @param string currency
	 * @param string level
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayTable($index, $logged_username, $access_right, $currency, $level, $form_elements = array())
    { 
		global $APPROVAL_STATUS;	
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[0];
		
	  	$payment_id = $form_elements["payment_id"];
	  	$request = $form_elements["request"];
		$organization_id = $form_elements["organization_id"];
		$organization_name = $form_elements["organization_name"];
		$organization_name .= " <b>Reg No: " . $form_elements["registration_number"] . " | Reg Year: " . $form_elements["registration_year"] . "</b>";
        $payment_mode = $form_elements["payment_mode"];
        $reason = $form_elements["reason"];
        $requested_date = $form_elements["requested_date"];
		$requested_date = date_format(date_create($requested_date), "d M Y");
        $requested_by = $form_elements["requested_by"];
        $requested_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $requested_by); 
        $request_status = $form_elements["request_status"];
		$class = (strtolower($request_status) === STATUS_REJECTED) ? " bg-red" : "";
        $amount = $form_elements["amount"];	
		if (strlen($amount) == 0) $amount = 0;
	
        $tbody = "	
		<tr>
			<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td>" . strtoupper($request) . "</td>
			<td>$organization_name</td>
			<td>$reason</td>
			<td nowrap=\"nowrap\">$requested_date</td>";
			
			if ($level == $awaiting_approval_level1) $tbody .= "<td class=\"text-center$class\">$request_status</td>";
			else $tbody .= "<td nowrap=\"nowrap\">$requested_by</td>";
			
			$tbody .= "<td class=\"text-right\">" . number_format($amount, 2) . "</td>";
			
			if ($access_right === "RW") {
				$action_1 = "approve"; $icon_1 = "fa fa-check";
				$action_2 = "reject"; $icon_2 = "fa fa-times";

				if ($level == $awaiting_approval_level1) {
					$action_1 = "info"; $icon_1 = "fa fa-info-circle";
					$action_2 = "delete"; $icon_2 = "fa fa-trash-o";
				}

				$tbody .= "		
				<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">
					<a title=\"" . ucwords($action_1) . "\" data-toggle=\"modal\" data-target=\"#$payment_id$action_1\" href=\"#\"><i class=\"$icon_1\"></i></a>
					<a title=\"" . ucwords($action_2) . "\" data-toggle=\"modal\" data-target=\"#$payment_id$action_2\" href=\"#\"><i class=\"$icon_2\"></i></a>
				</td>";
			}
				
			$tbody .= "	
		</tr>";
		
		if ($access_right === "RW") {
			// display Approve/Info Reversal/Refund Modal
			$tbody .= modal::displayModal($action_1, $logged_username, $currency, $requested_by, $level, $form_elements);
			
			// display Reject/Delete Reversal/Refund Modal
			$tbody .= modal::displayModal($action_2, $logged_username, $currency, $requested_by, $level, $form_elements);
		}

        return $tbody;
    }

    /**
     * display modal
     *
     * @param string action
	 * @param string logged_username
	 * @param string currency
	 * @param string organization_name
	 * @param string requested_by
	 * @param string level
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayModal($action, $logged_username, $currency, $requested_by, $level, $form_elements = array())
    {	
		global $APPROVAL_STATUS;	
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[0];
		$awaiting_approval_level2 = array_keys($APPROVAL_STATUS)[1];
		$approved = array_keys($APPROVAL_STATUS)[2];
		$awaiting_approval_level2_str = $APPROVAL_STATUS[$awaiting_approval_level2 + 1];
		
		$organization_name = $form_elements["organization_name"];
		$registration_number = $form_elements["registration_number"];
		$registration_year = $form_elements["registration_year"];
		$payment_id = $form_elements["payment_id"];	 
	  	$request = $form_elements["request"];
	  	$invoice_number = $form_elements["invoice_number"];
        $receipt_number = $form_elements["receipt_number"]; if (strlen($receipt_number) == 0) $receipt_number = "N/A";
        $payment_mode = $form_elements["payment_mode"];
        $reason = $form_elements["reason"];
        $requested_date = $form_elements["requested_date"];
		$requested_date = date_format(date_create($requested_date), "d M Y @ h:iA");
        $request_status = $form_elements["request_status"];
        $authorized_by = $form_elements["authorized_by"];
		$authorized_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $authorized_by); 
        $authorized_date = $form_elements["authorized_date"];
		$authorized_date = date_format(date_create($authorized_date), "d M Y @ h:iA");
        $authorizer_comments = $form_elements["authorizer_comments"];
		$rejected_by = $form_elements["rejected_by"];
		$rejected_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $rejected_by); 
        $rejected_date = $form_elements["rejected_date"];
		$rejected_date = date_format(date_create($rejected_date), "d M Y @ h:iA");
        $reject_comments = $form_elements["reject_comments"];
        $record_control = $form_elements["record_control"];
        $amount = $form_elements["amount"]; if (strlen($amount) == 0) $amount = 0;
		$amount = number_format($amount, 2);
		$required = ($action === "reject") ? "required" : "";

		$modal_title = ($level == $awaiting_approval_level1) ? ucwords("$request details") : ucwords("$action $request");
		$btn_label_save = ucwords($action);
		$btn_label_cancel = "Cancel";
		$tag = "h4";
		
		$modal_bottom = "
			<input type=\"hidden\" name=\"payment_id\" value=\"$payment_id\">          
			<input type=\"hidden\" name=\"invoice_number\" value=\"$invoice_number\">          
			<input type=\"hidden\" name=\"receipt_number\" value=\"$receipt_number\">          
			<input type=\"hidden\" name=\"request\" value=\"$request\">          
			<input type=\"hidden\" name=\"option\" value=\"approval\">          
			<input type=\"hidden\" name=\"action\" value=\"$action\">          
			<input type=\"hidden\" name=\"l\" value=\"$level\">          
			<input type=\"hidden\" name=\"record_control\" value=\"$record_control\">          
			<input type=\"hidden\" name=\"currency\" value=\"$currency\">          
			<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";
		
	   	if ($action === "delete") {
			$request_details = "$currency $amount > $invoice_number for $organization_name";
	
			$tag = "div";
		  	$modal_title = "Are you sure you want to delete payment " . strtolower($request) . " request '$request_details'?";
							
			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
		}
		
		$modal = "
		<!-- $modal_title Modal -->
		<div class=\"modal fade\" id=\"$payment_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" method=\"post\">";
						
							if ($action !== "delete") {
								// dont generate this part of the modal for Delete actions
								$modal .= "
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
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"receipt_number\">Receipt Number</label>
									</fieldset>								
									<fieldset class=\"form-group col-md-8\">
										$receipt_number
									</fieldset>
								</div>
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"payment_mode\">Payment Mode</label>
									</fieldset>								
									<fieldset class=\"form-group col-md-8\">
										$payment_mode
									</fieldset>
								</div>
									
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"amount\">Amount ($currency)</label>
									</fieldset>								
									<fieldset class=\"form-group col-md-8\">
										$amount
									</fieldset>
								</div>
									
								<div class=\"form-group col-md-12\" style=\"margin: 0; padding-top: 10px; border-top: 1px solid #999\">																		
									<fieldset class=\"form-group col-md-4\">
										<label for=\"requested_by\">Requested By</label>
									</fieldset>								
									<fieldset class=\"form-group col-md-8\">
										$requested_by / $requested_date
									</fieldset>
								</div>
									
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"reason\">$request Reason</label>
									</fieldset>								
									<fieldset class=\"form-group col-md-8\">
										$reason
									</fieldset>
								</div>";
							
								if ($level == $approved || $request_status === $awaiting_approval_level2_str) {
									$modal .= "
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">										
										<fieldset class=\"form-group col-md-4\">
											<label for=\"authorized_by\">Authorized By</label>
										</fieldset>								
										<fieldset class=\"form-group col-md-8\">
											$authorized_by / $authorized_date
										</fieldset>
									</div>
									
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">
										<fieldset class=\"form-group col-md-4\">
											<label for=\"authorizer_comments\">Authorizer Comments</label>
										</fieldset>								
										<fieldset class=\"form-group col-md-8\">
											$authorizer_comments
										</fieldset>
									</div>";
								} elseif (strtolower($request_status) === STATUS_REJECTED) {
									$modal .= "
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">									
										<fieldset class=\"form-group col-md-4\">
											<label for=\"rejected_by\">Rejected By</label>
										</fieldset>								
										<fieldset class=\"form-group col-md-8\">
											$rejected_by / $rejected_date
										</fieldset>
									</div>
										
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">										
										<fieldset class=\"form-group col-md-4\">
											<label for=\"reject_comments\">Rejection Comments</label>
										</fieldset>								
										<fieldset class=\"form-group col-md-8\">
											$reject_comments
										</fieldset>
									</div>";
								}
							}
														
							if ($level > $awaiting_approval_level1 || $action === "delete") {
								if ($action !== "delete") {								
									$modal .= "	
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">					
										<fieldset class=\"form-group col-md-12\" style=\"margin: 0px;\">
											<label class=\"$required\" for=\"approval_comments\">Comments</label>
											<textarea class=\"form-control\" maxlength=\"180\" name=\"approval_comments\" id=\"approval_comments\" rows=\"2\" $required></textarea>	
										</fieldset>
									</div>
									
									<div class=\"form-group col-md-12\">										
									</div>";
								}
								
								$modal .= "
								$modal_bottom
								<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">$btn_label_save</button>";
							}
							
							$modal .= "														
								<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">$btn_label_cancel</a>	
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- ./  $modal_title Modal Modal -->";
        return $modal;
    }
}