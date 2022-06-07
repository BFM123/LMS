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
	public static function displayTable($index, $logged_username, $access_right, $form_elements = array())
	{
		$report_id = $form_elements["report_id"];
		$report_name = $form_elements["report_name"];
		$description = $form_elements["description"];
		$destination = $form_elements["destination"];
		$sort_order = $form_elements["sort_order"];

		$tbody = "
		<tr>
			<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td>$report_name</td>
			<td>$description</td>";
			
			if ($access_right === "RW") $tbody .= "<td class=\"text-center\" style=\"width: 10px\">$sort_order</td>";
			
			$tbody .= "
			<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">
				<a title=\"Download\" data-toggle=\"modal\" data-target=\"#" . $report_id . "download\" href=\"#\"><i class=\"fa fa-arrow-down\"></i></a>";

			if ($access_right === "RW") {
				$tbody .= "
				<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#" . $report_id ."edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
				<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#" . $report_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>";
			}
			
		$tbody .= "
			</td>
		</tr>";
		
		// display Download Report Modal
		$tbody .= modal::displayModal("download", $logged_username, $form_elements);

		if ($access_right === "RW") {
			// display Edit Report Modal
			$tbody .= modal::displayModal("edit", $logged_username, $form_elements);

			// display Delete Delete ReportModal
			$tbody .= modal::displayModal("delete", $logged_username, $form_elements);
		}

		return $tbody;

	}

	/**
	 * display modal
	 *
	 * @param string action
	 * @param string logged_username
	 * @param array form_elements
	 *
	 * @return string modal
	 */
	public static function displayModal($action, $logged_username, $form_elements = array())
	{
		$report_id = "";
		$report_name = "";
		$description = "";
		$destination = "";
		$sort_order = "";

		$modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";

		if (!empty($form_elements)) {
			// form elements have values, this is an Edit Modal

			$report_id = $form_elements["report_id"];
			$report_name = $form_elements["report_name"];
			$description = $form_elements["description"];
			$destination = $form_elements["destination"];
			$sort_order = $form_elements["sort_order"];

			$modal_bottom = "<input type=\"hidden\" name=\"report_id\" value=\"$report_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";;
		}

		$modal_title = ucwords("$action Report");
		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";
		$disabled = "";
		if ($action === "edit") {
			$disabled = " disabled";
			$modal_bottom .= "<input type=\"hidden\" name=\"report_name\" value=\"$report_name\">";
		}
		
		if ($action === "download") {
			$modal_title = $report_name;
			$btn_label_save = "Download";
			$modal_bottom = "<input type=\"hidden\" name=\"printed_by\" value=\"$logged_username\">
							<input type=\"hidden\" name=\"report_name\" value=\"$report_name\">";
		}

		if ($action === "delete") {
			$tag = "div";
			$modal_title = "Are you sure you want to delete report '$report_name'?";

			$modal_bottom = "<input type=\"hidden\" name=\"report_id\" value=\"$report_id\"><br />
							<input type=\"hidden\" name=\"report_name\" value=\"$report_name\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";

			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
		}

		$modal = "
		<!-- " . ucwords($action) . " Report Modal -->
		<div class=\"modal fade\" id=\"$report_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"download.php\" method=\"post\">";

						if ($action !== "delete") {
							if ($action === "download") {
								 // only generate this part of the modal for Download and actions
								 $modal .= "							
								<fieldset class=\"form-group col-md-12\">
									<label for=\"custom_title\">Custom Title</label>
									<input type=\"text\" class=\"form-control\" name=\"custom_title\">													
								</fieldset>";
								 
	 							$print_datasets = false;
	 							$print_thematic_areas = false;
	 							$print_population_types = false;
	 							$print_sub_population_types = false;
	 							$print_reporting_periods = false;
								$print_partners = true;								
								$print_districts = true;								
								$print_zones = true;								
								$print_regions = true;
								$print_roles = false;
								$print_reporting_rate_format = false;														
								$column_width = 12;
								$required = "required";

	 							if ($report_name === "Datasets") {
									$print_datasets = true;
	 								$print_reporting_periods = true;
									$column_width = 6;
								} elseif ($report_name === "Indicators (Standard)") {
		 							$print_datasets = true;
									$print_thematic_areas = true;
									$print_population_types = true;
									$print_sub_population_types = true;
									$print_reporting_periods = true;
									$required = "";
									$column_width = 6;									
								} elseif ($report_name === "Indicators List") {
									$print_datasets = true;
									$print_thematic_areas = true;
									$print_population_types = true;
									$print_sub_population_types = true;									
									$print_partners = false;								
									$print_districts = false;								
									$print_zones = false;								
									$print_regions = false;								
									$required = "";
								} elseif ($report_name === "Partners") {
								} elseif ($report_name === "Districts") {
									$print_partners = false;								
								} elseif ($report_name === "Zones") {
									$print_partners = false;
									$print_districts = false;															
								} elseif ($report_name === "Regions") {
									$print_partners = false;
									$print_districts = false;															
									$print_zones = false;															
								} elseif ($report_name === "Users") {
									$print_roles = true;															
								} elseif ($report_name === "Reporting Rate") {
									$print_partners = false;								
									$print_districts = false;								
									$print_zones = false;								
									$print_regions = false;
									$print_reporting_rate_format = true;
								}
								
								if ($print_datasets) {
									// print datasets								
									$modal .= "
									<fieldset class=\"form-group col-md-12\">
										<label class=\"$required\" for=\"dataset_id\">Dataset</label>								
										<select class=\"form-control select2\" name=\"dataset_id[]\" style=\"width: 100%\" multiple=\"multiple\" $required>";
											$datasets = dataset::all();
											foreach ($datasets as $g) :
												$modal .= "<option value=\"$g->dataset_id\">$g->dataset_name</option>";
											endforeach;
										$modal .= " 
										</select>					
									</fieldset>";							
								}
								
								if ($print_thematic_areas) {
									// print thematic areas
									 $modal .= "
									 <fieldset class=\"form-group col-md-12\">
										<label for=\"thematic_area\">Thematic Area</label>															
										<select class=\"form-control select2\" name=\"thematic_area_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
	
										$thematic_areas = thematic_area::all();
	
										foreach ($thematic_areas as $t) :
											$modal .= "<option value=\"$t->thematic_area_id\">$t->thematic_area</option>";
										endforeach;
										$modal .= "
									</select>					
									</fieldset>";
								}
								
								if ($print_population_types) {
									// print population types
									$modal .= "
									<fieldset class=\"form-group col-md-12\">
										<label for=\"population_type_id\">Population Type</label>
										<select class=\"form-control select2\" name=\"population_type_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
		
											$population_types = population_type::all();
											foreach ($population_types as $p) :
												$modal .= "<option value=\"$p->population_type_id\">$p->population_type</option>";
											endforeach;
		
											$modal .= "
										</select>
									</fieldset>";
								}
									
								if ($print_sub_population_types) {
									// print sub population types
									$modal .= "
									<fieldset class=\"form-group col-md-12\">
										<label for=\"population_type_sub_id\">Sub Population Type</label>
										<select class=\"form-control select2\" name=\"population_type_sub_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
		
											$sub_population_types = population_type::getSubPopulationTypes();
											foreach ($sub_population_types as $s) :
												$modal .= "<option value=\"$s->population_type_sub_id\">$s->population_type_sub</option>";
											endforeach;
										$modal .= "
										</select>
									</fieldset>";
								}
								
								if ($print_partners) {
									// print partners								
									$modal .= "																
									<fieldset class=\"form-group col-md-12\">
										<label for=\"organization_id\">Partner</label>								
										<select class=\"form-control select2\" name=\"organization_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
											$partners = organization::all();
											foreach ($partners as $p) :
												$modal .= "<option value=\"$p->organization_id\">$p->organization_name</option>";
											endforeach;
										$modal .= " 
										</select>					
									</fieldset>";
								}				

								if ($print_districts) {
									// print districts								
									$modal .= "								
									<fieldset class=\"form-group col-md-12\">
										<label for=\"district_id\">District</label>								
										<select class=\"form-control select2\" name=\"district_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
											$districts = district::all();
											foreach ($districts as $d) :
												$modal .= "<option value=\"$d->district_id\">$d->district_name</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>";
								}
								
								if ($print_zones) {
									// print zones								
									$modal .= "
									<fieldset class=\"form-group col-md-12\">
										<label for=\"zone_id\">Zone</label>								
										<select class=\"form-control select2\" name=\"zone_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
											$zones = zone::all();
											foreach ($zones as $z) :
												$modal .= "<option value=\"$z->zone_id\">$z->zone_name</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>";
								}
									
								if ($print_regions) {
									// print regions								
									$modal .= "
									<fieldset class=\"form-group col-md-12\">
										<label for=\"region_id\">Region</label>								
										<select class=\"form-control select2\" name=\"region_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
											$regions = region::all();
											foreach ($regions as $r) :
												$modal .= "<option value=\"$r->region_id\">$r->region_name</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>";
								}
								
								if ($print_roles) {
									// print roles								
									$modal .= "
									<fieldset class=\"form-group col-md-12\">
										<label for=\"role_id\">Role</label>								
										<select class=\"form-control select2\" name=\"role_id[]\" style=\"width: 100%\" multiple=\"multiple\">";
											$roles = role::all();
											foreach ($roles as $r) :
												$modal .= "<option value=\"$r->role_id\">$r->role_name</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>";
								}								
								
								if ($print_reporting_rate_format) {
									// print reporting rate formats								
									$modal .= "
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"reporting_rate_format\">Format</label>
										<select class=\"form-control select2\" name=\"reporting_rate_format[]\" style=\"width: 100%\" multiple=\"multiple\" required>";
											$reporting_rate_formats = reporting::getFormats();
											foreach ($reporting_rate_formats as $r) :
												$modal .= "<option value=\"$r->reporting_rate_format_code\">$r->reporting_rate_format</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>";
								}								

								if ($print_reporting_periods) {
									// print reporting periods
									$modal .= "								
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"coverage\">Coverage</label>								
										<select class=\"form-control\" id=\"coverage\" name=\"coverage\" required>
											<option value=\"\"></option>";
	
											$coverages = common::getPeriods($sort_order = "ASC", "report_periods");
											foreach ($coverages as $c) :
												$modal .= "<option value=\"$c\">$c</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>	
									
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"period\">Period</label>								
										<select class=\"form-control period_coverage\" name=\"period\" required>";
											$reporting_months = common::getPeriods($sort_order = "ASC", "monthly");
											foreach ($reporting_months as $month_mum => $month_name) :
												$modal .= "<option value=\"$month_mum\">$month_name</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>		
									
									<fieldset class=\"form-group col-md-6\">
										<label class=\"required\" for=\"reporting_year\">Reporting Year</label>								
										<select class=\"form-control\" name=\"reporting_year\" required>";
											$reporting_years = common::getPeriods($sort_order = "DESC", "year");
											foreach ($reporting_years as $year) :
												$modal .= "<option value=\"$year\">$year</option>";
											 endforeach;
										$modal .= " 
										</select>					
									</fieldset>";
								}
								
								$modal .= " 
								<fieldset class=\"form-group col-md-$column_width\">
									<label class=\"required\" for=\"destination\">Destination</label>															
									<select class=\"form-control\" name=\"destination\" required>";
										
										if (strlen($destination) > 0) {
											$destination = substr($destination, 1); // remove the first | from the string
											$destination = substr_replace($destination, "", -1); // remove the last | from the string
										}
										$destinations = explode("|", $destination);
										foreach ($destinations as $d) :
											$destination = common::getFieldValue("report_destination", "destination", "destination_code", $d);
											$modal .= "<option value=\"$d\">$destination</option>";
										endforeach;
													
										$modal .= "
									</select>					
								</fieldset>";
							} else {
								 // only generate this part of the modal for Add and Edit actions
								$modal .= "
								<fieldset class=\"form-group\">
									<label class=\"required\" for=\"report\">Report Name</label>
									<input type=\"text\" class=\"form-control\" name=\"report_name\" value=\"$report_name\"$disabled required>
								</fieldset>
	
								<fieldset class=\"form-group\">
									<label for=\"description\">Description</label>
									<input type=\"text\" class=\"form-control\" name=\"description\" value=\"$description\">
								</fieldset>
								
								<fieldset class=\"form-group\">
									<label class=\"required\" for=\"destination\">Destination</label>								
									<select class=\"form-control select2\" name=\"destination[]\" style=\"width: 100%;\" multiple=\"multiple\" required>
										<option value=\"\">" . OPTION_SELECT . "</option>";
										$destinations = report::getReportDestinations();
										foreach ($destinations as $d) :
											$selected = (strpos($destination, "|$d->destination_code|") !== false) ? "selected" : "";
											$modal .= "<option value=\"$d->destination_code\"$selected>$d->destination</option>";
										endforeach;
													
										$modal .= "
									</select> 								
								</fieldset>
								
								<fieldset class=\"form-group\">	
									<label class=\"required\" for=\"sort_order\">Sort Order</label>												
									<input type=\"number\" class=\"form-control\" name=\"sort_order\" value=\"$sort_order\" style=\"width: 80px;\"
									min=\"-" . MAX_WEIGHT . "\" max=\"" . MAX_WEIGHT . "\" required>
								</fieldset>";
							}
						}
						$modal .= "
							<input type=\"hidden\" name=\"option\" value=\"$action\">
							$modal_bottom
							<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">$btn_label_save</button>
							<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">$btn_label_cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /." . ucwords($action) . " Report Modal -->";
		return $modal;
	}
}