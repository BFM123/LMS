<?php
require_once "common.php";
/**
 * Population types class
 */
class population_type
{
  /**
	* declarations 
	*/
	private $population_type_id;
	private $population_type_sub_id;
	private $population_type;
	private $population_type_sub;
	private $population_type_sub_code;
	private $type;
	private $description;
	private $captured_by;
	private $captured_date;
	private $last_edited_by;
	private $last_edited_date;
	private $deleted_by;
	private $deleted_date;
	private $status;

   /**
	 * Get the value of population_type_id
	 *
	 * @return mixed
	 */
	public function getPopulationTypeID()
	{
		return $this->population_type_id;
	}

   /**
	 * Set the value of population_type_id
	 *
	 * @param mixed population_type_id
	 *
	 * @return self
	 */
	public function setPopulationTypeID($population_type_id)
	{
		$this->population_type_id = $population_type_id;

		return $this;
	}

   /**
	 * Get the value of population_type
	 *
	 * @return mixed
	 */
	public function getPopulationType()
	{
		return $this->population_type;
	}

   /**
	 * Set the value of population_type
	 *
	 * @param mixed population_type
	 *
	 * @return self
	 */
	public function setPopulationType($population_type)
	{
		$this->population_type = $population_type;

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
     * Get the value of type
     *
     * @param mixed type
     *
     * @return self
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param mixed type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /** 
	 * Get the value of population_type_sub_id
	 *
     * @return mixed
     */
    public function getPopulationTypeSubID()
    {
        return $this->population_type_sub_id;
    }

    /**
     * Set the value of population_type_sub
     *
     * @param mixed population_type_sub
     *
     * @return self
     */
    public function setPopulationTypeSubID($population_type_sub_id)
    {
        $this->population_type_sub_id = $population_type_sub_id;

        return $this;
    }
 
    /** 
	 * Get the value of population_type
	 *
     * @return mixed
     */
 
    public function getPopulationTypeSub()
    {
        return $this->population_type_sub;
    }

    /**
     * Set the value of population_type_sub
     *
     * @param mixed population_type_sub
     *
     * @return self
     */
    public function setPopulationTypeSub($population_type_sub)
    {
        $this->population_type_sub = $population_type_sub;

        return $this;
    }

    /**
     * Get the value of population_type_sub_code
     *
     * @return self
     */
    public function getPopulationTypeSubCode()
    {
        return $this->population_type_sub_code;
    }

    /**
     * Set the value of population_type_sub_code
     *
     * @param mixed population_type_sub_code
     *
     * @return self
     */
    public function setPopulationTypeSubCode($population_type_sub_code)
    {
        $this->population_type_sub_code = $population_type_sub_code;

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
	 * Add population type
	 *
	 */
	public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$title = "";

        if ($this->type === "population-type") {
            $title = "Population type '$this->population_type'";
			// check if the population type already exists
            $exists = common::exists("population_type", 0, "population_type", $this->population_type);
			
			$sql = "INSERT INTO {$table_prefix}population_type (population_type, description, captured_by, captured_date, status) VALUES('";
			$sql .= $conn->real_escape_string($this->population_type) . "', '" . $conn->real_escape_string($this->description) . "', '";
			$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";
		} else {
			$population_type_str = (strlen($this->population_type_id) > 0) ? " (" . common::getFieldValue("population_type", "population_type", 
																										  "population_type_id", $this->population_type_id) . ")" : "";
            $title = "Sub population type '$this->population_type_sub$population_type_str'";
			// check if the sub population type already exists
            $exists = common::exists("population_type_sub", 0, "population_type_sub", $this->population_type_sub, "population_type_id", $this->population_type_id);
			
			$sql = "INSERT INTO {$table_prefix}population_type_sub (population_type_sub_code, population_type_sub, description, population_type_id, captured_by, captured_date, ";
            $sql .= "status) VALUES('" . $conn->real_escape_string(strtoupper($this->population_type_sub_code)) . "', '";
			$sql .= $conn->real_escape_string($this->population_type_sub) . "', '" . $conn->real_escape_string($this->description) . "', '";
			$sql .= $conn->real_escape_string($this->population_type_id) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '";
			$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";
		}

		if ($exists) {
			// this is a duplicate (sub)population type, display error message to the user	
			$_SESSION["message"] = $title . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		// this is not a duplicate (sub)population type, proceed to create
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = $title . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "PopulationTypes", mysqli_insert_id($conn));
	}
	
	/**
	 * Edit population_type
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$title = "";
		
		if ($this->type === "population-type") {
            $title = "Population type '$this->population_type'";
			// check if the population type already exists			
            $exists = common::exists("population_type", $this->population_type_id, "population_type", $this->population_type);
			
			$sql = "UPDATE {$table_prefix}population_type SET population_type = '" . $conn->real_escape_string($this->population_type) . "', description = '";
			$sql .= $conn->real_escape_string($this->description) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() ";
			$sql .= "WHERE population_type_id = '" . $conn->real_escape_string($this->population_type_id) . "'";
			
			$logged_id = $this->population_type_id;	
		} else {
			$population_type_str = (strlen($this->population_type_id) > 0) ? " (" . common::getFieldValue("population_type", "population_type", 
																										  "population_type_id", $this->population_type_id) . ")" : "";
            $title = "Sub population type '$this->population_type_sub$population_type_str'";
			// check if the sub population type already exists
            $exists = common::exists("population_type_sub", $this->population_type_sub_id, "population_type_sub", $this->population_type_sub, "population_type_id",
									 $this->population_type_id);
			
			$sql = "UPDATE {$table_prefix}population_type_sub SET population_type_sub = '" . $conn->real_escape_string($this->population_type_sub)."', population_type_sub_code = ";
            $sql .= "'" . $conn->real_escape_string(strtoupper($this->population_type_sub_code)) . "', population_type_id = '";
			$sql .= $conn->real_escape_string($this->population_type_id) . "', description = '" . $conn->real_escape_string($this->description) . "', last_edited_by = '";
            $sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE population_type_sub_id = '";
			$sql .= $conn->real_escape_string($this->population_type_sub_id) . "'";

			$logged_id = $this->population_type_sub_id;	
		}

		if ($exists) {
			// this is a duplicate (sub)population type, display error message to the user	
			$_SESSION["message"] = $title . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		// this is not a duplicate (sub)population type, proceed to update
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = $title . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "PopulationTypes", $logged_id);
	}
	
   /**
	 * Delete population type
	 *
	 */
	public function delete()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		if ($this->type === "population-type") {
            $title = "Population type '$this->population_type'";
			// check if this population type is in use
            $is_used = common::exists("population_type_sub", 0, "population_type_id", $this->population_type_id);
			
			$sql = "UPDATE {$table_prefix}population_type SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($this->deleted_by) . "', deleted_date = NOW() WHERE population_type_id = '" .$conn->real_escape_string($this->population_type_id)."'";
			
			$logged_id = $this->population_type_id;	
		} else {
			$population_type_str = (strlen($this->population_type_id) > 0) ? " (" . common::getFieldValue("population_type", "population_type", 
																										  "population_type_id", $this->population_type_id) . ")" : "";
            $title = "Sub population type '$this->population_type_sub$population_type_str'";
			// check if this sub population type is in use
            $is_used = false;
			
			$sql = "UPDATE {$table_prefix}population_type_sub SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($this->deleted_by) . "', deleted_date = NOW() WHERE population_type_sub_id = '" ;
			$sql .= $conn->real_escape_string($this->population_type_sub_id) . "'";
			
			$logged_id = $this->population_type_sub_id;	
		}
		
		if ($is_used) {
			// this (sub)population type is in use, display error message to the user	
			$_SESSION["message"] = $title . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		// this (sub)population type is not in use, proceed to delete
		$result = $conn->query($sql);
		
		if ($result) {
			$_SESSION["message"] = $title . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "PopulationTypes", $logged_id);
	}

	/**
	 * List all population types
	 *
	 * @param string population_type_id
	 *
	 * @return array of population types
	 */
	public static function all($population_type_id = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$population_types = array();

		$sql = "SELECT * FROM {$table_prefix}population_type WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen(trim($population_type_id)) > 0) $sql .= "AND population_type_id = '" . $conn->real_escape_string($population_type_id) . "' ";
		$sql .= "ORDER BY population_type";
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$population_types[] = $row;
		}
		return $population_types;
	}

	/**
	 * List all sub population types
	 *
	 * @param string population_type_id
	 *
	 * @return array of population types
	 */
	public static function getSubPopulationTypes($population_type_id = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$sub_population_types = array();

		$sql = "SELECT * FROM {$table_prefix}population_type_sub WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen(trim($population_type_id)) > 0) $sql .= "AND population_type_id = '" . $conn->real_escape_string($population_type_id) . "' ";
		$sql .= "ORDER BY population_type_sub";
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
            $sub_population_types[] = $row;
		}
		return $sub_population_types;
	}
}