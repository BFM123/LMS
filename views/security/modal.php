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
		$account_lockout_duration = security::getSecurityAttribute("account_lockout_duration");
		$account_unlock_duration = security::getSecurityAttribute("account_unlock_duration");
		$account_lockout_threshold = security::getSecurityAttribute("account_lockout_threshold");

        $modal = "
			<form action=\"action.php\" method=\"post\">

				<fieldset class=\"form-group\" style=\"margin: 0;\">
					<div class=\"col-md-4\">
						<label for=\"account_lockout_duration\" class=\"form-control required\" style=\"border: 0;\">Account Lockout Duration</label>
					</div>
					<div class=\"col-md-8\">				
						<input type=\"number\" class=\"form-control\" name=\"account_lockout_duration\" id=\"account_lockout_duration\" value=\"$account_lockout_duration\" 
						style=\"width: 60px; display: inline-block; margin-right: 10px;\" min=\"1\" max=\"" . ACCOUNT_LOCKOUT_DURATION . "\" required>minutes of no activity
					</div>
				</fieldset>
				
				<fieldset class=\"form-group\" style=\"margin: 0;\">
					<div class=\"col-md-4\">
						<label for=\"account_unlock_duration\" class=\"form-control required\" style=\"border: 0;\">Account Auto-Unlock Duration</label>
					</div>
					<div class=\"col-md-8\">				
						<input type=\"number\" class=\"form-control\" name=\"account_unlock_duration\" id=\"account_unlock_duration\" value=\"$account_unlock_duration\" 
						style=\"width: 60px; display: inline-block; margin-right: 10px;\" min=\"0\" max=\"" . ACCOUNT_LOCKOUT_DURATION . "\" required>minutes
						<i>(0 = no auto-unlock)</i>
					</div>
				</fieldset>		
								
				<fieldset class=\"form-group\" style=\"margin: 0;\">
					<div class=\"col-md-4\">
						<label for=\"account_lockout_threshold\" class=\"form-control required\" style=\"border: 0;\">Account Lockout Threshold</label>
					</div>
					<div class=\"col-md-8\">				
						<input type=\"number\" class=\"form-control\" name=\"account_lockout_threshold\" id=\"account_lockout_threshold\" value=\"$account_lockout_threshold\" 
						style=\"width: 60px; display: inline-block; margin-right: 10px;\" min=\"1\" max=\"" . ACCOUNT_LOCKOUT_THRESHOLD . "\" required>invalid logon attempts
					</div>
				</fieldset>";
				
				if ($access_right === "RW") {	
					$modal .= "								
					<input type=\"hidden\" name=\"captured_by\" value=\"$logged_username\">			
					
					<button id=\"btn-save\" type=\"submit\" class=\"btn btn-default btn-round dark-blue\">Save</button>";
				}

			 $modal .= "	
			</form>";
			
        return $modal;
    }
}