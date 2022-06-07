<?php
require_once "common.php";
/**
  * zone class
  */
 
class zone
{
   /**
	 *declarations
	 */
	private $zone_id;
	private $zone_name;
	private $region_id;
	private $captured_by;
    private $last_edited_by;
    private $deleted_by;

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
     * Get the value of zone_name
     *
     * @return mixed
     */
    public function getZoneName()
    {
        return $this->zone_name;
    }

   /**
     * Set the value of zone_name
     *
     * @param mixed zone_name
     *
     * @return self
     */
    public function setZoneName($zone_name)
    {
		$this->zone_name = $zone_name;
		
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
     * Add zone
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the zone already exists
		$exists = common::exists("zone", 0, "zone_name", $this->zone_name);
		
		if ($exists) {
			// this is a duplicate zone, display error message to the user
			$_SESSION["message"] = "Zone '$this->zone_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
													
		// this is not a duplicate zone, proceed to create
		$sql = "INSERT INTO {$table_prefix}zone (zone_name, region_id, captured_by, captured_date, status) VALUES('" . $conn->real_escape_string($this->zone_name) . "', '";
		$sql .= $conn->real_escape_string($this->region_id). "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE)."')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Zone '$this->zone_name'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Zones", mysqli_insert_id($conn));
	}
	
   /**
     * Update zone
	 *
     */
    public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the zone already exists
		$exists = common::exists("zone", $this->zone_id, "zone_name", $this->zone_name);
		
		if ($exists) {
			// this is a duplicate zone, display error message to the user
			$_SESSION["message"] = "Zone '$this->zone_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// this is not a duplicate zone, proceed to update
		$sql = "UPDATE {$table_prefix}zone SET zone_name = '" . $conn->real_escape_string($this->zone_name) . "', region_id = '" . $conn->real_escape_string($this->region_id);
		$sql .= "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE zone_id = '";
		$sql .= $conn->real_escape_string($this->zone_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Zone '$this->zone_name'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Zones", $this->zone_id);
	}
	
   /**
     * Delete zone
	 *
     */
    public function delete()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the zone is in use
		$is_used = common::exists("district", 0, "zone_id", $this->zone_id);
		
		if ($is_used) {
			// this zone is in use, display error message to the user
			$_SESSION["message"] = "Zone '$this->zone_name'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// zone not in use, proceed to delete
		$sql = "UPDATE {$table_prefix}zone SET status = '". $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by) . "', ";
		$sql .= "deleted_date = NOW() WHERE zone_id = '" . $conn->real_escape_string($this->zone_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Zone '$this->zone_name'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Zones", $this->zone_id);
	}
	
	/**
	 * List all zones
	 *
	 * @param string order_by
	 * @param string zone_id
	 * @param string region_id
	 *
 	 * @return array of zones
	 */
	public static function all($order_by = "", $zone_id = "", $region_id = "") 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$zones = array();
		$sql = "SELECT * FROM {$table_prefix}zone WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($zone_id) > 0) $sql .= "AND zone_id IN ('$zone_id') ";
		if (strlen($region_id) > 0) $sql .= "AND region_id IN ('$region_id') ";
		if (strlen($order_by) > 0) $sql .= "ORDER BY $order_by";
		else $sql .= "ORDER BY zone_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$zones[] = $row;
		}
		return $zones;
	}
}