<?php
require_once "common.php";
/**
 * Thematic areas class
 */
class thematic_area
{
  /**
	* declarations 
	*/
	private $thematic_area_id;
	private $thematic_area;
	private $description;
	private $indicators;
	private $captured_by;
	private $captured_date;
	private $last_edited_by;
	private $last_edited_date;
	private $deleted_by;
	private $deleted_date;
	private $status;

   /**
	 * Get the value of thematic_area_id
	 *
	 * @return mixed
	 */
	public function getThematicAreaID()
	{
		return $this->thematic_area_id;
	}

   /**
	 * Set the value of thematic_area_id
	 *
	 * @param mixed thematic_area_id
	 *
	 * @return self
	 */
	public function setThematicAreaID($thematic_area_id)
	{
		$this->thematic_area_id = $thematic_area_id;

		return $this;
	}

   /**
	 * Get the value of thematic_area
	 *
	 * @return mixed
	 */
	public function getThematicArea()
	{
		return $this->thematic_area;
	}

   /**
	 * Set the value of thematic_area
	 *
	 * @param mixed thematic_area
	 *
	 * @return self
	 */
	public function setThematicArea($thematic_area)
	{
		$this->thematic_area = $thematic_area;

		return $this;
	}

   /**
	 * Get the value of description
	 *
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

   /**
	 * Set the value of description
	 *
	 * @param mixed description
	 *
	 * @return self
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

   /**
	 * Get the value of indicators
	 *
	 * @return mixed
	 */
	public function getIndicators()
	{
		return $this->indicators;
	}

   /**
	 * Set the value of indicators
	 *
	 * @param mixed indicators
	 *
	 * @return self
	 */
	public function setIndicators($indicators)
	{
		$this->indicators = $indicators;

		return $this;
	}


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
	 * Add thematic area
	 *
	 */
	public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("thematic_area", 0, "thematic_area", $this->thematic_area);
		
		if ($exists) {											
			$_SESSION["message"] = "Thematic area '$this->thematic_area'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "INSERT INTO {$table_prefix}thematic_area (thematic_area, description, captured_by, captured_date, status) VALUES('";
		$sql .= $conn->real_escape_string($this->thematic_area) . "', '" . $conn->real_escape_string($this->description) . "', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Thematic area '$this->thematic_area'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "ThematicAreas", mysqli_insert_id($conn));
	}
	
	/**
	 * Edit thematic area
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("thematic_area", $this->thematic_area_id, "thematic_area", $this->thematic_area);
		
		if ($exists) {											
			$_SESSION["message"] = "Thematic area '$this->thematic_area'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$sql = "UPDATE {$table_prefix}thematic_area SET thematic_area = '" . $conn->real_escape_string($this->thematic_area) . "', description = '";
		$sql .= $conn->real_escape_string($this->description) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', ";
		$sql .= "last_edited_date = NOW() WHERE thematic_area_id = '" . $conn->real_escape_string($this->thematic_area_id) . "'";
	  	
		$result = $conn->query($sql);
		
		if ($result) {
			$_SESSION["message"] =  "Thematic area '$this->thematic_area'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "ThematicAreas", $this->thematic_area_id);
	}
	
   /**
	 * Delete thematic area
	 *
	 */
	public function delete()
	{
		// do not delete thematic areas
		$_SESSION["message"] = MESSAGE_DISABLED;
		$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		//return;
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this thematic area is in use
        $is_used = common::exists("indicator", 0, "thematic_area_id", $this->thematic_area_id);

		if ($is_used) {											
			$_SESSION["message"] = "Thematic area '$this->thematic_area'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql ="UPDATE {$table_prefix}thematic_area SET status = '".$conn->real_escape_string(STATUS_DELETED)."', deleted_by = '".$conn->real_escape_string($this->deleted_by)."', ";
		$sql .= "deleted_date = NOW() WHERE thematic_area_id = '" . $conn->real_escape_string($this->thematic_area_id) . "'";
		
		$result = $conn->query($sql);
	
		if ($result) {
			$_SESSION["message"] = "Thematic area '$this->thematic_area'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "ThematicAreas", $this->thematic_area_id);
	}
	
	/**
	 * List all thematic areas
	 *
	 * @param string thematic_area_id
	 *
	 * @return array of thematic areas
	 */
	public static function all($thematic_area_id = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$thematic_areas = array();

		$sql = "SELECT * FROM {$table_prefix}thematic_area WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen(trim($thematic_area_id)) > 0) $sql .= "AND thematic_area_id = '" . $conn->real_escape_string($thematic_area_id) . "' ";
		$sql .= "ORDER BY thematic_area";
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$thematic_areas[] = $row;
		}
		return $thematic_areas;
	}
}