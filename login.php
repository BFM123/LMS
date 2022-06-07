<?php
	session_start();
	require "config/config.php";
	require "models/user.php";
	require "controllers/user_controller.php";
	
	
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		if ($_POST["option"] === "login") {
			login();
			$message = $_SESSION["message_login"];
			$url = "./";
			
			if ($message === "valid") {
				if (isset($_SESSION["return_url"])) {
					// user was automatically logged out, set the url to the page where the user was being logged out
					$url = $_SESSION["return_url"];
					unset($_SESSION["return_url"]);
				} else {
					// this is a new login, get default landing page
					$landing_page_id = common::getFieldValue("system", "landing_page_id");
					
					// check if the landing page is accessible by this user, if not assign default page
					$this_role_id = common::getFieldValue("user", "role_id", "username", $_SESSION["username"]);
					$this_menu_ids = common::getFieldValue("role", "menu_ids", "role_id", $this_role_id);
					$this_menu_ids = str_replace("RW", "", $this_menu_ids); // remove read/write tag...as long as menu item is accessible it doesn't matter if its read/write
					$this_menu_ids = str_replace("RO", "", $this_menu_ids); // remove read only tag...as long as menu item is accessible it doesn't matter if its read-only
					if (strpos($this_menu_ids, "|$landing_page_id|") !== false)
						$landing_page = common::getFieldValue("menu", "menu_link", "menu_id", $landing_page_id);
					else
						$landing_page = "dashboard";
	
					$url = "views/" . $landing_page;
				}
				header("Location: $url");
			} else {
				header("Location: $url");
			}
		}
	}
?>