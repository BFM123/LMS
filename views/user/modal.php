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
	 * @param boolean logged_is_ngo_user
	 * @param string logged_organization_id
	 * @param string logged_role_id
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayTable($index, $logged_username, $access_right, $logged_is_ngo_user, $logged_organization_id, $logged_role_id, $form_elements = array())
    {
        $user_id = $form_elements["user_id"];
        $username = $form_elements["username"];			
        $firstname = $form_elements["firstname"];			
        $lastname = $form_elements["lastname"]; 
		$fullname = "$firstname $lastname";
	    $position = $form_elements["position"];			
	    $email = $form_elements["email"];			
	    $organization_id = $form_elements["organization_id"];			
		$organization = common::getFieldValue("organization", "CONCAT(organization_name, IF(LENGTH(abbreviation) > 0, CONCAT(' (', abbreviation, ')'), ''))", 
											  "organization_id", $organization_id);
        $district_id = $form_elements["district_id"];			
		$district = common::getFieldValue("district", "district_name", "district_id", $district_id);
        $role_id = $form_elements["role_id"];
		$role = common::getFieldValue("role", "role_name", "role_id", $role_id);
		
        $tbody = "		
		<tr>
			<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td>$username</td>
			<td>$fullname</td>
			<td>$position</td>
			<td>$district</td>
			<td>$role</td>";
			
			if ($access_right === "RW") {
				$tbody .= "
				<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">
					<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#" . $user_id ."edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
					<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#" . $user_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>
				</td>";
			}

		$tbody .= "
		</tr>";

		if ($access_right === "RW") {
			// display Edit User Modal
			$tbody .= modal::displayModal("edit", $logged_username, $logged_is_ngo_user, $logged_organization_id, $logged_role_id, $form_elements);
	
			// display Delete User Modal
			$tbody .= modal::displayModal("delete", $logged_username, $logged_is_ngo_user, $logged_organization_id, $logged_role_id, $form_elements);
		}

		return $tbody;
    }
   
    /**
     * display modal
     *
     * @param string action
	 * @param string logged_username
	 * @param boolean logged_is_ngo_user
 	 * @param string logged_organization_id
	 * @param string logged_role_id
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayModal($action, $logged_username, $logged_is_ngo_user, $logged_organization_id, $logged_role_id, $form_elements = array())
    {
 		$user_id = "";
		$table_name = "";
        $username = "";		
		$firstname = "";			
        $lastname = "";
        $district_id = "";
        $position = "";
        $email = "";
		$change_password = "";
		$change_password_checked = "";
		$account_disabled = "";
		$account_disabled_checked = "";
		$log_attempts = "";			
		$account_locked = "";
		$account_locked_checked = "";
		$is_ngo_user = "";
		$is_ngo_user_checked = "";
		$photo = "";		
	    $organization_id = "";
		$organization_disabled = " disabled";
		if ($logged_is_ngo_user) {
			$organization_id = $logged_organization_id;
			$is_ngo_user = "Yes";			
			$is_ngo_user_checked = " checked";
			$organization_disabled = "";
		}
		$role_id = ($logged_is_ngo_user) ? $logged_role_id : "";
		
        $modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";
		$check_passwords_match = " onInput=\"confirm_password.setCustomValidity(confirm_password.value != password.value ? 'The password fields do not match' : ''); \"";
        if (!empty($form_elements)) {
            // form elements have values, this is an Edit Modal
          
			$user_id = $form_elements["user_id"];
			$username = $form_elements["username"];
			$firstname = $form_elements["firstname"];			
			$lastname = $form_elements["lastname"]; 
			$fullname = "$firstname $lastname";   
			$position = $form_elements["position"];			
			$email = $form_elements["email"];			
			$organization_id = $form_elements["organization_id"];			
			$organization = common::getFieldValue("organization", "organization_name", "organization_id", $organization_id);
			$district_id = $form_elements["district_id"];			
			$district = common::getFieldValue("district", "district_name", "district_id", $district_id);
			$role_id = $form_elements["role_id"];
			$change_password = $form_elements["change_password"];
			$change_password_checked = ($change_password === "Yes") ? " checked" : "";
			$account_disabled = $form_elements["account_disabled"];
			$account_disabled_checked = ($account_disabled === "Yes") ? " checked" : "";
			$account_locked = $form_elements["account_locked"];			
			$log_attempts = $form_elements["log_attempts"];			
			$max_log_attempts = security::getSecurityAttribute("account_lockout_threshold");
			if ($log_attempts >= $max_log_attempts) $account_locked = "Yes";			
			$account_locked_checked = ($account_locked === "Yes") ? " checked" : "";			
			$is_ngo_user = $form_elements["is_ngo_user"];			
			if ($is_ngo_user === "Yes") {
				$is_ngo_user_checked = " checked";
				$organization_disabled = "";
				
			} else {
				$organization_disabled = " disabled";
			}
					
			$photo = $form_elements["photo"];

            $modal_bottom = "<input type=\"hidden\" name=\"user_id\" value=\"$user_id\">
							<input type=\"hidden\" name=\"username\" value=\"$username\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";
        }

		$from_page = ""; //user-account";		
        $modal_title = ($from_page === "user-account") ? $fullname : ucwords("$action User");
		
		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";
		
        if ($action === "delete") {
			$check_passwords_match = "";
			$tag = "div";
    		$modal_title = "Are you sure you want to delete user '$username'?";

            $modal_bottom = "<input type=\"hidden\" name=\"user_id\" value=\"$user_id\"><br />
							<input type=\"hidden\" name=\"username\" value=\"$username\">
							<input type=\"hidden\" name=\"photo\" value=\"$photo\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";
			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
        }

        $modal = "
		<!-- " . ucwords($action) . " User Modal -->
		<div class=\"modal fade\" id=\"$user_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" method=\"post\"$check_passwords_match enctype=\"multipart/form-data\">";

						if ($action !== "delete") {
							// only generate this part of the modal for Add and Edit actions
							
							// disable some details if this is an edit modal
							$disabled = ($action === "edit") ? " disabled" : "";
	
							// make some fileds required if the user got to this form via the 'Account' link
							$required = ($action === "edit") ? "" : " required";
														
							$modal .= "							
							<fieldset class=\"form-group col-md-12\">
								<label class=\"required\" for=\"username\">Username</label>
								<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"username\" value=\"$username\" $disabled required>
							</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label class=\"required\" for=\"firstname\">Firstname</label>
								<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"firstname\" value=\"$firstname\" required>
							</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label class=\"required\" for=\"lastname\">Lastname</label>
								<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"lastname\" value=\"$lastname\" required>
							</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label class=\"required\" for=\"position\">Position</label>
								<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"position\" value=\"$position\" required>
							</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label class=\"required\" for=\"email\">Email</label>
								<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"email\" value=\"$email\" required>
							</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label class=\"$required\" for=\"password\">Password</label>
								<input type=\"password\" class=\"form-control\" name=\"password\" value=\"\"$required>
							</fieldset>
							
							<fieldset class=\"form-group col-md-6\">
								<label class=\"$required\" for=\"confirm_password\">Confirm Password</label>
								<input type=\"password\" class=\"form-control\" name=\"confirm_password\" value=\"\"$required>
							</fieldset>";							
							
							if ($logged_is_ngo_user) {
								// force users created by NGOs to be assigned to the creator's NGO i.e. NGOs should only assign their users to their own NGO
								$modal .= "<input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">";			
								$modal .= "<input type=\"hidden\" name=\"is_ngo_user\" value=\"$is_ngo_user\">";			
							} else {
								$modal_length = ($action === "edit") ? 6 : 12;
								$modal .= "
								<fieldset class=\"form-check col-md-$modal_length\">							
									<label class=\"switch\">
										<input type=\"checkbox\" name=\"is_ngo_user\" class=\"is_ngo_user\" value=\"Yes\" id=\"$user_id" . "_is_ngo_user\" $is_ngo_user_checked>
										<span class=\"slider round\"></span>
									</label>
									<b>NGO user</b>
								</fieldset>";
							
								if ($action === "edit") {
									$modal .= "
									<fieldset class=\"form-check col-md-$modal_length\">							
										<label class=\"switch\">
											<input type=\"checkbox\" name=\"send_activation_email\" class=\"send_activation_email\" value=\"Yes\">
											<span class=\"slider round\"></span>
										</label>
										<b>Send Activation Email</b>
									</fieldset>";
								}
									
								$modal .= "
								<fieldset class=\"form-group col-md-6\">
									<label for=\"organization_id\">NGO</label>								
									<select class=\"form-control select2\" style=\"width: 100%\" name=\"organization_id\" id=\"$user_id" . 
									"_organization_id\"$organization_disabled>
										<option value=\"\">" . OPTION_SELECT . "</option>";										
										$organizations = organization::all();
										foreach ($organizations as $o) :
											$organization_name = (strlen($o->abbreviation) > 0 ) ? "$o->organization_name ($o->abbreviation)" : $o->organization_name;
											$selected = ($organization_id === $o->organization_id) ? " selected" : "";
											$modal .= "<option value=\"$o->organization_id\"$selected>$organization_name</option>";
										endforeach;
										
									$modal .= " 
									</select>
								</fieldset>";
							}
							
							$modal .= "	
							<fieldset class=\"form-group col-md-6\">
								<label class=\"required\" for=\"district_id\">District</label>								
								<select class=\"form-control select2\" style=\"width: 100%\" name=\"district_id\" required>
									<option value=\"\">" . OPTION_SELECT . "</option>";									
									$districts = district::all();
									foreach ($districts as $d) :
										$selected = ($district_id === $d->district_id) ? " selected" : "";
										$modal .= "<option value=\"$d->district_id\"$selected>$d->district_name</option>";
									endforeach;
								
								$modal .= " 
								</select>
							</fieldset>";
							
							if ($logged_is_ngo_user) {
								// force users created by NGOs to be assigned to the creator's role i.e. NGOs should only assign their users to the NGO role
								$modal .= "<input type=\"hidden\" name=\"role_id\" value=\"$role_id\">";			
							} else {
								$modal .= "
								<fieldset class=\"form-group col-md-6\">
									<label class=\"required\" for=\"role_id\">Role</label>								
									<select class=\"form-control select2\" style=\"width: 100%\" name=\"role_id\" required>
										<option value=\"\">" . OPTION_SELECT . "</option>";										
										$roles = role::all();
										foreach ($roles as $r) :
											$role_name = $r->role_name;
	
											$selected = ($role_id === $r->role_id) ? " selected" : "";
											$modal .= "<option value=\"$r->role_id\"$selected>$role_name</option>";
										endforeach;
									
										$modal .= " 
									</select>
								</fieldset>";
							}
							
							$modal .= "												
							<fieldset class=\"form-group col-md-6\">
								<label for=\"photo\">Photo</label>
								<input type=\"file\" class=\"form-control-file border\" name=\"photo\" value=\"\">
							</fieldset>";
							
							if ($from_page === "user-account") {
								$modal .= "
								<input type=\"hidden\" name=\"change_password\" value=\"$change_password\">
								<input type=\"hidden\" name=\"account_disabled\" value=\"$account_disabled\">
								<input type=\"hidden\" name=\"account_locked\" value=\"$account_locked\">";
							} else {
								// don't show the account options if user got to this form via the 'Account' link
							
								$modal .= 
								"<fieldset class=\"form-check col-md-12\">							
									<label class=\"switch\">
										<input type=\"checkbox\" name=\"change_password\" value=\"Yes\"$change_password_checked>
										<span class=\"slider round\"></span>
									</label>
									<b>User Must Change Password at Next Logon</b>
								</fieldset>
								
								<fieldset class=\"form-check col-md-12\">							
									<label class=\"switch\">
										<input type=\"checkbox\" name=\"account_disabled\" value=\"Yes\"$account_disabled_checked>
										<span class=\"slider round\"></span>
									</label>
									<b>Account is Disabled</b>
								</fieldset>
								
								<fieldset class=\"form-check col-md-12\">							
									<label class=\"switch\">
										<input type=\"checkbox\" name=\"account_locked\" value=\"Yes\"$account_locked_checked>
										<span class=\"slider round\"></span>
									</label>
									<b>Account is Locked Out</b>
								</fieldset>";
							}
							
							$modal .= "
							<fieldset class=\"form-check col-md-12\">&nbsp;</fieldset>";
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
		<!-- /." . ucwords($action) . " User Modal -->";

        return $modal;
    }
}