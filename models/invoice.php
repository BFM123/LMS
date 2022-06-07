<?php
require_once "common.php";
require_once "organization.php";
/**
 * Class invoice
 */
 
class invoice
{
    private $invoice_id;
    private $organization_id;
    private $invoice_number;
    private $fee_category;
    private $TEP_details;
    private $invoice_year;
    private $captured_by;
    private $last_edited_by;
    private $reversed_by;

    /**
     * Get the value of invoice_id
     *
     * @return mixed
     */
    public function getInvoiceID()
    {
        return $this->invoice_id;
    }

    /**
     * Set the value of invoice_id
     *
     * @param mixed invoice_id
     *
     * @return self
     */
    public function setInvoiceID($invoice_id)
    {
        $this->invoice_id = $invoice_id;

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
     * Get the value of fee_category
     *
     * @return mixed
     */
    public function getFeeCategory()
    {
        return $this->fee_category;
    }

    /**
     * Set the value of fee_category
     *
     * @param mixed fee_category
     *
     * @return self
     */
    public function setFeeCategory($fee_category)
    {
        $this->fee_category = $fee_category;

        return $this;
    }
	
    /**
     * Get the value of TEP_details
     *
     * @return mixed
     */
    public function getTEPDetails()
    {
        return $this->TEP_details;
    }

    /**
     * Set the value of TEP_details
     *
     * @param mixed TEP_details
     *
     * @return self
     */
    public function setTEPDetails($TEP_details)
    {
        $this->TEP_details = $TEP_details;

        return $this;
    }
	
    /**
     * Get the value of invoice_year
     *
     * @return mixed
     */
    public function getInvoiceYear()
    {
        return $this->invoice_year;
    }

    /**
     * Set the value of invoice_year
     *
     * @param mixed invoice_year
     *
     * @return self
     */
    public function setInvoiceYear($invoice_year)
    {
        $this->invoice_year = $invoice_year;

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
     * Get the value of reversed_by
     *
     * @return mixed
     */
    public function getReversedBy()
    {
        return $this->reversed_by;
    }

    /**
     * Set the value of reversed_by
     *
     * @param mixed reversed_by
     *
     * @return self
     */
    public function setReversedBy($reversed_by)
    {
        $this->reversed_by = $reversed_by;

        return $this;
    }
	
	/**
	 * Generate invoices
	 * 
	 */
    public function generate()
    {
		global $APPROVAL_STATUS;
		$approved = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
        $table_prefix = TABLE_PREFIX;		

		if (count($this->fee_category) == 0) {
            $_SESSION["message"] = "No fee category specified";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        } elseif (strlen($this->invoice_year) == 0) {
            $_SESSION["message"] = "No invoice year specified";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

		$organization_ids = array();		
		if (empty($this->organization_id)) {
			// organizations are not specified, generate invoices for all registered organizations only
			$organizations = organization::all($organization_id = "", $order_by = "", $district_id = "", $zone_id = "", $region_id = "", $record_control = $approved);	

			$organization_ids = array_column($organizations, "organization_id");	
		} else {
			// organizations are specified, generate invoices for specified organizations only
			$organization_ids = $this->organization_id;
		}
		
		$generate = self::generateInvoice($organization_ids, $this->fee_category, $this->TEP_details,$this->invoice_year, $this->captured_by);	
    }
	
	/**
	 * Get generate invoice SQL string
	 *
	 * @param string organization_ids
	 * @param string fee_categories
	 * @param string TEP_details
	 * @param string invoice_year
	 * @param string captured_by
	 * @param boolean check_if_invoiced
	 * 
	 */
	public static function generateInvoice($organization_ids, $fee_categories, $TEP_details, $invoice_year, $captured_by, $check_if_invoiced = true)
	{
		// set the maximum execution time to be unlimited
		ini_set("max_execution_time", 0);
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$sql = "";
		
		// track whether or not the sql statement header has been generated
		$sql_header_generated = false;
		
		// track number of already invoiced fee categories
		$already_invoiced = 0;
		
		$counter = 0;
		$serial_number = self::generateInvoiceNumber($invoice_year, $get_serial_number = true);
		$total_records = count($organization_ids);
 		$last_invoice_id = "";
 		for ($i = 0; $i < $total_records; $i++) {
			//track whether or not this organization has been included in the query
			$organization_included = false;
			
			//generate invoice number
			$invoice_number = self::generateInvoiceNumber($invoice_year, $get_serial_number = false, $serial_number);
			// store the invoice number in session for use in other pages e.g. when generating TEP processing certificates in models/organization.php
			// and models/licensing_organization.php
			$_SESSION["invoice_number"] = $invoice_number;
			$serial_number++;
			$k = 0;
			for ($j = 0; $j < count($fee_categories); $j++) {
				$fee_category = $fee_categories[$j];
				$invoice_time = common::getFieldValue("fee", "invoice_time", "fee_category", $fee_category);
				$fee_details = "";
				// $currency_original = common::getFieldValue("fee", "currency", "invoice_time", $invoice_time, "fee_category", $fee_category);
				// $exchange_rate = common::getFieldValue("currency", "exchange_rate", "currency", $currency_original);
				// $amount = common::getFieldValue("fee", "amount * $exchange_rate", "invoice_time", $invoice_time, "fee_category", $fee_category);
				if ($invoice_time === INVOICE_TIME_REGISTRATION) {
					// this is an NGO registration...get the organization's annual income
					// wait a minute...infact annual income has no bearing on registration fees so just set the annual income to any number e.g. 0
					// $annual_income = 0;
					$annual_income = common::getFieldValue("organization", "annual_income", "organization_id", $organization_ids[$i]);
				} elseif ($invoice_time === INVOICE_TIME_YEARLY) {
					// this is an annual returns submission...get the organization's annual income from the submitted annual return
					$annual_income = common::getFieldValue("licensing_organization", "annual_income", "organization_id", $organization_ids[$i], "reporting_year", $invoice_year);
				} elseif ($invoice_time === INVOICE_TIME_TEP) {
					// this is a TEP processing certificate request invoicing...set the annual income to any number e.g. 0
					$annual_income = 0;
					
					// don't check for duplicate invoices
					$check_if_invoiced = false;
					
					// include TEP processing certificate request details in the invoice
					//$fee_category .= " - " . $TEP_details[$k];
					$fee_details = $conn->real_escape_string($TEP_details[$k]);
					
					$k++;
				} else {
					// this is an adhoc invoicing...set the annual income to any number e.g. 0
					$annual_income = 0;
				}
				$amount = fee::getFees($invoice_time, $annual_income);
				
				$start_date = certificate::getPeriod($invoice_time, "start_date");		
				if (strlen($start_date) > 0) $start_date = $invoice_year . "-" . $start_date;
				$end_date = certificate::getPeriod($invoice_time, "end_date");		
				if (strlen($end_date) > 0) $end_date = $invoice_year . "-" . $end_date;
				
				// check if this invoice was already generated		
				$is_invoiced = ($check_if_invoiced) ? self::isInvoiced($organization_ids[$i], $fee_category, $start_date, $end_date) : false;
			
				if ($is_invoiced) {
					// this fee category was already invoiced for this organization
					$already_invoiced++;
				} elseif (!$is_invoiced && $amount > 0) {					
					$start_date_sql = (strlen($start_date) > 0) ? "'$start_date'" : "NULL";
					$end_date_sql = (strlen($end_date) > 0) ? "'$end_date'" : "NULL";
			
					if (!$sql_header_generated) {
						$sql .= "INSERT INTO {$table_prefix}invoice (invoice_number, organization_id, fee_category, details, start_date, end_date, invoice_year, amount, due_date,";
						$sql .= "captured_by, captured_date, status) VALUES";
						$sql_header_generated = true;
					}

					$sql .= "('" . $conn->real_escape_string($invoice_number) . "', '" . $conn->real_escape_string($organization_ids[$i]) . "', '";
					$sql .= $conn->real_escape_string($fee_category) . "', '$fee_details', $start_date_sql, $end_date_sql, '" . $conn->real_escape_string($invoice_year) . "', '";
					$sql .= $conn->real_escape_string($amount) . "', DATE_ADD(NOW(), INTERVAL 30 DAY), '" . $conn->real_escape_string($captured_by) . "', NOW(), '";
					$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "'), ";

					$organization_included = true;

					//process in batches of records
					if ($i % BATCH_RECORDS_PROCESS == 0 || $i == ($total_records - 1)) {
						$sql = substr_replace($sql, "", -2); // remove the last 2 characters from the string
						$result = $conn->query($sql);
						$sql = "";
						$sql_header_generated = false;
				
						if  (!$result) {
							$_SESSION["message"] = MESSAGE_ERROR;
							$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
							return;
						} else {
							$last_invoice_id = mysqli_insert_id($conn);
						}
					}
				}
			}			
			if ($organization_included) $counter++;
		}
		
		if ($already_invoiced > 0) {
			// some invoices were already generated			
			$message = "Invoices already generated";
			$message_type = MESSAGE_INFORMATION_TYPE;
			
			if ($already_invoiced == count($fee_categories)) {
				// do nothing...message details already set
			} else {
				$invoiced = count($fee_categories) - $already_invoiced;
				$message = "Generated " . number_format($invoiced, 0) . " invoices. " . number_format($already_invoiced, 0) . " " . strtolower($message);
			}
		} elseif ($counter == 0) {
			$message = "No invoices generated";
			$message_type = MESSAGE_INFORMATION_TYPE;			
		} else {			
			$message = ucwords(MESSAGE_SUCCESS) ."generated ".strtolower(implode(", ",array_unique($fee_categories)))." invoices for ".number_format($counter,0)." organization(s)";
			$message_type = MESSAGE_SUCCESS_TYPE;				
			// store last invoice ID in session
			// $_SESSION["last_invoice_id"] = $last_invoice_id;
		}
		$_SESSION["message"] = $message;
		$_SESSION["message_type"] = $message_type;
		
		// log the user activity
		audit_trail::log_trail("Generate Invoice", $_SESSION["message"], $captured_by, "Invoice", $last_invoice_id);
	}
	
	/**
	 * Generate invoice number
	 *
	 * @param string invoice_year
	 * @param boolean get_serial_number
	 * @param int existing_serial_number
	 *
	 * @return string invoice_number
	 */
	public static function generateInvoiceNumber($invoice_year, $get_serial_number = false, $existing_serial_number = -1)
	{		
		$serial_number = $existing_serial_number;
		
		$prefix  = common::getFieldValue("system", "invoice_number_prefix");

		if ($existing_serial_number == -1) {
			$length = 1 + strlen($prefix);
			$serial_number = common::getFieldValue("invoice", "MAX(SUBSTRING(invoice_number, -" . INVOICE_NUMBER_LENGTH . "))","SUBSTRING(invoice_number,$length,4)",$invoice_year);
			if (strlen($serial_number) == 0) $serial_number = 0;
			$serial_number++;
		}
		
		if ($get_serial_number) return $serial_number;
				
		//add trailing zeros to the serial number
		$number_of_zeros = INVOICE_NUMBER_LENGTH - strlen($serial_number);		
		for ($i = 0; $i < $number_of_zeros; $i++) {
			$serial_number = "0" . $serial_number;
		}
		
		// invoice number has format PREFIX-INVOICE YEAR-SERIAL NUMBER e.g. NGO-2020-00001
		$invoice_number = "$prefix$invoice_year-$serial_number";
		
		return $invoice_number;
	}
	
	/**
	 * check if an invoice was already generated
	 *
	 * @param string organization_id
	 * @param string fee_category
	 * @param string start_date
	 * @param string end_date
	 *
	 * @return true if an invoice was already generated, false otherwise
	 */
	public static function isInvoiced($organization_id, $fee_category = "", $start_date = "", $end_date = "")
	{	
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;	
		
		$is_invoiced = false;									
										
		$sql = "SELECT invoice_id FROM {$table_prefix}invoice WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND organization_id = '";
		$sql .= $conn->real_escape_string($organization_id) . "' ";
		if (strlen($fee_category) > 0) $sql .= "AND fee_category = '$fee_category' ";
		if (strlen($start_date) > 0) $sql .= "AND start_date >= '$start_date' ";
		if (strlen($end_date) > 0) $sql .= "AND end_date <= '$end_date '"; //"AND end_date < DATE_ADD('$end_date', INTERVAL 1 DAY) ";

		$result = $conn->query($sql);		
		while ($row = $result->fetch_object()) {
			$is_invoiced = true;
		}
									
		return $is_invoiced;
	}
	
	/**
   	 * List all invoices
	 *
     * @param string organization_id
     * @param string invoice_year
     * @param string invoice_number
     * @param string search_query
     * @param boolean group
	 * 
	 * @return array of invoices
     */
	public static function all($organization_id = "", $invoice_year = "", $invoice_number = "", $search_query = "", $group = true)
    {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	
		$invoices = array();
		
		$group_concat = "(";
		$sum = "";
		$group_by = "";
        if ($group) {
			$group_concat = "GROUP_CONCAT(DISTINCT";
			$sum = "SUM";
			$group_by = " GROUP BY I.organization_id, I.invoice_number, I.invoice_year ";
		}
		
		$sql = "SELECT I.invoice_id, I.invoice_number, I.invoice_year, I.start_date, I.end_date, I.organization_id, CONCAT(O.organization_name, IF(LENGTH(O.abbreviation)";
		$sql .= " > 0, CONCAT(' (', O.abbreviation, ')'), '')) AS organization_name, O.registration_number, O.registration_year, O.annual_income, O.executive_director_fullname, ";
		$sql .= "O.telephone, O.email, $group_concat I.fee_category) AS fee_category, $sum(I.amount) AS amount, $group_concat F.invoice_time) AS invoice_time, I.captured_date, ";
		$sql .= "I.details FROM {$table_prefix}invoice AS I JOIN {$table_prefix}organization AS O ON I.organization_id = O.organization_id JOIN (SELECT DISTINCT fee_category, ";
		$sql .= "invoice_time FROM {$table_prefix}fee WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) ."') AS F ON I.fee_category = F.fee_category WHERE I.status = '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		
		if (strlen($organization_id) > 0) $sql .= " AND I.organization_id IN ('$organization_id') ";
		if (strlen($invoice_year) > 0) $sql .= " AND I.invoice_year IN ('" .  $conn->real_escape_string($invoice_year) . "') ";
		if (strlen($invoice_number) > 0) $sql .= " AND I.invoice_number IN ('" .  $conn->real_escape_string($invoice_number) . "') ";
		if (strlen($search_query) > 0) $sql .= " AND $search_query";
		$sql .= "$group_by ORDER BY I.captured_date DESC, O.organization_name, I.fee_category, I.invoice_year";

		$result = $conn->query($sql);
		while ($row = $result->fetch_object()) {
			$invoices[] = $row;
		}
		
		return $invoices;
	}
}