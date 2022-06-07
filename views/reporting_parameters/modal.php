<?php
/**
 * A class for managing modals
 */

class modal
{
    /**
     * display details
     *
	 * @param string logged_username
	 * @param string access_right
	 *
     * @return string modal
     */

    public static function displayDetails($logged_username, $access_right) {
		global $INDICATOR_STATUS;
		global $INDICATOR_APPROVAL_LEVELS;
		
		// get reporting details
		$reporting_id = "";
		$report_acceptance_status = "";
		$report_approval_levels = "";
		$reporting_deadline = "";
		
		$reporting_details = reporting::all();				
		foreach ($reporting_details as $r) :
			$reporting_id = $r->reporting_id;
			$report_acceptance_status = $r->report_acceptance_status;
			$report_approval_levels = $r->report_approval_levels;
			$reporting_deadline = $r->reporting_deadline;
		endforeach;

        $modal = "		
			<form action=\"action.php\" method=\"post\">
			
			<fieldset class=\"form-group\" style=\"margin: 0;\">
				<div class=\"col-md-4\">
					<label for=\"report_acceptance_status\" class=\"form-control required\" style=\"border: 0;\">Accept Reports as Submitted When In</label>
				</div>
				<div class=\"col-md-8\">
					<select class=\"form-control\" name=\"report_acceptance_status\" style=\"width: 200px; display: inline-block; margin-right: 10px;\" required>";
					$record_controls = array_keys($INDICATOR_STATUS);
					foreach ($record_controls as $r) :
						$selected = ($report_acceptance_status == $r) ? " selected" : "";
						$indicator_status = $INDICATOR_STATUS[$r];
						$modal .= "<option value=\"$r\"$selected>" . ucwords($indicator_status) . "</option>";
					endforeach;
								
					$modal .= "
					</select> status
				</div>
			</fieldset>
			
			<fieldset class=\"form-group\" style=\"margin: 0;\">
				<div class=\"col-md-4\">
					<label for=\"report_approval_levels\" class=\"form-control required\" style=\"border: 0;\">Report Approval Levels</label>
				</div>
				<div class=\"col-md-8\">
					<select class=\"form-control\" name=\"report_approval_levels\" style=\"width: 200px; display: inline-block; margin-right: 10px;\" required>";
					$record_controls = array_keys($INDICATOR_APPROVAL_LEVELS);
					foreach ($record_controls as $r) :
						$selected = ($report_approval_levels == $r) ? " selected" : "";
						$indicator_approval_level = $INDICATOR_APPROVAL_LEVELS[$r];
						$modal .= "<option value=\"$r\"$selected>" . ucwords($indicator_approval_level) . "</option>";
					endforeach;
								
					$modal .= "
					</select>
				</div>
			</fieldset>		
			
			<fieldset class=\"form-group\" style=\"margin: 0;\">
				<div class=\"col-md-4\">
					<label for=\"reporting_deadline\" class=\"form-control required\" style=\"border: 0;\">Reporting Timeliness Deadline</label>
				</div>
				<div class=\"col-md-8\">				
					<select class=\"form-control\" name=\"reporting_deadline\" style=\"width: 70px; display: inline-block; margin-right: 10px;\" required>";
					$days = common::getDays();
					foreach ($days as $d) :
						$selected = ($reporting_deadline == $d) ? " selected" : "";
						$modal .= "<option value=\"$d\"$selected>$d</option>";
					endforeach;
								
					$modal .= "
					</select> of every month
				</div>
			</fieldset>";
			
			if ($access_right === "RW") {	
				$modal .= "								
				<input type=\"hidden\" name=\"option\" value=\"edit\">
				<input type=\"hidden\" name=\"reporting_id\" value=\"$reporting_id\">
				<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">			
				
				<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">Save</button>";
			}

		$modal .= "	
			</div>
		</form>";
			
        return $modal;
    }
}