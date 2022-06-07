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
		$role_id = $form_elements["role_id"];
		$role_name = $form_elements["role_name"];
		$access_levels = $form_elements["access_levels"];
		
		if (strlen($access_levels) == 0)
			$access_levels = "";
		//else
			//$access_levels = str_replace(menu::getCommonMenuIDs(), "|", $access_levels);
		
		$access_str = "";
		
		// print dashboard menu items for this parent
		$dashboard = common::getFieldValue("menu", "CONCAT('<i class=\"', icon, '\" style=\"color: ', icon_color, '\"></i> &nbsp;&nbsp;', menu_item)", "menu_id", 1);
		$access_str .= "<b>$dashboard</b> ";
		$dashboards = common::getFieldValue("role", "dashboards", "role_id", $role_id);		
		$dashboards = substr($dashboards, 1); // remove the first | from the string
		$dashboards = substr_replace($dashboards, "", -1);// remove the last | from the string
		
		$dashboards = explode("|", $dashboards);				
		for ($i = 0; $i < count($dashboards); $i++ ) :	
			//by definition all dashboard access is read onlyy
			$icon = ICON_CHECK;
			$icon_color = COLOR_AMBER;
			
			if (strlen($dashboards[$i]) > 0) $access_str .= "<i class=\"fa fa-$icon\" style=\"color: $icon_color\"></i>" . $dashboards[$i] . " &nbsp;&nbsp;";
		endfor;
		$access_str .= "<br />";
		 
		$parent_menus = menu::display();
		
		$i = 1;
		foreach ($parent_menus as $p) :	
			//don't display common menu items...these will be added to every user's menu by default
			//if (strpos(menu::getCommonMenuIDs(), "|$p->menu_id" . "RW" . "|") === false) {
							
			// print parent menu item
			$access_str .= "<b>" . MENU_PARENT_PLACEHOLDER . "</b> ";

			// by default this parent menu item is not accessible
			$is_accessible = false;
			$menu_item_placeholder_replacement = "";

			// print children menu items for this parent
			$children_menus = menu::display($p->menu_id);

			foreach ($children_menus as $c) :
				$menu_id = $c->menu_id;
				$menu_item = $c->menu_item;													

				if (strpos($access_levels, "|$menu_id" . "RW" . "|") !== false || strpos($access_levels, "|$menu_id" . "RO" . "|") !== false) {
					// only display items that are either read/write or read only
					$is_accessible = true;
					$menu_item_placeholder_replacement = "<i class=\"$p->icon\" style=\"color: $p->icon_color\"></i> &nbsp;&nbsp;$p->menu_item";
					
					if (strpos($access_levels, "|$menu_id" . "RW" . "|") !== false) {
						// this is a read/write access
						$icon = ICON_CHECK;
						$icon_color = COLOR_BLUE;						
					} elseif (strpos($access_levels, "|$menu_id" . "RO" . "|") !== false) {
						// this is a read only  access
						$icon = ICON_CHECK;
						$icon_color = COLOR_AMBER;
					}
					$access_str .= "<i class=\"fa fa-$icon\" style=\"color: $icon_color\"></i>$menu_item &nbsp;&nbsp;";
				}																		
			endforeach;
			
			if ($is_accessible) $access_str .= "<br />"; // add a line break after  printing every parent menu

			// print parent menu items to take care of those without children e.g. Reports, apart from common menu items
			if (strpos(COMMON_MENU_ITEMS, "|$p->menu_item|") === false) {
				if (strpos($access_levels, "|$p->menu_id" . "RW" . "|") !== false || strpos($access_levels, "|$p->menu_id" . "RO" . "|") !== false) {
					// only display items that are either read/write or read only
					$menu_item_placeholder_replacement = "<i class=\"$p->icon\" style=\"color: $p->icon_color\"></i> &nbsp;&nbsp;$p->menu_item";
					
					if (strpos($access_levels, "|$p->menu_id" . "RW" . "|") !== false) {
						// this is a read/write access
						$icon = ICON_CHECK;
						$icon_color = COLOR_BLUE;						
					} elseif (strpos($access_levels, "|$p->menu_id" . "RO" . "|") !== false) {
						// this is a read only  access
						$icon = ICON_CHECK;
						$icon_color = COLOR_AMBER;
					}
					$access_str .= "<i class=\"fa fa-$icon\" style=\"color: $icon_color\"></i><br />";
				}
			}
		
			$access_str = str_replace(MENU_PARENT_PLACEHOLDER, $menu_item_placeholder_replacement, $access_str); // replace menu item placeholder
		endforeach;
		
		$access_str_check = str_replace("<b>", "", $access_str);
		$access_str_check = str_replace("</b>", "", $access_str_check);
		$access_str_check = trim($access_str_check);
		
		if (strlen($access_str_check) == 0) $access_str = "<i class=\"fa fa-" . ICON_CROSS . "\" style=\"color: " . COLOR_RED . "\"></i>";		
		$access_levels = $access_str;
			
		$tbody = "		
			<tr>
				<td class=\"text-right\" style=\"width: 10px\">" . number_format($index, 0) . ".</td>
				<td nowrap=\"nowrap\">$role_name</td>
				<td>$access_levels</td>";
				
				if ($access_right === "RW") {
					$tbody .= "
					<td class=\"text-center\" nowrap=\"nowrap\">
						<a title=\"Edit\" data-toggle=\"modal\" data-target=\"#" . $role_id ."edit\" href=\"#\"><i class=\"fa fa-edit\"></i></a>
						<a title=\"Delete\" data-toggle=\"modal\" data-target=\"#" . $role_id . "delete\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a>
					</td>";
				}
				
			$tbody .= "
			</tr>";

		if ($access_right === "RW") {
			// display Edit Role Modal
			$tbody .= modal::displayModal("edit", $logged_username, $form_elements);
			
			// display Delete Role Modal
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
		$role_id = "";
		$role_name = "";
		//$access_levels = "";
		$disabled = "";
		$role_name_input = "";

    	$modal_bottom = "<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">";
							
		if (!empty($form_elements)) {
			// form elements have values, this is an Edit Modal
			
			$role_id = $form_elements["role_id"];
			$role_name = $form_elements["role_name"];
			//$access_levels = $form_elements["access_levels"];
			
			/*		
			if ($action === "edit" && in_array($role_name, array(USER_TYPE_STUDENT, USER_TYPE_FINANCE))) {
				$disabled = "disabled";
				$role_name_input = "<input type=\"hidden\" name=\"role_name\" value=\"$role_name\">";
			}*/

			$modal_bottom = "<input type=\"hidden\" name=\"role_id\" value=\"$role_id\">
							 $role_name_input
							<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">";
		}
		
		$modal_title = ucwords("$action Role");
		$tag = "h4";
		$btn_label_save = "Save";
		$btn_label_cancel = "Cancel";

		if ($action === "delete") {
			$tag = "div";
			$modal_title = "Are you sure you want to delete role '$role_name'?";			
			$modal_bottom = "<input type=\"hidden\" name=\"role_id\" value=\"$role_id\">
							<input type=\"hidden\" name=\"role_name\" value=\"$role_name\">
							<input type=\"hidden\" name=\"deleted_by\" value=\"$logged_username\">";
			$btn_label_save = "Yes";
			$btn_label_cancel = "&nbsp;&nbsp; No &nbsp;&nbsp";
		}

		$modal = "
		<!-- " . ucwords($action) . " Role Modal -->
		<div class=\"modal fade\" id=\"$role_id" . "$action\" role=\"dialog\">
			<div class=\"modal-dialog modal-md\">
				<div class=\"modal-content\">
					<div class=\"modal-header\">
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
						<$tag class=\"modal-title\">$modal_title</$tag>
					</div>
					<div class=\"modal-body\">
						<form action=\"action.php\" name=\"formroles\" method=\"post\">";
						
							if ($action !== "delete") {
								// only generate this part of the modal for Add and Edit actions
								
								$modal .= "
									<fieldset class=\"form-group\">
										<label class=\"required\" for=\"role_name\">Role Name</label>
										<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"role_name\" id=\"role_name\" value=\"$role_name\" required $disabled>
									</fieldset>
									
									<fieldset class=\"form-group\">									
										<label for=\"access rights\" style=\"font-weight: normal\"><b>Access Rights</b>&nbsp; &gt; &nbsp;
											<i class=\"fa fa-" . ICON_CHECK . "\" style=\"color: " . COLOR_BLUE . "\"></i>Read/Write &nbsp;&nbsp;
											<i class=\"fa fa-" . ICON_CHECK . "\" style=\"color: " . COLOR_AMBER . "\"></i>Read only
										</label>
										<div class=\"form-group\">";
											$parent_menus = menu::display("", "menu_item", "dashboard"); // display all menu items apart from dashboard
											
											$i = 1;
											foreach ($parent_menus as $p) :	
												//don't display common menu items...these will be added to every user's menu by default
												//if (strpos(menu::getCommonMenuIDs(), "|$p->menu_id" . "RW" . "|") === false) {
													// print parent menu item
													$modal .= "
													<div class=\"col-sm-6\">";
													$modal .= "<br />&nbsp;&nbsp;&nbsp;&nbsp;
														<i class=\"fa fa-" . ICON_CHECK . "\" style=\"color: " . COLOR_BLUE . "\"></i>&nbsp;&nbsp;
														<i class=\"fa fa-" . ICON_CHECK . "\" style=\"color: " . COLOR_AMBER . "\"></i>													
														<b>&nbsp;$p->menu_item</b>";
													
													// print children menu items for this parent
													if ($p->menu_id == 1 && strpos(COMMON_MENU_ITEMS, "|$p->menu_item|") !== false) {
														// print dashboard menu items...prints nothing, there are no dashboard menu items
													} else {
														$children_menus = menu::display($p->menu_id);

														if(empty($children_menus)) {
															// this menu item has no children...just display the same menu item
															$children_menus = menu::display($menu_parent = "", $no_field_name = "", $no_field_value = "", $p->menu_id);
														}
														
														foreach ($children_menus as $c) :
															$menu_id = $c->menu_id;
															$menu_item = $c->menu_item;													
															$this_menu_id = common::getFieldValue("role", "menu_ids", "role_id", $role_id);
															
															$checked_rw = (strpos($this_menu_id, "|$menu_id" . "RW" . "|") === false) ? "" : " checked";					
															$checked_ro = (strpos($this_menu_id, "|$menu_id" . "RO" . "|") === false) ? "" : " checked";								
															
															// disable the read/write radio button if the parent menu item is Reports...Reports can only be read only
															// $disabled_rw = ($p->menu_item === "Reports") ? " disabled" : "";
															$disabled_rw = "";
															
															// disable the read only radio button if the child menu item is Users or Roles...
															// Users or Roles should be read/write to enable System Administrators perform their functions
															$disabled_ro = ($menu_item == "Users" || $menu_item == "Roles") ? " disabled" : "";
															
															// if both radio buttons are disabled, then enable the readonly button
															$disabled_ro = ($disabled_rw === " disabled" && $disabled_ro === " disabled") ? "" : $disabled_ro;
															
															// don't display Menus and Licensing radio buttons and menu items ...
															if (!in_array($menu_item, array("xxxMenus", "xxxLicensing"))) {
																$modal .= "<br />&nbsp;&nbsp;&nbsp;";
																$modal .= "
																<label class=\"container\">
																	<input type=\"radio\" name=\"menu_id_" . $i . "\" value=\"".$menu_id."RW\"$disabled_rw$checked_rw>&nbsp;&nbsp;
																	<span class=\"checkmark checkmark-blue\"></span>
																</label>";
																$modal .= "
																<label class=\"container last\">
																	<input type=\"radio\" name=\"menu_id_" . $i . "\" value=\"".$menu_id."RO\"$disabled_ro$checked_ro>&nbsp;&nbsp;
																	<span class=\"checkmark checkmark-amber\"></span>
																</label>";													
																$modal .= "$menu_item";
															}
															$i++;
														endforeach;													
													}
												$modal .= "
												</div>";
											//}
										endforeach;
									$modal .= "
										</div>
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
		<!-- /." . ucwords($action) . " Role Modal -->";
		
		return $modal;
	}
}