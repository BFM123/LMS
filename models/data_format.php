<?php
require_once "common.php";
/**
 * Data formats class
 */
class data_format
{
  /**
	* declarations 
	*/
	private $data_format_id;
	private $data_format;
	private $factor;
	private $captured_by;
	private $captured_date;
	private $last_edited_by;
	private $last_edited_date;
	private $deleted_by;
	private $deleted_date;
	private $status;

   /**
	 * Get the value of data_format_id
	 *
	 * @return mixed
	 */
	public function getDataFormatID()
	{
		return $this->data_format_id;
	}

   /**
	 * Set the value of data_format_id
	 *
	 * @param mixed data_format_id
	 *
	 * @return self
	 */
	public function setDataFormatID($data_format_id)
	{
		$this->data_format_id = $data_format_id;

		return $this;
	}

   /**
	 * Get the value of data_format
	 *
	 * @return mixed
	 */
	public function getDataFormat()
	{
		return $this->data_format;
	}

   /**
	 * Set the value of data_format
	 *
	 * @param mixed data_format
	 *
	 * @return self
	 */
	public function setDataFormat($data_format)
	{
		$this->data_format = $data_format;

		return $this;
	}

   /**
	 * Get the value of factor
	 *
	 * @return mixed
	 */
	public function getFactor()
	{
		return $this->factor;
	}

   /**
	 * Set the value of factor
	 *
	 * @param mixed factor
	 *
	 * @return self
	 */
	public function setFactor($factor)
	{
		$this->factor = $factor;

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
	 * Add data format
	 *
	 */
	public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("data_format", 0, "data_format", $this->data_format);
		
		if ($exists) {											
			$_SESSION["message"] = "Data format '$this->data_format'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "INSERT INTO {$table_prefix}data_format (data_format, factor, captured_by, captured_date, status) VALUES('" . $conn->real_escape_string($this->data_format) . "', '";
		$sql .= $conn->real_escape_string($this->factor) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";

		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Data format '$this->data_format'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "DataFormats", mysqli_insert_id($conn));
	}
	
	/**
	 * Edit data_format
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("data_format", $this->data_format_id, "data_format", $this->data_format);
		
		if ($exists) {											
			$_SESSION["message"] = "Data format '$this->data_format'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$sql = "UPDATE {$table_prefix}data_format SET data_format = '".$conn->real_escape_string($this->data_format)."', factor = '".$conn->real_escape_string($this->factor)."', ";
		$sql .= "last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE data_format_id = '";
		$sql .= $conn->real_escape_string($this->data_format_id) . "'";

		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] =  "Data format '$this->data_format'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "DataFormats", $this->data_format_id);
	}
	
   /**
	 * Delete data format
	 *
	 */
	public function delete()
	{
		// do not delete data formats
		$_SESSION["message"] = MESSAGE_DISABLED;
		$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		//return;
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this data format is in use
        $is_used = common::exists("indicator", 0, "data_format_id", $this->data_format_id);

		if ($is_used) {											
			$_SESSION["message"] = "Data format '$this->data_format'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "UPDATE {$table_prefix}data_format SET status = '" .$conn->real_escape_string(STATUS_DELETED)."', deleted_by = '".$conn->real_escape_string($this->deleted_by)."', ";
		$sql .= "deleted_date = NOW() WHERE data_format_id = '" . $conn->real_escape_string($this->data_format_id) . "'";
		
		$result = $conn->query($sql);
	
		if ($result) {
			$_SESSION["message"] = "Data format '$this->data_format'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "DataFormats", $this->data_format_id);
	}
	
	/**
	 * List all data formats
	 *
	 * @param string data_format_id
	 * @param string factor
	 * @return array of data formats
	 */
	public static function all($data_format_id = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$data_formats = array();

		$sql = "SELECT * FROM {$table_prefix}data_format WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen(trim($data_format_id)) > 0) $sql .= "AND data_format_id = '" . $conn->real_escape_string($data_format_id) . "' ";
		$sql .= "ORDER BY data_format";
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$data_formats[] = $row;
		}
		return $data_formats;
	}
}