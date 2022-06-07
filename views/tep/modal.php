<?php

/**
 * A class for managing modals
 */

class modal
{
	/**
     * display table
     *
     * @param string logged_username
	 * @param string access_right
     * @param string currency
     * @param array form_elements
     * @param string level
     *
     * @return string modal
     */
    public static function displayTable($logged_username, $access_right, $currency, $form_elements = array(), $level)
    {
		global $APPROVAL_STATUS;	
		$approved = array_keys($APPROVAL_STATUS)[4];
		$draft = array_keys($APPROVAL_STATUS)[0];
		
		$tbody = "";
		$index = 1;
		
		foreach ($form_elements as $invoice_number => $tep) :
			if (strlen($invoice_number) == 0) $invoice_number = "N/A";
			$invoice_number_id = str_replace("/", "", $invoice_number); // remove / when creating IDs for elements
			$number_of_teps = count($tep);			
			$organization_id = $tep[0]["organization_id"];
			$organization_name = $tep[0]["organization_name"];
			$abbreviation = $tep[0]["abbreviation"];
			if (strlen($abbreviation) > 0) $organization_name .= " ($abbreviation)";		
			$organization_name .= "<br /><b>Reg No: " .  $tep[0]["registration_number"] . " | Reg Year: " . $tep[0]["registration_year"] . "</b>";
			$contact_person = $tep[0]["contact_person"];
			$contact_details = $tep[0]["telephone"] . " > " . $tep[0]["email"] . " > " . $tep[0]["postal_address"];
			$contact_details = str_replace(">  >", ">", $contact_details);
			if (common::startsWith($contact_details, " > ")) $contact_details = substr($contact_details, 3); // remove the first ' > ' from the string							
			if (common::endsWith($contact_details, " > ")) $contact_details = substr_replace($contact_details, "", -3); // remove the last ' > ' from the string
			$request_date = $tep[0]["captured_date"];
			$request_date = date_format(date_create($request_date), "d M Y");
			$request_year = date_format(date_create($request_date), "Y");
			$record_control = $tep[0]["record_control"];
			$approval_status = $APPROVAL_STATUS[$record_control];
			$status = $tep[0]["status"];
			
			$class = "";
			$class_2 = ($request_year == date("Y")) ? " alert-info" : "";
			$can_view_info = $can_delete = true;
			$can_edit = $can_approve = $can_reject = $can_view_details = false;
			
			if ($level == $draft) {
				if ($status === STATUS_REJECTED) {
					$approval_status = ucwords($status);
					$class = " bg-red";
					$can_edit = true;
				} elseif ($record_control == $draft) {
						$can_edit = true;
				} elseif ($record_control == $approved) {
					// cannot delete an approved annual return
					$can_delete = false;
				}
			} elseif ($level == $approved) { 
				// for approved annual returns, display the view details icon
				$can_view_details = true;
				$can_delete = false;
			} else {
				$can_approve = true;
				$can_reject = true;
				$can_view_info = $can_delete = false;
			}
				
			$tbody .= "
			<tr>
				<td class=\"text-right$class_2\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
				<td class=\"$class_2\">$organization_name</td>
				<td class=\"$class_2\">$contact_person</td>
				<td class=\"$class_2\" nowrap=\"nowrap\">$invoice_number</td>
				<td class=\"text-center$class_2\" nowrap=\"nowrap\">" . number_format($number_of_teps, 0) . "</td>
				<td class=\"$class_2\" nowrap=\"nowrap\">$request_date</td>";
				
				if ($level == $draft) $tbody .= "<td class=\"text-center$class$class_2\">$approval_status</td>";
					
				if ($access_right === "RW") {
					$tbody .= "
					<td class=\"text-center$class_2\" nowrap=\"nowrap\">";
						if ($can_approve) 
							$tbody .= "<a title=\"Approve\" data-toggle=\"modal\"data-target=\"#$invoice_number_id" . "approve\" href=\"#\"><i class=\"fa fa-check\"></i></a> ";
						if ($can_reject) 
							$tbody .= "<a title=\"Reject\" data-toggle=\"modal\"data-target=\"#$invoice_number_id" . "reject\" href=\"#\"><i class=\"fa fa-times\"></i></a> ";
						if ($can_view_info) 
						$tbody .= "<a title=\"Info\"data-toggle=\"modal\"data-target=\"#$invoice_number_id" . "info\"href=\"#\"><i class=\"fa fa-info-circle fa-lg\"></i></a> ";
						if ($can_edit)
							$tbody .= "<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#$invoice_number_id" . "edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>";
						if ($can_view_details) {
							$tbody .= "
							<a title=\"Details\" data-toggle=\"modal\" data-target=\"#$invoice_number_id" . "details\" href=\"#\"><i class=\"fa fa-file\"></i></a>";
						}
						if ($can_delete)
							$tbody .= "<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#$invoice_number_id" . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>						
					</td>";
				}
				
			$tbody .= "
			</tr>";
	
			if ($access_right === "RW") {
				// display Approve TEP Request Modal
				if ($can_approve) $tbody .= modal::displayModal("approve", $logged_username, $currency, 0, "", $tep, $level);
				
				// display Reject TEP Request Modal
				if ($can_reject) $tbody .= modal::displayModal("reject", $logged_username, $currency, 0, "", $tep, $level);
				
				// display Edit TEP Request Modal
				if ($can_edit) $tbody .= modal::displayModal("edit", $logged_username, $currency, 0, "", $tep, $level);
	
				// display TEP Request Details Modal
				if ($can_view_details) $tbody .= modal::displayModal("details", $logged_username, $currency, 0, "", $tep, $level);
				
				// display TEP Request Info Modal
				if ($can_view_info) $tbody .= modal::displayModal("info", $logged_username, $currency, 0, "", $tep, $level);
				
				// display Delete TEP Request Modal
				if ($can_delete) $tbody .= modal::displayModal("delete", $logged_username, $currency, 0, "", $tep, $level);
			}
			$index++;
		endforeach;

        return $tbody;
    }

    /**
     * display modal
     *
     * @param string action
	 * @param string logged_username
     * @param string currency
     * @param string organization_id
     * @param string organization_name
     * @param array tep
     * @param string level
     *
     * @return string modal
     */
    public static function displayModal($action, $logged_username, $currency, $organization_id, $organization_name, $tep = array(), $level = 0)
    {
		global $APPROVAL_STATUS;	
		$draft = array_keys($APPROVAL_STATUS)[0];
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[1];
		$awaiting_approval_level2 = array_keys($APPROVAL_STATUS)[2];
		$awaiting_payment_processing = array_keys($APPROVAL_STATUS)[3];
		$approved = array_keys($APPROVAL_STATUS)[4];
		
	   	$invoice_number = "";
	   	$invoice_number_str = "N/A";
		$registration_number = "";
		$registration_year = "";
		$approved1_by = "";
		$approved2_by = "";
		$rejected_by = "";
		$download_invoice = "";
		$field_disabled = "";
		$can_upload_document = true;
		$default_nationality = "Malawi";
		$existing_request = false;
		$document_required = " required";
		
        $modal_bottom = "<input type=\"hidden\" name=\"invoice_number\" value=\"$invoice_number\">
						 <input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
						 <input type=\"hidden\" name=\"organization_name\" value=\"$organization_name\">
						 <input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">
						 <input type=\"hidden\" name=\"l\" value=\"$level\">";

        if (!empty($tep)) {
            // form elements have values, this is an existing TEP request
			$existing_request = true;
	
			$record_control = $tep[0]["record_control"];
			if ($action === "edit" && $record_control == $approved) {
				// flag selected fields as disabled if user wishes to edit details for approved TEP requests			
				$field_disabled = " disabled";
				$can_upload_document = false;
			} elseif (in_array($action, array("approve", "details")) && in_array($level, array($awaiting_approval_level1, $awaiting_approval_level2, $approved))) {
				// flag all fields as disabled if user wishes to approve or view details of an approved EP request
				$field_disabled = " disabled";
				$can_upload_document = false;
			}
			
		   	$invoice_number = $tep[0]["invoice_number"];
			if (strlen($invoice_number) > 0) $invoice_number_str = $invoice_number;
			$invoice_number_id = str_replace("/", "", $invoice_number_str); // remove / when creating IDs for elements
						
			$organization_id = $tep[0]["organization_id"];
			$organization_name = $tep[0]["organization_name"];
			$registration_number = $tep[0]["registration_number"];
			$registration_year = $tep[0]["registration_year"];
			$record_control = $tep[0]["record_control"];
			
			$document_required = "";
			$payment_proof = $tep[0]["payment_proof"];
															
 			$modal_bottom = "<input type=\"hidden\" name=\"record_control\" value=\"$record_control\">
			 				 <input type=\"hidden\" name=\"invoice_number\" value=\"$invoice_number\">
							 <input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
	 						 <input type=\"hidden\" name=\"organization_name\" value=\"$organization_name\">
							 <input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">
							 <input type=\"hidden\" name=\"l\" value=\"$level\">";       
		}
		
        $modal_title = ucwords("$action TEP Processing Certificate Request");
		$tag = "h4";
		$btn_label_save = "Request";
		$btn_label_reset = "&nbsp;&nbsp;Reset&nbsp;&nbsp;";
		$btn_reset = "<input type=\"reset\" name=\"reset\" class=\"btn btn-default btn-round\" value=\"$btn_label_reset\">";
		$btn_label_draft = "&nbsp;&nbsp;&nbsp;Draft&nbsp;&nbsp;&nbsp;";		
		$btn_draft = "<input type=\"submit\" name=\"draft\" class=\"btn btn-default btn-round btn-draft\" id=\"$invoice_number_id" . "_$action" . "_btn-draft\" ";
		$btn_draft .= "value=\"$btn_label_draft\">";

		$btn_label_cancel = "&nbsp;Cancel&nbsp;";
		
		if ($record_control == $approved) {
			$btn_draft  = "";
		}
			   			
		$btn_save = "<button type=\"submit\" class=\"btn btn-default btn-round dark-blue btn-submit\" id=\"btn-submit\">$btn_label_save</button>";
		
		if (in_array($action, array("request"))) {
			$modal_title = ucwords("Request TEP Processing Certificate");
        } elseif ($action === "delete") {
			$tag = "div";
            $modal_title = "Are you sure you want to delete this TEP processing certificate request for '$organization_name'?";

            $modal_bottom = "<input type=\"hidden\" name=\"invoice_number\" value=\"$invoice_number\">
							 <input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
	 						 <input type=\"hidden\" name=\"organization_name\" value=\"$organization_name\">
	 						 <input type=\"hidden\" name=\"payment_proof\" value=\"$payment_proof\">
							 <input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">
 							 <input type=\"hidden\" name=\"l\" value=\"$level\">";

			$btn_save = "<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">Yes</button>";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
			$btn_reset = "";
			$btn_draft = "";
        } elseif (in_array($action, array("info", "details"))) {
			$modal_title = ucwords("TEP Processing Certificate Request Details");
			$btn_save = "";
			$btn_reset = "";
			$btn_draft = "";
		} elseif (in_array($action, array("approve", "reject")) && in_array($level, array($awaiting_approval_level1, $awaiting_approval_level2))) {
			// hide/rename some buttons if user wishes to approve/reject an NGO 
			$btn_save = "<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">" . ucwords($action) . "</button>";			
			$btn_reset = "";
			$btn_draft = "";
			
			$modal_bottom = "<input type=\"hidden\" name=\"record_control\" value=\"$level\">
							 <input type=\"hidden\" name=\"invoice_number\" value=\"$invoice_number\">
							 <input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
	 						 <input type=\"hidden\" name=\"organization_name\" value=\"$organization_name\">
							 <input type=\"hidden\" name=\"approved_by\" value=\"$logged_username\">
 							 <input type=\"hidden\" name=\"l\" value=\"$level\">";
		}

		$modal = "
		<!-- " . ucwords($action) . " TEP Request Modal -->
		<div class=\"modal fade\" id=\"$invoice_number_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" id=\"frm-$invoice_number_id" . "-$action" . "-register\" method=\"post\" enctype=\"multipart/form-data\">";

       					if ($action !== "delete") {
							 
							if (in_array($action, array("info", "reject"))) {
								$requested_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $tep[0]["captured_by"]);
								$requested_date = date_format(date_create($tep[0]["captured_date"]), "d M Y @ h:iA");
								/*
								$approved1_by = $tep[0]["approved1_by"];
								if (strlen($approved1_by) > 0) {
									$approved1_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $approved1_by);
									$approved1_date = date_format(date_create($tep[0]["approved1_date"]), "d M Y @ h:iA");
									$approved1_by  = "$approved1_by / $approved1_date";
								} else {
									$approved1_by = "N/A";
								}							
								*/
								$approved2_by = $tep[0]["approved2_by"];
								if (strlen($approved2_by) > 0 && $record_control >= $awaiting_payment_processing) {
									$approved2_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $approved2_by);
									$approved2_date = date_format(date_create($tep[0]["approved2_date"]), "d M Y @ h:iA");
									$approved2_by  = "$approved2_by / $approved2_date";
								} else {
									$approved2_by = "N/A";
								}
								
								if ($record_control >= $approved) {
									$payment_processed_by = $tep[0]["payment_processed_by"];
									$payment_processed_date = $tep[0]["payment_processed_date"];
									
									if (strlen($payment_processed_by) > 0) {
										$payment_processed_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $payment_processed_by);
										$payment_processed_date = date_format(date_create($payment_processed_date), "d M Y @ h:iA");
										$payment_processed_by  = "$payment_processed_by / $payment_processed_date";
									}
								} else {
									$payment_processed_by = "N/A";
								}	
								
								$rejected_by = $tep[0]["rejected_by"];
								if (strlen($rejected_by) > 0) {
									$rejected_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $rejected_by);
									$rejected_date = date_format(date_create($tep[0]["rejected_date"]), "d M Y @ h:iA");
									$rejected_by  = "$rejected_by / $rejected_date";
									$rejected_comments = $tep[0]["rejected_comments"];
								} else {
									$rejected_by = "N/A";
									$rejected_comments = "N/A";
								}															
								
								$status = $tep[0]["status"];
								$approval_status = $APPROVAL_STATUS[$record_control];
								$class = "";
								if ($status === STATUS_REJECTED) {
									$class = " bg-red";
									$approval_status = ucwords($status);
								}
								
								$organization_details = "$organization_name <br /><b>Reg No: $registration_number | Reg Year: $registration_year</b>";
								$tep_requests = "";
								
								$i = 0;
								foreach($tep as $t) :
									$i++;
									$tep_requests .= number_format($i, 0) . ". $t[fullname] ($t[nationality] / $t[passport_number])<br />";
								endforeach;
								
								$modal .= "						
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"organization_name\">NGO Name</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$organization_details</fieldset>							
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
									<fieldset class=\"form-group col-md-4\">
										<label for=\"registration_type\">TEP Requests</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$tep_requests</fieldset>								
								</div>";
								
								if ($action !== "reject") {
									$modal .= "
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">
										<fieldset class=\"form-group col-md-4\">
											<label for=\"status\">Status</label>
										</fieldset>
										<fieldset class=\"form-group col-md-8$class\">$approval_status</fieldset>
									</div>";
								}
								
								$modal .= "								
								<div class=\"form-group col-md-12\" style=\"margin: 0; padding-top: 10px; border-top: 1px solid #999\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"requested_by\">Requested By</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$requested_by / $requested_date</fieldset>
								</div>
													
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"approved2_by\">Approver</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$approved2_by</fieldset>
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"payment_processed_by\">Payment By</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$payment_processed_by</fieldset>
								</div>";
								
								if ($status == STATUS_REJECTED) {
									$modal .= "						
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">
										<fieldset class=\"form-group col-md-4\">
											<label for=\"rejected_by\">Rejected By</label>
										</fieldset>
										<fieldset class=\"form-group col-md-8\">$rejected_by</fieldset>
									</div>
									
									<div class=\"form-group col-md-12\" style=\"margin: 0;\">
										<fieldset class=\"form-group col-md-4\">
											<label for=\"rejected_comments\">Rejection Comments</label>
										</fieldset>
										<fieldset class=\"form-group col-md-8\">" . str_replace("\r\n", "<br />", $rejected_comments) . "</fieldset>
									</div>";
								}
								
								if ($action == "reject") {
									$modal .= "									
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"rejected_comments\">Comments</label>
										<textarea class=\"form-control\" maxlength=\"180\" name=\"rejected_comments\" id=\"rejected_comments\" rows=\"2\" required></textarea>
									</fieldset>";
								}								
							} elseif (in_array($action, array("request", "edit", "approve", "details"))) {
								$tep_fee = fee::getFees(INVOICE_TIME_TEP);
								$download_invoice = "";
								
								if ($record_control == $draft || $level == $draft) {										
									// define download invoice link
									$fee_category = implode(", ", array_unique(array_column(fee::all(INVOICE_TIME_TEP), "fee_category")));
									
									$invoice_link = "download.php?organization_id=$organization_id&invoice_number=$fee_category&currency=$currency&amount=$tep_fee";	
									$download_invoice = "
									<a href=\"#\" title=\"Download Proforma Invoice\"onclick=\"window.location.href='$invoice_link'\">
										<i class=\"fa fa-file-pdf-o fa-lg\" style=\"color:#ee0000; margin-left: 5px;\"></i>
									</a>";	
								}
										
								$tep_fee = INVOICE_TIME_TEP . " - $currency " . payment::formatLargeNumber($tep_fee) . $download_invoice;
																
								if ($existing_request) $document_required = "";
								
								$modal .= "
								<div class=\"form-group\" id=\"". $action ."_tep\" style=\"margin-top: 0;\">
									<div class=\"col-md-12\" style=\"margin-bottom: 15px;\">																	
										<label class=\"required\" for=\"payment_proof\">TEP Fee Proof of Payment</label>
										<i class=\"text-red\">$tep_fee</i>";
										
										if ($can_upload_document)
											$modal .= "<input type=\"file\" name=\"payment_proof\" id=\"payment_proof\"$document_required>";
										else 
											$modal .= "<br />";
										
									$i = 0;
									if ($existing_request) {
										// this is an existing TEP request
										
										if (strlen($payment_proof) > 0) {
											$document_extension = explode(".", $payment_proof); $document_extension = strtolower(end($document_extension));
											$document_type = $document_extension;
											$icon_color = "ee0000";						
											if (in_array($document_extension, array("doc", "docx"))) {
												$document_type = "word";
												$icon_color = "0000ff";
											} elseif (in_array($document_extension, array("xls", "xlsx"))) {
												$document_type = "excel";
												$icon_color = "008800";
											}
											
											$modal.= "										
											<a href=\"#\" title=\"Download\" onclick=\"window.location.href='download.php?payment_proof=$payment_proof&l=$level'\">
												<i class=\"fa fa-file-$document_type-o fa-lg\" style=\"color:#$icon_color;margin-top:7px;\"></i> Download TEP fee proof of payment
											</a>";
										}

										$modal.= "
										</div>";
										
										foreach($tep as $t) :	
											$div_id = ($i == (count($tep) - 1)) ? " id=\"add_tep\"" : "";	
											$modal .= "
											<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 20px;\">";
											
												if ($i == 0) {
													$btn_prefix = "add";
													$btn_icon = "plus";
												} else {
													$btn_prefix = "remove";
													$btn_icon = "minus";
												}
												
												$modal .= "
												<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">
													<fieldset class=\"form-group col-md-12\">
														<label for=\"tep_fullname\">Fullname</label>
														<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"tep_fullname[]\" id=\"tep_fullname\" 
														value=\"" . $t["fullname"] . "\" required$field_disabled>
														<input type=\"hidden\" name=\"tep_id[]\" id=\"tep_id\" value=\"" . $t["tep_id"] . "\">										
													</fieldset>
									
													<fieldset class=\"form-group col-md-6\">
														<label for=\"tep_nationality\">Nationality</label>												
														<select class=\"form-control select2\"	name=\"tep_nationality[]\" style=\"width: 100%;\" required$field_disabled>";										
															if (empty($nationalities)) $nationalities = country::all();
															foreach ($nationalities as $n) :
																$selected = ($t["nationality"] === $n->country_name) ? " selected" : "";
																$modal .= "<option value=\"$n->country_name\"$selected>$n->country_name</option>";
															endforeach;											
															$modal .= " 
														</select>
													</fieldset>
																						
													<fieldset class=\"form-group col-md-5\">
														<label for=\"tep_passport_number\">Passport Number</label>
														<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"tep_passport_number[]\" id=\"tep_passport_number\"
														value=\"" . $t["passport_number"] . "\" required$field_disabled>									
													</fieldset>									
													
													<fieldset class=\"form-group col-md-1\">
														<button type=\"button\" name=\"$btn_prefix" . "_more_tep\" id=\"$btn_prefix" . "_more_tep\" 
														class=\"btn btn-box-tool $btn_prefix" . "_more_tep\"$field_disabled><i class=\"fa fa-$btn_icon\"></i></button>
													</fieldset>
												</div>										
											</div>";
											$i++;
										endforeach;
									} else {
										// this is a new TEP request
										
										$modal .= "
										</div>
										
										<div id=\"add_tep\" class=\"form-group col-md-12\" style=\"margin-bottom: 20px;\">										
											<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">
												<fieldset class=\"form-group col-md-12\">
													<label for=\"tep_fullname\">Fullname</label>
													<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"tep_fullname[]\" id=\"tep_fullname\" required>
												</fieldset>
								
												<fieldset class=\"form-group col-md-6\">
													<label for=\"tep_nationality\">Nationality</label>												
													<select class=\"form-control select2\" name=\"tep_nationality[]\" style=\"width: 100%;\" required>";										
														if (empty($nationalities)) $nationalities = country::all();
														foreach ($nationalities as $n) :
															$selected = ($default_nationality === $n->country_name) ? " selected" : "";
															$modal .= "<option value=\"$n->country_name\"$selected>$n->country_name</option>";
														endforeach;											
														$modal .= " 
													</select>
												</fieldset>
																					
												<fieldset class=\"form-group col-md-5\">
													<label for=\tep_passport_number\">Passport Number</label>
													<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"tep_passport_number[]\" id=\"tep_passport_number\" required>									
												</fieldset>									
												
												<fieldset class=\"form-group col-md-1\">
													<button type=\"button\" name=\"add_more_tep\" id=\"add_more_tep\" class=\"btn btn-box-tool add_more_tep\">
														<i class=\"fa fa-plus\"></i>
													</button>
												</fieldset>
											</div>										
										</div>";
									}
									
									$modal .= "									
								</div>";
							}
						}
						$modal .= "<input type=\"hidden\" name=\"option\" value=\"$action\">
							$modal_bottom
							$btn_save
							$btn_draft
							$btn_reset
							<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">$btn_label_cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /." . ucwords($action) . " TEP Request Modal -->";

        return $modal;
    }
}