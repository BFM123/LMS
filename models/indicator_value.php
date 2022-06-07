<?php
require_once "common.php";
require_once "reporting.php";
/**
 * indicator value class
 */
class indicator_value
{
   /**
	* declarations 
	*/
		
	private $indicator_value_id;
    private $indicators;
    private $action;
    private $reporting_month;
    private $reporting_year;
    private $reporting_period;
    private $record_control;
    private $data_source;
    private $captured_by;
    private $last_edited_by;
    private $rejection_comment;
    private $deleted_by;
    private $status;

    /**
     * Get the value of indicator_value_id
     *
     * @return mixed
     */
    public function getIndicatorValueID()
    {
        return $this->indicator_value_id;
    }

    /**
     * Set the value of indicator_value_id
     *
     * @param mixed indicator_value_id
     *
     * @return self
     */
    public function setIndicatorValueID($indicator_value_id)
    {
        $this->indicator_value_id = $indicator_value_id;

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
     * Get the value of reporting_month
     *
     * @return mixed
     */
    public function getReportingMonth()
    {
        return $this->reporting_month;
    }

    /**
     * Set the value of reporting_month
     *
     * @param mixed reporting_month
     *
     * @return self
     */
    public function setReportingMonth($reporting_month)
    {
        $this->reporting_month = $reporting_month;

        return $this;
    }
	
	/**
     * Get the value of reporting_year
     *
     * @return mixed
     */
    public function getReportingYear()
    {
        return $this->reporting_year;
    }

    /**
     * Set the value of reporting_year
     *
     * @param mixed reporting_year
     *
     * @return self
     */
    public function setReportingYear($reporting_year)
    {
        $this->reporting_year = $reporting_year;

        return $this;
    }

	/**
     * Get the value of reporting_period
     *
     * @return mixed
     */
    public function getReportingPeriod()
    {
        return $this->reporting_period;
    }

    /**
     * Set the value of reporting_period
     *
     * @param mixed reporting_period
     *
     * @return self
     */
    public function setReportingPeriod($reporting_period)
    {
        $this->reporting_period = $reporting_period;

        return $this;
    }

    /**
     * Get the value of deleted_comments
    rejection_comment
     * @return mixed
     */
    public function getRejectionComment()
    {
        return $this->rejection_comment;
    }

    /**
     * Set the value of rejection_comment
     *
     * @param mixed rejection_comment
     *
     * @return self
     */
    public function setRejectionComment($rejection_comment)
    {
        $this->rejection_comment = $rejection_comment;

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
     * Get the value of data_source
     *
     * @return mixed
     */
    public function getDataSource()
    {
        return $this->data_source;
    }

    /**
     * Set the value of data_source
     *
     * @param mixed data_source
     *
     * @return self
     */
    public function setDataSource($data_source)
    {
        $this->data_source = $data_source;

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
     * Capture indicator values
	 *
     */
    public function capture()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		global $INDICATOR_STATUS;	
		
		$draft = array_keys($INDICATOR_STATUS)[0];
		$awaiting_approval_1 = array_keys($INDICATOR_STATUS)[1];
		$awaiting_approval_2 = array_keys($INDICATOR_STATUS)[2];
		$approved = array_keys($INDICATOR_STATUS)[3];
		$sql_approval_fields = "";
		$sql_approval_values = "";
		$logged_ids = "";
		
		if ($this->record_control == $draft) {
			$action = "saved";
			$record_control = $this->record_control;
		} else {
			$action = "submitted";
			
			// get the configured report approval level
			$report_approval_level = reporting::getReportApprovalLevel();
			$record_control = $approved - $report_approval_level;
			if (strlen($this->data_source) > 0) {
				//$record_control = $this->record_control;
				$sql_approval_fields .= ", data_source";
				$sql_approval_values .= ", '" . $conn->real_escape_string($this->data_source) . "'";
			} else {
				//$record_control = $approved - $report_approval_level;
			}
			
			if ($record_control > $awaiting_approval_1) {
				// assuming the rsulting record control is in approved status, then also update the approval fields
				for ($i = 1;  $i < $record_control; $i++) {
					$sql_approval_fields .= ", approved$i" . "_by, approved$i" . "_date";
					$sql_approval_values .= ", '" . $conn->real_escape_string($this->captured_by) . "', NOW()";
				}
			}
		}

		$indicators_success = 0;
		$indicators_error = 0;
		$indicators_submitted = 0;
		$is_submitted = false;
		$total_indicators = count($this->indicators);
		
		for ($i = 0; $i < $total_indicators; $i++) {			
			$sql = "";
			$indicator_id = $this->indicators[$i][0];
			$dataset_id = $this->indicators[$i][1];
			$indicator_value = $this->indicators[$i][2];

			// check if the indicator value already exists in draft state
			$indicator_value_id = common::getFieldValue("indicator_value", "indicator_value_id", "indicator_id", $indicator_id, "dataset_id", $dataset_id, "month",
														$this->reporting_month, "year", $this->reporting_year, "captured_by", $this->captured_by, "record_control", $draft);			
			if (strlen($indicator_value_id) > 0) {
				//if (strlen($indicator_value_id) > 0 && strlen(trim($indicator_value)) > 0) {
				// this indicator already exists, its in draft state, update it
				$sql = "UPDATE {$table_prefix}indicator_value SET indicator_id = '" . $conn->real_escape_string($indicator_id) . "', dataset_id = '";
				$sql .= $conn->real_escape_string($dataset_id) . "', month = '" . $conn->real_escape_string($this->reporting_month) . "', year = '";
				$sql .= $conn->real_escape_string($this->reporting_year) . "', indicator_value = '" . $conn->real_escape_string($indicator_value) . "', record_control = '";
				$sql .= $conn->real_escape_string($record_control) . "', last_edited_by = '" . $conn->real_escape_string($this->captured_by) . "', last_edited_date = NOW() ";
				$sql .= "WHERE indicator_value_id = '" . $conn->real_escape_string($indicator_value_id) . "'";
				
				if ($action === "submitted") $logged_ids .= $indicator_value_id . "|";
			} else {
				// this indicator doesn't exist in draft state
				
				// check if the indicator value was already submitted previously
				$indicator_value_id = common::getFieldValue("indicator_value", "indicator_value_id", "indicator_id", $indicator_id, "dataset_id", $dataset_id, 
															"month", $this->reporting_month, "year", $this->reporting_year);
															
				$organization_id = common::getFieldValue("user", "organization_id", "username", $this->captured_by);
				$district_id = common::getFieldValue("user", "district_id", "username", $this->captured_by);
				$sql_captured_by = "captured_by IN (SELECT username FROM {$table_prefix}user WHERE organization_id = '" . $conn->real_escape_string($organization_id) . "' ";
				$sql_captured_by .= "AND district_id = '$district_id')";
												
				$indicator_submitted = common::getFieldValue("indicator_value", "indicator_value_id", "indicator_id", $indicator_id, "dataset_id", $dataset_id,
															 "month", $this->reporting_month, "year", $this->reporting_year, "$sql_captured_by AND 1", 1, "record_control IN 
															 ('$awaiting_approval_1', '$awaiting_approval_2', '$approved') AND 1", 1, STATUS_ACTIVE . "', '" . STATUS_REJECTED);	
				
				if ($indicator_submitted) {
					// this indicator was already submitted
					$is_submitted = true;
				} else {
					// insert indicator
					$sql = "INSERT INTO {$table_prefix}indicator_value (indicator_id, dataset_id, month, year, indicator_value, record_control,captured_by,captured_date, ";
					$sql .= "status$sql_approval_fields) VALUES('" . $conn->real_escape_string($indicator_id) . "', '" . $conn->real_escape_string($dataset_id) . "', '";
					$sql .= $conn->real_escape_string($this->reporting_month) . "', '" . $conn->real_escape_string($this->reporting_year) . "', '";
					$sql .= $conn->real_escape_string($indicator_value) . "', '" . $conn->real_escape_string($record_control) . "', '";
					$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "'$sql_approval_values)";

					if ($action === "submitted") $logged_ids .= mysqli_insert_id($conn) . "|";
				}
 			}		

			$result = (strlen($sql) > 0) ? $conn->query($sql) : false;
			
			// update counter for successfully proceesed indicators, indicators with errors or already submitted indicators
			if ($is_submitted) {
				$indicators_submitted++;
				$is_submitted = false;
			} else {
				if ($result) 
					$indicators_success++;
				else 
					$indicators_error++;
			}
		}

		if ($indicators_success < $total_indicators) {
			// not all indicators were processed successfully
			if ($indicators_error == $total_indicators) {
				// all indicators had errors
				$message = MESSAGE_ERROR;
				$type = MESSAGE_ERROR_TYPE;	
			/*
			} elseif ($indicators_submitted == $total_indicators) {
				// all indicators were already submitted
				$message = "All " . number_format($indicators_submitted, 0) . " indicator(s) were already submitted";
				$type = MESSAGE_INFORMATION_TYPE;
			*/
			} else {
				// some indicators had errors or indicators_submitted
				$message = "A total of " . number_format($indicators_success, 0) . " indicator(s) were $action " . trim(MESSAGE_SUCCESS) . ". ".number_format($indicators_error,0);
				$message .= " indicator(s) had errors. " . number_format($indicators_submitted, 0) . " indicator(s) were already submitted";
				$type = MESSAGE_INFORMATION_TYPE;
			}
		} else {
			// all indicators were processed successfully
			$message = ucwords(MESSAGE_SUCCESS) . "$action " . number_format($indicators_success, 0) . " indicator(s)";
			$type = MESSAGE_SUCCESS_TYPE;
		}
		
		$_SESSION["message"] = $message;
		$_SESSION["message_type"] = $type;
		
		// log the user activity
		if (strlen($logged_ids) > 0) $logged_ids = "|" . $logged_ids;
		if ($action === "submitted" && strlen($this->data_source) == 0) // only log trail for data submitted manually, imported data is logged via the data import functionality
			audit_trail::log_trail("Data Capture", $_SESSION["message"], $this->captured_by, "DataCapture", $logged_ids);		
	}
	
	/**
     * Reject/approve indicator values
	 *
     */
    public function approve()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		global $INDICATOR_STATUS;	
		
		$awaiting_approval_1 = array_keys($INDICATOR_STATUS)[1];
		$awaiting_approval_2 = array_keys($INDICATOR_STATUS)[2];		
		$status = "";	
		$record_control = "";
		
		$total_indicators = count($this->indicators);
		
		if ($total_indicators == 0)	{		
			$_SESSION["message"] = "No indicators selected";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$indicator_value_ids = implode(", ", $this->indicators);

		$indicator_value_ids_str = str_replace(",", "', '", $indicator_value_ids);

        $message_str = (isset($_POST["type"]) && $_POST["type"] == "batch") ? "report(s)" : "indicator(s)";
		
		$logged_table_name = "DataApproval(Level$this->record_control)";

        if ($this->action === "approve") {
			$next_record_control = $this->record_control + 1;	
			if ($this->record_control == $awaiting_approval_1) {
				$action_by = "approved1_by";
				$action_date = "approved1_date";
			} elseif ($this->record_control == $awaiting_approval_2) {
				$action_by = "approved2_by";
				$action_date = "approved2_date";
			}
			$action_str = "approved";
			$record_control = "record_control = '" . $conn->real_escape_string($next_record_control) . "', ";
			$message = ucwords(MESSAGE_SUCCESS) . "$action_str " . number_format($total_indicators, 0) . " $message_str";
		} elseif ($this->action === "reject") {	
			$action_by = "rejected_by";
			$action_date = "rejected_date";
			$status = " rejected_comments = '" . $conn->real_escape_string($this->rejection_comment) . "',  status = '" . $conn->real_escape_string(STATUS_REJECTED) . "', ";
			$action_str = STATUS_REJECTED;	
			$message = ucwords(MESSAGE_SUCCESS) . "$action_str " . number_format($total_indicators, 0) . " $message_str";
		} elseif ($this->action === "delete") {	
			$action_by = "deleted_by";
			$action_date = "deleted_date";
			$status = " status = '" . STATUS_DELETED . "', ";
			$action_str = STATUS_DELETED;
			$message = 	"Report for '$this->reporting_period'" . MESSAGE_SUCCESS . "deleted";
			
			$logged_table_name = "DataCapture";	
		}
		
		$sql = "UPDATE {$table_prefix}indicator_value SET $status $record_control $action_by = '" . $conn->real_escape_string($this->captured_by) . "', $action_date = NOW() ";
		$sql .= "WHERE indicator_value_id IN ('$indicator_value_ids_str')";

		$result = $conn->query($sql);
		if ($result) {
			// indicators were actioned successfully
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}		
				
		// log the user activity
		$logged_ids = "|" . str_replace(",", "|", $indicator_value_ids) . "|";
		audit_trail::log_trail(ucwords($this->action), $_SESSION["message"], $this->captured_by, $logged_table_name, $logged_ids);		
	}
	
	/**
   	 * Display indicator values awaiting approval
     * @param string record_control
     * @param string requestor
     * @param string organization_id
     * @param string district_id
     * 
	 * @return array of indicator value items awaiting approval
     */
	public static function getApprovals($record_control, $requestor, $organization_id = "", $district_id = "")
    {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		global $INDICATOR_STATUS;	
		
		$draft = array_keys($INDICATOR_STATUS)[0];
		$awaiting_approval_1 = array_keys($INDICATOR_STATUS)[1];
		$awaiting_approval_2 = array_keys($INDICATOR_STATUS)[2];
		$approved = array_keys($INDICATOR_STATUS)[3];
		
		$approvals = array();
		
		$sql_status_1 = " I.status IN ('" . STATUS_REJECTED . "', '" . STATUS_ACTIVE . "')";
		$sql_status_2 = " I.status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		$sql_where = "";
		if ($record_control == $draft) {
			// $sql_where .= "WHERE $sql_status_1 AND I.captured_by = '$requestor' AND I.record_control <> '$approved'";			
			$sql_where .= "JOIN {$table_prefix}user AS U ON I.captured_by = U.username WHERE $sql_status_1 AND U.organization_id = '" . $conn->real_escape_string($organization_id);
			$sql_where .= "' AND U.district_id = '" . $conn->real_escape_string($district_id) . "' AND I.record_control <> '$approved'";
		} elseif ($record_control == $awaiting_approval_1) {
			$sql_where .= "JOIN {$table_prefix}user AS U ON I.captured_by = U.username WHERE $sql_status_2 AND U.organization_id = '" . $conn->real_escape_string($organization_id);
			$sql_where .= "' AND U.district_id = '" . $conn->real_escape_string($district_id) . "' AND I.record_control = '" . $conn->real_escape_string($awaiting_approval_1) ."'";			
		} elseif ($record_control == $awaiting_approval_2) {
			$sql_where .= "JOIN {$table_prefix}user AS U ON I.captured_by = U.username ";
			$sql_where .= "WHERE $sql_status_2 AND I.record_control = '" . $conn->real_escape_string($awaiting_approval_2) . "'";			
		}
		
		$sql = "SELECT I.indicator_value_id AS indicator_value_id, GROUP_CONCAT(DISTINCT I.indicator_value_id) AS indicator_value_ids,I.dataset_id AS dataset_ids,";
		$sql .= "I.year AS year, I.month AS month, IF(I.month < 9, CONCAT('0', I.month), I.month) AS month_number, COUNT(I.indicator_id) AS indicators, I.captured_by AS ";
		$sql .= "captured_by, DATE_FORMAT(I.captured_date,'%d %b %Y') AS captured_date, IF(I.status = '" . $conn->real_escape_string(STATUS_REJECTED) . "', '";
		$sql .= $conn->real_escape_string(ucwords(STATUS_REJECTED)) . "', IF(I.record_control = '" . $conn->real_escape_string($draft) . "', '";
		$sql .= $conn->real_escape_string(DRAFT) . "', IF(I.record_control = '" . $conn->real_escape_string($awaiting_approval_1) . "', '";
		$sql .= $conn->real_escape_string(AWAITING_APPROVAL_1) . "', IF(I.record_control = '" . $conn->real_escape_string($awaiting_approval_2) . "', '";
		$sql .= $conn->real_escape_string(AWAITING_APPROVAL_2) . "', IF(I.record_control = '" . $conn->real_escape_string($approved) . "', '";
		$sql .= $conn->real_escape_string(APPROVED) . "', ''))))) AS indicator_status, I.record_control AS ";
		$sql .= "record_control, U.organization_id AS organization_id, U.district_id AS district_id FROM {$table_prefix}indicator_value AS I $sql_where ";
		// indicator reports are processed per user per month i.e. no user can submit the same indicator for the same period
		// $sql .= "GROUP BY I.captured_by, CONCAT(I.year, I.month), I.record_control ORDER BY I.year DESC, month_number DESC, I.captured_date";
		// indicator reports are processed per dataset i.e. no user can submit the same group of indicators for the same period
		$sql .= "GROUP BY I.dataset_id, CONCAT(I.year, I.month), I.record_control ORDER BY I.year DESC, month_number DESC, I.captured_date";
		//echo $sql;
		$result = $conn->query($sql);
		while ($row = $result->fetch_object()) {
			$approvals[] = $row;
		}
		
		return $approvals;
	}
	
	/**
	 * List all indicator values
	 *
	 * @param string dataset_id
	 * @param string indicator_value_id
	 * @param string record_control
	 * @param string status
	 *
	 * @return array of indicator values
	 */
	public static function all($dataset_id = "", $indicator_value_id = "", $record_control = "", $status = STATUS_ACTIVE)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$indicator_values = array();

		$sql = "SELECT * FROM {$table_prefix}indicator_value WHERE status IN ('$status') ";
		if (strlen(trim($dataset_id)) > 0) $sql .= "AND dataset_id = '" . $conn->real_escape_string($dataset_id) . "' ";
		if (strlen(trim($indicator_value_id)) > 0) $sql .= "AND indicator_value_id IN ('$indicator_value_id') ";
		if (strlen(trim($record_control)) > 0) $sql .= "AND record_control = '" . $conn->real_escape_string($record_control) . "' ";
		$sql .= "ORDER BY indicator_value_id";
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$indicator_values[] = $row;
		}
		return $indicator_values;
	}
}