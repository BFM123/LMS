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
	 * @param string level
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayTable($index, $logged_username, $access_right, $level, $form_elements = array())
    {
		global $APPROVAL_STATUS;	
		$draft = array_keys($APPROVAL_STATUS)[0];
		$waiting_approval_1 = array_keys($APPROVAL_STATUS)[1];
		$waiting_approval_2 = array_keys($APPROVAL_STATUS)[2];
		$approved = array_keys($APPROVAL_STATUS)[3];

        $leave_id = $form_elements["leave_id"];
        $lastname = $form_elements["lastname"];
        $firstname = $form_elements["firstname"];
        $leave_type = ucwords($form_elements["leave_type"]);
        $duration = $form_elements["duration"];
		$requested_for = $form_elements["requested_for"];
		$start_date = $form_elements["start_date"];
		$start_date = date_format(date_create($start_date), "d M Y"); 
		$end_date = $form_elements["end_date"];
		$end_date = date_format(date_create($end_date), "d M Y"); 
		$number_of_day_due = $form_elements["number_of_day_due"];
		$record_control = $form_elements["record_control"];
		$approval_status = $APPROVAL_STATUS[$record_control];

		$can_view_info = true;
		$can_approve = false;
		$can_delete = false;

		if ($level == $draft) {
			// can view info
			$can_view_info = true;
			$can_delete = ($record_control == $waiting_approval_1) ? true : false;
		} elseif ($level == $waiting_approval_1) { 
			// for approved applications, display the view details icon	
			$can_view_info = false;
			$can_approve = true;
		} elseif ($level == $waiting_approval_2) {
			$can_approve = true;
			$can_view_info = false;
		} elseif ($level == $approved) {
			$can_approve = false;
		}

		if ($level == $record_control || $level == $draft) {
			//$username = ($level == $draft) ? $logged_username : $requested_for;

			$tbody = "		
			<tr>
				<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . "</td>
				<td nowrap=\"nowrap\">$firstname $lastname</td>
				<td>$leave_type</td>
				<td>$start_date</td>
				<td>$end_date</td>
				<td class=\"text-right\">$duration</td>
				<td class=\"text-right\">$number_of_day_due</td>";
				
				if ($level == $draft || $approved)
					$tbody .= "<td class=\"text-center\" nowrap=\"nowrap\">$approval_status</td>";

				if ($access_right === "RW") {
					$tbody .= "
					<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">";
						if ($can_approve) 
							$tbody .= "<a title=\"Approve\" data-toggle=\"modal\" data-target=\"#" . $leave_id . "approve\" href=\"#\"><i class=\"fa fa-check\"></i></a>&nbsp";
						if ($can_view_info)
							$tbody .= "<a title=\"Info\" data-toggle=\"modal\" data-target=\"#" . $leave_id . "info\" href=\"#\"><i class=\"fa fa-info-circle fa-lg info\"></i></a>&nbsp";
						if ($can_delete) 
							$tbody .= "<a title=\"delete\" data-toggle=\"modal\" data-target=\"#" . $leave_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>&nbsp
					</td>";
				}
			$tbody .= "
			</tr>";

			if ($access_right === "RW") {
				// display Approve leave Modal
				if ($can_approve) $tbody .= modal::displayModal("approve", $logged_username, $form_elements, $level);

				// display leave Info Modal
				if ($can_view_info) $tbody .= modal::displayModal("info", $logged_username, $form_elements, $level);	
		
				// display delete leave application Modal
				if ($can_delete) $tbody .= modal::displayModal("delete", $logged_username, $form_elements, $level);
			}
			return $tbody;
		}
    }

    /**
     * display modal
     *
     * @param string action
	 * @param string logged_username
     * @param array form_elements
     * @param string level

     * @return string modal
     */
    public static function displayModal($action, $logged_username, $form_elements = array(), $level, $requested_for = "")
    {
		$leave_id = "";
        $num_of_days = "";
        $start_date = "";
        $end_date = "";
		$disabled = "";

        $modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";

        if (!empty($form_elements)) {
            // form elements have values this is an Edit Modal
			$leave_id = $form_elements['leave_id'];
			$num_of_days = $form_elements['duration'];
			$start_date = $form_elements['start_date'];
			$start_date = date_format(date_create($start_date), "d M Y"); 
			$end_date = $form_elements['end_date'];
			$end_date = date_format(date_create($end_date), "d M Y"); 
			$record_control = $form_elements["record_control"];
			$comment = $form_elements['comment'];
			$leave_type = $form_elements['leave_type'];
			$can_request_for_others = $form_elements['can_request_for_others'];
			$requested_for = $form_elements['requested_for'];
			$logged_organization_id = common::getFieldValue("user", "organization_id", "username", $logged_username);
			$user_id = common::getFieldValue("user", "user_id", "username", $logged_username);
			$leave_types = leave::getLeaveTypes($logged_organization_id, "Yes");
			
            $modal_bottom = "<input type=\"hidden\" name=\"leave_id\" value=\"$leave_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">
							<input type=\"hidden\" name=\"approved_by\" value=\"$logged_username\">
							<input type=\"hidden\" name=\"organization_id\" value=\"$logged_organization_id\">";
		}

		if ($action === "request" || $action === "info") {
			$modal_title = ucwords("leave application details");
		} elseif ($action === "approve") {
			$modal_title = ucwords("$action") . " or Reject leave application";
		}

		$tag = "h4";
		$blank = "";
		$logged_organization_id = common::getFieldValue("user", "organization_id", "username", $logged_username);
		$logged_role_id = common::getFieldValue("user", "role_id", "username", $logged_username, "organization_id", $logged_organization_id);
		$can_request_for_others = common::getFieldValue("role", "can_request_for_others", "role_id", $logged_role_id, "organization_id", $logged_organization_id);


		$btn_label_save = "Save";
		$btn_label_cancel = "<a data-dismiss=\"modal\" class=\"btn btn-default btn-b\">&nbsp;Cancel&nbsp</a>";
				
        if ($action === "delete") {
			$tag = "div";
			$delete_for = common::getFieldValue("user", "CONCAT(firstname , ' ' , lastname)", "username", $requested_for, "organization_id", $logged_organization_id);
			$delete_for = ($requested_for != $logged_username) ? " for $delete_for" : "";
            $modal_title = "Are you sure you want to delete $leave_type leave application$delete_for ($start_date to $end_date)?";
			$btn_label_save = "Yes";

            $modal_bottom = "<input type=\"hidden\" name=\"leave_id\" value=\"$leave_id\"><br/>
				<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">
				<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">
				<input type=\"hidden\" name=\"deleted_for\" value=\"$requested_for\">
				<input type=\"hidden\" name=\"l\" value=\"$level\">
				<input type=\"hidden\" name=\"record_control\" value=\"$record_control\">";

			$btn_label_cancel = "<a data-dismiss=\"modal\" class=\"btn btn-default btn-b\">&nbsp;&nbsp; No &nbsp;&nbsp</a>";
        } elseif ($action === "approve") {
			$btn_label_save = "Save";
		}

		if ($action !== "request") {
			$modal_id = "$leave_id" . "$action";
			$disabled = "disabled";
			$type = "text";
		}
		 else
		{
			$modal_id = "$action";
			$type = "date";
			$record_control = 0;
			$start_date = date("d M Y"); 
			$end_date = date("d M Y"); 
			$btn_label_save = "Request";
		}

		$modal = "
		<!-- " . ucwords($action) . " request Modal -->
		<div class=\"modal fade\" id=\"$modal_id\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" name=\"formclasses\" method=\"post\" enctype=\"multipart/form-data\">";
       					if ($action !== "delete" && $action !== "info" && $action !== "approve") {
							if ($can_request_for_others == "Yes") {
								$modal .= "
								<fieldset class=\"form-group col-md-12\">
									<label for=\"requested_for\">Employee</label>
									<select class=\"form-control select2\" style=\"width: 100%;\" name=\"requested_for\" id=\"requested_for\">
										<option value=\"\">" . OPTION_SELECT . "</option>";
											$users = user::all($blank, $blank, $logged_organization_id);
											foreach ($users as $u):
												$selected = ($requested_for === $u->username) ? " selected" : "";
												$modal .= "<option value=\"$u->username\"$selected> ". ucwords($u->firstname . " " . $u->lastname) ."</option>";
											endforeach;
									$modal .= "</select>
								</fieldset>";
							}
							$modal .= "
							<fieldset class=\"form-group col-md-12\">
							  <label class=\"required\" for=\"start_date\">Start Date</label>
							  <div class=\"input-group date\" data-date-format=\"dd/mm/yyyy\">
								<input type=\"date\" class=\"form-control end_date\" name=\"start_date\" id=\"$leave_id-$action-start_date\" value=\"$start_date\" $disabled required>
								<div class=\"input-group-addon\">
									<span class=\"glyphicon glyphicon-calendar fa fa-calendar\"></span>
								</div>
							  </div>
						  	</fieldset>

							<fieldset class=\"form-group col-md-12\">
								<label class=\"required\" for=\"end_date\">End Date</label>
								<div class=\"input-group date\" data-date-format=\"dd/mm/yyyy\">
									<input type=\"date\" class=\"form-control end_date\" name=\"end_date\" id=\"$leave_id-$action-end_date\" value=\"$end_date\" $disabled required>
									<div class=\"input-group-addon\">
										<span class=\"glyphicon glyphicon-calendar fa fa-calendar\"></span>
									</div>
								</div>
							</fieldset>

							<fieldset class=\"form-group alert alert-" . MESSAGE_INFORMATION_TYPE . " hide\" id=\"$leave_id-$action-alert\">
								<i class=\"fa fa-info-circle style=\"font-size: 20px\"></i> <span>Start Date cannot be greater than End Date</span>
							</fieldset>

							<fieldset class=\"form-group col-md-12\">
							  <label class=\"\" for=\"num_of_days\">Days Requested</label>
								<input type=\"text\" class=\"form-control\" name=\"num_of_days\" value=\"$num_of_days\" id=\"$leave_id-$action-num_of_days\" disabled>
						  	</fieldset>

							<fieldset class=\"form-group col-md-12\">
								<label class=\"required\" for=\"leave_type\">Leave Type</label>
								<select id=\"$leave_id-$action-leave_type\" class=\"form-control leave_type\" name=\"leave_type\" value=\"$leave_type\" $disabled required> 
									<option value=\"\">" . OPTION_SELECT. "</option>";
									$leave_types = leave::getLeaveTypes($logged_organization_id);
									foreach ($leave_types as $t):
										if ($action === "request")
											$selected = "";
										else
										 $selected = ($leave_type === $t->leave_type) ? " selected" : "";
										
										$modal .= "<option value=\"$t->leave_type\"$selected> ". ucwords($t->leave_type) ."</option>";
									endforeach;
									$modal .= "
								</select>
							</fieldset>

							<fieldset class=\"form-group col-md-12\">
								<label for=\"comments\">Comments</label>
								<textarea class=\"form-control\" maxlength=\"180\" name=\"comments\" id=\"$leave_id-$action-comments\" rows=\"2\" $disabled>$comment</textarea>
							</fieldset>

							<div class=\"\">
								<fieldset class=\"form-group col-md-12 \">
									<label id=\"$leave_id-$action-document\" for=\"supporting_document\">Supporting Document</label>
									<input type=\"file\" name=\"supporting_document\" value=\"\" id=\"$leave_id-$action-supporting_document\"  accept=\".pdf,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document\" required>
								</fieldset>
							</div>";
										
						} elseif ($action === "info" || $action === "approve") {
							$filename = common::getFieldValue("document", "filename", "organization_id", $logged_organization_id, "username", $requested_for, "leave_id", $leave_id);
							$document_id = common::getFieldValue("document", "document_id", "organization_id", $logged_organization_id, "username", $requested_for, "leave_id", $leave_id);
							$document_category = common::getFieldValue("document", "document_category", "organization_id", $logged_organization_id, "username", $requested_for, "leave_id", $leave_id);

							// get document type
							$document_extension = explode(".", $filename); $document_extension = strtolower(end($document_extension));
							$document_type = $document_extension;	
							
							$icon_color = "ee0000";
							$link = "download.php?document_id=$document_id&organization_id=$logged_organization_id&l=$level";

							$icon_download = "
							<a href=\"#\" title=\"Download\" onclick=\"window.location.href='$link'\">
								<i class=\"fa fa-file-$document_type-o fa-lg\" style=\"color:#$icon_color;margin-top:7px;\"></i> Download ".strtolower($document_category)."
							</a>";

							// only generate this part of the modal for approve actions
							if ($action == "approve") {
								$modal .= "
								<fieldset class=\"form-group col-md-12\">
									<fieldset class=\"col-md-6\"><label class=\"required\" for=\"approve\">Approve</label></fieldset>
									<fieldset class=\"col-md-6\">
										<select id=\"$leave_id-$action-approve\" class=\"form-control approve\" name=\"approve\" value=\"\" required>
											<option value=\"\">" . OPTION_SELECT. "</option>
											<option value=\"Yes\">Yes</option>
											<option value=\"No\">No</option>
										</select>
									</fieldset>
								</fieldset>";
							}
							$modal .= " 
							<fieldset class=\"form-group col-md-12\">
								<fieldset class=\"col-md-6\"><label class=\"\" for=\"start_date\">Start Date</label></fieldset>
								<fieldset class=\"col-md-6\">$start_date</fieldset>
							</fieldset>

							<fieldset class=\"form-group col-md-12\">
								<fieldset class=\"col-md-6\"><label class=\"form-group\" for=\"end_date\" style=\"left-margin: -2;\">End Date</label></fieldset>
								<fieldset class=\"col-md-6\"><span class=\"form-group\">$end_date</span></fieldset>
							</fieldset>

							<fieldset class=\"form-group col-md-12\">
								<fieldset class=\"col-md-6\"><label class=\"form-group\" for=\"num_of_days\">Days Requested</label></fieldset>
								<fieldset class=\"col-md-6\"><span class=\"form-group\">$num_of_days</span></fieldset>
							</fieldset>

							<fieldset class=\"form-group col-md-12\">
								<fieldset class=\"col-md-6\"><label class=\"form-group\" for=\"leave_type\">Leave Type</label></fieldset>
								<fieldset class=\"col-md-6\"><span class=\"form-group\">$leave_type</span></fieldset>
							</fieldset>";

							if ($action == "approve") {
								$modal .= "
								<fieldset class=\"form-group col-md-12\">
									<fieldset class=\"col-md-6\"><label class=\"required\" id=\"$leave_id-$action-comments_label\" for=\"comments\">Comments</label></fieldset>
									<fieldset class=\"col-md-6\">
										<textarea class=\"form-control\" maxlength=\"180\" name=\"comments\" id=\"$leave_id-$action-comments\" rows=\"2\" required>$comment</textarea>
									</fieldset>
								</fieldset>";
							} else {
								$modal .= "
								<fieldset class=\"form-group col-md-12\">
									<label class=\"form-group col-md-6\" for=\"comments\">Comments</label>
									<span class=\"form-group col-md-6\">$comment</span>
								</fieldset>";
							}

							if ($document_id > 0) {
							$modal .= "
								<fieldset class=\"form-group col-md-12\">
									<fieldset class=\"col-md-6\"><label class=\"form-group\" for=\"supporting_document\">Supporting Document</label></fieldset>
									<fieldset class=\"col-md-6\"><span class=\"form-group\"><input type=\"hidden\" name=\"supporting_document\" value=\"$document_id\">$icon_download</span></fieldset>
								</fieldset>";
							}
						}

						$modal .= "<input type=\"hidden\" name=\"option\" id=\"$leave_id-$action-option\" value=\"$action\">
								<input type=\"hidden\" name=\"user_id\" value=\"$user_id\">
								<input type=\"hidden\" name=\"record_control\" value=\"$record_control\">
								<input type=\"hidden\" name=\"l\" value=\"$level\">";
								$modal .= " $modal_bottom 
							<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\" id=\"$leave_id-$action-approve_btn\">$btn_label_save</button>
						$btn_label_cancel
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- " . ucwords($action) . " request Modal -->";
        return $modal;
    }
}