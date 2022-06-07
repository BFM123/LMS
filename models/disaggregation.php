<?php
require_once "common.php";
/**
 * Disaggregation class
 */
class disaggregation
{
  /**
	* declarations 
	*/
	private $disaggregation_id;
	private $disaggregation;
	private $gender;
	private $description;
	private $captured_by;
	private $captured_date;
	private $last_edited_by;
	private $last_edited_date;
	private $deleted_by;
	private $deleted_date;
	private $status;

   /**
	 * Get the value of disaggregation_id
	 *
	 * @return mixed
	 */
	public function getDisaggregationID()
	{
		return $this->disaggregation_id;
	}

   /**
	 * Set the value of disaggregation_id
	 *
	 * @param mixed disaggregation_id
	 *
	 * @return self
	 */
	public function setDisaggregationID($disaggregation_id)
	{
		$this->disaggregation_id = $disaggregation_id;

		return $this;
	}

   /**
	 * Get the value of disaggregation
	 *
	 * @return mixed
	 */
	public function getDisaggregation()
	{
		return $this->disaggregation;
	}

   /**
	 * Set the value of disaggregation
	 *
	 * @param mixed disaggregation
	 *
	 * @return self
	 */
	public function setDisaggregation($disaggregation)
	{
		$this->disaggregation = $disaggregation;

		return $this;
	}

   /**
	 * Get the value of gender
	 *
	 * @return mixed
	 */
	public function getGender()
	{
		return $this->gender;
	}

   /**
	 * Set the value of gender
	 *
	 * @param mixed gender
	 *
	 * @return self
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;

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
	 * Add disaggregation
	 *
	 */
	public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("disaggregation", 0, "disaggregation", $this->disaggregation, "gender", $this->gender);
		$gender_str = (strlen($this->gender) > 0) ? " ($this->gender)" : "";

		if ($exists) {											
			$_SESSION["message"] = "Disaggregation '$this->disaggregation$gender_str'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "INSERT INTO {$table_prefix}disaggregation (disaggregation, gender, description, captured_by, captured_date, status) VALUES(";
		$sql .= "'" . $conn->real_escape_string($this->disaggregation) ."', '".$conn->real_escape_string($this->gender)."', '".$conn->real_escape_string($this->description)."', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";

		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Disaggregation '$this->disaggregation$gender_str'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Disaggregations", mysqli_insert_id($conn));
	}
	
	/**
	 * Edit disaggregation
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("disaggregation", $this->disaggregation_id, "disaggregation", $this->disaggregation, "gender", $this->gender);
		$gender_str = (strlen($this->gender) > 0) ? " ($this->gender)" : "";
		if ($exists) {											
			$_SESSION["message"] = "Disaggregation '$this->disaggregation$gender_str'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$sql = "UPDATE {$table_prefix}disaggregation SET disaggregation = '" . $conn->real_escape_string($this->disaggregation) . "', gender = '";
		$sql .= $conn->real_escape_string($this->gender) . "', description = '" . $conn->real_escape_string($this->description) . "', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->last_edited_by) ."', last_edited_date = NOW() WHERE disaggregation_id = '".$conn->real_escape_string($this->disaggregation_id)."'";
		
		$result = $conn->query($sql);
		
		if ($result) {
			$_SESSION["message"] =  "Disaggregation '$this->disaggregation$gender_str'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Disaggregations", $this->disaggregation_id);
	}
	
   /**
	 * Delete disaggregation
	 *
	 */
	public function delete()
	{
		// do not delete disaggregations
		$_SESSION["message"] = MESSAGE_DISABLED;
		$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		//return;
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this disaggregation is in use
        $is_used = common::exists("indicator", 0, "disaggregation_ids LIKE '%|" . $conn->real_escape_string($this->disaggregation_id) . "|%' AND status", STATUS_ACTIVE);
		$gender_str = (strlen($this->gender) > 0) ? " ($this->gender)" : "";
		
		if ($is_used) {											
			$_SESSION["message"] = "Disaggregation '$this->disaggregation$gender_str'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "UPDATE {$table_prefix}disaggregation SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
		$sql .= $conn->real_escape_string($this->deleted_by) . "', deleted_date = NOW() WHERE disaggregation_id = '" . $conn->real_escape_string($this->disaggregation_id) . "'";
		
		$result = $conn->query($sql);
	
		if ($result) {
			$_SESSION["message"] = "Disaggregation '$this->disaggregation$gender_str'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Disaggregations", $this->disaggregation_id);
	}

	/**
	 * List all disaggregations
	 *
	 * @param string program_id
	 * @param string description
	 *
	 * @return array of Disaggregationes
	 */
	public static function all($disaggregation_id = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$disaggregations = array();

		$sql = "SELECT * FROM {$table_prefix}disaggregation WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen(trim($disaggregation_id)) > 0) $sql .= "AND disaggregation_id = '". $conn->real_escape_string($disaggregation_id) . "' ";
		$sql .= "ORDER BY disaggregation";
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$disaggregations[] = $row;
		}
		return $disaggregations;
	}
}