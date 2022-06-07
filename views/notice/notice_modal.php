<?php

/**
 * A class for managing modals
 */

class notice_modal
{
    /**
     * display notices articles
     *
	 * @param array notices
     *
     * @return string modal
     */
    public static function displayNotices($notices)
    {
		$notice_id = $notices["notice_id"];
		$notice_title = $notices["notice_title"];
		$notice_content = $notices["notice_content"];
		$captured_by = $notices["captured_by"];
		$captured_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $captured_by);
		$captured_date = date_format(date_create($captured_date = $notices["captured_date"]), "d M Y @h:iA");
		
		$tbody = "	
			<div class=\"panel box box-primary\" style=\"font-weight: normal\">
				<div class=\"box-header\" style=\"margin-bottom: 0px;\">
					<h4 class=\"box-title\">
						<a data-toggle=\"collapse\" data-parent=\"#accordion\" name=\"notice-$notice_id\">$notice_title</a>
					</h4>
					<br />
					<span class=\"text\"><i>By $captured_by, </i></span>
					<span class=\"text\"><i>$captured_date</i></span>
				</div>
				<div id=\"notice_id_$notice_id\" class=\"panel-collapse collapse in\" style=\"margin-top: -15px;\">
					<div class=\"box-body\" style=\"color: #000;\">
						<article class=\"addReadMore showlesscontent\">$notice_content</article>  
					</div>
				</div>
			</div>";
			
		return $tbody;
    }

    /**
     * display table
     *
     * @param string action
	 * @param string logged_username
	 * @param string access_right
     * @param array notices
	 * @param string view
     *
     * @return string modal
     */
    public static function displayTable($index, $logged_username, $access_right = "", $notices = array(), $view = "")
    {
        $notice_id = $notices["notice_id"];
        $notice_title = $notices["notice_title"];
        $notice_content = $notices["notice_content"];
        $captured_by = $notices["captured_by"];
		$captured_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $captured_by);
		$captured_date = date_format(date_create($captured_date = $notices["captured_date"]), "d M Y @h:iA");	
		
		if ($view === "display") {
			$tbody = "
			<tr>
				<td style=\"border: none; background-color: #fff;\">
					<div class=\"panel box box-primary\" style=\"margin-bottom: 0px; margin-top: 0px;\">
						<div class=\"box-header\" style=\"margin-bottom: 0px;\">
							<h4 class=\"box-title\">
								<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#notice_id_$notice_id\">$notice_title</a>
							</h4>
							<br />
							<span class=\"text\"><i>By $captured_by, </i></span>
							<span class=\"text\"><i>$captured_date</i></span>
						</div>
						<div id=\"notice_id_$notice_id\" class=\"panel-collapse collapse in\" style=\"margin-top: -15px;\">
							<div class=\"box-body\">
								<article class=\"addReadMore showlesscontent\">$notice_content</article>  
							</div>
						</div>
					</div>
				</td>
			</tr>";
		} else {
			$tbody = "		
			<tr>
				<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
				<td>$notice_title</td>
				<td><article class=\"addReadMore showlesscontent\">$notice_content</article></td>
				<td>$captured_by</td>
				<td nowrap=\"nowrap\">$captured_date</td>";
				
				if ($access_right === "RW") {
					$tbody .= "
					<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">
						<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#" . $notice_id ."edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
						<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#" . $notice_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>
					</td>";
				}
	
			$tbody .= "
			</tr>";
			
			// display Edit Notice Modal
			$tbody .= notice_modal::displayModal("edit", $logged_username, $notices);
	
			// display Delete Notice Modal
			$tbody .= notice_modal::displayModal("delete", $logged_username, $notices);
		}

        return $tbody;

    }

    /**
     * display modal
     *
     * @param string action
     * @param string logged_username
     * @param array notices
     *
     * @return string modal
     */

    public static function displayModal($action, $logged_username, $notices = array())
    {
        $notice_id = "";
        $notice_title = "";
        $notice_content = "";
        $captured_by = "";
        $captured_date = "";
        $modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";

        if (!empty($notices)) {
            // form elements have values, this is an Edit Modal
            $notice_id = $notices["notice_id"];
            $notice_title = $notices["notice_title"];
            $notice_content = $notices["notice_content"];

            $modal_bottom = "<input type=\"hidden\" name=\"notice_id\" value=\"$notice_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";
        }

        $modal_title = ucwords("$action Notice");

		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";
		
        if ($action === "delete") {
			$tag = "div";
          	$modal_title = "Are you sure you want to delete notice '$notice_title'?";

            $modal_bottom = "<input type=\"hidden\" name=\"notice_id\" value=\"$notice_id\">
							<input type=\"hidden\" name=\"notice_title\" value=\"$notice_title\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";
							
			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
        }
		
        $modal = "
		<!-- " . ucwords($action) . " Notice Modal -->
		<div class=\"modal fade\" id=\"$notice_id" . "$action\" role=\"dialog\">
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
							<label class=\"required\" for=\"notice_title\">Title</label>
							<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"notice_title\" id=\"notice_title\" value=\"$notice_title\" required>
						</fieldset>
					
						<fieldset class=\"form-group col-md-12\">
							<label class=\"required\" for=\"notice_content\">Content</label>
							<textarea class=\"textarea form-control\" name=\"notice_content\" required>$notice_content</textarea>
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
		<!-- ./" . ucwords($action) . " Notice Modal -->";
		
		return $modal;
    }
}