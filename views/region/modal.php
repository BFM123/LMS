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
	   	$region_id = $form_elements['region_id'];
        $region_name = $form_elements['region_name'];
		
        $tbody = "		
		<tr>
			<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td>$region_name</td>";
			
			if ($access_right === "RW") {
				$tbody .= "
				<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">
					<a data-toggle=\"modal\" data-target=\"#" . $region_id ."edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
					<a data-toggle=\"modal\" data-target=\"#" . $region_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>
				</td>";
			}
		$tbody .= "
		</tr>";

		if ($access_right === "RW") {
			// display Edit Region Modal
			$tbody .= modal::displayModal("edit", $logged_username, $form_elements);
	
			// display Delete Region Modal
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
	   	$region_id = "";
        $region_name = "";

        $modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";

        if (!empty($form_elements)) {
            // form elements have values, this is an Edit Modal

			$region_id = $form_elements['region_id'];
			$region_name = $form_elements['region_name'];

            $modal_bottom = "<input type=\"hidden\" name=\"region_id\" value=\"$region_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";;
        }

        $modal_title = ucwords("$action Region");
		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";
		
        if ($action === "delete") {
			$tag = "div";
            $modal_title = "Are you sure you want to delete region '$region_name'?";

            $modal_bottom = "<input type=\"hidden\" name=\"region_id\" value=\"$region_id\"><br />
							<input type=\"hidden\" name=\"region_name\" value=\"$region_name\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";

			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
        }

		$modal = "
		<!-- " . ucwords($action) . " Region Modal -->
		<div class=\"modal fade\" id=\"$region_id" . "$action\" role=\"dialog\">
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
							<fieldset class=\"form-group col-md\">
								<label class=\"required\" for=\"region_name\">Region Name</label>
								<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"region_name\" value=\"$region_name\" required>
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
		<!-- /." . ucwords($action) . " Region Modal -->";
        return $modal;
    }
}