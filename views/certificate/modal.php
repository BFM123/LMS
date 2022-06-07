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
	   	$certificate_id = $form_elements["certificate_id"];
	   	$organization_id = $form_elements["organization_id"];
		$organization_name = $form_elements["organization_name"];
		$organization_name .= "<br /><b>Reg No: " . $form_elements["registration_number"] . " | Reg Year: " . $form_elements["registration_year"] . "</b>";
	   	$certificate_category = $form_elements["certificate_category"];
		$certificate_category_str = $certificate_category;
	   	$details_1 = $form_elements["details_1"];
		if (strlen($details_1) > 0) $certificate_category_str .= " - $details_1"; 
		$start_date = $form_elements["start_date"]; 
		$start_date = (strlen($start_date) > 0) ? date_format(date_create($start_date), "d M Y") : "";
		$end_date = $form_elements["end_date"];
		$request_year = $form_elements["request_year"];
		$end_date = (strlen($end_date) > 0) ? date_format(date_create($end_date), "d M Y") : "";
        $is_printed = $form_elements["is_printed"];
		$printed_by = $is_printed;
		
		if ($is_printed === "Yes") {
			$printed_by = common::getFieldValue("user", "CONCAT(LEFT(TRIM(firstname), 1), '. ', lastname)", "username", $form_elements["last_printed_by"]);
			$printed_date = $form_elements["last_printed_date"];
			$printed_date = (strlen($printed_date) > 0) ? date_format(date_create($printed_date), "d M Y") : "";
			$printed_by .= 	"<br />$printed_date";	
		}
		$class = ($is_printed === "Yes") ? "" : " alert-info";

        $tbody = "		
		<tr>
			<td class=\"text-right$class\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
			<td class=\"$class\">$organization_name</td>
			<td class=\"$class\">$certificate_category_str</td>
			<td class=\"$class\" nowrap=\"nowrap\">$start_date</td>
			<td class=\"$class\" nowrap=\"nowrap\">$end_date</td>
			<td class=\"$class\" nowrap=\"nowrap\" class=\"text-center\">$request_year</td>
			<td class=\"text-center$class\" nowrap=\"nowrap\">$printed_by</td>";		
			
			if ($access_right === "RW") {
				$link = "download.php?organization_id=$organization_id&certificate_id=$certificate_id&certificate_category=$certificate_category&l=$level";	
				$tbody .= "
				<td class=\"text-center$class\" style=\"width: 30px\" nowrap=\"nowrap\">
					<a href=\"#\" title=\"Download\" onclick=\"window.location.href='$link'\"><i class=\"fa fa-print fa-lg\"></i></a>
				</td>";
			}
		$tbody .= "
		</tr>";

		if ($access_right === "RW") {
			// display Print Certificate Modal
			// no Print Certificate Modal required...this will be handled in download.php
			// $tbody .= modal::displayModal("download", $logged_username, $form_elements);	
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
	   	$certificate_id = "";
        $certificate_category = "";
		$organization_id = "";
		
        $modal_bottom = "<input type=\"hidden\" name=\"printed_by\" value=\"$logged_username\">";

        if (!empty($form_elements)) {
			$certificate_id = $form_elements["certificate_id"];
			$certificate_category = $form_elements["certificate_category"];
			$organization_id = $form_elements["organization_id"];
			$organization_name = common::getFieldValue("organization", "organization_name", "organization_id", $organization_id);

            $modal_bottom = "<input type=\"hidden\" name=\"certificate_id\" value=\"$certificate_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";;
        }

        $modal_title = ucwords("$action Certificate");
		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";
		
        if ($action === "download") {
			$tag = "div";
            $modal_title = "Are you sure you want to download " . strtolower($certificate_category) . " for '$organization_name'?";

            $modal_bottom = "<input type=\"hidden\" name=\"certificate_id\" value=\"$certificate_id\"><br />
							<input type=\"hidden\" name=\"organization_id\" value=\"$organization_id\">
							<input type=\"hidden\" name=\"certificate_category\" value=\"$certificate_category\">
							<input type=\"hidden\" name=\"printed_by\" value=\"$logged_username\">";

			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
        }

		$modal = "
		<!-- " . ucwords($action) . " Certificate Modal -->
		<div class=\"modal fade\" id=\"$certificate_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"download.php\" method=\"post\">
							<input type=\"hidden\" name=\"option\" value=\"$action\">
							$modal_bottom
							<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">$btn_label_save</button>
							<a data-dismiss=\"modal\" class=\"btn btn-default btn-round\">$btn_label_cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /." . ucwords($action) . " Certificate Modal -->";
        return $modal;
    }
}