<?php
require_once "user.php";
/**
 * session class
 */
 
class session
{	
	/**
	 * Check if a session is valid 
	 *
	 * @param string page_id
	 *
	 * @return string session_result
	 */
	public static function isValidSession($page_id)
	{
		$username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
		$session_key = (isset($_SESSION["session_id"])) ? $_SESSION["session_id"] : "";
		$time_stamp = (isset($_SESSION["time_stamp"])) ? $_SESSION["time_stamp"] : "";
		$message_login = (isset($_SESSION["message_login"])) ? $_SESSION["message_login"] : "";
		
		// log the user activity...do not log the activity when the users is coming from saving some data i.e. session key 'message' is set
		$page = common::getFieldValue("menu", "menu_item", "menu_id", $page_id);
		
		if (!isset($_SESSION["message"])) audit_trail::log_trail("View", "Viewing page $page", $username, str_replace(" ", "", $page));
	
		$session_result = array();
		$session_result[0] = "valid";
		$session_result[1] = "../../";
		$session_result[2] = "";

		if (strlen($session_key) == 0 || strlen($username) == 0 || strlen($time_stamp) == 0 || $message_login !== "valid") {	
			$session_result[0] = "invalid";												
		} else {
			$role_id = common::getFieldValue("user", "role_id", "username", $username);
			$accessible_menu_ids = common::getFieldValue("role", "menu_ids", "role_id", $role_id);

			// first, get the access right...whether read/write (RW) or read only (RO)
			$start_pos = strpos($accessible_menu_ids, "|$page_id" . "R");
			$end_pos = strpos(substr($accessible_menu_ids, $start_pos + 1), "|");
			$access_right = substr($accessible_menu_ids, $start_pos + $end_pos - 1, 2);
			
			 // then, remove read/write and read-only tags...at this point as long as the menu item is accessible it doesn't matter if its read/write or read-only
			$accessible_menu_ids = str_replace("RW", "", $accessible_menu_ids);
			$accessible_menu_ids = str_replace("RO", "", $accessible_menu_ids);
		
			$inactive_period = time() - $time_stamp;
			$max_inactive_period = security::getSecurityAttribute("account_lockout_duration") * 60;

			if ($inactive_period > $max_inactive_period) {
				// maximum allowable inactivity period has been reached, invalidate all session keys 
				unset($_SESSION["username"]);
				unset($_SESSION["fullname"]);
				unset($_SESSION["user_since"]);
				unset($_SESSION["photo"]);
				unset($_SESSION["session_id"]);
				unset($_SESSION["time_stamp"]);
				unset($_SESSION["message_login"]);
				unset($_SESSION["message_login_type"]);

				$url = str_replace("\\", "/", strtolower(getcwd()));
				$parameters = (common::startsWith(basename($_SERVER["REQUEST_URI"]), "?")) ? basename($_SERVER["REQUEST_URI"]) : "";
				
				$pos = strpos($url, strtolower(SYS_DIR)) + strlen(SYS_DIR) + 1;
				$return_url = substr($url, $pos) . "/" . $parameters;
				$_SESSION["return_url"] = $return_url;
				$_SESSION["message_login"] = "You have been automatically logged off after more than " . $max_inactive_period / 60 . " minutes of inactivity";
				$_SESSION["message_login_type"] = MESSAGE_INFORMATION_TYPE;
				//$session_result[1] = "../../";
				
				$session_result[0] = "inactive";
				
				// log the user activity
				audit_trail::log_trail("Login Check", $_SESSION["message_login"], $username, "Users");
			} elseif (strpos($accessible_menu_ids, "|$page_id|") === false) {
				// this menu item is not accessible by this user
				$_SESSION["message_login"] = "You do not have access to the selected page";	
				$_SESSION["message_login_type"] = MESSAGE_ERROR_TYPE;
				
				$session_result[0] = "invalid";				
				//$session_result[1] = "../../";
				
				// log the user activity
				audit_trail::log_trail("Login Check", "Automatically logged off. " . $_SESSION["message_login"] . ": " . $page, $username, "Users");
			} else {
				$_SESSION["time_stamp"] = time();
	
				$session_result[0] = "valid";
				$session_result[2] = $access_right;
			}
		}
		return $session_result;
	}
}