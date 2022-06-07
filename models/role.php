<?php
require_once "common.php";
require_once "menu.php";
/**
 * role class
 */
class role
{
    /**
     *declarations
     */
	private $role_id;
	private $role_name;
	private $menu_ids;
	private $dashboards;
	private $captured_by;
	private $last_edited_by;
	private $deleted_by;
	private $status;
		
    /**
     * Get the value of role_id
     *
     * @return mixed
     */
    public function getRoleID()
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     *
     * @param mixed role_id
     *
     * @return self
     */
    public function setRoleID($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get the value of role_name
     *
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->role_name;
    }

    /**
     * Set the value of role_name
     *
     * @param mixed role_name
     *
     * @return self
     */
    public function setRoleName($role_name)
    {
        $this->role_name = $role_name;

        return $this;
    }
 
	/**
     * Get the value of menu_ids
     *
     * @return mixed
     */
    public function getMenuIDs()
    {
        return $this->menu_ids;
    }

    /**
     * Set the value of menu_ids
     *
     * @param mixed menu_ids
     *
     * @return self
     */
    public function setMenuIDs($menu_ids)
    {
        $this->menu_ids = $menu_ids;

        return $this;
    }
	
	/**
     * Get the value of dashboards
     *
     * @return mixed
     */
    public function getDashboards()
    {
        return $this->dashboards;
    }

    /**
     * Set the value of dashboards
     *
     * @param mixed dashboards
     *
     * @return self
     */
    public function setDashboards($dashboards)
    {
        $this->dashboards = $dashboards;

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
     * Add role
	 *
     */
    public function add()
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$record_exists = common::exists("role", 0, "role_name", trim($this->role_name));
			
		if ($record_exists) {											
			$_SESSION["message"] = "Role '$this->role_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$menu_ids = $this->menu_ids . menu::getCommonMenuIDs();
		$dashboards = (strlen($this->dashboards) > 0) ? $this->dashboards . "|" : $this->dashboards;
		
        $sql = "INSERT INTO {$table_prefix}role (role_name, menu_ids, dashboards, captured_by, captured_date, status) VALUES ('".$conn->real_escape_string($this->role_name)."', '";
		$sql .= $conn->real_escape_string($menu_ids) . "', '" . $conn->real_escape_string($dashboards) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";

        $result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Role '$this->role_name'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Roles", mysqli_insert_id($conn));
    }

   /**
     * Edit role
	 *
     */
    public function edit()
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;
       	   
		$record_exists = common::exists("role", $this->role_id, "role_name", trim($this->role_name));

		if ($record_exists) {											
			$_SESSION["message"] = "Role '$this->role_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$menu_ids = $this->menu_ids . menu::getCommonMenuIDs();
		$dashboards = (strlen($this->dashboards) > 0) ? $this->dashboards . "|" : $this->dashboards;

	    $sql = "UPDATE {$table_prefix}role SET role_name = '" . $conn->real_escape_string($this->role_name) . "', menu_ids = '" . $conn->real_escape_string($menu_ids) . "', ";
		$sql .=  "dashboards = '" . $conn->real_escape_string($dashboards) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', ";
		$sql .= "last_edited_date = NOW() WHERE role_id = '" . $conn->real_escape_string($this->role_id) . "'";

        $result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Role '$this->role_name'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Roles", $this->role_id);
    }
	
   /**
     * Delete role
	 *
     */
    public function delete()
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this role is assigned to any user
		$is_used = common::exists("user", 0, "role_id", $this->role_id);

		if ($is_used) {											
			$_SESSION["message"] = "Role '$this->role_name'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
       
	    $sql = "UPDATE {$table_prefix}role SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by) . "', ";
		$sql .= "deleted_date = NOW() WHERE role_id = '" . $conn->real_escape_string($this->role_id) . "'";
        $result = $conn->query($sql);
	
		if ($result) {
			$_SESSION["message"] = "Role '$this->role_name'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Roles", $this->role_id);
    }
	
    /**
	 * List all roles
	 *
 	 * @param role_id
	 *
 	 * @return array of roles
	 */
	public static function all($role_id = "")
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
       
	    $role = array();
		$sql = "SELECT * FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($role_id) > 0) $sql .= "AND role_id = '" . $conn->real_escape_string($role_id) . "' ";
		$sql .= "ORDER BY role_name";
		
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            $role[] = $row;
        }
        return $role;
    }

   /**
     * Find a specific role
	 *
	 * @param int $role_id
	 * 
	 * @return string role_name
     */
    public function find($role_id)
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;

        $sql = "SELECT * FROM {$table_prefix}role WHERE role_id = '" . $conn->real_escape_string($role_id) . "'";
        $result = $conn->query($sql);
        return $result->fetch_object();
    }
}