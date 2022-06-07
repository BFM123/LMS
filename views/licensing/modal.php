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
     * @param boolean is_reporting_period
     * @param array form_elements
     * @param array organization_data
     * @param string level
     * @param boolean can_submit
     *
     * @return string modal
     */
    public static function displayTable($index, $logged_username, $access_right, $currency, $is_reporting_period, $form_elements = array(), $organization_data = array(), $level, 
										$can_submit = true)
    {
		global $APPROVAL_STATUS;	
		$approved = array_keys($APPROVAL_STATUS)[4];
		$draft = array_keys($APPROVAL_STATUS)[0];
		
	   	$licensing_organization_id = $form_elements["licensing_organization_id"];
	   	$organization_id = $form_elements["organization_id"];
        $organization_name = $form_elements["organization_name"];
        $abbreviation = $form_elements["abbreviation"];
		if (strlen($abbreviation) > 0) $organization_name .= " ($abbreviation)";
        $organization_details = common::getFieldValue("organization", "CONCAT('<br /><b>Reg No: ', registration_number, ' | Reg Year: ', registration_year, '</b>')", 
													  "organization_id", $organization_id);
        $organization_name .= $organization_details;
        $reporting_year = $form_elements["reporting_year"];
		$record_control = $form_elements["record_control"];
		$telephone = $form_elements["telephone"];
        $email = $form_elements["email"];
        $postal_address = $form_elements["postal_address"];
        $district_id = $form_elements["district_id"];
		$district = common::getFieldValue("district", "district_name", "district_id", $district_id);
        $executive_director_fullname = $form_elements["executive_director_fullname"];
        $contact_details = $telephone . " > " . $email . " > " . $postal_address;
		$contact_details = str_replace(">  >", ">", $contact_details);
		if (common::startsWith($contact_details, " > ")) $contact_details = substr($contact_details, 3); // remove the first ' > ' from the string							
		if (common::endsWith($contact_details, " > ")) $contact_details = substr_replace($contact_details, "", -3); // remove the last ' > ' from the string
		$approval_status = $APPROVAL_STATUS[$record_control];
		$status = $form_elements["status"];
		
		$class = "";
		$class_2 = ($reporting_year == date("Y")) ? " alert-info" : "";
		$can_view_info = $can_delete = $can_print = true;
		$can_edit = $can_approve = $can_reject = $can_view_details = false;
		
		if ($level == $draft) {
			if ($status === STATUS_REJECTED) {
				$approval_status = ucwords($status);
				$class = " bg-red";
				$can_edit = true;
			} elseif ($record_control == $draft) {
				if ($is_reporting_period) 
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
	
	   	$tbody = "
		<tr>
			<td class=\"text-right$class_2\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td class=\"$class_2\">$organization_name</td>
			<td class=\"$class_2\">$executive_director_fullname</td>
			<td class=\"$class_2\">$contact_details</td>
			<td class=\"text-center$class_2\" nowrap=\"nowrap\">$reporting_year</td>";
			
			if ($level == $draft)
				$tbody .= "<td class=\"text-center$class$class_2\" nowrap=\"nowrap\">$approval_status</td>";
			else
				$tbody .= "<td class=\"$class_2\">$district</td>";
				
			if ($access_right === "RW") {
				$tbody .= "
				<td class=\"text-center$class_2\" nowrap=\"nowrap\">";
					if ($can_approve) 
						$tbody .= "<a title=\"Approve\" data-toggle=\"modal\"data-target=\"#".$licensing_organization_id."approve\" href=\"#\"><i class=\"fa fa-check\"></i></a> ";
					if ($can_reject) 
						$tbody .= "<a title=\"Reject\" data-toggle=\"modal\"data-target=\"#".$licensing_organization_id."reject\" href=\"#\"><i class=\"fa fa-times\"></i></a> ";
					if ($can_view_info) 
					$tbody .= "<a title=\"Info\"data-toggle=\"modal\"data-target=\"#".$licensing_organization_id."info\"href=\"#\"><i class=\"fa fa-info-circle fa-lg\"></i></a> ";
					if ($can_edit)
						$tbody .= "<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#" . $licensing_organization_id . "edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a> ";
					if ($can_view_details) {
						$tbody .= "
						<a title=\"Details\" data-toggle=\"modal\" data-target=\"#" . $licensing_organization_id."details\" href=\"#\"><i class=\"fa fa-folder-open-o\"></i></a> ";
					}
					if ($can_delete)
						$tbody .="<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#".$licensing_organization_id."delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a> ";						
					if ($can_print) {
						$link = "download.php?form=Annual Return Form&licensing_organization_id=$licensing_organization_id&l=$level";	
						$tbody .= "<a href=\"#\" title=\"Download\" onclick=\"window.location.href='$link'\"><i class=\"fa fa-print fa-lg\"></i></a>";
					}
				$tbody .= "
				</td>";
			}
			
		$tbody .= "
		</tr>";

		if ($access_right === "RW") {
			// display Approve Organization Modal
			if ($can_approve) $tbody .= modal::displayModal("approve", $logged_username, $currency, $is_reporting_period, $form_elements, $organization_data, $level, $can_submit);
			
			// display Reject Organization Modal
			if ($can_reject) $tbody .= modal::displayModal("reject", $logged_username, $currency, $is_reporting_period, $form_elements, $organization_data, $level, $can_submit);
			
			// display Edit Organization Modal
			if ($can_edit) $tbody .= modal::displayModal("edit", $logged_username, $currency, $is_reporting_period, $form_elements, $organization_data, $level, $can_submit);

			// display Organization Details Modal
			if ($can_view_details) $tbody .= modal::displayModal("details", $logged_username, $currency,$is_reporting_period,$form_elements,$organization_data,$level,$can_submit);
			
			// display Organization Info Modal
			if ($can_view_info) $tbody .= modal::displayModal("info", $logged_username, $currency, $is_reporting_period, $form_elements, $organization_data, $level, $can_submit);
	
			// display Delete Organization Modal
			if ($can_delete) $tbody .= modal::displayModal("delete", $logged_username, $currency, $is_reporting_period, $form_elements);
			
			// display Print Annual Return Form Modal
			// no Print Annual Return Form Modal required...this will be handled in download.php
		}

        return $tbody;
    }

    /**
     * display modal
     *
     * @param string action
	 * @param string logged_username
     * @param string currency
     * @param boolean is_reporting_period
     * @param array form_elements
     * @param array organization_data
     * @param string level
     * @param boolean can_submit
     *
     * @return string modal
     */
    public static function displayModal($action, $logged_username, $currency, $is_reporting_period, $form_elements = array(), $organization_data = array(), $level = 0, 
										$can_submit = true)
    {
		global $APPROVAL_STATUS;	
		$draft = array_keys($APPROVAL_STATUS)[0];
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[1];
		$awaiting_approval_level2 = array_keys($APPROVAL_STATUS)[2];
		$awaiting_payment_processing = array_keys($APPROVAL_STATUS)[3];
		$approved = array_keys($APPROVAL_STATUS)[4];

		$field_disabled = "";
		$field_disabled2 = "";
		$can_upload_document = true;
		
		// organizational details
	   	$licensing_organization_id = "";
		$organization_id = "";
		$abbreviation = "";
		$reporting_year = "";
		$organization_name = "";
		$charity_number = "";
		$telephone = "";
		$email = "";
		$registration_type = "";
		$oranization_type = "";
		$postal_address = "";
		$physical_address = "";
		$district_id = "";
		
		// coverage
		$default_nationality = "Malawi";
		
		// governance		
		$executive_director_fullname = "";
		$executive_director_highest_qualification = "";
		$executive_director_nationality = $default_nationality;
		$executive_director_national_id = "";
		$executive_director_national_id_disabled = "";
		$executive_director_email = "";
		$executive_director_telephone = "";
		
		// accounting
		$financial_year_start_month = "";
		$financial_year_end_month = "";
		$annual_income = 0;
		
		// documents
		$download_license_payment_proof = "";
		$download_annual_technical_report = "";
		$download_financial_statement = "";
		$download_activities_plan = "";
		$download_government_approval = "";
		$download_association_membership = "";
		$download_sworn_affidavit = "";
		
		// other
		$approved1_by = "";
		$approved2_by = "";
		$rejected_by = "";
		$download_invoice = "";
		
        $modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">
						 <input type=\"hidden\" name=\"l\" value=\"$level\">";

        if (!empty($form_elements)) {
            // form elements have values, this is an Edit Modal
	
			$record_control = $form_elements["record_control"];
			if ($action === "edit" && $record_control == $approved) {
				// flag selected fields as disabled if user wishes to edit details for approved annual return 			
				$field_disabled = " disabled";
				$can_upload_document = false;
			} elseif (in_array($action, array("approve", "details")) && in_array($level, array($awaiting_approval_level1, $awaiting_approval_level2, $approved))) {
				// flag all fields as disabled if user wishes to approve or view details of an approved annual return 
				$field_disabled = " disabled";
				$field_disabled2 = " disabled";
				$can_upload_document = false;
			}
			
			// organizational details
		   	$licensing_organization_id = $form_elements["licensing_organization_id"];
			$organization_id = $form_elements["organization_id"];
			$abbreviation = $form_elements["abbreviation"];
			$reporting_year = $form_elements["reporting_year"];
			$organization_name = $form_elements["organization_name"];
			$charity_number = $form_elements["charity_number"];
			$telephone = $form_elements["telephone"];
			$email = $form_elements["email"];
			$registration_type = $form_elements["registration_type"];
			$organization_type = $form_elements["organization_type"];
			$postal_address = $form_elements["postal_address"];
			$physical_address = $form_elements["physical_address"];
			$district_id = $form_elements["district_id"];
			
			// coverage
			
			// governance
			$executive_director_fullname = $form_elements["executive_director_fullname"];
			$executive_director_nationality = $form_elements["executive_director_nationality"];
			$executive_director_national_id = $form_elements["executive_director_national_id"];			
			$executive_director_national_id_disabled = ($executive_director_nationality === $default_nationality) ? "" : " disabled";
			
			$executive_director_highest_qualification = $form_elements["executive_director_highest_qualification"];
			$executive_director_email = $form_elements["executive_director_email"];
			$executive_director_telephone = $form_elements["executive_director_telephone"];
			
			// accounting
			$financial_year_start_month = $form_elements["financial_year_start_month"];
			$financial_year_end_m = $form_elements["financial_year_end_month"];
			$financial_year_end_month =  date("F", mktime(0, 0, 0, $financial_year_end_m, 10));
			$annual_income = $form_elements["annual_income"];

			// documents
															
            $modal_bottom = "<input type=\"hidden\" name=\"licensing_organization_id\" value=\"$licensing_organization_id\">
							<input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">
							<input type=\"hidden\" name=\"reporting_year\" value=\"$reporting_year\">							
							<input type=\"hidden\" name=\"l\" value=\"$level\">";
        }
		
		$annual_income = number_format($annual_income, 2);
		
		// organization data
		// organizational details
		$objectives_fieldset = "
		<div id=\"add_objectives\" class=\"form-group col-md-12\">
			<fieldset class=\"form-group col-md-11\" style=\"padding-left: 0;\">
				<label class=\"required\" for=\"objectives\">Organizational Objectives</label>
				<input type=\"text\" class=\"form-control\" maxlength=\"200\" name=\"objectives[]\" id=\"objectives\" required>
			</fieldset>
			
			<fieldset class=\"form-group col-md-1\">
				<label for=\"add_more_objectives\"></label>
				<button type=\"button\" name=\"add_more_objectives\" id=\"add_more_objectives\"class=\"btn btn-box-tool add_more_objectives\"><i class=\"fa fa-plus\"></i></button>
			</fieldset>
		</div>";
		
		$staff_capacity_fieldset = "
		<div id=\"add_staff_capacity\" class=\"form-group col-md-12\">
			<fieldset class=\"form-group col-md-8\" style=\"padding-left: 0;\">
				<label class=\"required\" for=\"staff_capacity_staff\">Staff</label>											
				<select id=\"staff_capacity_type\" class=\"form-control\" name=\"staff_capacity_type[]\" required>
					<option value=\"\">" . OPTION_SELECT . "</option>";
					if (empty($staff_types)) $staff_types = staff::getStaffTypes();									
					foreach ($staff_types as $st) :
						$staff_capacity_fieldset .= "<option value=\"$st->staff_type\">$st->staff_type</option>";
					endforeach;					
					$staff_capacity_fieldset .= " 
				</select>
			</fieldset>										
			
			<fieldset class=\"form-group col-md-3\">
				<label class=\"required\" for=\"staff_capacity_number\">Number</label>
				<input type=\"text\" class=\"form-control format-number\" maxlength=\"20\" name=\"staff_capacity_number[]\" id=\"staff_capacity_number\" required>
			</fieldset>
			
			<fieldset class=\"form-group col-md-1\">
				<label for=\"add_more_staff_capacity\"></label>
				<button type=\"button\" name=\"add_more_staff_capacity\" id=\"add_more_staff_capacity\" class=\"btn btn-box-tool add_more_staff_capacity\">
				<i class=\"fa fa-plus\"></i></button>
			</fieldset>
		</div>";
		
		// coverage
		$selected_sectors = array();
		$sector_fieldset = "
		<fieldset class=\"form-group col-md-12\">
			<label class=\"required\" for=\"sectors\">Sectors Engaged In</label> <i>Government approved </i>
			<select id=\"sectors\" class=\"form-control select2\" name=\"sectors[]\" style=\"width: 100%;\" multiple=\"multiple\"$field_disabled required>
				<option value=\"\">" . OPTION_SELECT . "</option>";
				$i = 0;						
				$sector_option = "";
				if (empty($sectors)) $sectors = sector::all();
				foreach ($sectors as $s) :
					if ($i == 0) $sector_fieldset .= COMMON_PLACEHOLDER; 
					$sector_option .= "<option value=\"$s->sector\">$s->sector</option>";
					$i++;
				endforeach;		
				$sector_fieldset .= " 
			</select>
		</fieldset>";
	
		$location_activity_fieldset = "
		<div id=\"add_location_activities\" class=\"form-group col-md-12\">
			<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
				<label class=\"required\" for=\"location_activities\">Location of Activities</label>
			</fieldset>
			
			<fieldset class=\"form-group col-md-4\" style=\"padding-left: 0;\">
				<label class=\"required\" for=\"location_activities_vdc\">Village Development Committee (VDC)</label>
				<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"location_activities_vdc[]\" id=\"location_activities_vdc\" required>											
			</fieldset>
			
			<fieldset class=\"form-group col-md-4\">
				<label class=\"required\" for=\"location_activities_adc\">Area Development Committee (ADC)</label>
				<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"location_activities_adc[]\" id=\"location_activities_adc\" required>											
			</fieldset>									
			
			<fieldset class=\"form-group col-md-3\">
				<label class=\"required\" for=\"location_activities_district_id\">District Where Located</label>
				<select class=\"form-control select2\" id=\"location_activities_district_id\" name=\"location_activities_district_id[]\" style=\"width: 100%;\" required>
					<option value=\"\">" . OPTION_NA . "</option>";
					if (empty($districts)) $districts = district::all();
					foreach ($districts as $d):
						$location_activity_fieldset .= "<option value=\"$d->district_id\">$d->district_name</option>";
					endforeach;
					$location_activity_fieldset .= "
				</select>
			</fieldset>
			
			<fieldset class=\"form-group col-md-1\">
				<label for=\"add_more_location_activities\"></label>
				<button type=\"button\" name=\"add_more_location_activities\" id=\"add_more_location_activities\" class=\"btn btn-box-tool add_more_location_activities\">
				<i class=\"fa fa-plus\"></i></button>
			</fieldset>
		</div>";
		
		$selected_target_groups = array();
		$target_group_fieldset = "
		<fieldset class=\"form-group col-md-12\">
			<label class=\"required\" for=\"target_groups\">Target Groups</label>
			<select id=\"target_groups\" class=\"form-control select2\" name=\"target_groups[]\" style=\"width: 100%;\" multiple=\"multiple\"$field_disabled required>
				<option value=\"\">" . OPTION_SELECT . "</option>";
				$i = 0;						
				$target_group_option = "";
				if (empty($target_groups)) $target_groups = target_group::all();
				foreach ($target_groups as $t) :
					if ($i == 0) $target_group_fieldset .= COMMON_PLACEHOLDER; 
					$target_group_option .= "<option value=\"$t->target_group\">$t->target_group</option>";
					$i++;
				endforeach;		
				$target_group_fieldset .= " 
			</select>
		</fieldset>";
		
		// governance
		$directors_trustees_fieldset = "
		<div id=\"add_directors_trustees\" class=\"form-group col-md-12\">
			<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
				<label class=\"required\" for=\"directors_trustees\">Directors/Trustees</label>	<i>for international, include Directors on affidavits</i>
			</fieldset>
			
			<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"directors_trustees_fullname\">Fullname</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"directors_trustees_fullname[]\" id=\"directors_trustees_fullname\" required>											
				</fieldset>
				
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"directors_trustees_telephone\">Phone</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_telephone[]\" id=\"directors_trustees_telephone\" required>											
				</fieldset>
				
				<fieldset class=\"form-group col-md-6\">
					<label for=\"directors_trustees_email\">Email</label>
					<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"directors_trustees_email[]\" id=\"directors_trustees_email\">											
				</fieldset>

				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"directors_trustees_occupation\">Occupation</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_occupation[]\" id=\"directors_trustees_occupation\" required>											
				</fieldset>

				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"directors_trustees_nationality\">Nationality</label>												
					<select id=\"$licensing_organization_id" . "_$action" . "_directors_trustees_nationality\" class=\"form-control select2 nationality\" 
					name=\"directors_trustees_nationality[]\" style=\"width: 100%;\" required>";										
						if (empty($nationalities)) $nationalities = country::all();
						foreach ($nationalities as $n) :
							$selected = ($default_nationality === $n->country_name) ? " selected" : "";
							$directors_trustees_fieldset .= "<option value=\"$n->country_name\"$selected>$n->country_name</option>";
						endforeach;						
						$directors_trustees_fieldset .= " 
					</select>
				</fieldset>
						
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"directors_trustees_national_id\">National ID</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"directors_trustees_national_id[]\" 
					id=\"$licensing_organization_id" . "_$action" . "_directors_trustees_national_id\" required>									
				</fieldset>
															
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"directors_trustees_position\">Position</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_position[]\" id=\"directors_trustees_position\" required>											
				</fieldset>

				<fieldset class=\"form-group col-md-5\">
					<label class=\"required\" for=\"directors_trustees_timeframe\">Timeframe</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_timeframe[]\" id=\"directors_trustees_timeframe\" required>											
				</fieldset>
				
				<fieldset class=\"form-group col-md-1\">
					<label for=\"add_more_directors_trustees\"></label>
					<button type=\"button\" name=\"add_more_directors_trustees\" id=\"0_add_more_directors_trustees\" class=\"btn btn-box-tool add_more_directors_trustees\">
					<i class=\"fa fa-plus\"></i></button>
				</fieldset>
			</div>
		</div>";
		
		// accounting
		$source_funding_fieldset = "		
		<div id=\"add_source_funding\" class=\"form-group col-md-12\">
			<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
				<label class=\"required\" for=\"source_funding\">Sources of Funding</label>											
			</fieldset>
			<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">											
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"source_funding_donor_id\">Funder/Donor Name</label>
					<select class=\"form-control select2\" id=\"source_funding_donor_id\" name=\"source_funding_donor_id[]\" style=\"width: 100%;\" required>
						<option value=\"\">" . OPTION_SELECT . "</option>";
						if (empty($donors)) $donors = donor::all();
						foreach ($donors as $d):
							$source_funding_fieldset .= "<option value=\"$d->donor_id\">$d->donor</option>";
						endforeach;
						$source_funding_fieldset .= "
					</select>
				</fieldset>
														
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"source_funding_contact_details\">Details of Contact Person</label>
					<textarea class=\"form-control\" maxlength=\"180\" name=\"source_funding_contact_details[]\" id=\"source_funding_contact_details\" rows=\"1\" required>
					</textarea>										
				</fieldset>
				
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"source_funding_currency\">Funding Currency</label>											
					<select class=\"form-control select2\" id=\"source_funding_currency\" name=\"source_funding_currency[]\" style=\"width: 100%;\" required>";
						if (empty($currencies)) $currencies = currency::all();
						foreach ($currencies as $c):
							$selected = ($c->currency === "USD") ? "selected" : "";
							$source_funding_fieldset .= "<option value=\"$c->currency\"$selected>$c->currency - $c->description</option>";
						endforeach;
						$source_funding_fieldset .= "
					</select>
				</fieldset>
						
				<fieldset class=\"form-group col-md-5\">
					<label class=\"required\" for=\"source_funding_amount\">Amount During the Year</label>											
					<input type=\"text\" class=\"form-control format-money\" maxlength=\"20\" name=\"source_funding_amount[]\" id=\"source_funding_amount\" required>											
				</fieldset>
		
				<fieldset class=\"form-group col-md-1\">
					<label for=\"add_more_source_funding\"></label>
					<button type=\"button\" name=\"add_more_source_funding\" id=\"add_more_source_funding\" class=\"btn btn-box-tool add_more_source_funding\">
					<i class=\"fa fa-plus\"></i></button>
				</fieldset>										
			</div>										
		</div>";
		
		$auditor_fieldset = "
		<div id=\"add_auditor\" class=\"form-group col-md-12\">
			<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
				<label class=\"required\" for=\"auditor\">Auditor's Details</label>											
			</fieldset>
			<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eeddff;\">											
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"auditor_name\">Name</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"auditor_name[]\" id=\"auditor_name\" required>
				</fieldset>
							
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"auditor_address\">Address</label>
					<textarea class=\"form-control\" maxlength=\"180\" name=\"auditor_address[]\" id=\"auditor_address\" rows=\"1\" required></textarea>
				</fieldset>
				
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"auditor_telephone\">Telephone</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"auditor_telephone[]\" id=\"auditor_telephone\" required>
				</fieldset>
																			
				<fieldset class=\"form-group col-md-5\">
					<label for=\"auditor_email\">Email</label>
					<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"auditor_email[]\" id=\"auditor_email\">
				</fieldset>

				<fieldset class=\"form-group col-md-1\">
					<label for=\"add_more_auditor\"></label>
					<button type=\"button\" name=\"add_more_auditor\" id=\"add_more_auditor\" class=\"btn btn-box-tool add_more_auditor\"><i class=\"fa fa-plus\"></i></button>
				</fieldset>										
			</div>										
		</div>";
		
		$bank_fieldset = "			
		<div id=\"add_bank\" class=\"form-group col-md-12\">
			<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
				<label class=\"required\" for=\"bank\">Bank Details</label>											
			</fieldset>
			<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">											
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"bank_id\">Name</label>
					<select class=\"form-control select2\" id=\"bank_id\" name=\"bank_id[]\" style=\"width: 100%;\" required>
						<option value=\"\">" . OPTION_SELECT . "</option>";
						if (empty($banks)) $banks = bank::all();
						foreach ($banks as $b):
							$bank_fieldset .= "<option value=\"$b->bank_id\">$b->bank_name</option>";
						endforeach;
						$bank_fieldset .= "
					</select>
				</fieldset>
							
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"bank_address\">Address</label>
					<textarea class=\"form-control\" maxlength=\"180\" name=\"bank_address[]\" id=\"bank_address\" rows=\"1\" required></textarea>
				</fieldset>
				
				<fieldset class=\"form-group col-md-6\">
					<label class=\"required\" for=\"bank_telephone\">Telephone</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"bank_telephone[]\" id=\"bank_telephone\" required>
				</fieldset>
																			
				<fieldset class=\"form-group col-md-5\">
					<label for=\"bank_email\">Email</label>
					<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"bank_email[]\" id=\"bank_email\">
				</fieldset>

				<fieldset class=\"form-group col-md-1\">
					<label for=\"add_more_bank\"></label>
					<button type=\"button\" name=\"add_more_bank\" id=\"add_more_bank\" class=\"btn btn-box-tool add_more_bank\"><i class=\"fa fa-plus\"></i></button>
				</fieldset>										
			</div>										
		</div>";
		
		// temporary employment permit
		$tep_fieldset = "
		<div id=\"add_tep\" class=\"form-group col-md-12\">
			<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">
				<fieldset class=\"form-group col-md-12\">
					<label for=\"tep_fullname\">Fullname</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"tep_fullname[]\" id=\"tep_fullname\"$field_disabled>											
				</fieldset>

				<fieldset class=\"form-group col-md-6\">
					<label for=\"tep_nationality\">Nationality</label>												
					<select class=\"form-control select2\" name=\"tep_nationality[]\" style=\"width: 100%;\"$field_disabled>";										
						if (empty($nationalities)) $nationalities = country::all();
						foreach ($nationalities as $n) :
							$selected = ($default_nationality === $n->country_name) ? " selected" : "";
							$tep_fieldset .= "<option value=\"$n->country_name\"$selected>$n->country_name</option>";
						endforeach;						
						$tep_fieldset .= " 
					</select>
				</fieldset>
			
									
				<fieldset class=\"form-group col-md-5\">
					<label for=\"tep_passport_number\">Passport Number</label>
					<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"tep_passport_number[]\" id=\"tep_passport_number\"$field_disabled>											
				</fieldset>
				
				<fieldset class=\"form-group col-md-1\">
					<label for=\"add_more_tep\"></label>
					<button type=\"button\" name=\"add_more_tep\" id=\"add_more_tep\" class=\"btn btn-box-tool add_more_tep\"$field_disabled>
					<i class=\"fa fa-plus\"></i></button>
				</fieldset>
			</div>
		</div>";
		
		// documents
		// flag document fields as required
		$document_required = " required";
		
		$additional_documents_fieldset = "
		<div id=\"add_documents\" class=\"form-group col-md-12\" style=\"padding: 10px 0 0 0;\">
			<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">					
				<label for=\"additional_documents\">Additional Documents</label>
			</fieldset>

			<div class=\"col-md-12\" style=\"padding-top: 15px; background-color: #eee;\">
				<fieldset class=\"form-group col-md-11\" style=\"padding-left: 0;\">
					<input type=\"file\" name=\"additional_documents[]\" id=\"additional_documents\">
				</fieldset>
				
				<fieldset class=\"form-group col-md-1\">
					<button type=\"button\" name=\"add_more_documents\" id=\"add_more_documents\" class=\"btn btn-box-tool add_more_documents\">
					<i class=\"fa fa-plus\"></i></button>
				</fieldset>
			</div>			
		</div>";
		
		// temporarily store the fieldsets incase they are empty in the subsquent processing
		$objectives_fieldset_temp = $objectives_fieldset;
		$staff_capacity_fieldset_temp = $staff_capacity_fieldset;
		$location_activity_fieldset_temp = $location_activity_fieldset;			
		$directors_trustees_fieldset_temp = $directors_trustees_fieldset;
		$source_funding_fieldset_temp = $source_funding_fieldset;
		$auditor_fieldset_temp = $auditor_fieldset;
		$bank_fieldset_temp = $bank_fieldset;
		$tep_fieldset_temp = $tep_fieldset;
		$additional_documents_fieldset_temp = $additional_documents_fieldset;	
	
		if (!empty($organization_data)) {
			$objectives_fieldset = "";
			$staff_capacity_fieldset = "";
			$sector_option = "";
			$location_activity_fieldset = "";			
			$target_group_option = "";
			$directors_trustees_fieldset = "";
			$tep_fieldset = "";			
			$source_funding_fieldset = "";
			$auditor_fieldset = "";
			$bank_fieldset = "";
			$additional_documents_fieldset = "";
			
			foreach ($organization_data as $data_category => $data_details) :
				$j = 0;	
				foreach ($data_details as $data) :
					switch ($data_category) :					
						case "objective" :
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_objectives\"" : "";
				
							$objectives_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 0;\">
								<fieldset class=\"form-group col-md-11\" style=\"padding-left: 0;\">";
								
								if ($j == 0) {
									$label = "<label class=\"required\" for=\"objectives\">Organizational Objectives</label>";
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$label = "";
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
	
								$objectives_fieldset .= "
									$label
									<input type=\"text\" class=\"form-control\" maxlength=\"200\" name=\"objectives[]\" id=\"objectives\" value=\"$data->objective\"
									$field_disabled required>
									<input type=\"hidden\" name=\"objectives_id[]\" id=\"objectives_id\" value=\"$data->objective_id\">
								</fieldset>
								
								<fieldset class=\"form-group col-md-1\">
									<button type=\"button\" name=\"$btn_prefix" . "_more_objectives\" id=\"$btn_prefix" . "_more_objectives\" 
									class=\"btn btn-box-tool $btn_prefix" . "_more_objectives\"$field_disabled>
									<i class=\"fa fa-$btn_icon\"></i></button>
								</fieldset>
							</div>";
							$j++;
							break;
							
						case "staff capacity" :	
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_staff_capacity\"" : "";		
							$staff_capacity_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 0;\">
								<fieldset class=\"form-group col-md-8\" style=\"padding-left: 0;\">";
								
								if ($j == 0) {
									$label = "<label class=\"required\" for=\"staff_capacity_staff\">Staff</label>";
									$label_1 = "<label class=\"required\" for=\"staff_capacity_number\">Number</label>";
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$label = "";
									$label_1 = "";
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
	
								$staff_capacity_fieldset .= "
									$label
									<select id=\"staff_capacity_type\" class=\"form-control\" name=\"staff_capacity_type[]\"$field_disabled required>
										<option value=\"\">" . OPTION_SELECT . "</option>";
										if (empty($staff_types)) $staff_types = staff::getStaffTypes();									
										foreach ($staff_types as $st) :
											$selected = ($data->staff_type === $st->staff_type) ? " selected" : "";
											$staff_capacity_fieldset .= "<option value=\"$st->staff_type\"$selected>$st->staff_type</option>";
										endforeach;
										$staff_capacity_fieldset .= " 
									</select>
								</fieldset>
								
								<fieldset class=\"form-group col-md-3\">
									$label_1
									<input type=\"text\" class=\"form-control format-number\" maxlength=\"20\" name=\"staff_capacity_number[]\" 
									id=\"staff_capacity_number\" value=\"" . number_format($data->staff_number) . "\"$field_disabled required>
									<input type=\"hidden\" name=\"staff_capacity_id[]\" id=\"staff_capacity_id\" value=\"$data->staff_capacity_id\">
								</fieldset>
								
								<fieldset class=\"form-group col-md-1\">
									<button type=\"button\" name=\"$btn_prefix" . "_more_staff_capacity\" id=\"$btn_prefix" . "_more_staff_capacity\" 
									class=\"btn btn-box-tool $btn_prefix" . "_more_staff_capacity\"$field_disabled>
									<i class=\"fa fa-$btn_icon\"></i></button>
								</fieldset>
							</div>";
							$j++;						
							break;
					
						case "sector" :	
							$selected_sectors[] = $data->sector;
							$sector_fieldset .= "<input type=\"hidden\" name=\"sector_id[]\" id=\"sector_id\" value=\"$data->sector_id\">";
							break;
						
						case "location activity" :	
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_location_activities\"" : "";		
							$location_activity_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 0;\">";
								
								if ($j == 0) {
									$label = "<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
												<label class=\"required\" for=\"location_activities\">Location of Activities</label>											
											</fieldset>";
									$label_1 = "<label class=\"required\" for=\"location_activities_vdc\">Village Development Committee (VDC)</label>";
									$label_2 = "<label class=\"required\" for=\"location_activities_adc\">Area Development Committee (ADC)</label>";
									$label_3 = "<label class=\"required\" for=\"location_activities_district_id\">District Where Located</label>";
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$label = "";
									$label_1 = "";
									$label_2 = "";
									$label_3 = "";
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
	
								$location_activity_fieldset .= "
									$label
									<fieldset class=\"form-group col-md-4\" style=\"padding-left: 0;\">
										$label_1
										<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"location_activities_vdc[]\" id=\"location_activities_vdc\"
										value=\"$data->vdc\" required $field_disabled>
										<input type=\"hidden\" name=\"location_activities_id[]\" id=\"location_activities_id\" value=\"$data->location_activity_id\">											
									</fieldset>
									
									<fieldset class=\"form-group col-md-4\">
										$label_2
										<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"location_activities_adc[]\" id=\"location_activities_adc\"
										value=\"$data->adc\" required $field_disabled>											
									</fieldset>
																
									<fieldset class=\"form-group col-md-3\">
										$label_3
										<select class=\"form-control select2\" id=\"location_activities_district_id\" name=\"location_activities_district_id[]\" 
										style=\"width: 100%;\"$field_disabled required>				
										<option value=\"\">" . OPTION_NA . "</option>";
										if (empty($districts)) $districts = district::all();									
										foreach ($districts as $d) :
											$selected = ($data->district_id === $d->district_id) ? " selected" : "";
											$location_activity_fieldset .= "<option value=\"$d->district_id\"$selected>$d->district_name</option>";
										endforeach;
										$location_activity_fieldset .= " 
									</select>
								</fieldset>
								
								<fieldset class=\"form-group col-md-1\">
									<button type=\"button\" name=\"$btn_prefix" . "_more_location_activities\" id=\"$btn_prefix" . "_more_location_activities\" 
									class=\"btn btn-box-tool $btn_prefix" . "_more_location_activities\"$field_disabled>
									<i class=\"fa fa-$btn_icon\"></i></button>
								</fieldset>
							</div>";
							$j++;						
							break;
				
						case "target group" :	
							$selected_target_groups[] = $data->target_group;
							$target_group_fieldset .= "<input type=\"hidden\" name=\"target_group_id[]\" id=\"target_group_id\" value=\"$data->target_group_id\">";
							break;
							
						case "trustee" :
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_directors_trustees\"" : "";	
							$directors_trustees_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 20px;\">";
							
								if ($j == 0) {
									$label = "<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
												<label class=\"required\" for=\"directors_trustees\">Directors/Trustees</label> 
												<i>for international, include Directors on affidavits</i>
											</fieldset>";
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$label = "";									
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
								
								$directors_trustees_national_id_disabled = ($data->nationality === $default_nationality) ? "" : " disabled";

								$directors_trustees_fieldset .= "
								$label
								<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"directors_trustees_fullname\">Fullname</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"directors_trustees_fullname[]\" id=\"directors_trustees_fullname\" 
										value=\"$data->fullname\"$field_disabled required>
										<input type=\"hidden\" name=\"directors_trustees_id[]\" id=\"directors_trustees_id\" value=\"$data->trustee_id\">										
									</fieldset>
									
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"directors_trustees_telephone\">Phone</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_telephone[]\" id=\"directors_trustees_telephone\" 
										value=\"$data->telephone\"$field_disabled required>											
									</fieldset>
									
									<fieldset class=\"form-group col-md-6\">
										<label for=\"directors_trustees_email\">Email</label>
										<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"directors_trustees_email[]\" id=\"directors_trustees_email\" 
										value=\"$data->email\"$field_disabled>											
									</fieldset>
					
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"directors_trustees_occupation\">Occupation</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_occupation[]\" id=\"directors_trustees_occupation\" 
										value=\"$data->occupation\"$field_disabled required>											
									</fieldset>
					
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"directors_trustees_nationality\">Nationality</label>												
										<select id=\"$licensing_organization_id" . "_$j" . "_$action" . "_directors_trustees_nationality\" class=\"form-control select2 
										nationality\" name=\"directors_trustees_nationality[]\" style=\"width: 100%;\"$field_disabled required>";										
											if (empty($nationalities)) $nationalities = country::all();
											foreach ($nationalities as $n) :
												$selected = ($data->nationality === $n->country_name) ? " selected" : "";
												$directors_trustees_fieldset .= "<option value=\"$n->country_name\"$selected>$n->country_name</option>";
											endforeach;											
											$directors_trustees_fieldset .= " 
										</select>
									</fieldset>
								
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"directors_trustees_national_id\">National ID</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"directors_trustees_national_id[]\" 
										id=\"$licensing_organization_id" . "_$j" . "_$action" . "_directors_trustees_national_id\" value=\"$data->national_id\"$field_disabled 
										required $directors_trustees_national_id_disabled>									
									</fieldset>
																												
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"directors_trustees_position\">Position</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_position[]\" id=\"directors_trustees_position\" 
										value=\"$data->position\"$field_disabled required>											
									</fieldset>
					
									<fieldset class=\"form-group col-md-5\">
										<label class=\"required\" for=\"directors_trustees_timeframe\">Timeframe</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"directors_trustees_timeframe[]\" id=\"directors_trustees_timeframe\" 
										value=\"$data->timeframe\"$field_disabled required>											
									</fieldset>
									
									<fieldset class=\"form-group col-md-1\">
										<button type=\"button\" name=\"$btn_prefix" . "_more_directors_trustees\" id=\"$j" . "_$btn_prefix" . "_more_directors_trustees\" 
										class=\"btn btn-box-tool $btn_prefix" . "_more_directors_trustees\"$field_disabled>
										<i class=\"fa fa-$btn_icon\"></i></button>
									</fieldset>
								</div>										
							</div>";
							$j++;
							break;
						
						case "tep" :							
							// temporary employment permit		
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_tep\"" : "";	
							$tep_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 20px;\">";
							
								if ($j == 0) {
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
								
								$tep_fieldset .= "
								<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">
									<fieldset class=\"form-group col-md-12\">
										<label for=\"tep_fullname\">Fullname</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"tep_fullname[]\" id=\"tep_fullname\" 
										value=\"$data->fullname\"$field_disabled>
										<input type=\"hidden\" name=\"tep_id[]\" id=\"tep_id\" value=\"$data->tep_id\">										
									</fieldset>
					
									<fieldset class=\"form-group col-md-6\">
										<label for=\"tep_nationality\">Nationality</label>												
										<select class=\"form-control select2\"	name=\"tep_nationality[]\" style=\"width: 100%;\"$field_disabled>";										
											if (empty($nationalities)) $nationalities = country::all();
											foreach ($nationalities as $n) :
												$selected = ($data->nationality === $n->country_name) ? " selected" : "";
												$tep_fieldset .= "<option value=\"$n->country_name\"$selected>$n->country_name</option>";
											endforeach;											
											$tep_fieldset .= " 
										</select>
									</fieldset>
																		
									<fieldset class=\"form-group col-md-5\">
										<label for=\"tep_passport_number\">Passport Number</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"tep_passport_number[]\" id=\"tep_passport_number\" 
										value=\"$data->passport_number\"$field_disabled>									
									</fieldset>									
									
									<fieldset class=\"form-group col-md-1\">
										<button type=\"button\" name=\"$btn_prefix" . "_more_tep\" id=\"$btn_prefix" . "_more_tep\" 
										class=\"btn btn-box-tool $btn_prefix" . "_more_tep\"$field_disabled><i class=\"fa fa-$btn_icon\"></i></button>
									</fieldset>
								</div>										
							</div>";
							$j++;
							break;
							
						case "source funding" :
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_source_funding\"" : "";	
							$source_funding_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 20px;\">";
							
								if ($j == 0) {
									$label = "<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
												<label class=\"required\" for=\"source_funding\">Sources of Funding</label>											
											</fieldset>";
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$label = "";
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
								
								$source_funding_fieldset .= "
								$label
								<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">											
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"source_funding_donor_id\">Funder/Donor Name</label>
										<select class=\"form-control select2\" id=\"source_funding_donor_id\" name=\"source_funding_donor_id[]\" style=\"width: 100%;\" required
										$field_disabled>
											<option value=\"\">" . OPTION_SELECT . "</option>";
											if (empty($donors)) $donors = donor::all();
											foreach ($donors as $d):
												$selected = ($data->donor_id === $d->donor_id) ? "selected" : "";
												$source_funding_fieldset .= "<option value=\"$d->donor_id\" $selected>$d->donor</option>";
											endforeach;
											$source_funding_fieldset .= "
										</select>
									</fieldset>
																			
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"source_funding_contact_details\">Details of Contact Person</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"200\" name=\"source_funding_contact_details[]\" 
										id=\"source_funding_contact_details\" value=\"$data->contact_details\"$field_disabled required>
										<input type=\"hidden\" name=\"source_funding_id[]\" id=\"source_funding_id\" value=\"$data->source_funding_id\">									
									</fieldset>
									
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"source_funding_curency\">Funding Currency</label>																			
										<select class=\"form-control select2\" id=\"source_funding_currency\" name=\"source_funding_currency[]\" 
										style=\"width: 100%;\"$field_disabled required>";
											if (empty($currencies)) $currencies = currency::all();
											foreach ($currencies as $c):
												$selected = ($data->funding_currency === $c->currency) ? "selected" : "";
												$source_funding_fieldset .= "<option value=\"$c->currency\" $selected>$c->currency - $c->description</option>";
											endforeach;
											$source_funding_fieldset .= "
										</select>
									</fieldset>
											
									<fieldset class=\"form-group col-md-5\">
										<label class=\"required\" for=\"source_funding_amount\">Amount During the Year</label>
										<input type=\"text\" class=\"form-control format-money\" maxlength=\"20\" name=\"source_funding_amount[]\" id=\"source_funding_amount\" 
										value=\"" . number_format($data->funding_amount, 2) . "\"$field_disabled required>											
									</fieldset>
										
									<fieldset class=\"form-group col-md-1\">
										<button type=\"button\" name=\"$btn_prefix" . "_more_source_funding\" id=\"$btn_prefix" . "_more_source_funding\" 
										class=\"btn btn-box-tool $btn_prefix" . "_more_source_funding\"$field_disabled>
										<i class=\"fa fa-$btn_icon\"></i></button>
									</fieldset>
								</div>
							</div>";
							$j++;
							break;
			
						case "auditor" :
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_auditor\"" : "";	
							$auditor_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 20px;\">";
							
								if ($j == 0) {
									$label = "<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
												<label class=\"required\" for=\"auditor\">Auditor's Details</label>											
											</fieldset>";
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$label = "";
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
								
								$auditor_fieldset .= "
								$label						
								<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eeddff;\">											
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"auditor_name\">Name</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"auditor_name[]\" id=\"auditor_name\" value=\"$data->name\"
										$field_disabled required>
										<input type=\"hidden\" name=\"auditor_id[]\" id=\"auditor_id\" value=\"$data->auditor_id\">									
									</fieldset>
												
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"auditor_address\">Address</label>
										<textarea class=\"form-control\" maxlength=\"180\" name=\"auditor_address[]\" id=\"auditor_address\" rows=\"1\"$field_disabled 
										required>$data->address</textarea>
									</fieldset>
									
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"auditor_telephone\">Telephone</label>
										<input type=\"text\"class=\"form-control\"maxlength=\"50\" name=\"auditor_telephone[]\"id=\"auditor_telephone\"
										value=\"$data->telephone\"$field_disabled required>
									</fieldset>
																								
									<fieldset class=\"form-group col-md-5\">
										<label for=\"auditor_email\">Email</label>
										<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"auditor_email[]\" id=\"auditor_email\" 
										value=\"$data->email\"$field_disabled>
									</fieldset>
										
									<fieldset class=\"form-group col-md-1\">
										<button type=\"button\" name=\"$btn_prefix" . "_more_auditor\" id=\"$btn_prefix" . "_more_auditor\" 
										class=\"btn btn-box-tool $btn_prefix" . "_more_auditor\"$field_disabled>
										<i class=\"fa fa-$btn_icon\"></i></button>
									</fieldset>										
								</div>										
							</div>";
							$j++;
							break;
														
						case "bank" :
							$div_id = ($j == (count($data_details) - 1)) ? " id=\"add_bank\"" : "";	
							$bank_fieldset .= "
							<div$div_id class=\"form-group col-md-12\" style=\"margin-bottom: 20px;\">";
							
								if ($j == 0) {
									$label = "<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
												<label class=\"required\" for=\"bank\">Bank Details</label>											
											</fieldset>";
									$btn_prefix = "add";
									$btn_icon = "plus";
								} else {
									$label = "";
									$btn_prefix = "remove";
									$btn_icon = "minus";
								}
								
								$bank_fieldset .= "
								$label		
								<div class=\"col-md-12\" style=\"padding: 10px 0 0 0; background-color: #eee;\">											
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"bank_id\">Name</label>
										<select class=\"form-control select2\" id=\"bank_id\" name=\"bank_id[]\" style=\"width: 100%;\"$field_disabled required>
											<option value=\"\">" . OPTION_SELECT . "</option>";
											if (empty($banks)) $banks = bank::all();
											foreach ($banks as $b):
												$selected = ($data->bank_id === $b->bank_id) ? "selected" : "";
												$bank_fieldset .= "<option value=\"$b->bank_id\" $selected>$b->bank_name</option>";
											endforeach;
											$bank_fieldset .= "
										</select>
									</fieldset>
												
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"bank_address\">Address</label>
										<textarea class=\"form-control\" maxlength=\"180\" name=\"bank_address[]\" id=\"bank_address\" rows=\"1\"$field_disabled 
										required>$data->address</textarea>
										<input type=\"hidden\" name=\"organization_bank_id[]\" id=\"organization_bank_id\" value=\"$data->organization_bank_id\">
									</fieldset>
									
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"bank_telephone\">Telephone</label>
										<input type=\"text\"class=\"form-control\"maxlength=\"50\" name=\"bank_telephone[]\"id=\"bank_telephone\"
										value=\"$data->telephone\"$field_disabled required>
									</fieldset>
																								
									<fieldset class=\"form-group col-md-5\">
										<label for=\"bank_email\">Email</label>
										<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"bank_email[]\" id=\"bank_email\" 
										value=\"$data->email\"$field_disabled>
									</fieldset>
							
									<fieldset class=\"form-group col-md-1\">
										<button type=\"button\" name=\"$btn_prefix" . "_more_bank\" id=\"$btn_prefix" . "_more_bank\" 
										class=\"btn btn-box-tool $btn_prefix" . "_more_bank\"$field_disabled>
										<i class=\"fa fa-$btn_icon\"></i></button>
									</fieldset>																		
								</div>										
							</div>";				
							$j++;
							break;
						
						case "document" :
							// flag document fields as not required
							$document_required = "";
							
							// get document type
							$document_extension = explode(".", $data->filename); $document_extension = strtolower(end($document_extension));
							$document_type = $document_extension;
							$icon_color = "ee0000";						
							if (in_array($document_extension, array("doc", "docx"))) {
								$document_type = "word";
								$icon_color = "0000ff";
							} elseif (in_array($document_extension, array("xls", "xlsx"))) {
								$document_type = "excel";
								$icon_color = "008800";
							}
							
							// define download document link
							$link = "download.php?document_id=$data->document_id&licensing_organization_id=$licensing_organization_id&l=$level";	
							$icon_download = "
							<a href=\"#\" title=\"Download\" onclick=\"window.location.href='$link'\">
								<i class=\"fa fa-file-$document_type-o fa-lg\" style=\"color:#$icon_color;margin-top:7px;\"></i> Download ".strtolower($data->document_category)."
							</a>";
							
							// print document download link
							if ($data->document_category === DOCUMENT_CATEGORY_PAYMENT_PROOF_LICENSE)						
								$download_license_payment_proof = "<input type=\"hidden\" name=\"license_payment_proof_id\"value=\"$data->document_id\">$icon_download";
							elseif ($data->document_category === DOCUMENT_CATEGORY_TECHNICAL_REPORT)
								$download_annual_technical_report = "<input type=\"hidden\" name=\"annual_technical_report_id\" value=\"$data->document_id\">$icon_download";
							elseif ($data->document_category === DOCUMENT_CATEGORY_FINANCIAL_STATEMENT)
							    $download_financial_statement = "<input type=\"hidden\" name=\"financial_statement_id\" value=\"$data->document_id\">$icon_download";
							elseif (common::startsWith($data->document_category, DOCUMENT_CATEGORY_ADDITIONAL_DOCUMENT)) {
								$div_id = ($j == (count((array)$data) - 1)) ? " id=\"add_documents\"" : "";	
								$additional_documents_fieldset .= "
								<div$div_id class=\"form-group col-md-12\" style=\"padding: 0; margin-bottom: 0;\">";								
									if ($j == 0) {
										$label = "<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
													<label for=\"additional_documents\">Additional Documents</label>
												</fieldset>";
										$btn_prefix = "add";
										$btn_icon = "plus";
									} else {
										$label = "";
										$btn_prefix = "remove";
										$btn_icon = "minus";
									}
									
									$additional_documents_fieldset .= "
									$label
									<div class=\"col-md-12\" style=\"padding-top: 15px; background-color: #eee;\">
										<fieldset class=\"form-group col-md-11\" style=\"padding-left: 0;\">";									
											if ($can_upload_document)
												$additional_documents_fieldset .= "<input type=\"file\" name=\"additional_documents[]\" id=\"additional_documents\">";
											$additional_documents_fieldset .= "
											<input type=\"hidden\" name=\"additional_documents_id[]\" value=\"$data->document_id\">$icon_download
										</fieldset>
										
										<fieldset class=\"form-group col-md-1\">
											<button type=\"button\" name=\"$btn_prefix" . "_more_documents\" id=\"$btn_prefix" . "_more_documents\" 
											class=\"btn btn-box-tool $btn_prefix" . "_more_documents\"$field_disabled>
											<i class=\"fa fa-$btn_icon\"></i></button>
										</fieldset>	
									</div>
								</div>";
								$j++;
							}
							break;
				
						default:
							break;					
					endswitch;
				endforeach;								
			endforeach;	
		}
		$sector_option = "";
		if (empty($sectors)) $sectors = sector::all();
		foreach ($sectors as $s) :
			$selected = (in_array($s->sector, $selected_sectors)) ? " selected" : "";
			$sector_option .= "<option value=\"$s->sector\"$selected>$s->sector</option>";
		endforeach;		
		$sector_fieldset = str_replace(COMMON_PLACEHOLDER, $sector_option, $sector_fieldset);

		$target_group_option = "";
		if (empty($target_groups)) $target_groups = target_group::all();
		foreach ($target_groups as $t) :
			$selected = (in_array($t->target_group, $selected_target_groups)) ? " selected" : "";
			$target_group_option .= "<option value=\"$t->target_group\"$selected>$t->target_group</option>";
		endforeach;		
		$target_group_fieldset = str_replace(COMMON_PLACEHOLDER, $target_group_option, $target_group_fieldset);
		
		
		// set back the fieldsets to the temporary fieldsets if they are empty at this stage
		if (strlen($objectives_fieldset) == 0 && $level == $draft) $objectives_fieldset = $objectives_fieldset_temp;
		if (strlen($staff_capacity_fieldset) == 0 && $level == $draft) $staff_capacity_fieldset = $staff_capacity_fieldset_temp;
		if (strlen($location_activity_fieldset) == 0 && $level == $draft) $location_activity_fieldset = $location_activity_fieldset_temp;
		if (strlen($directors_trustees_fieldset) == 0 && $level == $draft) $directors_trustees_fieldset = $directors_trustees_fieldset_temp;
		if (strlen($source_funding_fieldset) == 0 && $level == $draft) $source_funding_fieldset = $source_funding_fieldset_temp;
		if (strlen($auditor_fieldset) == 0 && $level == $draft) $auditor_fieldset = $auditor_fieldset_temp;
		if (strlen($bank_fieldset) == 0 && $level == $draft) $bank_fieldset = $bank_fieldset_temp;
		if (strlen($tep_fieldset) == 0) $tep_fieldset = $tep_fieldset_temp;
		if (strlen($additional_documents_fieldset) == 0 && $level == $draft) $additional_documents_fieldset = $additional_documents_fieldset_temp;
		
        $modal_title = ucwords("$action Annual Return");
		$tag = "h4";
		$btn_label_save = "Submit";
		$btn_label_reset = "&nbsp;&nbsp;Reset&nbsp;&nbsp;";
		$btn_reset = "<input type=\"reset\" name=\"reset\" class=\"btn btn-default btn-round\" value=\"$btn_label_reset\">";
		$btn_label_draft = "&nbsp;&nbsp;&nbsp;Draft&nbsp;&nbsp;&nbsp;";		
		$btn_draft = "<input type=\"submit\" name=\"draft\" class=\"btn btn-default btn-round btn-draft\" id=\"$licensing_organization_id" . "_$action" . "_btn-draft\" ";
		$btn_draft .= "value=\"$btn_label_draft\">";

		$btn_label_cancel = "&nbsp;Cancel&nbsp;";
		
		if ($record_control == $approved) {
			// $btn_label_save = "&nbsp;Save&nbsp;";
			$btn_draft  = "";
		}
				
		$btn_save = "<button type=\"submit\" class=\"btn btn-default btn-round dark-blue btn-submit\" id=\"btn-submit\">$btn_label_save</button>";
		
        if ($action === "delete") {
			$tag = "div";
            $modal_title = "Are you sure you want to delete $reporting_year annual return for '$organization_name'?";

            $modal_bottom = "<input type=\"hidden\" name=\"licensing_organization_id\" value=\"$licensing_organization_id\">
							<input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
							<input type=\"hidden\" name=\"organization_name\" value=\"$organization_name\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">
							<input type=\"hidden\" name=\"reporting_year\" value=\"$reporting_year\">
							<input type=\"hidden\" name=\"l\" value=\"$level\">";

			$btn_save = "<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">Yes</button>";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
			$btn_reset = "";
			$btn_draft = "";
        } elseif (in_array($action, array("info", "details"))) {
			$modal_title = ucwords("Annual Return Details");
			$btn_save = "";
			$btn_reset = "";
			$btn_draft = "";
		} elseif (in_array($action, array("approve", "reject")) && ($level == $awaiting_approval_level1 || $level == $awaiting_approval_level2)) {
			// hide/rename some buttons if user wishes to approve/reject an NGO 
			$btn_save = "<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">" . ucwords($action) . "</button>";			
			$btn_reset = "";
			$btn_draft = "";
			
			$modal_bottom .= "<input type=\"hidden\" name=\"record_control\" value=\"$level\">
							 <input type=\"hidden\" name=\"approved_by\" value=\"$logged_username\">";
		}

		$modal = "
		<!-- " . ucwords($action) . " Organization Modal -->
		<div class=\"modal fade\" id=\"$licensing_organization_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" id=\"frm-$licensing_organization_id" . "-$action" . "-register\" method=\"post\" enctype=\"multipart/form-data\">";

       					if ($action !== "delete") {
           					 // only generate this part of the modal for Add and Edit actions
							 
							if (in_array($action, array("info", "reject"))) {
								$district = common::getFieldValue("district", "district_name", "district_id", $district_id);
								$submitted_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $form_elements["captured_by"]);
								$submitted_date = date_format(date_create($form_elements["captured_date"]), "d M Y @ h:iA");
								
								$approved1_by = $form_elements["approved1_by"];
								if (strlen($approved1_by) > 0 && $record_control >= $awaiting_approval_level2) {
									$approved1_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $approved1_by);
									$approved1_date = date_format(date_create($form_elements["approved1_date"]), "d M Y @ h:iA");
									$approved1_by  = "$approved1_by / $approved1_date";
								} else {
									$approved1_by = "N/A";
								}							
								
								$approved2_by = $form_elements["approved2_by"];
								if (strlen($approved2_by) > 0 && $record_control >= $awaiting_payment_processing) {
									$approved2_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $approved2_by);
									$approved2_date = date_format(date_create($form_elements["approved2_date"]), "d M Y @ h:iA");
									$approved2_by  = "$approved2_by / $approved2_date";
								} else {
									$approved2_by = "N/A";
								}
								
								if ($record_control >= $approved) {
									$payment_processed_by = $form_elements["payment_processed_by"];
									$payment_processed_date = $form_elements["payment_processed_date"];
									
									if (strlen($payment_processed_by) > 0) {
										$payment_processed_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $payment_processed_by);
										$payment_processed_date = date_format(date_create($payment_processed_date), "d M Y @ h:iA");
										$payment_processed_by  = "$payment_processed_by / $payment_processed_date";
									}
								} else {
									$payment_processed_by = "N/A";
								}	
								
								$rejected_by = $form_elements["rejected_by"];
								if (strlen($rejected_by) > 0) {
									$rejected_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $rejected_by);
									$rejected_date = date_format(date_create($form_elements["rejected_date"]), "d M Y @ h:iA");
									$rejected_by  = "$rejected_by / $rejected_date";
									$rejected_comments = $form_elements["rejected_comments"];
								} else {
									$rejected_by = "N/A";
									$rejected_comments = "N/A";
								}															
								
								$status = $form_elements["status"];
								$approval_status = $APPROVAL_STATUS[$record_control];
								$class = "";
								if ($status === STATUS_REJECTED) {
									$class = " bg-red";
									$approval_status = ucwords($status);
								}
								

								$organization_details = common::getFieldValue("organization", "CONCAT('<br /><b>Reg No: ', registration_number, ' | Reg Year: ', registration_year,
																			 '</b>')", "organization_id", $organization_id);
								$abbreviation_str = (strlen($abbreviation) > 0) ? " ($abbreviation)" : "";
								$modal .= "						
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"organization_name\">NGO Name</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$organization_name$abbreviation_str$organization_details</fieldset>							
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
									<fieldset class=\"form-group col-md-4\">
										<label for=\"registration_type\">Registration Type</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$registration_type</fieldset>								
								</div>								
				
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">																	
									<fieldset class=\"form-group col-md-4\">
										<label for=\"charity_number\">Charities Number</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$charity_number</fieldset>								
								</div>									
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"telephone\">Telephone Number(s)</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\" style=\"margin: 0;\">$telephone</fieldset>								
								</div>
								
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">								
									<fieldset class=\"form-group col-md-4\">
										<label for=\"email\">Offical Email Address</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$email</fieldset>
								</div>
									
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"postal_address\">Postal Address</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$postal_address, $district</fieldset>
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
										<label for=\"reporting_year\">Licensing Year</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$reporting_year</fieldset>								
								</div>
															
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"submitted_by\">Submitted By</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$submitted_by / $submitted_date</fieldset>
								</div>";
								
								//if ($record_control >= $awaiting_approval_level2) {
								$modal .= "						
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"approved1_by\">First Approver</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$approved1_by</fieldset>
								</div>";
								//} 
								
								//if ($record_control >= $awaiting_payment_processing) {
								$modal .= "						
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"approved2_by\">Second Approver</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$approved2_by</fieldset>
								</div>";
								//}
								
								//if ($record_control >= $approved) {
								$modal .= "						
								<div class=\"form-group col-md-12\" style=\"margin: 0;\">
									<fieldset class=\"form-group col-md-4\">
										<label for=\"payment_processed_by\">License Payment By</label>
									</fieldset>
									<fieldset class=\"form-group col-md-8\">$payment_processed_by</fieldset>
								</div>";
								//}
								
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
							} elseif (in_array($action, array("submit", "edit", "approve", "details"))) {
								$modal .= "
								<!-- Tabs -->
								<ul class=\"nav nav-tabs\">
									<li class=\"nav-item active\">
										<a class=\"nav-link\" data-toggle=\"tab\" href=\"#$licensing_organization_id" . $action . "_organizational_details\">Details</a>
									</li>
									
									<li class=\"nav-item\">
										<a class=\"nav-link\" data-toggle=\"tab\" href=\"#$licensing_organization_id". $action . "_coverage\">Coverage</a>
									</li>
									
									<li class=\"nav-item\">
										<a class=\"nav-link\" data-toggle=\"tab\" href=\"#$licensing_organization_id". $action . "_governance\">Governance</a>
									</li>
									<li class=\"nav-item\">
										<a class=\"nav-link\" data-toggle=\"tab\" href=\"#$licensing_organization_id". $action . "_accounting\">Accounting</a>
									</li>
									<li class=\"nav-item\">
										<a class=\"nav-link\" data-toggle=\"tab\" href=\"#$licensing_organization_id". $action . "_tep\">TEP</a>
									</li>
									<li class=\"nav-item\">									
										<a class=\"nav-link\" data-toggle=\"tab\" href=\"#$licensing_organization_id". $action ."_documents\">Documents</a>
									</li>
								</ul>
		
								<fieldset class=\"form-group col-md-12\">
								</fieldset>
		
								<!-- Tab panes -->
								<div class=\"tab-content\">								
									<!-- Organizational Details tab -->
									<div class=\"tab-pane active\" id=\"$licensing_organization_id". $action ."_organizational_details\">									
										<fieldset class=\"form-group col-md-12\">
											<label class=\"required\" for=\"organization_name\">Name</label>
											<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"organization_name\" id=\"organization_name\"
											value=\"$organization_name\" $field_disabled required>
										</fieldset>
										
										<fieldset class=\"form-group col-md-6\">
											<label for=\"abbreviation\">Abbreviation</label>
											<input type=\"text\" class=\"form-control\" maxlength=\"10\" name=\"abbreviation\" id=\"abbreviation\" 
											value=\"$abbreviation\"$field_disabled>
										</fieldset>							
										
										<fieldset class=\"form-group col-md-6\">
											<label for=\"charity_number\">Charities Number</label> <i>for international</i>
											<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"charity_number\" id=\"charity_number\" 
											value=\"$charity_number\"$field_disabled>
										</fieldset>
						
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"telephone\">Telephone Number(s)</label>
											<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"telephone\" id=\"telephone\" value=\"$telephone\"$field_disabled2
											required>
										</fieldset>					
										
										<fieldset class=\"form-group col-md-6\">
											<label for=\"email\">Offical Email Address</label>
											<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"email\" id=\"email\" value=\"$email\"$field_disabled2>
										</fieldset>
	
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"registration_type\">Registration Type</label>								
											<select id=\"registration_type\" class=\"form-control\" name=\"registration_type\"$field_disabled required>
												<option value=\"\">" . OPTION_SELECT . "</option>";								
												if (empty($registration_types)) $registration_types = organization::getRegistrationTypes();
												foreach ($registration_types as $rt) :
													$selected = ($registration_type === $rt->registration_type) ? " selected" : "";
													$modal .= "<option value=\"$rt->registration_type\"$selected>$rt->registration_type</option>";
												endforeach;
												
												$modal .= " 
											</select>
										</fieldset>										
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"organization_type\">Organization Type</label>								
											<select id=\"organization_type\" class=\"form-control\" name=\"organization_type\"$field_disabled required>
												<option value=\"\">" . OPTION_SELECT . "</option>";								
												if (empty($organization_types)) $organization_types = organization::getOrganizationTypes();
												foreach ($organization_types as $ot) :
													$selected = ($organization_type === $ot->organization_type_code) ? " selected" : "";
													$modal.="<option value=\"$ot->organization_type_code\"$selected>$ot->organization_type_code - $ot->organization_type</option>";
												endforeach;
												
												$modal .= " 
											</select>
										</fieldset>
								
										<fieldset class=\"form-group col-md-12\">
											<label class=\"required\" for=\"postal_address\">Postal Address</label>
											<textarea class=\"form-control\" maxlength=\"180\" name=\"postal_address\" id=\"postal_address\" rows=\"2\" $field_disabled2
											required>$postal_address</textarea>
										</fieldset>
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"district_id\">District</label>
											<select class=\"form-control select2\" name=\"district_id\" style=\"width: 100%;\"$field_disabled required>
												<option value=\"\">" . OPTION_SELECT. "</option>";
												if (empty($districts)) $districts = district::all();
												foreach ($districts as $d):
													$selected = ($district_id === $d->district_id) ? "selected" : "";
													$modal .= "<option value=\"$d->district_id\" $selected>$d->district_name</option>";
												endforeach;
												$modal .= "
											</select>
										</fieldset>
								
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"physical_address\">Physical Address</label>
											<input type=\"text\" class=\"form-control\" maxlength=\"200\" name=\"physical_address\" id=\"physical_address\"
											value=\"$physical_address\"	$field_disabled required>
										</fieldset>
										
										$objectives_fieldset 
										
										$staff_capacity_fieldset
									</div>
													
									<!-- Coverage tab -->
									<div class=\"tab-pane fade\" id=\"$licensing_organization_id". $action ."_coverage\">								
										$sector_fieldset
										
										$location_activity_fieldset
										
										$target_group_fieldset
									</div>
									
									<!-- Governance tab -->
									<div class=\"tab-pane fade\" id=\"$licensing_organization_id". $action ."_governance\">									
										<fieldset class=\"form-group col-md-12\" style=\"margin-bottom: 0;\">
											<label class=\"required\" for=\"executive_director\">Executive Director/Country Director/Country Representative</label> 
										</fieldset>
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"executive_director_fullname\">Fullname</label>
											<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"executive_director_fullname\" id=\"executive_director_fullname\" 
											value=\"$executive_director_fullname\"$field_disabled2 required>											
										</fieldset>
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"executive_director_highest_qualification\">Highest Qualification</label>											
											<select id=\"executive_director_highest_qualification\" class=\"form-control\" name=\"executive_director_highest_qualification\" 
											$field_disabled2 required>
												<option value=\"\">" . OPTION_SELECT . "</option>";
												if (empty($qualifications)) $qualifications = qualification::all();
												foreach ($qualifications as $q) :
													$selected = ($executive_director_highest_qualification === $q->qualification) ? " selected" : "";
													$modal .= "<option value=\"$q->qualification\"$selected>$q->qualification</option>";
												endforeach;
												
												$modal .= " 
											</select>
										</fieldset>										
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"executive_director_email\">Email</label>
											<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"executive_director_email\" id=\"executive_director_email\" 
											value=\"$executive_director_email\"$field_disabled2 required>											
										</fieldset>
	
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"executive_director_telephone\">Phone</label>
											<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"executive_director_telephone\" id=\"executive_director_telephone\" 
											value=\"$executive_director_telephone\"$field_disabled2 required>											
										</fieldset>
										
											<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"executive_director_nationality\">Nationality</label>										
											<select id=\"$licensing_organization_id" . "_$action" . "_executive_director_nationality\" class=\"form-control select2 nationality\"
											name=\"executive_director_nationality\" style=\"width: 100%;\"$field_disabled2 required>";								
												if (empty($nationalities)) $nationalities = country::all();
												foreach ($nationalities as $n) :
													$selected = ($executive_director_nationality === $n->country_name) ? " selected" : "";
													$modal .= "<option value=\"$n->country_name\"$selected>$n->country_name</option>";
												endforeach;
												
												$modal .= " 
											</select>
										</fieldset>
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"executive_director_national_id\">National ID</label>
											<input type=\"text\" class=\"form-control\" maxlength=\"20\" name=\"executive_director_national_id\"
											 value=\"$executive_director_national_id\" id=\"$licensing_organization_id" . "_$action" . 
											 "_executive_director_national_id\"$field_disabled2 required $executive_director_national_id_disabled>									
										</fieldset>
																		
										$directors_trustees_fieldset
									</div>
									
									<!-- Accounting tab -->
									<div class=\"tab-pane fade\" id=\"$licensing_organization_id". $action ."_accounting\">	
										<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">					
											<label for=\"financial_year\" class=\"form-control required\" style=\"border: 0;\">Financial Year Dates</label>
										</fieldset>
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"financial_year_start_month\">Start Month</label>												
											<select class=\"form-control select2 financial_year_start_month\" id=\"financial_year_start_month\" name=\"financial_year_start_month\"
											style=\"width: 100%;\"$field_disabled2 required>
												<option value=\"\">" . OPTION_SELECT . "</option>";
												if (empty($months)) $months = common::getPeriods($sort_order = "ASC", $format = "monthly");										
												foreach ($months as $k => $v):
													$selected = ($financial_year_start_month == $k) ? " selected" : "";
													$modal .= "<option value=\"$k\"$selected>$v</option>";
												endforeach;
												$modal .= " 
											</select>
										</fieldset>
										
										<fieldset class=\"form-group col-md-6\">
											<label class=\"required\" for=\"financial_year_end_month\">End Month</label>
											<input type=\"text\" class=\"form-control\" name=\"financial_year_end_month\" id=\"financial_year_end_month\" 
											value=\"$financial_year_end_month\" disabled>
											<input type=\"hidden\" class=\"form-control\" name=\"financial_year_end_m\" id=\"financial_year_end_m\"
											value=\"$financial_year_end_m\">										
										</fieldset>
										
										<fieldset class=\"form-group col-md-12\">
											<label class=\"required\" for=\"annual_income\">Annual Income ($currency)</label>
											<input type=\"text\" class=\"form-control annual_income format-money\" maxlength=\"20\" name=\"annual_income\" 
											id=\"$licensing_organization_id" . "_annual_income\" value=\"$annual_income\" $field_disabled2 required>
											<input type=\"hidden\" name=\"currency\" id=\"$licensing_organization_id" . "_currency\" value=\"$currency\">
										</fieldset>
										
										$source_funding_fieldset
										
										$auditor_fieldset
										
										$bank_fieldset
										
										<fieldset class=\"form-group col-md-12\">
										</fieldset>
									</div> 
										
									<!-- TEP tab -->";
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

									$modal .= "
									<div class=\"tab-pane fade\" id=\"$licensing_organization_id". $action ."_tep\">
										<div class=\"form-group col-md-12\">
											<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">
												<label class=\"required\" for=\"tep\">TEP Processing Certificate Request</label>
												<i class=\"text-red\">$tep_fee</i>
											</fieldset>
										</div>
										$tep_fieldset
										
										<fieldset class=\"form-group col-md-12\">
										</fieldset>
									</div> 
									
									<!-- Documents tab -->
									<div class=\"tab-pane fade\" id=\"$licensing_organization_id" . $action . "_documents\">
										<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">					
											<label class=\"$document_required\" for=\"registration_payment\">License Fee</label>
										</fieldset>";										
										
										$license_renewal_fee = fee::getFees(INVOICE_TIME_YEARLY, $annual_income);
										$download_invoice = "";
										
										if ($record_control == $draft || $level == $draft) {
											// define download invoice link
											//$fee_category = common::getFieldValue("fee", "fee_category", "invoice_time", INVOICE_TIME_YEARLY);											
											$fee_category = implode(", ", array_unique(array_column(fee::all(INVOICE_TIME_YEARLY), "fee_category")));
											
											$invoice_link = "download.php?organization_id=$organization_id&invoice_number=$fee_category&currency=$currency";
											$invoice_link .= "&amount=$license_renewal_fee";	
											$download_invoice = "
											<a href=\"#\" title=\"Download Proforma Invoice\"onclick=\"window.location.href='$invoice_link'\">
												<i class=\"fa fa-file-pdf-o fa-lg\" style=\"color:#ee0000; margin-left: 5px;\"></i>
											</a>";
										}
												
										$modal .= "
										<div class=\"col-md-12\" style=\"margin-bottom: 20px; padding: 10px 0 0 0; background-color: #eee;\">																	
											<fieldset class=\"form-group col-md-12\">
												<label class=\"required\" for=\"license_payment_proof\">Proof of Payment of License Fee</label>
												<input type=\"hidden\" id=\"$licensing_organization_id" . "_organization_id\" value=\"$organization_id\">
												<input type=\"hidden\" id=\"$licensing_organization_id" . "_fee_category\" value=\"$fee_category\">
												<i class=\"text-red\" id=\"$licensing_organization_id" . "_license_renewal_fee_info\">
													$currency " . payment::formatLargeNumber($license_renewal_fee) . $download_invoice . "
												</i>";
												if ($can_upload_document)
													$modal .= "<input type=\"file\" name=\"license_payment_proof\" id=\"license_payment_proof\" $document_required>";
												else 
													$modal .= "<br />";
												$modal .= "
												$download_license_payment_proof
											</fieldset>
										</div>
										
										<fieldset class=\"form-group col-md-12\" style=\"padding-left: 0; margin-bottom: 0;\">					
											<label class=\"$document_required\" for=\"supporting_documents\">Supporting Documents</label>
										</fieldset>
	
										<div class=\"col-md-12\" style=\"margin-bottom: 20px; padding: 10px 0 0 0; background-color: #eeddff;\">																	
											<fieldset class=\"form-group col-md-12\">
												<label class=\"$document_required\" for=\"annual_technical_report\">Annual Technical Reports</label>";										
												if ($can_upload_document)
													$modal .= "<input type=\"file\" name=\"annual_technical_report\" id=\"annual_technical_report\" $document_required>";
												else 
													$modal .= "<br />";
												$modal .= "
												$download_annual_technical_report
											</fieldset>
											
											<fieldset class=\"form-group col-md-12\">
												<label class=\"$document_required\" for=\"financial_statement\">Audited Financial Statements</label>";											
												if ($can_upload_document)
													$modal .= "<input type=\"file\" name=\"financial_statement\" id=\"financial_statement\" $document_required>";
												else 
													$modal .= "<br />";
												$modal .= "
												$download_financial_statement
											</fieldset>											
										</div>										
									
										$additional_documents_fieldset
										
										<fieldset class=\"form-group col-md-12\">
										</fieldset>
									</div>
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
		<!-- /." . ucwords($action) . " Organization Modal -->";

        return $modal;
    }
}
