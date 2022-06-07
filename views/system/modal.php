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
		// get system details
		$system_id = "";
		$title = "";
		$licensee = "";
		$slogan = "";
		$address = "";
		$website = "";
		$landing_page_id = "";
		$technical_support_contact = "";
		$email = "";
		$telephone = "";
		
		$system = system::all();				
		foreach ($system as $s) :
			$system_id = $s->system_id;
			$title = $s->title;
			$licensee = $s->licensee;
			$slogan = $s->slogan;
			$address = $s->address;
			$website = $s->website;
			$landing_page_id = $s->landing_page_id;
			$technical_support_contact = $s->technical_support_contact;
			$email = $s->email;
			$telephone = $s->telephone;
		endforeach;

        $modal = "
		<form action=\"action.php\" method=\"post\">
		
			<fieldset class=\"form-group col-md-6\">
				<label for=\"title\" class=\"required\">System Title</label>
				<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"title\" value=\"$title\" required>
			</fieldset>
			
			<fieldset class=\"form-group col-md-6\">
				<label for=\"licensee\" class=\"required\">Licensee</label>
				<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"licensee\" value=\"$licensee\" required>
			</fieldset>						
			
			<fieldset class=\"form-group col-md-6\">
				<label for=\"slogan\" class=\"required\">Slogan</label>
				<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"slogan\" value=\"$slogan\">		
			</fieldset>	
			
			<fieldset class=\"form-group col-md-6\">
				<label for=\"telephone\" class=\"required\">Telephone</label>				
				<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"telephone\" value=\"$telephone\" required>
			</fieldset>
			
			<fieldset class=\"form-group col-md-6\">
				<label for=\"email\" class=\"required\">Email</label>				
				<input type=\"email\" class=\"form-control\" maxlength=\"100\" name=\"email\" value=\"$email\" required>
			</fieldset>	
			
			<fieldset class=\"form-group col-md-6\">
				<label for=\"website\" class=\"required\">Website</label>				
				<input type=\"text\" class=\"form-control\" maxlength=\"50\" name=\"website\" value=\"$website\" required>
			</fieldset>
			
			<fieldset class=\"form-group col-md-6\">
				<label for=\"technical_support_contact\" class=\"required\">Technical Support Contact</label>				
				<input type=\"text\" class=\"form-control\" maxlength=\"100\" name=\"technical_support_contact\" value=\"$technical_support_contact\" required>
			</fieldset>
			
			<fieldset class=\"form-group col-md-6\">
				<label for=\"landing_page_id\" class=\"required\">Landing Page</label><i> Only applies when user has access to the page</i>			
				<select class=\"form-control\" name=\"landing_page_id\" required>";
					$menus = menu::display();
					foreach ($menus as $m) :
						$activate_parent_menu_item = (strpos(COMMON_MENU_ITEMS, "|$m->menu_item|") === false) ? false : true;
						
						if (!$activate_parent_menu_item) {
							$modal .= "<optgroup label=\"$m->menu_item\">";
						} else {
							$selected = ($landing_page_id === $m->menu_id) ? " selected" : "";
							$modal .= "<option value=\"$m->menu_id\"$selected>$m->menu_item</option>";
						}
						
						$landing_pages = menu::display($m->menu_id);
						foreach ($landing_pages as $l) :					
							$selected = ($landing_page_id === $l->menu_id) ? " selected" : "";
							$modal .= "<option value=\"$l->menu_id\"$selected>$l->menu_item</option>";
						endforeach;
						if (!$activate_parent_menu_item)
							$modal .= "</optgroup>";
					endforeach;
								
					$modal .= " 
				</select>
			</fieldset>
			
			<fieldset class=\"form-group col-md-12\">
				<label for=\"address\" class=\"required\">Address</label>
				<textarea rows=\"2\" class=\"form-control\" maxlength=\"180\" name=\"address\" required>$address</textarea>		
			</fieldset>";
			
			if ($access_right === "RW") {	
				$modal .= "								
				<input type=\"hidden\" name=\"option\" value=\"edit\">
				<input type=\"hidden\" name=\"system_id\" value=\"$system_id\">
				<input type=\"hidden\" name=\"last_edited_by\" value=\"$logged_username\">			
				
				<button type=\"submit\" class=\"btn btn-default btn-round dark-blue\">Save</button>";
			}

		$modal .= "	
		</form>";
			
        return $modal;
    }
}