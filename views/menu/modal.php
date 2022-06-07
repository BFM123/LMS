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
		$menu_id = $form_elements["menu_id"];
		$menu_item = $form_elements["menu_item"];
		$menu_link = $form_elements["menu_link"];
		$menu_parent = $form_elements["menu_parent"];
		$weight = $form_elements["weight"];	
		$icon = $form_elements["icon"];
		$icon_color = $form_elements["icon_color"];
		
		$menu_level = $form_elements["menu_level"];
		$menu_item = "<i class=\"$icon\" style=\"color: $icon_color;\"></i>&nbsp;&nbsp;$menu_item";
		
		if ($menu_level === "parent") {
			// format parent menu item
			$index = number_format($index, 0) . ".";
			$menu_item = "<strong>$menu_item</strong>";
		} else {
			// format child menu item
			$index = "";
			$menu_item = "&nbsp;&nbsp;&nbsp;$menu_item";
		}
		
		$tbody = "		
			<tr>
				<td class=\"text-right\" style=\"width: 10px\">$index</td>
				<td>$menu_item</td>
				<td>" . common::getFieldValue("menu", "menu_item", "menu_id", $menu_parent) . "</td>
				<td>$menu_link</td>
				<td class=\"text-center\" style=\"width: 10px\">$weight</td>";

				if ($access_right === "RW") {
					$tbody .= "
					<td class=\"text-center\" style=\"width: 30px\" nowrap=\"nowrap\">
						<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#" . $menu_id ."edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
						<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#" . $menu_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>
					</td>";
				}

			$tbody .= "
			</tr>";

		if ($access_right === "RW") {
			// display Edit Menu Modal
			$tbody .= modal::displayModal("edit", $logged_username, $form_elements);
			
			// display Delete Menu Modal
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
		global $icons;
		$menu_id = "";
		$menu_item = "";
		$menu_link = "";
		$menu_parent = "";
		$weight = "";
		$icon = "";
		$icon_color = "";
		
		$modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";
							
		if (!empty($form_elements)) {
			// form elements have values, this is an Edit Modal
			
			$menu_id = $form_elements["menu_id"];
			$menu_item = $form_elements["menu_item"];
			$menu_link = $form_elements["menu_link"];
			$menu_parent = $form_elements["menu_parent"];
			$weight = $form_elements["weight"];
			$icon = $form_elements["icon"];
			$icon_color = $form_elements["icon_color"];
			
			$modal_bottom = "<input type=\"hidden\" name=\"menu_id\" value=\"$menu_id\">
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";
		}
		
		$modal_title = ucwords("$action Menu");
		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";

		if ($action === "delete") {
			$tag = "div";
			$modal_title = "Are you sure you want to delete menu item '$menu_item'?";
			$modal_bottom = "<input type=\"hidden\" name=\"menu_id\" value=\"$menu_id\">
							<input type=\"hidden\" name=\"menu_item\" value=\"$menu_item\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";
			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
		}

		$modal = "
		<!-- " . ucwords($action) . " Menu Modal -->
		<div class=\"modal fade\" id=\"$menu_id" . "$action\" role=\"dialog\">
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
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"menu_item\">Menu Item</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"menu_item\" id=\"menu_item\" value=\"$menu_item\" required>
									</fieldset>
									
									<fieldset class=\"form-group col-md-12\">
										<label for=\"menu_link\">Link</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"menu_link\" id=\"menu_item\" value=\"$menu_link\">
									</fieldset>
									
									<fieldset class=\"form-group col-md-12\">
										<label for=\"menu_parent\">Menu Parent</label>
										<select id=\"menu_parent\" class=\"form-control\" style=\"width: 100%;\" name=\"menu_parent\">
											<option value=\"\">" . OPTION_NONE . "</option>";
									
											$my_menus = menu::display();
											
											foreach ($my_menus as $mm) :
												if($mm->menu_id === $menu_id) {
													// do nothing...a menu item cannot be its own parent
												} else {
													$selected = ($mm->menu_id === $menu_parent) ? " selected" : "";
													$modal .= "<option value=\"$mm->menu_id\"$selected>$mm->menu_item</option>";
												}
											endforeach;
									
											$modal .= "</select>
									</fieldset>								
									
									<fieldset class=\"form-group col-md-12\">
										<label class=\"required\" for=\"icon\">Icon</label>
										<select id=\"icon\" class=\"form-control\" style=\"width: 200px; font-family:FontAwesome,Arial\" name=\"icon\"multiple size=\"3\"required>";
										
											foreach ($icons as $icon_i => $icon_details) :
												$hex_code = $icon_details[0];
												$description = $icon_details[1];
												
												if ($action === "add")
													$selected = "";
												else // for Edit Modal, default icon is icon for this menu item
													$selected = ($icon_i == $icon) ? " selected" : "";
									
												$modal .= "<option style=\"font-family: FontAwesome, Arial\" value=\"$icon_i\"$selected>$hex_code $description</option>";
											endforeach;
											
											$modal .= "																						
										</select>
									</fieldset>
																			
									<fieldset class=\"form-group col-md-3\">
										<label class=\"required\" for=\"weight\">Icon Color</label>
										<input type=\"color\" class=\"form-control\" name=\"icon_color\" id=\"icon_color\" value=\"$icon_color\" required>
									</fieldset>
									
									<fieldset class=\"form-group col-md-9\">
										<label class=\"required\" for=\"weight\">Weight</label>
										<input type=\"number\" class=\"form-control\" name=\"weight\" id=\"weight\" value=\"$weight\" style=\"width: 80px;\"
										min=\"-" . MAX_WEIGHT . "\" max=\"" . MAX_WEIGHT . "\" required>
									</fieldset>
									
									<fieldset class=\"form-group col-md-12\">
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
		<!-- /." . ucwords($action) . " Menu Modal -->";
		
		return $modal;
	}
}