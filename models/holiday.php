<?php
require_once "common.php";

/**
 * Class holidays
 */

class holiday
{
    private $holiday_id;
    private $organization_id;
    private $category;
    private $captured_by;
    private $last_edited_by;
    private $deleted_by;

    /**
     * Get the value of holiday_id
     *
     * @return mixed holiday_id
     */
    public function getHolidayID()
    {
        return $this->holiday_id;
    }

    /**
     * Set the value of holiday_id
     *
     * @param mixed holiday_id
     *
     * @return self
     */
    public function setHolidayID($holiday_id)
    {
        $this->holiday_id = $holiday_id;

        return $this;
    }

    /**
     * Get the value of organization_id
     *
     * @return mixed
     */
    public function getOrganizationID()
    {
        return $this->organization_id;
    }
 
    /**
     * Set the value of organization_id
     *
     * @param mixed organization_id
     *
     * @return self
     */
    public function setOrganizationID($organization_id)
    {
        $this->organization_id = $organization_id;

        return $this;
    }

    /**
     * Get the value of category
     *
     * @return mixed category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param mixed category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }   
    
    /**
    * Get the value of holiday_date
    *
    * @return mixed holiday_date
    */
   public function getHolidaydate()
   {
       return $this->holiday_date;
   }

   /**
    * Set the value of category
    *
    * @param mixed category
    *
    * @return self
    */
   public function setHolidaydate($holiday_date)
   {
       $this->holiday_date = $holiday_date;

       return $this;
   }

    /**
     * Get the value of captured_by
     *
     * @return mixed captured_by
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
     * Get the value of deleted by
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
     * Add holidays
     */
    public function add()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;
        $record_exists = common::exists("holiday", 0, "category", trim($this->category));

        if ($record_exists) {
            $_SESSION["message"] = "Holiday  <b><i>$this->category</i></b>" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

        $holiday_date = DateTime::createFromFormat("Y-m-d", $this->holiday_date);

        $sql = "INSERT INTO {$table_prefix}holiday (organization_id, category, holiday_date, holiday_year, captured_by, captured_date, status) VALUES ('$this->organization_id','".$conn->real_escape_string($this->category)."', ";
		$sql.="'".$conn->real_escape_string($this->holiday_date)."', '". $holiday_date->format("Y")."', '".$conn->real_escape_string($this->captured_by)."', NOW(), '".$conn->real_escape_string(STATUS_ACTIVE)."')";

        $result = $conn->query($sql);
		
        if ($result){
            $_SESSION["message"] = "<b><i>$this->category Holiday added</i></b>" . MESSAGE_SUCCESS . "added";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
         } else {
            $_SESSION["message"] =  MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Holidays", mysqli_insert_id($conn));
    }

    /**
     * Edit holidays
     */
    public function edit()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;
        $record_exists = common::exists("holiday", $this->holiday_id, "category", trim($this->category));

        if ($record_exists) {
            $_SESSION["message"] = "The <b><i>$this->category</i></b> holiday" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
        $sql = "UPDATE {$table_prefix}holiday SET category = '" . $conn->real_escape_string($this->category) . "', holiday_date = '";
		$sql .= $conn->real_escape_string($this->holiday_date) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() ";
		$sql .= "WHERE holiday_id = '" . $conn->real_escape_string($this->holiday_id) . "' ";
		
        $result = $conn->query($sql);
		
        if ($result){
            $_SESSION["message"] = "<b><i>$this->category</i></b> holiday" . MESSAGE_SUCCESS . "updated";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
         } else {
            $_SESSION["message"] =  MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Holidays", $this->holiday_id);
    }

    /**
     * Delete holidays
     */
    public function delete()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

		$sql = "UPDATE {$table_prefix}holiday SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by);
		$sql .= "', deleted_date = NOW() WHERE holiday_id = '" . $conn->real_escape_string($this->holiday_id) . "'";
		
        $result = $conn->query($sql);
		
        if ($result){
            $_SESSION["message"] = "<b><i>$this->category</i></b> holiday" . MESSAGE_SUCCESS . "deleted";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
         } else {
            $_SESSION["message"] =  MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Holidays", $this->holiday_id);
	}
	
	/**
	 * 
	 * List holidays
	 *
     * @param string limit
	 *
     * @return array of holidays article
     */
    public static function all($limit = "")
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        $holidays = array();
        $sql = "SELECT * FROM {$table_prefix}holiday WHERE status= '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY captured_date DESC";
		if (strlen($limit) > 0) $sql .= " LIMIT $limit";

        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            $holidays[] = $row;
        }
        return $holidays;
    }
}