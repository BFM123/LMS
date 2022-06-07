<?php
require_once "common.php";
/**
 * menu class
 */
class menu
{
    /**
     *declarations
     */
	private $menu_id;
	private $menu_item;
	private $menu_link;
	private $menu_parent;
	private $weight;
	private $icon;
	private $icon_color;
	private $captured_by;
	private $last_edited_by;
	private $deleted_by;
	private $status;
		
    /**
     * Get the value of menu_id
     *
     * @return mixed
     */
    public function getMenuID()
    {
        return $this->menu_id;
    }

    /**
     * Set the value of menu_id
     *
     * @param mixed menu_id
     *
     * @return self
     */
    public function setMenuID($menu_id)
    {
        $this->menu_id = $menu_id;

        return $this;
    }

    /**
     * Get the value of menu_item
     *
     * @return mixed
     */
    public function getMenuItem()
    {
        return $this->menu_item;
    }

    /**
     * Set the value of menu_item
     *
     * @param mixed menu_item
     *
     * @return self
     */
    public function setMenuItem($menu_item)
    {
        $this->menu_item = $menu_item;

        return $this;
    }
 
    /**
     * Get the value of menu_link
     *
     * @return mixed
     */
    public function getMenuLink()
    {
        return $this->menu_link;
    }

    /**
     * Set the value of menu_link
     *
     * @param mixed menu_link
     *
     * @return self
     */
    public function setMenuLink($menu_link)
    {
        $this->menu_link = $menu_link;

        return $this;
    }
 
	/**
     * Get the value of menu_parent
     *
     * @return mixed
     */
    public function getMenuParent()
    {
        return $this->menu_parent;
    }

    /**
     * Set the value of menu_parent
     *
     * @param mixed menu_parent
     *
     * @return self
     */
    public function setMenuParent($menu_parent)
    {
        $this->menu_parent = $menu_parent;

        return $this;
    }

	/**
     * Get the value of weight
     *
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @param mixed weight
     *
     * @return self
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }
	
    /**
     * Get the value of icon
     *
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of icon
     *
     * @param mixed icon
     *
     * @return self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the value of icon_color
     *
     * @return mixed
     */
    public function getIconColor()
    {
        return $this->icon_color;
    }

    /**
     * Set the value of icon_color
     *
     * @param mixed icon_color
     *
     * @return self
     */
    public function setIconColor($icon_color)
    {
        $this->icon_color = $icon_color;

        return $this;
    }

	/**
     * Get the value of captured_by
     *
     * @return mixed
     */
    public function getCapturedBy()
    {
        return $this->captured_by;
    }

    /**
     * Set the value of captured_by
     *
     * @param mixed captured_by
     *
     * @return self
     */
    public function setCapturedBy($captured_by)
    {
        $this->captured_by = $captured_by;

        return $this;
    }

    /**
     * Get the value of captured_date
     *
     * @return mixed
     */
    public function getCapturedDate()
    {
        return $this->captured_date;
    }

    /**
     * Set the value of captured_date
     *
     * @param mixed captured_date
     *
     * @return self
     */
    public function setCapturedDate($captured_date)
    {
        $this->captured_date = $captured_date;

        return $this;
    }

    /**
     * Get the value of last_edited_by
	 *
     * @return mixed last_edited_by
     */
    public function getLastEditedBy()
    {
        return $this->last_edited_by;
    }

    /**
     * Set the value of last_edited_by
     *
     * @param mixed last_edited_by
     *
     * @return self
     */
    public function setLastEditedBy($last_edited_by)
    {
        $this->last_edited_by = $last_edited_by;

        return $this;
    }

    /**
     * Get the value of last_edited_date
     *
     * @return mixed
     */
    public function getLastEditedDate()
    {
        return $this->last_edited_date;
    }

    /**
     * Set the value of last_edited_date
     *
     * @param mixed last_edited_date
     *
     * @return self
     */
    public function setLastEditedDate($last_edited_date)
    {
        $this->last_edited_date = $last_edited_date;

        return $this;
    }

    /**
     * Get the value of deleted_by
	 *
     * @return mixed deleted_by
     */
    public function getDeletedBy()
    {
        return $this->deleted_by;
    }

    /**
     * Set the value of deleted_by
     *
     * @param mixed deleted_by
     *
     * @return self
     */
    public function setDeletedBy($deleted_by)
    {
        $this->deleted_by = $deleted_by;

        return $this;
    }

    /**
     * Get the value of deleted_date
     *
     * @return mixed
     */
    public function getDeletedDate()
    {
        return $this->deleted_date;
    }

    /**
     * Set the value of deleted_date
     *
     * @param mixed deleted_date
     *
     * @return self
     */
    public function setDeletedDate($deleted_date)
    {
        $this->deleted_date = $deleted_date;

        return $this;
    }
	
    /**
     * Get the value of status
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param mixed status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Add menu item
	 *
     */
    public function add()
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$record_exists = common::exists("menu", 0, "menu_item", trim($this->menu_item), "menu_parent", trim($this->menu_parent));
			
		if ($record_exists) {											
			$_SESSION["message"] = "Menu item '$this->menu_item'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
        $sql = "INSERT INTO {$table_prefix}menu (menu_item, menu_link, menu_parent, weight, icon, icon_color, captured_by, captured_date, status) VALUES ('";
		$sql .= $conn->real_escape_string($this->menu_item) . "', '" . $conn->real_escape_string($this->menu_link) . "', '" . $conn->real_escape_string($this->menu_parent) ."', '";
		$sql .= $conn->real_escape_string($this->weight) . "', '" . $conn->real_escape_string($this->icon) . "', '" . $conn->real_escape_string($this->icon_color) . "', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";

        $result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Menu item '$this->menu_item'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Menus", mysqli_insert_id($conn));
    }

   /**
     * Edit menu item
	 *
     */
    public function edit()
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;
       
	   
		$record_exists = common::exists("menu", $this->menu_id, "menu_item", trim($this->menu_item), "menu_parent", trim($this->menu_parent));
			
		if ($record_exists) {											
			$_SESSION["message"] = "Menu item '$this->menu_item'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

	    $sql = "UPDATE {$table_prefix}menu SET menu_item = '" . $conn->real_escape_string($this->menu_item) . "', menu_link = '" .$conn->real_escape_string($this->menu_link)."', ";
		$sql .= "menu_parent = '" . $conn->real_escape_string($this->menu_parent) . "', weight = '" . $conn->real_escape_string($this->weight) . "', icon = '";
		$sql .= $conn->real_escape_string($this->icon) . "', icon_color = '" . $conn->real_escape_string($this->icon_color) . "', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE menu_id = '" . $conn->real_escape_string($this->menu_id) . "'";

        $result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Menu item '$this->menu_item'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Menus", $this->menu_id);
    }
	
   /**
     * Delete menu item
	 *
     */
    public function delete()
    {
		// do not deleted menu items
		$_SESSION["message"] = MESSAGE_DISABLED;
		$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		return;
		
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$is_used = false; //common::exists("menu", $this->menu_id);

		if ($is_used) {											
			$_SESSION["message"] = "Menu item '$this->menu_item'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
       
	    $sql = "UPDATE {$table_prefix}menu SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by) . "', ";
		$sql .= "deleted_date = NOW() WHERE menu_id = '" . $conn->real_escape_string($this->menu_id) . "'";
        $result = $conn->query($sql);
		
		$has_children = common::exists("menu", 0, "menu_parent", $this->menu_id);
		
		if ($has_children) {
			// if this is a parent, then delete its children as well
			$sql = "UPDATE {$table_prefix}menu SET status = '" . STATUS_DELETED . "', deleted_by = '$this->deleted_by', deleted_date = NOW() WHERE menu_parent = '$this->menu_id'";
			$result = $conn->query($sql);
		}
		
		if ($result) {
			$_SESSION["message"] = "Menu item '$this->menu_item'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Menus", $this->menu_id);
    }
	
   /**
     * List all menu items
	 * 
	 * @param string field_name
 	 * @param string field_value
	 *
 	 * @return array of menu items
     */
    public static function all($field_name = "", $field_value = "")
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
       
	    $menu = array();
        $sql = "SELECT * FROM {$table_prefix}menu WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen(trim($field_name)) > 0) $sql .= "AND $field_name = '" . $conn->real_escape_string($field_value) . "' ";		
		$sql .= "ORDER BY weight, menu_item, menu_parent";
		
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            $menu[] = $row;
        }
        return $menu;
    }

   /**
     * Display menu items in a n orderly fashion
	 *
 	 * @param string menu_parent
 	 * @param string no_field_name
 	 * @param string no_field_value
 	 * @param string menu_id
 	 * 
 	 * @return array of menu items
     */
    public static function display($menu_parent = "", $no_field_name = "", $no_field_value = "", $menu_id = "")
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
       
	    $menu = array();
        
		$sql = "SELECT * FROM {$table_prefix}menu WHERE menu_parent = '" . $conn->real_escape_string($menu_parent)."' AND status = '".$conn->real_escape_string(STATUS_ACTIVE)."' ";
		if (strlen(trim($no_field_name)) > 0) $sql .= "AND lower($no_field_name) <> '" . strtolower($no_field_value) . "' ";
		if (strlen(trim($menu_id)) > 0) $sql .= "AND menu_id = '$menu_id' ";
		$sql .= "ORDER BY weight, menu_item";
		
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
			$menu[] = $row; 
        }
        return $menu;
    }
	
   /**
     * Find a specific menu item
	 *
	 * @param int menu_id
	 * 
	 * @return string menu_item
     */
    public function find($menu_id)
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;

        $sql = "SELECT * FROM {$table_prefix}menu WHERE menu_id = '" . $conn->real_escape_string($menu_id) . "'";
        $result = $conn->query($sql);
        return $result->fetch_object();
    }
	
   /**
     * Get IDs for common menu items
	 * 
	 * @return string menu_ids
     */
    public static function getCommonMenuIDs()
    {		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$menu_ids = "|";
		
		$menus = substr(COMMON_MENU_ITEMS, 1); // remove the first | from the string
		$menus = substr_replace($menus, "", -1);// remove the last | from the string
		$sql_common = "menu_item IN ('" . str_replace("|", "', '", $menus) . "') AND menu_parent = ''";
		
		$sql = "SELECT menu_id FROM {$table_prefix}menu WHERE $sql_common AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);		

		while ($row = $result->fetch_object()) {
			$menu_ids .= $row->menu_id . "RW|";
		}
		return $menu_ids;
    }
	
    /**
     * Print menu items for logged in users
	 *
	 * @param string username
	 * @param string path
	 * 
	 * @return string menu_result
     */
	public static function printMenu($username, $path)
	{
		$menu_result = "";
		
		if (strlen($username) > 0) {
			$role_id = common::getFieldValue("user", "role_id", "username", $username);
			$user_menu_ids = common::getFieldValue("role", "menu_ids", "role_id", $role_id);
			$user_menu_ids = str_replace("RW", "", $user_menu_ids); // remove read/write tag...as long as menu item is accessible it doesn't matter if its read/write
			$user_menu_ids = str_replace("RO", "", $user_menu_ids); // remove read only tag...as long as menu item is accessible it doesn't matter if its read-only
			
			$menu_result = "
				<!-- sidebar menu -->
				
				<ul class=\"sidebar-menu\" data-widget=\"tree\">";
					
					$menus = menu::display();
					foreach ($menus as $m) {
						$menu_id = $m->menu_id;

						$has_children = false;
						$children_menus = menu::display($menu_id);
						foreach ($children_menus as $c) {
							$sub_menu_id = $c->menu_id;
							if (strpos($user_menu_ids, "|$sub_menu_id|") !== false)
								$has_children = true;
						}
										
						if (strpos($user_menu_ids, "|$menu_id|") !== false || $has_children) {
							// this menu item, or at least its children, is accessible by this user

							$menu_item = $m->menu_item;
							//$menu_link = "views/" . $m->menu_link;
							$menu_link = $m->menu_link;
							$menu_icon = $m->icon;
							$menu_icon_color = $m->icon_color;
						
							$class = "";
							//$href = "$path" . "$menu_link";
							$href = $path . "views/" . $menu_link;
							$span = "";
							if (strlen($menu_link) == 0 ) {
								$class = "class=\"treeview\"";
								$href = "#";
								$span = "<span class=\"pull-right-container\">
											<i class=\"fa fa-angle-left pull-right\"></i>
										</span>";
							}
							
							$menu_result .= "
								<!-- main menu: $menu_item --> 
								<li $class>
									<a href=\"$href\">
										<i class=\"$menu_icon fa-lg\" style=\"color: $menu_icon_color;\"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>$menu_item</span>
										$span
									</a>
									
									<!-- sub menu items for $menu_item --> 
									<ul class=\"treeview-menu\">";
									
									$children_menus = menu::display($menu_id);
									foreach ($children_menus as $c) {
										$sub_menu_id = $c->menu_id;
										$sub_menu_item = $c->menu_item;
										$sub_menu_link = $path . "views/" . $c->menu_link;
										//$sub_menu_link = $path . "views/" . $c->menu_link . "/?h=" . user::generateHash($c->menu_id);
										$sub_menu_icon = $c->icon;
										$sub_menu_icon_color = $c->icon_color;
										
										if (strpos($user_menu_ids, "|$sub_menu_id|") !== false) {
											// this sub menu item is accessible by this user
											$menu_result .= "
											<li>
												<a href=\"$sub_menu_link\"><i class=\"$sub_menu_icon\" style=\"color: $sub_menu_icon_color;\"></i>&nbsp;$sub_menu_item</a>
											</li>";
										}
									}
		
									$menu_result .= "
									</ul>
									<!-- ./sub menu items for $menu_item -->
								</li>
								<!-- ./main menu: $menu_item -->";
						}
					}
			$menu_result .= "	
				</ul>";
		}
		
		return $menu_result;
	}
}