<?php
require_once "common.php";
/**
  * district class
  */
 
class district
{
   /**
	 *declarations
	 */
	private $district_id;
	private $district_code;
	private $district_name;
	private $region_id;
	private $zone_id;
	private $captured_by;
    private $last_edited_by;
    private $deleted_by;

   /**
     * Get the value of district_id
     *
     * @return mixed
     */
    public function getDistrictID()
    {
        return $this->district_id;
    }

   /**
     * Set the value of district_id
     *
     * @param mixed district_id
     *
     * @return self
     */
    public function setDistrictID($district_id)
    {
		$this->district_id = $district_id;
		
        return $this;
    }
	
	/**
     * Get the value of district_code
     *
     * @return mixed
     */
    public function getDistrictCode()
    {
        return $this->district_code;
    }

   /**
     * Set the value of district_code
     *
     * @param mixed district_code
     *
     * @return self
     */
    public function setDistrictCode($district_code)
    {
		$this->district_code = $district_code;
		
        return $this;
    }
	
   /**
     * Get the value of district_name
     *
     * @return mixed
     */
    public function getDistrictName()
    {
        return $this->district_name;
    }

   /**
     * Set the value of district_name
     *
     * @param mixed district_name
     *
     * @return self
     */
    public function setDistrictName($district_name)
    {
		$this->district_name = $district_name;
		
        return $this;
    }
	
	/**
     * Get the value of zone_id
     *
     * @return mixed
     */
    public function getZoneID()
    {
        return $this->zone_id;
    }

   /**
     * Set the value of zone_id
     *
     * @param mixed zone_id
     *
     * @return self
     */
    public function setZoneID($zone_id)
    {
		$this->zone_id = $zone_id;
		
        return $this;
    }
	
   /**
     * Get the value of region_id
     *
     * @return mixed
     */
    public function getRegionID()
    {
        return $this->region_id;
    }

   /**
     * Set the value of region_id
     *
     * @param mixed region_id
     *
     * @return self
     */
    public function setRegionID($region_id)
    {
		$this->region_id = $region_id;
		
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
     * Get the value of last_edited_by
     *
     * @return mixed
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
     * Get the value of deleted_by
     *
     * @return mixed
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
     * Add district
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the district already exists
		$exists = common::exists("district", 0, "district_name", $this->district_name);
		
		if ($exists) {
			// this is a duplicate district, display error message to the user	
			$_SESSION["message"] = "District '$this->district_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
													
		// this is not a duplicate district, proceed to create	
		$sql = "INSERT INTO {$table_prefix}district (district_code, district_name, zone_id, region_id, captured_by, captured_date, status) VALUES('";
		$sql .= $conn->real_escape_string($this->district_code) . "', '" . $conn->real_escape_string($this->district_name)."', '".$conn->real_escape_string($this->zone_id)."', '"; 
		$sql .= $conn->real_escape_string($this->region_id) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '" .$conn->real_escape_string(STATUS_ACTIVE)."')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "District '$this->district_name'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Districts", mysqli_insert_id($conn));
	}
	
   /**
     * Update district
	 *
     */
    public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the district already exists
		$exists = common::exists("district", $this->district_id, "district_name", $this->district_name);
		
		if ($exists) {
			// this is a duplicate district, display error message to the user	
			$_SESSION["message"] = "District '$this->district_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// this is not a duplicate district, proceed to update	
		$sql = "UPDATE {$table_prefix}district SET district_code = '" . $conn->real_escape_string($this->district_code) . "', district_name = '";
		$sql .= $conn->real_escape_string($this->district_name) . "', region_id = '" . $conn->real_escape_string($this->region_id) . "', zone_id = ";
		$sql .= "'" . $conn->real_escape_string($this->zone_id) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE ";
		$sql .= "district_id = '" . $conn->real_escape_string($this->district_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "District '$this->district_name'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Districts", $this->district_id);
	}
	
   /**
     * Delete district
	 *
     */
    public function delete()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the district is in use
		$is_used = common::exists("user", 0, "district_id", $this->district_id); // check in users table
		$is_used = (!$is_used) ? common::exists("organization", 0, "district_id", $this->district_id) : $is_used; //check in organizations table
		
		if ($is_used) {
			// this district is in use, display error message to the user	
			$_SESSION["message"] = "District '$this->district_name'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// district not in use, proceed to delete	
		$sql = "UPDATE {$table_prefix}district SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '".$conn->real_escape_string($this->deleted_by)."', ";
		$sql .= "deleted_date = NOW() WHERE district_id = '" . $conn->real_escape_string($this->district_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "District '$this->district_name'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Districts", $this->district_id);
	}
	
	/**
	 * List all districts
	 *
	 * @param string order_by
	 * @param string district_id
	 * @param string zone_id
	 * @param string region_id
	 *
 	 * @return array of districts
	 */
	public static function all($order_by = "", $district_id = "", $zone_id = "", $region_id = "") 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$districts = array();
		$sql = "SELECT * FROM {$table_prefix}district WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($district_id) > 0) $sql .= "AND district_id IN ('$district_id') ";		
		if (strlen($zone_id) > 0) $sql .= "AND zone_id IN ('$zone_id') ";
		if (strlen($region_id) > 0) $sql .= "AND region_id IN ('$region_id') ";
		if (strlen($order_by) > 0) $sql .= "ORDER BY $order_by";
		else $sql .= "ORDER BY district_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$districts[] = $row;
		}
		return $districts;
	}
}