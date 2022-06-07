<?php

/**
 * A class for managing modals
 */

class holiday_modal
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
    public static function displayTable($index, $logged_username, $access_right, $form_elements = array())
    {
        $holiday_id = $form_elements["holiday_id"];
        $organization_id = $form_elements['organization_id'];
        $category = $form_elements["category"];
        $holiday_date = $form_elements["holiday_date"];
		$holiday_date = date_format(date_create($holiday_date), "d M Y"); 
        $holiday_year = $form_elements["holiday_year"];

		$tbody = "		
		<tr>
			<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . "</td>
			<td>$category</td>
			<td>$holiday_date</td>
			<td>$holiday_year</td>";
			if ($access_right === "RW") {
				$tbody .= "
				<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">
					<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#" . $holiday_id . 	"edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
					<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#" . $holiday_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>
				</td>";
			}
		$tbody .= "
		</tr>";

		if ($access_right === "RW") {
			// display Edit District Modal
			$tbody .= holiday_modal::displayModal("edit", $organization_id, $logged_username, $form_elements);
	
			// display Delete District Modal
			$tbody .= holiday_modal::displayModal("delete", $organization_id, $logged_username, $form_elements);
		}
		return $tbody;
    }

    /**
     * display modal
     *
     * @param string action
     * @param string logged_username
     * @param array holidays
     *
     * @return string modal
     */

    public static function displayModal($action, $logged_organization_id, $logged_username, $holidays = array())
    {
        $holiday_id = "";
        $category = "";
        $disabled = "";
		$organization_id = $logged_organization_id;
        $modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">
						 <input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">";

        if (!empty($holidays)) {
            // form elements have values, this is an Edit Modal
            $holiday_id = $holidays["holiday_id"];
            $organization_id = $holidays["organization_id"];
            $category = $holidays["category"];
            $holiday_date = $holidays["holiday_date"];
			$holiday_date = date_format(date_create($holiday_date), "d M Y"); 

            $modal_bottom = "<input type=\"hidden\" name=\"holiday_id\" value=\"$holiday_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">
							<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";
        }

        $modal_title = ucwords("$action holiday");

		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";
		$type = ($action != "add") ? "text" : "date";

        if ($action === "delete") {
			$tag = "div";
          	$modal_title = "Are you sure you want to delete holiday '$category'?";

            $modal_bottom = "<input type=\"hidden\" name=\"holiday_id\" value=\"$holiday_id\">
							<input type=\"hidden\" name=\"category\" value=\"$category\">
							<input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";
											
			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
        }
		
        $modal = "
		<!-- " . ucwords($action) . " holiday Modal -->
		<div class=\"modal fade\" id=\"$holiday_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
					    <div class=\"box-body pad\"></div>
						<form action=\"action.php\" method=\"post\">";
                    if ($action !== "delete") {
                        // only generate this part of the modal for Add and Edit actions
                       $modal .= "             
						<fieldset class=\"form-group col-md-12\">
							<label class=\"required\" for=\"category\">Holiday Type</label>
							<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"category\" id=\"category\" value=\"$category\" required>
						</fieldset>
					
						<fieldset class=\"form-group col-md-12\">
							<label class=\"required\" for=\"holiday_content\">Holiday Date</label>
							<input type=\"$type\" class=\"form-control\" name=\"holiday_date\" id=\"$holiday_id-$action-date\" value=\"$holiday_date\" $disabled required>
						</fieldset>";
                    }
					
					$modal .= "<input type=\"hidden\" name=\"option\" value=\"$action\">
							$modal_bottom
							<button id=\"btn-save\" type=\"submit\" class=\"btn btn-default btn-round dark-blue clicked-button-tabs\">$btn_label_save</button>
							<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">$btn_label_cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- ./" . ucwords($action) . " holiday Modal -->";
		
		return $modal;
    }
}