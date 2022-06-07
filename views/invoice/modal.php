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
		$invoice_id = $form_elements["invoice_id"];
		$invoice_number = $form_elements["invoice_number"];
		$invoice_year = $form_elements["invoice_year"];
		$start_date = $form_elements["start_date"]; 
		$start_date = (strlen($start_date) > 0) ? date_format(date_create($start_date), "d M Y") : "";
		$end_date = $form_elements["end_date"];
		$end_date = (strlen($end_date) > 0) ? date_format(date_create($end_date), "d M Y") : "";
		$organization_id = $form_elements["organization_id"];
		$organization_name = $form_elements["organization_name"];
		//$organization_name .= " <b>Reg No: " . $form_elements["registration_number"] . " | Reg Year: " . $form_elements["registration_year"] . "</b>";
		$organization_name .= " <b>Reg No: " . $form_elements["registration_number"] . "</b>";
		$invoice_amount = (strlen($form_elements["amount"]) > 0) ? $form_elements["amount"] : 0;
		$invoice_number = $form_elements["invoice_number"];
		$fee_category = $form_elements["fee_category"];
		$class = ($invoice_year == date("Y")) ? " alert-info" : "";
		
		$download_invoice = "
		<a href=\"#\" title=\"Download Invoice\"onclick=\"window.location.href='download.php?organization_id=$organization_id&invoice_number=$invoice_number&currency=$currency'\">
			<i class=\"fa fa-file-pdf-o fa-lg\"style=\"color:#ee0000;\"></i>
		</a>";

		$tbody = "
		<tr>
			<td class=\"text-right$class\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td class=\"$class\">$organization_name</td>
			<td class=\"$class\">$fee_category</td>
			<td class=\"$class\" nowrap=\"nowrap\">$invoice_number</td>
			<td class=\"text-center$class\" nowrap=\"nowrap\">$invoice_year</td>
			<td class=\"$class\" nowrap=\"nowrap\">$start_date</td>
			<td class=\"$class\" nowrap=\"nowrap\">$end_date</td>
			<td class=\"text-right$class\" nowrap=\"nowrap\">" . number_format($invoice_amount, 2) . "</td>			
			<td class=\"text-center$class\" nowrap=\"nowrap\">$download_invoice</td>			
		</tr>";
		
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
		global $APPROVAL_STATUS;
		$organization_approved = array_keys($APPROVAL_STATUS)[4];
					
        $modal_bottom = "<input type=\"hidden\" id=\"option\" name=\"option\" value=\"$action\">
						<input type=\"hidden\" id=\"captured_by\" name=\"captured_by\" value=\"$logged_username\">";       

		$btn_label_save = ucwords($action);
		$modal_title = ucwords($action) . " Invoices";

		$modal = "
		<!-- " . ucwords($action) . " Invoices Modal -->
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
								<fieldset class=\"form-group col-md-12\">
									<label class=\"required\" for=\"invoice_year\">Invoice Year</label>
									<select class=\"form-control select2\" style=\"width: 100%;\" name=\"invoice_year\" id=\"invoice_year\" required>
										<option value=\"\">" . OPTION_SELECT . "</option>";
										$invoice_years = common::getPeriods($sort_order = "ASC", $format = "year", $period_depth = -4);													
										foreach ($invoice_years as $k => $v):
											$next_year = date("Y") + 1;
											$selected = "";//($next_year == $k) ? " selected" : "";
											$modal .= "<option value=\"$k\"$selected>$v</option>";
										endforeach; 
										$modal .= "			
									</select>
								</fieldset>
							</div>
							
							<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
								<fieldset class=\"form-group col-md-12\">
									<label class=\"required\" for=\"fee_category\">Fee Category</label>
										<select id=\"fee_category\" class=\"form-control select2\" style=\"width: 100%;\" name=\"fee_category[]\" multiple=\"multiple\" required>
											<option value=\"\">" . OPTION_SELECT . "</option>";										
											$fee_categories = array_unique(array_column(fee::all(), "fee_category"));
											foreach ($fee_categories as $f) :
												$modal .= "<option value=\"$f\">$f</option>"; 
											endforeach;											
										$modal .= "    
									</select>
								</fieldset>
							</div>
							
							<div class=\"form-group col-md-12\" style=\"margin: 0;\">	
								<fieldset class=\"form-group col-md-12\">
									<label for=\"organization_id\">Organization</label>
										<br /><i>If no organization is sepecified, then invoices will be generated for all registered organizations</i>
										<select id=\"organization_id\" class=\"form-control select2\" style=\"width: 100%;\"name=\"organization_id[]\" multiple=\"multiple\">
											<option value=\"\">" . OPTION_SELECT . "</option>";	
											$blank = "";					
											$organizations = organization::all($blank, $blank, $blank, $blank, $blank, $organization_approved);									
											foreach ($organizations as $o) :
												$organization_name = $o->organization_name;
												if (strlen($o->abbreviation) > 0) $organization_name .= " ($o->abbreviation)";
												if (strlen($o->registration_number) > 0) $organization_name .= " - Reg No: $o->registration_number";
												$modal .= "<option value=\"$o->organization_id\">$organization_name</option>";
											endforeach;											
											$modal .= "    
									</select>
								</fieldset>
							</div>
			
							$modal_bottom
							<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">$btn_label_save</button>
							<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">Cancel</a>							
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- ./ " . ucwords($action) . " Invoices Modal -->";

        return $modal;
    }
}
