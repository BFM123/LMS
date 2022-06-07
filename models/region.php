<?php
require_once "common.php";
/**
  * region class
  */
 
class region
{
   /**
	 *declarations
	 */
	private $region_id;
	private $region_name;
	private $captured_by;
    private $last_edited_by;
    private $deleted_by;

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
     * Get the value of region_name
     *
     * @return mixed
     */
    public function getRegionName()
    {
        return $this->region_name;
    }

   /**
     * Set the value of region_name
     *
     * @param mixed region_name
     *
     * @return self
     */
    public function setRegionName($region_name)
    {
		$this->region_name = $region_name;
		
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
     * Add region
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the region already exists
		$exists = common::exists("region", 0, "region_name", $this->region_name);
		
		if ($exists) {
			// this is a duplicate region, display error message to the user	
			$_SESSION["message"] = "Region '$this->region_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
													
		// this is not a duplicate region, proceed to create	
		$sql = "INSERT INTO {$table_prefix}region (region_name, captured_by, captured_date, status) VALUES('" . $conn->real_escape_string($this->region_name) . "', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Region '$this->region_name'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Regions", mysqli_insert_id($conn));
	}
	
   /**
     * Update region
	 *
     */
    public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the region already exists
		$exists = common::exists("region", $this->region_id, "region_name", $this->region_name);
		
		if ($exists) {
			// this is a duplicate region, display error message to the user	
			$_SESSION["message"] = "Region '$this->region_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// this is not a duplicate region, proceed to update	
		$sql = "UPDATE {$table_prefix}region SET region_name = '" . $conn->real_escape_string($this->region_name) . "', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE region_id = '";
		$sql .= $conn->real_escape_string($this->region_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Region '$this->region_name'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Regions", $this->region_id);
	}
	
   /**
     * Delete region
	 *
     */
    public function delete()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the region is in use
		$is_used = common::exists("district", 0, "region_id", $this->region_id);
		
		if ($is_used) {
			// this region is in use, display error message to the user	
			$_SESSION["message"] = "Region '$this->region_name'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// region not in use, proceed to delete	
		$sql = "UPDATE {$table_prefix}region SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by)."', ";
		$sql .= "deleted_date = NOW() WHERE region_id = '" . $conn->real_escape_string($this->region_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Region '$this->region_name'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Regions", $this->region_id);
	}
	
	/**
	 * List all regions
	 *
	 * @param string order_by
	 * @param string region_id
	 *
 	 * @return array of regions
	 */
	public static function all($order_by = "", $region_id = "") 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$regions = array();
		$sql = "SELECT * FROM {$table_prefix}region WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($region_id) > 0) $sql .= "AND region_id IN ('$region_id') ";		
		if (strlen($order_by) > 0) $sql .= "ORDER BY $order_by";
		else $sql .= "ORDER BY region_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$regions[] = $row;
		}
		return $regions;
	}
}