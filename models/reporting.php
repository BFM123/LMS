<?php
require_once "common.php";
/**
  * reporting class
  */
 
class reporting
{
   /**
	 *declarations
	 */
	private $reporting_id;
	private $report_acceptance_status;
	private $report_approval_levels;
	private $reporting_deadline;
	private $captured_by;
    private $last_edited_by;
    private $deleted_by;

   /**
     * Get the value of reporting_id
     *
     * @return mixed
     */
    public function getReportingID()
    {
        return $this->reporting_id;
    }

   /**
     * Set the value of reporting_id
     *
     * @param mixed reporting_id
     *
     * @return self
     */
    public function setReportingID($reporting_id)
    {
		$this->reporting_id = $reporting_id;
		
        return $this;
    }
	
   /**
     * Get the value of report_acceptance_status
     *
     * @return mixed
     */
    public function getReportAcceptanceStatus()
    {
        return $this->report_acceptance_status;
    }

   /**
     * Set the value of report_acceptance_status
     *
     * @param mixed report_acceptance_status
     *
     * @return self
     */
    public function setReportAcceptanceStatus($report_acceptance_status)
    {
        $this->report_acceptance_status = $report_acceptance_status;

        return $this;
    }

	
   /**
     * Get the value of report_approval_levels
     *
     * @return mixed
     */
    public function getReportApprovalLevels()
    {
        return $this->report_approval_levels;
    }

   /**
     * Set the value of report_approval_levels
     *
     * @param mixed report_approval_levels
     *
     * @return self
     */
    public function setReportApprovalLevels($report_approval_levels)
    {
        $this->report_approval_levels = $report_approval_levels;

        return $this;
    }

   /**
     * Get the value of reporting_deadline
     *
     * @return mixed
     */
    public function getReportingDeadline()
    {
        return $this->reporting_deadline;
    }

   /**
     * Set the value of reporting_deadline
     *
     * @param mixed reporting_deadline
     *
     * @return self
     */
    public function setReportingDeadline($reporting_deadline)
    {
        $this->reporting_deadline = $reporting_deadline;

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
     * Add reporting details
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the reporting details already exists
		$exists = common::exists("reporting", 0);
		
		if ($exists) {
			// this is a duplicate, display error message to the user	
			$_SESSION["message"] = "Reporting details" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
													
		// this is not a duplicate, proceed to create	
		$sql = "INSERT INTO {$table_prefix}reporting (report_acceptance_status, report_approval_levels, reporting_deadline, captured_by, captured_date, status) VALUES('";
		$sql .= $conn->real_escape_string($this->report_acceptance_status) . "', '" . $conn->real_escape_string($this->report_approval_levels) . "', '";
		$sql .= $conn->real_escape_string($this->reporting_deadline) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Reporting details" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Reporting", mysqli_insert_id($conn));
	}
		
   /**
     * Update reporting details
	 *
     */
    public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the reporting details already exists
		$exists = common::exists("reporting", $this->reporting_id);
		
		if ($exists) {
			// this is a duplicate, display error message to the user	
			$_SESSION["message"] = "Reporting " . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// this is not a duplicate, proceed to update	
		$sql = "UPDATE {$table_prefix}reporting SET report_acceptance_status = '" . $conn->real_escape_string($this->report_acceptance_status) . "', report_approval_levels = '";
		$sql .= $conn->real_escape_string($this->report_approval_levels) . "', reporting_deadline = '".$conn->real_escape_string($this->reporting_deadline)."', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE reporting_id = '" . $conn->real_escape_string($this->reporting_id) . "' ";
		$sql .= "AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Reporting details" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Reporting", $this->reporting_id);
	}
	
	
   /**
     * Delete reporting details
	 *
     */
    public function delete()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the reporting details are in use...by default the reporting details are in use, don't delete reporting details
		$is_used = true;
		
		if ($is_used) {
			// reporting details in use, display error message to the user	
			$_SESSION["message"] = "Reporting details" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// reporting details not in use, proceed to delete	
		$sql = "UPDATE {$table_prefix}reporting SET status = '" . $conn->real_escape_string(STATUS_DELETED)."', deleted_by = '".$conn->real_escape_string($this->deleted_by). "', ";
		$sql .= "deleted_date = NOW() WHERE reporting_id = '" . $conn->real_escape_string($this->reporting_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) ."'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Reporting details" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Reporting", $this->reporting_id);
	}
	
	/**
	 * Get report approval level
	 *
 	 * @return report approval level
	 */
	public static function getReportApprovalLevel()
	{  
	   	$report_approval_level = common::getFieldValue("reporting", "report_approval_levels");
		
		return $report_approval_level;
	}
	
   /**
	 * List all reporting details
	 *
 	 * @return array of reporting details
	 */
	public static function all()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$reporting_details = array();
		$sql = "SELECT * FROM {$table_prefix}reporting WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$reporting_details[] = $row;
		}
		return $reporting_details;
	}  
	
	/**
	 * Get expected number of reports to be submitted per period
	 *
	 * @param string type
	 * @param string month
	 * @param string year
	 * @param string district_id
	 * @param string organization_id
	 *
 	 * @return array of expected number of reports
	 */
	public static function getReports($type = "expected", $month = "", $year = "", $district_id = "", $organization_id = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$reports = 0;
		$reports_array = array(); // array to keep the numbers of reports
				
		if ($type === "expected") {
				// calculate the number of expected reports
			$dataset_ids = array(); // string to keep dataset IDs
	
			// reports are processed per organization per district i.e. no duplicates at this level
			$sql = "SELECT REPLACE(GROUP_CONCAT(DISTINCT dataset_ids), '|,|', '|') AS expected_reports FROM {$table_prefix}user WHERE LENGTH(dataset_ids) > 0 ";
			if (strlen($organization_id) > 0) $sql .= "AND organization_id = '" . $conn->real_escape_string($organization_id) . "' ";
			if (strlen($district_id) > 0) $sql .= "AND district_id = '" . $conn->real_escape_string($district_id) . "' ";
			$sql .= "AND status = '" . STATUS_ACTIVE . "' GROUP BY organization_id, district_id";
	
			$result = $conn->query($sql);
			
			while ($row = $result->fetch_object()) {
				$dataset_ids[] = $row;
			}
			
			// convert the associative array  of dataset_ids into a simple array
			foreach ($dataset_ids as $i) :
				$reports_array[] = $i->expected_reports;
			endforeach;
	
			foreach($reports_array as $r) :
				// create a new array of unique elements by converting each element of dataset IDs array, 
				// so that the number of reports is unique per organization per district
				// count the resulting numbr and add it to the expected number of reports
				$reports += count(array_unique(explode("|", substr_replace(substr($r, 1), "", -1))));
			endforeach;
		} elseif (in_array($type, array("timely", "late"))) {
			// calculate the number of timely reports
			global $INDICATOR_STATUS;	

			$draft = array_keys($INDICATOR_STATUS)[0];
			$submitted = array_keys($INDICATOR_STATUS)[1];
			$first_approval = array_keys($INDICATOR_STATUS)[2];
			$second_approval = array_keys($INDICATOR_STATUS)[3];
		
			$reporting_day = common::getFieldValue("reporting", "reporting_deadline") + 1; // reporting deadline...add 1 so that we include reports submitted until 12 mid night
			$timely_approval_date = "DATE_ADD('$year-$month-$reporting_day', INTERVAL 1 MONTH)";
			$approval_level = common::getFieldValue("reporting", "report_acceptance_status"); // level at which a report is accepted as submitted
			if ($approval_level == $draft || $approval_level == $submitted) {
				 // reports are accepted as submitted when in draft state or simply when submitted, check the captured date for timeliness
				 $date_check = "I.captured_date";
			} elseif ($approval_level == $first_approval || $approval_level == $second_approval) {
				// reports are accepted as submitted when first or second approved, check the approved_by date for timeliness
				$x = $approval_level - 1;
				$date_check = "approved$x" . "_date";
			}			
			$date_check_operator = ($type === "timely") ? "<=" : ">";
			$reports_array_temp = array(); // array to temporarily keep the numbers of submitted reports 
			
			$sql = "SELECT COUNT(DISTINCT(I.dataset_id)) AS reported FROM {$table_prefix}indicator_value AS I JOIN {$table_prefix}user AS U ON I.captured_by = U.username ";
			$sql .= "WHERE I.status = '" . STATUS_ACTIVE . "' AND I.record_control >= '$approval_level' ";

			if (strlen($month) > 0) $sql .= "AND I.month = '" . $conn->real_escape_string($month) . "' ";
			if (strlen($year) > 0) $sql .= "AND I.year = '" . $conn->real_escape_string($year) . "' ";
			if (strlen($organization_id) > 0) $sql .= "AND U.organization_id = '" . $conn->real_escape_string($organization_id) . "' ";
			if (strlen($district_id) > 0) $sql .= "AND U.district_id = '" . $conn->real_escape_string($district_id) . "' ";

			$sql .= "AND $date_check $date_check_operator $timely_approval_date GROUP BY CONCAT(I.year, I.month), U.organization_id, U.district_id ORDER BY ";
			$sql .= "CONCAT(I.year, I.month)";
			//if ($month == 12 && $year == 2019) {echo $sql;die();}
			$result = $conn->query($sql);
			
			while ($row = $result->fetch_object()) {
				$reports_array_temp[] = $row;
			}
			
			// convert the associative array  of reports into a simple array
			foreach ($reports_array_temp as $r) :
				$reports_array[] = $r->reported;
			endforeach;
			
			// sum all submitted reports 
			$reports = array_sum($reports_array);
		}
		
		return $reports;
	}
	
	
   /**
	 * List all reporting rate formats
	 *
 	 * @return array of reporting rate formats
	 */
	public static function getFormats()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$reporting_rate_formats = array();
		$sql = "SELECT * FROM {$table_prefix}reporting_rate_format WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY sort_order";
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$reporting_rate_formats[] = $row;
		}
		return $reporting_rate_formats;
	} 
}