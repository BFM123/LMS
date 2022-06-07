<?php

/**
 * A class for managing modals
 */

class modal
{
	/**
     * display table
     *
     * @param string logged_username
     * @param array form_elements
     *
     * @return string modal
     */
    public static function displayTable($logged_username, $form_elements = array())
    {
		$blanks = "";
	   	$action_date = $form_elements["action_date"];
		$action_date = date_format(date_create($action_date), "d M Y @h:i A"); 
        $action = $form_elements["action"];
        $action = strtoupper($action);
        $detail = $form_elements["detail"];
        $action_by = $form_elements["action_by"];
		$fullname = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $action_by, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks,
										  $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_DELETED);									   
		if (strlen($fullname) == 0) $fullname = "Doesn't Exist";
		// if ($action_by !== "system" && strlen($fullname) == 0) $fullname = "Doesn't Exist";
		//if (strlen($fullname) > 0)
		$action_by = "$action_by ($fullname)";
		
        $record_id = $form_elements["record_id"];
      
	    $tbody = "
		<tr>
			<td nowrap=\"nowrap\">$action_date</td>
			<td nowrap=\"nowrap\">$action</td>
			<td>$detail</td>
			<td nowrap=\"nowrap\">$action_by</td>
		</tr>";

        return $tbody;

    }
}
