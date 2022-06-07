<?php
require_once "common.php";
require_once "user.php";
require_once "report.php";

/**
 * certificate class
 */
class certificate
{
   /**
	* declarations 
	*/
    private $certificate_id;
    private $organization_id;
    private $certificate_category;
    private $details_1;
    private $details_2;
	private $invoice_number;
    private $captured_by;
    private $start_date;
    private $end_date;
    private $last_edited_by;
    private $approved_by;
    private $deleted_by;
    private $printed_by;
    private $status;

    /**
     * Get the value of certificate_id
     *
     * @return mixed
     */
    public function getCertificateID()
    {
        return $this->certificate_id;
    }
 
    /**
     * Set the value of certificate_id
     *
     * @param mixed certificate_id
     *
     * @return self
     */
    public function setCertificateID($certificate_id)
    {
        $this->certificate_id = $certificate_id;

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
     * Get the value of certificate_category
     *
     * @return mixed
     */
    public function getCategory()
    {
        return $this->certificate_category;
    }
 
    /**
     * Set the value of certificate_category
     *
     * @param mixed certificate_category
     *
     * @return self
     */
    public function setCategory($certificate_category)
    {
        $this->certificate_category = $certificate_category;

        return $this;
    }
 
    /**
     * Get the value of details_1
     *
     * @return mixed
     */
    public function getDetails1()
    {
        return $this->details_1;
    }
 
    /**
     * Set the value of details_1
     *
     * @param mixed details_1
     *
     * @return self
     */
    public function setDetails1($details_1)
    {
        $this->details_1 = $details_1;

        return $this;
    }
 
   /**
     * Get the value of details_2
     *
     * @return mixed
     */
    public function getDetails2()
    {
        return $this->details_2;
    }
 
    /**
     * Set the value of details_2
     *
     * @param mixed details_2
     *
     * @return self
     */
    public function setDetails2($details_2)
    {
        $this->details_2 = $details_2;

        return $this;
    }
	
	/**
     * Get the value of invoice_number
     *
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->invoice_number;
    }

    /**
     * Set the value of invoice_number
     *
     * @param mixed invoice_number
     *
     * @return self
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->invoice_number = $invoice_number;

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
     * Get the value of printed_by
     *
     * @return mixed
     */
    public function getPrintedBy()
    {
        return $this->printed_by;
    }

    /**
     * Set the value of printed_by
     *
     * @param mixed printed_by
     *
     * @return self
     */
    public function setPrintedBy($printed_by)
    {
        $this->printed_by = $printed_by;

        return $this;
    }

    /**
     * generate certificate
	 *
     */
    public function generate()
	{
		global $APPROVAL_STATUS;
		$awaiting_approval = array_keys($APPROVAL_STATUS)[3];
		$approved = array_keys($APPROVAL_STATUS)[4];
	
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$details_1 = (count($this->details_1) > 0) ? $this->details_1 : array(""); // an array of TEP TEP processing certificate requests for the case of TEP certificates
		$details_2 = (strlen($this->details_2) > 0) ? $this->details_2 : "";
		$invoice_number = (strlen($this->invoice_number) > 0) ? $this->invoice_number : "";
		
		// by default all certificates are created as awaiting approval, they will be approved upon clearing payments
		$record_control = $awaiting_approval;
		
		$start_date = $end_date = "NULL";
		$start_date_in = $end_date_in = "NULL";
		$start_date_check = $end_date_check = "1";

		if (strlen($this->start_date) > 0) {
			$start_date = $this->start_date;
			$start_date_check = "start_date >= '$start_date'";
			$start_date_in = "'$start_date'";
		}

		if (strlen($this->end_date) > 0) {
			$end_date = $this->end_date;
			$end_date_check = "end_date <= '$end_date'";
			$end_date_in = "'$end_date'";
		}
				
		if ($this->certificate_category === CERTIFICATE_REGISTRATION) {
			$exists = common::exists("certificate", 0, "organization_id", $this->organization_id, "certificate_category", $this->certificate_category);
		} elseif ($this->certificate_category === CERTIFICATE_LICENSE) {
			$exists = common::exists("certificate", 0,  "organization_id", $this->organization_id, "certificate_category", $this->certificate_category, 
									 "$start_date_check AND $end_date_check AND '1'", "1");
		} elseif ($this->certificate_category === CERTIFICATE_TEP) {
			// dont check for duplicates when generating TEP processing certificates, an NGO can have many TEP processing certificates
			$exists = false;
		}
		
		$organization_name = common::getFieldValue("organization", "organization_name", "organization_id", $this->organization_id);

        if ($exists) {
            $_SESSION["message"] = "Current " . strtolower($this->certificate_category) . " for '$organization_name'" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
						
		$sql = "INSERT INTO {$table_prefix}certificate (organization_id, certificate_category, details_1, details_2, start_date, end_date, is_printed, invoice_number, ";
		$sql .= "record_control, captured_by, captured_date, status) VALUES";
		
		foreach ($details_1 as $d) :
			$sql .= "('" . $conn->real_escape_string($this->organization_id) . "', '" . $conn->real_escape_string($this->certificate_category) . "', '";
			$sql .= $conn->real_escape_string($d) . "', '" . $conn->real_escape_string($details_2) . "', $start_date_in, $end_date_in, 'No', '";
			$sql .= $conn->real_escape_string($invoice_number) . "', '" . $conn->real_escape_string($record_control) . "', '" . $conn->real_escape_string($this->captured_by);
			$sql .= "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE)."'), ";
		endforeach;
		$sql = substr_replace($sql, "", -2); // remove the last 2 characters from the string
		
		$result = $conn->query($sql);
		
		$certificate_id = mysqli_insert_id($conn);		
		if ($result) {
			// successfully generated certificate
			$_SESSION["message"] = ucfirst(strtolower($this->certificate_category)) . " for '$organization_name'" . MESSAGE_SUCCESS . "generated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Generate Certificate", $_SESSION["message"], $this->captured_by, "Certificate", $certificate_id);
	}
	
	/**
     * Print/download certificate
	 *
     */
    public function download()
    {		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
				
		// generate the certificate
		$report = new report();
		$report->setCertificateID($this->certificate_id);
		$report->setOrganizationID($this->organization_id);
		$report->setReportName($this->certificate_category);
		$report->setDestination(PDF_FILE_EXT);
		$report->setPrintedBy($this->printed_by);
		$report->generate();
		
		$report_generation_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
		$is_downloaded = (strpos(strtolower($report_generation_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;

		if (!$is_downloaded) {
			// if certificate was not generated successfully then abort and display the error message. Error message details gotten from report
			return;
		}

	    $sql = "UPDATE {$table_prefix}certificate SET is_printed = 'Yes', last_printed_by = '" . $conn->real_escape_string($this->printed_by) . "', last_printed_date = NOW() ";
		$sql .= "WHERE certificate_id = '" . $conn->real_escape_string($this->certificate_id) . "' AND organization_id = '" . $conn->real_escape_string($this->organization_id)."'";
		
		$result = $conn->query($sql);

		if ($result) {
			$organization_name = common::getFieldValue("organization", "organization_name", "organization_id", $this->organization_id);
			$_SESSION["message"] = ucfirst(strtolower($this->certificate_category)) . " for '$organization_name'" . MESSAGE_SUCCESS . "downloaded";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
    }
	
	/**
     * Approve certificate
	 *
     */
    public function approve()
	{
		global $APPROVAL_STATUS;	
		$awaiting_approval = array_keys($APPROVAL_STATUS)[3];
		$approved = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$sql = "UPDATE {$table_prefix}certificate SET record_control = '" . $conn->real_escape_string($approved) . "', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->approved_by) . "', last_edited_date = NOW() WHERE organization_id = '" . $conn->real_escape_string($this->organization_id) . "' ";
		$sql .= "AND invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "' AND record_control = '" . $conn->real_escape_string($awaiting_approval) . "'";

		$result = $conn->query($sql);

        if ($result) {
			// successfully approved certificate		
			$_SESSION["message"] = "Certificate with invoice number '$this->invoice_number'" . MESSAGE_SUCCESS . "approved";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;            
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Approve", $_SESSION["message"], $this->approved_by, "Certificate", $this->invoice_number);
	}
	
 	/**
	 * List all certificates
	 *
	 * @param int year
	 * @param int organization_record_control
	 * @param string certificate_id
	 * @param string organization_id
	 * @param string certificate_category
	 * @param string is_printed
	 *
 	 * @return array of certificates
	 */
	public static function all($year, $organization_record_control, $certificate_id = "", $organization_id = "", $certificate_category = "", $is_printed = "") 
	{									
		global $APPROVAL_STATUS;
		$certificate_approved = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$certificates = array();
		$sql = "SELECT C.*, CONCAT(O.organization_name,IF(LENGTH(O.abbreviation) > 0, CONCAT(' (', O.abbreviation, ')'), '')) AS organization_name, O.registration_number, ";
		$sql .= "O.registration_year, YEAR(C.captured_date) AS request_year FROM {$table_prefix}certificate AS C JOIN {$table_prefix}organization AS O ON C.organization_id = ";
		$sql .= "O.organization_id WHERE C.status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND O.record_control = '";
		$sql .= $conn->real_escape_string($organization_record_control) . "' AND C.record_control = '" . $conn->real_escape_string($certificate_approved) . "'";
		if (strlen($year) > 0) $sql .= "AND YEAR(C.captured_date) = " . $conn->real_escape_string($year) . " ";
		if (strlen($certificate_id) > 0) $sql .= "AND C.certificate_id IN ('$certificate_id') ";		
		if (strlen($organization_id) > 0) $sql .= "AND C.organization_id IN ('$organization_id') ";
		if (strlen($certificate_category) > 0) $sql .= "AND C.certificate_category IN ('$certificate_category') ";
		if (strlen($is_printed) > 0) $sql .= "AND C.is_printed IN ('$is_printed') ";
		$sql .= "ORDER BY C.captured_date DESC, C.start_date, O.organization_name, C.certificate_category, C.is_printed";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$certificates[] = $row;
		}
		return $certificates;
	}
	
	/**
	 * Get period
	 *
	 * @param string invoice_time
	 * @param string period
	 *
 	 * @return period
	 */
	public static function getPeriod($invoice_time, $field = "*") 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$periods = array();
		$period = "";
		
		$sql = "SELECT $field FROM {$table_prefix}period WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND invoice_time = '";
		$sql .= $conn->real_escape_string($invoice_time) . "' ORDER BY invoice_time";
		
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			if ($field === "*") $periods[] = $row;
			else $period = $row->$field;
		}
		if ($field === "*") return $periods;
		else return $period;
	}
}