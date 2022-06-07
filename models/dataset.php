<?php
require_once "common.php";
/**
 * Datasets class
 */
class dataset
{
  /**
	* declarations 
	*/
	private $dataset_id;
	private $dataset_name;
	private $description;
	private $indicators;
	private $indicator_ids;
	private $captured_by;
	private $captured_date;
	private $last_edited_by;
	private $last_edited_date;
	private $deleted_by;
	private $deleted_date;
	private $status;

   /**
	 * Get the value of dataset_id
	 *
	 * @return mixed
	 */
	public function getDatasetID()
	{
		return $this->dataset_id;
	}

   /**
	 * Set the value of dataset_id
	 *
	 * @param mixed dataset_id
	 *
	 * @return self
	 */
	public function setDatasetID($dataset_id)
	{
		$this->dataset_id = $dataset_id;

		return $this;
	}

   /**
	 * Get the value of dataset_name
	 *
	 * @return mixed
	 */
	public function getDatasetName()
	{
		return $this->dataset_name;
	}

   /**
	 * Set the value of dataset_name
	 *
	 * @param mixed dataset_name
	 *
	 * @return self
	 */
	public function setDatasetName($dataset_name)
	{
		$this->dataset_name = $dataset_name;

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
	 * Get the value of indicator_ids
	 *
	 * @return mixed
	 */
	public function getIndicatorIDs()
	{
		return $this->indicator_ids;
	}

   /**
	 * Set the value of indicator_ids
	 *
	 * @param mixed indicator_ids
	 *
	 * @return self
	 */
	public function setIndicatorIDs($indicator_ids)
	{
		$this->indicator_ids = $indicator_ids;

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
	 * Add dataset
	 *
	 */
	public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this dataset exists
		$exists = common::exists("dataset", 0, "dataset_name", trim($this->dataset_name));
		
		if ($exists) {
			// this is a duplicate dataset, display error message to the user											
			$_SESSION["message"] = "Dataset '" . trim($this->dataset_name) . "'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		// this is not a duplicate dataset, proceed to update
		$sql = "INSERT INTO {$table_prefix}dataset (dataset_name, description, indicator_ids, captured_by, captured_date, status) VALUES(";
		$sql .= "'" . $conn->real_escape_string(trim($this->dataset_name)) . "', '" . $conn->real_escape_string($this->description) . "', '";
		$sql .= $conn->real_escape_string($this->indicator_ids) . "', '" .$conn->real_escape_string($this->captured_by)."', NOW(), '".$conn->real_escape_string(STATUS_ACTIVE)."')";

		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Dataset '". trim($this->dataset_name) . "'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Datasets", mysqli_insert_id($conn));
	}
	
	/**
	 * Edit dataset
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this dataset exists
		$exists = common::exists("dataset", $this->dataset_id, "dataset_name", trim($this->dataset_name));
		
		if ($exists) {	
			// this is a duplicate dataset, display error message to the user																					
			$_SESSION["message"] = "Dataset '" . trim($this->dataset_name) . "'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		// this is not a duplicate dataset, proceed to update		
		$sql = "UPDATE {$table_prefix}dataset SET dataset_name = '" . $conn->real_escape_string(trim($this->dataset_name)) . "', description = '";
		$sql .= $conn->real_escape_string($this->description) . "', indicator_ids = '" . $conn->real_escape_string($this->indicator_ids) . "', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE dataset_id = '" . $conn->real_escape_string($this->dataset_id) . "'";

		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] =  "Dataset '" . trim($this->dataset_name) . "'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Datasets", $this->dataset_id);
	}
	
   /**
	 * Delete dataset
	 *
	 */
	public function delete()
	{
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this dataset is in use
        $is_used = common::exists("user", 0, "dataset_ids LIKE '%|$this->dataset_id|%' AND status", STATUS_ACTIVE);

		if ($is_used) {	
			// this dataset is in use, display error message to the user																					
			$_SESSION["message"] = "Dataset '$this->dataset_name'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		// this dataset is not in use, proceed to delete																					
		$sql = "UPDATE {$table_prefix}dataset SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" .$conn->real_escape_string($this->deleted_by)."', ";
		$sql .= "deleted_date = NOW() WHERE dataset_id = '" . $conn->real_escape_string($this->dataset_id) . "'";
		
		$result = $conn->query($sql);
	
		if ($result) {
			$_SESSION["message"] = "Dataset '". trim($this->dataset_name) . "'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
	
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Datasets", $this->dataset_id);
	}
	
	/**
	 * List all dataset
	 *
	 * @param string dataset_id
	 * @param string indicator_ids
	 * @return array of datasets
	 */
	public static function all($dataset_id = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$datasets = array();

		$sql = "SELECT * FROM {$table_prefix}dataset WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen(trim($dataset_id)) > 0) $sql .= "AND dataset_id = '" . $conn->real_escape_string($dataset_id) . "' ";
		$sql .= "ORDER BY dataset_name";
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$datasets[] = $row;
		}
		return $datasets;
	}
}