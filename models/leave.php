<?php
require_once "common.php";
require_once "user.php";
/**
 * program class
 */
class leave
{
  /**
	* declarations 
	*/
	  private $leave_id;
    private $organization_id;
    private $leave_type;
    private $start_date;
    private $end_date;
    private $duration;
    private $user_id;
    private $record_control;
    private $comments;
    private $documents;
    private $captured_by;
    private $requested_for;
    private $action;
    private $captured_date;
    private $last_edited_by;
    private $approved_by;
    private $deleted_by;
    private $rejected_comments;
    private $last_edited_date;
    private $status;

    /**
     * Get the value of leave_id
     *
     * @return mixed
     */
    public function getLeaveID()
    {
        return $this->leave_id;
    }

    /**
     * Set the value of leave_id
     *
     * @param mixed leave_id
     *
     * @return self
     */
    public function setLeaveID($leave_id)
    {
        $this->leave_id = $leave_id;

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
     * Get the value of user_id
     *
     * @return mixed
     */
    public function getUserID()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @param mixed user_id
     *
     * @return self
     */
    public function setUserID($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of rejected_comments
     *
     * @return mixed
     */
    public function getRejectedComments()
    {
        return $this->rejected_comments;
    }

    /**
     * Set the value of rejected_comments
     *
     * @param mixed rejected_comments
     *
     * @return self
     */
    public function setRejectedComments($rejected_comments)
    {
        $this->rejected_comments = $rejected_comments;

        return $this;
    }

    /**
     * Get the value of comments
     *
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @param mixed comments
     *
     * @return self
     */

    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get the value of record_control
     *
     * @return mixed
     */
    public function getRecordControl()
    {
        return $this->record_control;
    }

    /**
     * Set the value of record_control
     *
     * @param mixed record_control
     *
     * @return self
     */
    public function setRecordControl($record_control)
    {
        $this->record_control = $record_control;

        return $this;
    }
    
    /**
     * Get the value of action
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
 
    /**
     * Set the value of action
     *
     * @param mixed action
     *
     * @return self
     */

    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }  

    /**
     * Get the value of start_date
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set the value of start_date
     *
     * @param mixed start_date
     *
     * @return self
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get the value of end_date
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @param mixed end_date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Get the value of duration
     *
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @param mixed duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of leave_type
     *
     * @return mixed
     */
    public function getLeaveType()
    {
        return $this->leave_type;
    }

    /**
     * Set the value of leave_type
     *
     * @param mixed leave_type
     *
     * @return self
     */
    public function setLeaveType($leave_type)
    {
        $this->leave_type = $leave_type;

        return $this;
    }

    /**
     * Get the value of documents
     *
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }
 
    /**
     * Set the value of documents
     *
     * @param mixed documents
     *
     * @return self
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;

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
     * Get the value of requested_for
     *
     * @return mixed
     */
    public function getRequestedFor()
    {
        return $this->requested_for;
    }

    /**
     * Set the value of requested_for
     *
     * @param mixed requested_for
     *
     * @return self
     */
    public function setRequestedFor($requested_for)
    {
        $this->requested_for = $requested_for;

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
     * Get the value of approved_by
     *
     * @return mixed
     */
    public function getApprovedBy()
    {
        return $this->approved_by;
    }

    /**
     * Set the value of approved_by
     *
     * @param mixed approved_by
     *
     * @return self
     */
    public function setApprovedBy($approved_by)
    {
        $this->approved_by = $approved_by;

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
     * Get the value of deleted_for
     *
     * @return mixed
     */
    public function getDeletedFor()
    {
      return $this->deleted_for;
    }

    /**
     * Set the value of deleted_for
     *
     * @param mixed deleted_for
     *
     * @return self
     */
    public function setDeletedFor($deleted_for)
    {
      $this->deleted_for = $deleted_for;

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
     * Add leave application
     *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$leave_entitlement = common::getFieldValue("leave_entitlement", "leave_days", "organization_id", $this->organization_id, "leave_type", $this->leave_type);
    $holidays = array_unique(leave::getHolidays($this->organization_id));
    $duration = leave::getWorkingDays($this->start_date, $this->end_date, $holidays);
    $username = (strlen($this->requested_for) > 0) ? $this->requested_for : $this->captured_by;
    $used_days = leave::getDaysUsed($username, $this->leave_type, $this->organization_id);
    $current_remaining_days = $leave_entitlement - $used_days;
    $leave_applicant = common::getFieldValue("user", "CONCAT(firstname , ' ' , lastname)", "username", $username, "organization_id", $this->organization_id);
    $leave_applicant = (strlen($this->requested_for) > 0)	? " for $leave_applicant" : "";
    $is_used = leave::isDateUsed($username, $this->organization_id, $this->start_date, $this->end_date);

     // check if user has enough days to acquire a leave
		if ($current_remaining_days < $duration || $duration > $leave_entitlement) {				
			$_SESSION["message"] = "The number of requested days$leave_applicant is greater than allocated or remaining leave days";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

    // check if the selected dates have already been used
    if ($is_used) {
			$_SESSION["message"] = "Some day(s) in the selected range have already been used";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
    }
    
		$sql = "INSERT INTO {$table_prefix}leave (organization_id, requested_for, leave_type, record_control, comment, start_date, end_date, captured_by, captured_date, status) VALUES('";
		$sql .= "$this->organization_id', '$username', '$this->leave_type', '$this->record_control', '$this->comments', '$this->start_date', '$this->end_date', '$this->captured_by', NOW(), '" . STATUS_ACTIVE."'); ";

		$sql_result = $conn->query($sql);

		if ($sql_result) {
      $action = "request";
      $log_data_activity = false;

      // save documents
      $leave_id = mysqli_insert_id($conn); //get the leave id that has just been generated 
			self::processOrganizationDocuments($this->organization_id, $leave_id, $this->documents, $action, $username, $this->captured_by, $log_data_activity);

      $_SESSION["message"] = "Leave$leave_applicant" . MESSAGE_SUCCESS . "requested";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
	}
	
	/**
	 * Edit leave application
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

    //Check if user has enough days to acquire a leave
		$days_due = common::getFieldValue("user", "leave_days_due", "user_id", $this->user_id);
		$leave_entitlement = common::getFieldValue("user", "leave_entitlement", "user_id", $this->user_id);
    $leave_applicant = common::getFieldValue("user", "CONCAT(lastname , ' ' , firstname)");	

    //Change record control when user submits a draft
    $new_record_control = $this->record_control + 1;

    
		if ($days_due < $this->duration || $this->duration > $leave_entitlement) {											
			$_SESSION["message"] = "User '$leave_applicant'" . MESSAGE_EXHAUSTED;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "UPDATE {$table_prefix}leave SET duration = '$this->duration', record_control = '$new_record_control', start_date = '$this->start_date', leave_type = '";
		$sql .= "$this->leave_type', last_edited_by = '$this->last_edited_by', last_edited_date=NOW() WHERE leave_id='$this->leave_id'";
		
	   $result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] =  "Leave Application" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = $sql . MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
	}

  /**
    * Approve leave application
    *
    */
    public function approve()
	{
		global $APPROVAL_STATUS;	
		$approved = array_keys($APPROVAL_STATUS)[3];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$level_str = "";
    $staff_name = common::getFieldValue("leave", "requested_for", "leave_id", $this->leave_id);
    $staff_name = common::getFieldValue("user", "CONCAT(firstname , ' ' , lastname)", "username", $staff_name, "organization_id", $this->organization_id);
		 
		if ($this->action === "approve") {
			$level_str = " (Level $this->record_control)";
			$new_record_control = $this->record_control + 1;
			$record_control_sql = "record_control = '" . $conn->real_escape_string($new_record_control) . "', ";
			$rejection_sql = "";
			$actioned = $this->action . "d";
			$field_approved_by = $actioned . $this->record_control . "_by";
			$field_approved_date = $actioned . $this->record_control . "_date";
		} elseif ($this->action === "reject") {
			$record_control_sql = "";
			$rejection_sql = "rejected_comments = '" . $conn->real_escape_string($this->comments) . "', status= '" . $conn->real_escape_string(STATUS_REJECTED) . "', "; 
			$actioned = $this->action . "ed";
			$field_approved_by = $actioned . "_by";
			$field_approved_date = $actioned . "_date";
		}
				
		$sql="UPDATE {$table_prefix}leave SET $record_control_sql$rejection_sql$field_approved_by = '".$conn->real_escape_string($this->approved_by)."',";
		$sql .= "$field_approved_date = NOW() WHERE leave_id = '" . $conn->real_escape_string($this->leave_id) . "'";

    $result = $conn->query($sql);
        if ($result) {
			// successfully approved/rejected leave		
			$message = "Leave application for $staff_name has been " . MESSAGE_SUCCESS . $actioned . $level_str;
			$message_type = MESSAGE_SUCCESS_TYPE;
        
			// inform the next user (second approver/requestor) to act on the request
			$page_id_approval = 51; // awaiting approval (level 2), inform second level approvers
			$url = "leave_approval_2";
			$subject_str = "Leave Application Awaiting Approval";
			$message_email = "Dear Approver,</p><p>A new leave application for '$staff_name' has been submitted awaiting your approval. ";
			$task = "approve";
			$blanks = "";
			$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
			$search_query .= "'%|$page_id_approval" . "RW|%' AND email IS NOT NULL)";														 
			$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
 			
			// ensure to get the correct requestor even for rejected application
			$requested_by = common::getFieldValue("leave", "captured_by", "leave_id", $this->leave_id, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks,
												  $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);
			$requestor_firstname = common::getFieldValue("user", "firstname", "username", $requested_by, "organization_id", $this->organization_id);

			if ($this->action === "approve") {
				if ($new_record_control == $approved) {
					// approved, inform requestor
					$url = "leave";
					$subject_str = "Application Approved";
					$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
					$message_email = "Dear $requestor_firstname,</p><p>Your application for leave has been approved with ";
					$task = "track the status of your Application";
				}
			} elseif ($this->action === "reject") {
				// rejected, inform requestor
				$url = "leave";
				$subject_str = "Leave Application Rejected";
				$rejected_comments = common::getFieldValue("leave", "rejected_comments", "leave_id", $this->leave_id, $blanks, $blanks, $blanks, $blanks,
														                      $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);
				$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "user_id", $this->user_id));
				$message_email = "Dear $requestor_firstname,</p><p>Your application for leave has been rejected with the following ";
				$message_email .= "reasons: </p><p><b>" . str_replace("\r\n", "<br />", $rejected_comments) . "</b></p><p>";
				$task = "review your request";
			}
			
			$subject_str .= " - $this->organization_name";
			
			$message_email .= "To $task, login to <a href=\"" . SYS_URL . VIEWS_PATH . "$url\">myLMS</a>.</p>";		
			$to_email = array();
			if (!empty($approver_emails)) {	
				$to_email[] = $approver_emails;
				$subject[] = $subject_str;								
				$email_body[] = $message_email;
				$email_attachment[] = NULL;
			}
						
			// send email							
			if (!empty($to_email)) {
				$send_email = new send_email();				
				$send_email->setToEmail($to_email);
				$send_email->setSubject($subject);
				$send_email->setMessage($email_body);				
				$send_email->setAttachment($email_attachment);				
				$send_email->send();
			}	
			
			$_SESSION["message"] = $message;
      $_SESSION["message_type"] = $message_type;
    } else {
      $_SESSION["message"] = MESSAGE_ERROR;
      $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
    }
		
		// log the user activity
		audit_trail::log_trail(ucwords($this->action), $_SESSION["message"], $this->approved_by, "Organization", $this->organization_id);
	}
	
  /**
   * Delete Leave Application
   *
   */
  public function delete()
  {		
    $conn = config::connect();
    $table_prefix = TABLE_PREFIX;
    $deleted_by = (strlen($this->deleted_for) > 0) ? $this->deleted_for : $this->deleted_by;

    $sql = "UPDATE {$table_prefix}leave SET status = '" . STATUS_DELETED . "', deleted_by = '$deleted_by', deleted_date = NOW() WHERE leave_id = '$this->leave_id'";
    
    $result = $conn->query($sql);
  
    if ($result) {
			$delete_for = common::getFieldValue("user", "CONCAT(firstname , ' ' , lastname)", "username", $deleted_by, "organization_id", $this->organization_id);
      $deleted_by = (strlen($this->deleted_for) > 0) ? "for $delete_for" : "";

      $_SESSION["message"] = "Leave application $deleted_by" . MESSAGE_SUCCESS . "deleted";
      $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
    } else {
      $_SESSION["message"] = MESSAGE_ERROR;
      $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
    }
  }
	
 	/**
	 * List all leave applications
	 *
	 * @param string leave_id
	 * @param string username
	 * @param string leave type
	 * @param date captured date
	 * @param string record control
   * 
 	 * @return array of leave applications
	 */
	public static function all($organization_id = "", $username = "", $can_request_for_others = "", $leave_type = "", $captured_date = "", $leave_id = "", $record_control = "", $status = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	  
		$leaves = array();
		$sql = "SELECT * FROM {$table_prefix}leave WHERE organization_id IN ('$organization_id') ";
    if (strlen($username) > 0) $sql .= "AND (requested_for IN ('$username') ";
    $sql .= (strlen($can_request_for_others) > 0) ? "OR captured_by IN ('$username')) " : ")";
    if (strlen($leave_type) > 0) $sql .= "AND leave_type IN ('$leave_type') ";
    if (strlen($captured_date) > 0) $sql .= "AND captured_date <= '$captured_date' ";
    if (strlen($leave_id) > 0) $sql .= "AND leave_id IN ('$leave_id') ";
    if (strlen($record_control) > 0) $sql .= "AND record_control IN ('$record_control') ";
    if (strlen($status) > 0) $sql .= "AND status IN ('$status') ";
		$sql .= "ORDER BY captured_date";
    
    $result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$leaves[] = $row;
		}
		return $leaves;
	}
	
  /**
	 * List leave types
	 *
 	 *
	 * @return array of leave types
	 */
	public static function getLeaveTypes($organization_id, $can_upload_document = "")
	{
    $conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$leave_types = array();
		$sql = "SELECT leave_type FROM {$table_prefix}leave_type WHERE status = '" . STATUS_ACTIVE . "' ";
    if (strlen($organization_id) > 0) $sql .= "AND organization_id IN ('$organization_id') ";		
    if (strlen($can_upload_document) > 0) $sql .= "AND can_upload_document IN ('$can_upload_document') ";		
    $sql .= "ORDER BY leave_type";

    $result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$leave_types[] = $row;
		}
		return $leave_types;
	}
	
	/**
	 * List Holidays
	 *
	 * @param string username
	 * @param string organization_id
   * 
	 * @return array of holidays
	 */
	public static function getHolidays($organization_id)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		

		$holidays = array();
		$sql = "SELECT * FROM {$table_prefix}holiday WHERE organization_id = $organization_id AND holiday_year = YEAR(NOW()) AND status = '" . STATUS_ACTIVE . "' ";
    $result = $conn->query($sql);
		while ($row = $result->fetch_object()) {
			$holidays[] = $row;
		}
    if (!empty($holidays)) $holidays = array_column($holidays, "holiday_date");

		return $holidays;
	}

  /**
	 * get the number of business days excluding weekends
	 *
	 * @param date start_date
	 * @param date end_date
	 * @param array holidays
   * 
	 * @return string of number of working days
	 */
	public static function getWorkingDays($start_date, $end_date, $holidays = array())
	{
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);

    // ensure the end date is not excluded
    $end->modify("+1 day");

    // total days
    $days = $end->diff($start)->days;

    // create an array of days between the start and end dates
    $period = new DatePeriod($start, new DateInterval("P1D"), $end);

    foreach ($period as $dt) {
      $curr = $dt->format("D");
    
      // substract if day is a weekend or a holiday
      if ($curr === "Sat" || $curr === "Sun" || in_array($dt->format("Y-m-d"), $holidays))
      {
        $days--;
      }
    }
    return $days;
	}

  /**
	 * check if requested dates are already taken
	 *
	 * @param string username
	 * @param string organization-id
   * @param date start_date
	 * @param date end_date
	 *  
	 * @return true if a matching date exists, false otherwise
	 */
	public static function isDateUsed($username, $organization_id, $start_date, $end_date)
	{
		$range_of_dates_taken = array();
		$range_of_dates_requested = array();
    $blanks = "";
    $leave_dates = leave::all($organization_id, $username, $can_request_for_others = "", $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE);
    $return_value = false;
    if (!function_exists("toDate")) {function toDate($date){return date("Y-m-d", $date);}}

    foreach ($leave_dates as $d) {
      // jump 86400 seconds representing 1 day
      $dates_taken = range(strtotime($d->start_date), strtotime($d->end_date), 86400);
      $dates_requested = range(strtotime($start_date), strtotime($end_date), 86400);
      $range_of_dates_taken = array_map("toDate", $dates_taken);
      $range_of_dates_requested = array_map("toDate", $dates_requested);

      if (sizeof(array_intersect($range_of_dates_taken, $range_of_dates_requested)) != 0) $return_value = true;
    }

    return $return_value;
	}

  /**
	 * get accummulated leave days
	 *
	 * @param string username
	 * @param string leave_type
	 * @param string organization-id
   * @param date capture_date
	 *
   * @return string days
	 */
	public static function getDaysUsed($username, $leave_type, $organization_id, $captured_date = "")
	{
    $blanks = "";
    $leave_dates = leave::all($organization_id, $username, $can_request_for_others = "", $leave_type, $captured_date, $blanks, $blanks, STATUS_ACTIVE);
    $days = 0;

    foreach ($leave_dates as $d) {
      $holidays = leave::getHolidays($organization_id, $d->start_date, $d->end_date);
      $working_days = (int)leave::getWorkingDays($d->start_date, $d->end_date, $holidays);

      $days += $working_days;
    }

    return $days;
	}

  /**
   * Process organization documents
	 *
	 * @param string organization_id
	 * @param array documents
	 * @param string action
	 * @param string captured_by
	 * @param boolean log_activity
	 * 
	 */
  public static function processOrganizationDocuments($organization_id, $leave_id, $documents, $action, $username, $captured_by, $log_activity = true)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		global $DOC_FILE_EXT;

		// set the maximum execution time to 60 seconds
        set_time_limit(60);

		// set the default time zone to be that for Malawi
		date_default_timezone_set("Africa/Blantyre");
		
        if (empty($documents)) {
            $_SESSION["message"] = "No document was uploaded. Please upload document(s)";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

		if ($action === "request" || $action === "edit") {
			// loop through the documents to be uploaded
			foreach ($documents as $document_category => $document) :
				// if the document has been chosen, proceed
				if (isset($document["name"])) { 
					$document_size = $document["size"];
					$document_size_MB = $document_size / 1024 / 1024;
					$document_name = $document["name"];
					$document_type = $document["type"];
					$document_tmp = $document["tmp_name"];
					$document_ext = explode(".", $document_name); $document_ext = strtolower(end($document_ext));
	
					// if the document size is greater than zero, proceed
					if ($document_size > 0 && strlen(trim($document_name)) > 0) {
						// if the document size is less than the recommended size, proceed
						if ($document_size_MB <= MAX_FILE_IMPORT_SIZE) {
							// if the document extension is the correct one (docx, doc and pdf), proceed
							if (in_array($document_ext, $DOC_FILE_EXT)) {
								// define the path where the document should be saved
								$path = DOCUMENT_UPLOAD_PATH;
	
								// naming conversion of the new document: organization_id-document_category.extension e.g. FTC-1-constitution.pdf
								$new_document_name = strtolower(str_replace(" ", "-", "$leave_id-$organization_id-$document_category.$document_ext"));
	
								// get the old document name
								$old_document_name = common::getFieldValue("document", "filename", "leave_id", $leave_id, "organization_id", $organization_id, "document_category",
																		   $document_category);
								// delete the old document if it exists
								if (strlen($old_document_name) > 0 && file_exists($path . $old_document_name))
									unlink($path . $old_document_name);
								if ($action === "request" && strlen($old_document_name) == 0 && $document_type ) {
									// this is a 'request' action or there was no old document...insert the new information into the database
									$sql = "INSERT INTO {$table_prefix}document (organization_id, leave_id, document_category, filename, username, captured_by, captured_date, status) ";
									$sql .= "VALUES ('" . $conn->real_escape_string($organization_id) . "', '" . $conn->real_escape_string($leave_id) . "','" . $conn->real_escape_string($document_category) . "', '";
									$sql .= $conn->real_escape_string($new_document_name) . "', '" . $conn->real_escape_string($username) . "', '" . $conn->real_escape_string($captured_by) . "', NOW(), '";
									$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";
                  
								} elseif ($action === "edit") {
									// this is an 'edit' action...do nothing, the document information is already in the database...
									// just define s dumpy SQL statement which will be successful when executed i.e. result = true
									$sql = "SELECT 1";
								}		
								
								$result = $conn->query($sql);

								if ($result) {
									// upload document
									move_uploaded_file($document_tmp, $path . $new_document_name);
								
									$message = "Document '$document_name'" . MESSAGE_SUCCESS . "uploaded";
									$message_type = MESSAGE_SUCCESS_TYPE;
								} else {
									$message = MESSAGE_ERROR;
									$message_type = MESSAGE_ERROR_TYPE;
                  return;
								}
							} else {
								// wrong document type						
								$message = "Invalid document format. Please upload files of type " . implode(", ", $DOC_FILE_EXT);
								$message_type = MESSAGE_ERROR_TYPE;
                return;
							}
						} else {
							// document size exceeded
							$message = "Document size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
							$message_type = MESSAGE_ERROR_TYPE;
						}
				   } else {	
						// document size <= 0				
						$error_code = $document["error"];
		
						if ($error_code === UPLOAD_ERR_INI_SIZE || $error_code === UPLOAD_ERR_FORM_SIZE || $document_size_MB > MAX_FILE_IMPORT_SIZE)
							$error = "Document size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
						elseif ($error_code === UPLOAD_ERR_PARTIAL)						
							$error = "The uploaded document(s) were only partially uploaded";
						else
							$error = "No document was uploaded. Please upload document(s)";
									  
						$message = $error;
						$message_type = MESSAGE_ERROR_TYPE;
					}
				} else {
					// $document["name"]) not set 
					$message = "No document was uploaded. Please upload document(s)";					              
					$message_type = MESSAGE_ERROR_TYPE;
				}
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = $message_type;
			endforeach;
		} elseif ($action === "delete") {
			// delete organization documents
			$sql = "UPDATE {$table_prefix}document SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($captured_by) . "', deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND ";
			$sql .= "organization_id = '" . $conn->real_escape_string($organization_id) . "'";
			
			$result = $conn->query($sql);
			
			if ($result) {
				// delete the files from the file directory
				foreach ($documents as $key => $document) :
					if (strlen($document->filename) > 0 && file_exists(DOCUMENT_UPLOAD_PATH . $document->filename))
						unlink(DOCUMENT_UPLOAD_PATH . $document->filename);
				endforeach;
								
				$message = "Documents" . MESSAGE_SUCCESS . "deleted";
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
			} else {
				$message = MESSAGE_ERROR;
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			}			
		}
		
		// log the user activity
		if ($log_activity) audit_trail::log_trail("Save Details", $message, $captured_by, "Document", $organization_id);
	}
}