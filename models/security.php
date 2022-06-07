<?php
require_once "common.php";
/**
 * security class
 */
 
class security
{
	/**
	 *declarations
	 */
	private $account_lockout_duration;
	private $account_unlock_duration;
	private $account_lockout_threshold;
    private $captured_by;
    private $status;

   /**
     * Get the value of account_lockout_duration
     *
     * @return mixed
     */
    public function getAccountLockoutDuration()
    {
        return $this->account_lockout_duration;
    }

   /**
     * Set the value of account_lockout_duration
     *
     * @param mixed account_lockout_duration
     *
     * @return self
     */
    public function setAccountLockoutDuration($account_lockout_duration)
    {
		$this->account_lockout_duration = $account_lockout_duration;
		
        return $this;
    }
	
	 /**
     * Get the value of account_unlock_duration
     *
     * @return mixed
     */
    public function getAccountAutoUnlockDuration()
    {
        return $this->account_unlock_duration;
    }

   /**
     * Set the value of account_unlock_duration
     *
     * @param mixed account_unlock_duration
     *
     * @return self
     */
    public function setAccountAutoUnlockDuration($account_unlock_duration)
    {
		$this->account_unlock_duration = $account_unlock_duration;
		
        return $this;
    }
	
   /**
     * Get the value of account_lockout_threshold
     *
     * @return mixed
     */
    public function getAccountLockoutThreshold()
    {
        return $this->account_lockout_threshold;
    }

   /**
     * Set the value of account_lockout_threshold
     *
     * @param mixed account_lockout_threshold
     *
     * @return self
     */
    public function setAccountLockoutThreshold($account_lockout_threshold)
    {
		$this->account_lockout_threshold = $account_lockout_threshold;
		
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
     * Add security details
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("security", 0);
		
		if ($exists) {
			$sql = "UPDATE {$table_prefix}security SET account_lockout_duration = '" . $conn->real_escape_string($this->account_lockout_duration) ."', account_unlock_duration = '";
			$sql .= $conn->real_escape_string($this->account_unlock_duration) ."', account_lockout_threshold = '".$conn->real_escape_string($this->account_lockout_threshold)."', ";
			$sql .= "last_edited_by = '" .$conn->real_escape_string($this->captured_by)."', last_edited_date = NOW() WHERE status = '".$conn->real_escape_string(STATUS_ACTIVE)."'";
			
			$action = "Update";
			$record_id = self::getSecurityAttribute("security_id");
		} else {											
			$sql = "INSERT INTO {$table_prefix}security (account_lockout_duration, account_unlock_duration, account_lockout_threshold, captured_by, captured_date, status) ";
			$sql .= "VALUES('" . $conn->real_escape_string($this->account_lockout_duration) . "', '" . $conn->real_escape_string($this->account_unlock_duration) . "', '";
			$sql .= $conn->real_escape_string($this->account_lockout_threshold) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '";
			$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";

			$action = "Add";
			$record_id = mysqli_insert_id($conn);
		}
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Security details" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail($action, $_SESSION["message"], $this->captured_by, "Security", $record_id);
	}
	
	/**
	 * Get security attribute
	 *
 	 * @param attribute
	 *
 	 * @return security attribute
	 */
	public static function getSecurityAttribute($attribute)
	{		
		$attribute = common::getFieldValue("security", $attribute);
		
		return $attribute;
	}
	
}