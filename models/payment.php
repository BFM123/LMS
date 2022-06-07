<?php
require_once "common.php";
require_once "fee.php";
require_once "organization.php";
require_once "licensing_organization.php";
require_once "tep.php";

/**
 * payment class
 */
class payment
{
  /**
	* declarations 
	*/
	private $payment_id;
    private $organization_id;
    private $invoice_number;
    private $invoice_year;
    private $invoice_time;
    private $receipt_number;
    private $payment_mode;
    private $payment_reference;
    private $payment_amount;
    private $refund_amount;
    private $fee_category;
    private $reverse_details;
    private $payment_mode_items;
	private $invoice_number_prefix;
	private $invoice_number_format;
	private $receipt_number_prefix;
	private $receipt_number_format;
    private $captured_by;
    private $last_edited_by;
    private $deleted_by;
    private $reversed_by;
    private $refunded_by;
    private $record_control;
    private $action;    
	private $level;
	private $request;
    private $status;

    /**
     * Get the value of payment_id
     *
     * @return mixed
     */
    public function getPaymentID()
    {
        return $this->payment_id;
    }

    /**
     * Set the value of payment_id
     *
     * @param mixed payment_id
     *
     * @return self
     */
    public function setPaymentID($payment_id)
    {
        $this->payment_id = $payment_id;

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
     * Get the value of invoice_time
     *
     * @return mixed
     */
    public function getInvoiceTime()
    {
        return $this->invoice_time;
    }

    /**
     * Set the value of invoice_time
     *
     * @param mixed invoice_time
     *
     * @return self
     */
    public function setInvoiceTime($invoice_time)
    {
        $this->invoice_time = $invoice_time;

        return $this;
    }
	
	/**
     * Get the value of receipt_number
     *
     * @return mixed
     */
    public function getReceiptNumber()
    {
        return $this->receipt_number;
    }

    /**
     * Set the value of receipt_number
     *
     * @param mixed receipt_number
     *
     * @return self
     */
    public function setReceiptNumber($receipt_number)
    {
        $this->receipt_number = $receipt_number;

        return $this;
    }

    /**
     * Get the value of payment_mode
     *
     * @return mixed
     */
    public function getPaymentMode()
    {
        return $this->payment_mode;
    }

    /**
     * Set the value of payment_mode
     *
     * @param mixed payment_mode
     *
     * @return self
     */
    public function setPaymentMode($payment_mode)
    {
        $this->payment_mode = $payment_mode;

        return $this;
    }

    /**
     * Get the value of payment_reference
     *
     * @return mixed
     */
    public function getPaymentReference()
    {
        return $this->payment_reference;
    }

    /**
     * Set the value of payment_reference
     *
     * @param mixed payment_reference
     *
     * @return self
     */
    public function setPaymentReference($payment_reference)
    {
        $this->payment_reference = $payment_reference;

        return $this;
    }
	
    /**
     * Get the value of payment_amount
     *
     * @return mixed
     */
    public function getPaymentAmount()
    {
        return $this->payment_amount;
    }

    /**
     * Set the value of payment_amount
     *
     * @param mixed payment_amount
     *
     * @return self
     */
    public function setPaymentAmount($payment_amount)
    {
        $this->payment_amount = $payment_amount;

        return $this;
    }
	
    /**
     * Get the value of refund_amount
     *
     * @return mixed
     */
    public function getRefundAmount()
    {
        return $this->refund_amount;
    }

    /**
     * Set the value of refund_amount
     *
     * @param mixed refund_amount
     *
     * @return self
     */
    public function setRefundAmount($refund_amount)
    {
        $this->refund_amount = $refund_amount;

        return $this;
    }
	
    /**
     * Get the value of currency
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @param mixed currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

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
     * Get the value of reverse_details
     *
     * @return mixed
     */
    public function getReverseDetails()
    {
        return $this->reverse_details;
    }
 
    /**
     * Set the value of reverse_details
     *
     * @param mixed reverse_details
     *
     * @return self
     */
    public function setReverseDetails($reverse_details)
    {
        $this->reverse_details = $reverse_details;

        return $this;
    }

 	/**
     * Get the value of payment_mode_items
     *
     * @return mixed
     */
    public function getPaymentModesItems()
    {
        return $this->payment_mode_items;
    }
 
    /**
     * Set the value of payment_mode_items
     *
     * @param mixed payment_mode_items
     *
     * @return self
     */
    public function setPaymentModesItems($payment_mode_items)
    {
        $this->payment_mode_items = $payment_mode_items;

        return $this;
    }

	/**
     * Get the value of invoice_number_prefix
     *
     * @return mixed
     */
    public function getInvoiceNumberPrefix()
    {
        return $this->invoice_number_prefix;
    }
 
    /**
     * Set the value of invoice_number_prefix
     *
     * @param mixed invoice_number_prefix
     *
     * @return self
     */
    public function setInvoiceNumberPrefix($invoice_number_prefix)
    {
        $this->invoice_number_prefix = $invoice_number_prefix;

        return $this;
    }
	/**
     * Get the value of invoice_number_format
     *
     * @return mixed
     */
    public function getInvoiceNumberFormat()
    {
        return $this->invoice_number_format;
    }
 
    /**
     * Set the value of invoice_number_format
     *
     * @param mixed invoice_number_format
     *
     * @return self
     */
    public function setInvoiceNumberFormat($invoice_number_format)
    {
        $this->invoice_number_format = $invoice_number_format;

        return $this;
    }

	/**
     * Get the value of receipt_number_prefix
     *
     * @return mixed
     */
    public function getReceiptNumberPrefix()
    {
        return $this->receipt_number_prefix;
    }
 
    /**
     * Set the value of receipt_number_prefix
     *
     * @param mixed receipt_number_prefix
     *
     * @return self
     */
    public function setReceiptNumberPrefix($receipt_number_prefix)
    {
        $this->receipt_number_prefix = $receipt_number_prefix;

        return $this;
    }
	/**
     * Get the value of receipt_number_format
     *
     * @return mixed
     */
    public function getReceiptNumberFormat()
    {
        return $this->receipt_number_format;
    }
 
    /**
     * Set the value of receipt_number_format
     *
     * @param mixed receipt_number_format
     *
     * @return self
     */
    public function setReceiptNumberFormat($receipt_number_format)
    {
        $this->receipt_number_format = $receipt_number_format;

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
     * Get the value of refunded_by
     *
     * @return mixed
     */
    public function getRefundedBy()
    {
        return $this->refunded_by;
    }

    /**
     * Set the value of refunded_by
     *
     * @param mixed refunded_by
     *
     * @return self
     */
    public function setRefundedBy($refunded_by)
    {
        $this->refunded_by = $refunded_by;

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
     * Get the value of level
     *
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the value of level
     *
     * @param mixed level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }
	
	/**
     * Get the value of request
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the value of request
     *
     * @param mixed request
     *
     * @return self
     */
    public function setRequest($request)
    {
        $this->request = $request;

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
     * Make payment
	 *
     */
    public function pay()
	{
		global $APPROVAL_STATUS;
		$approved = array_keys($APPROVAL_STATUS)[2];
		$awaiting_payment_processing = array_keys($APPROVAL_STATUS)[3];
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		if ($this->payment_amount <= 0) {											
			$_SESSION["message"] = "Payment amount should be greater than 0";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$exists = common::exists("payment", 0, "payment_reference", $this->payment_reference);
		
		if ($exists) {											
			$_SESSION["message"] = "Payment reference '$this->payment_reference'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$receipt_number = payment::generateReceiptNumber();
		$payment = "$this->currency " . number_format($this->payment_amount, 2 ) . " > $this->payment_mode > $receipt_number";
		$is_reversible = "Yes";		
		
		$sql = "INSERT INTO {$table_prefix}payment (invoice_number, payment_mode, payment_reference, amount, receipt_number, is_reversible, record_control, captured_by, ";
		$sql .= "captured_date, status) VALUES('" . $conn->real_escape_string($this->invoice_number) . "', '" . $conn->real_escape_string($this->payment_mode) . "', '";
		$sql .= $conn->real_escape_string($this->payment_reference) . "', '" . $conn->real_escape_string($this->payment_amount) . "', '";
		$sql .= $conn->real_escape_string($receipt_number) . "', '" . $conn->real_escape_string($is_reversible) . "', '" . $conn->real_escape_string($approved) . "', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE). "')";
		
		$result = $conn->query($sql);
		if ($result) {
			$message = "Payment of '$payment' has been made" . MESSAGE_SUCCESS;
			$message_type = MESSAGE_SUCCESS_TYPE;
			$invoice_times = explode(",", $this->invoice_time);

			// if ($this->invoice_time === INVOICE_TIME_REGISTRATION || $this->invoice_time === INVOICE_TIME_YEARLY) {
			if (in_array(INVOICE_TIME_REGISTRATION, $invoice_times) || in_array(INVOICE_TIME_YEARLY, $invoice_times) || in_array(INVOICE_TIME_TEP, $invoice_times)) {
				// this is payment for a registration, annual license or TEP processing certificate invoice, check if invoice is paid in full and automatically approve 
				// the organization		
				$fees = array_unique(array_column(fee::all(implode ("', '", $invoice_times)), "fee_category"));
				$invoice_amount = common::getFieldValue("invoice", "SUM(amount)", "invoice_number", $this->invoice_number, "organization_id", $this->organization_id,
														"fee_category IN ('" . implode ("', '", $fees) . "') AND '1'", "1");
				$amount_paid = common::getFieldValue("payment", "SUM(amount)", "invoice_number", $this->invoice_number, "record_control", $approved);
					
				if ($amount_paid >= $invoice_amount) {
					// registration fee or annual license fee or TEP processing certificate fee is paid in full...automatically approve the organization
					$organization_name = common::getFieldValue("organization", "organization_name", "organization_id", $this->organization_id);
					
					$is_registration = false;
					$is_annual_return = false;
					$is_tep_request = false;
					
					if (in_array(INVOICE_TIME_REGISTRATION, $invoice_times)) {
						$entity = "organization";
						$message_temp = "registration";
					} elseif (in_array(INVOICE_TIME_YEARLY, $invoice_times)) {
						$entity = "licensing_organization";
						$message_temp = "licensing";
						$is_annual_return = true;						
					} elseif (in_array(INVOICE_TIME_TEP, $invoice_times)) {
						$entity = "tep";
						$message_temp = "TEP processing certificate request";
						$is_tep_request = true;
					}
					
					$organizations = new $entity();
					$organizations->setOrganizationID($this->organization_id);
					$organizations->setApprovedBy($this->captured_by);
					$organizations->setOrganizationName($organization_name);
					$organizations->setRecordControl($awaiting_payment_processing);
					
					if ($is_annual_return) {
						$licensing_organization_id = common::getFieldValue("licensing_organization", "licensing_organization_id", "organization_id", $this->organization_id,
																		   "reporting_year", $this->invoice_year);
						$organizations->setLicensingOrganizationID($licensing_organization_id);	
						$organizations->setReportingYear($this->invoice_year);						
					}
					
					if ($is_tep_request) {
						$organizations->setInvoiceNumber($this->invoice_number);
					}			
					$organizations->setAction("approve");					
					$organizations->approve();
	
					$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
					$payment_processed = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
					
					if (!$payment_processed) {					
						$message = trim($message) . ", but the organization could not be cleared for " . $message_temp;
						$message_type = MESSAGE_INFORMATION_TYPE;
					}
					
					// approve certificates
					if (in_array(INVOICE_TIME_TEP, $invoice_times) && !$is_tep_request) {
						// firstly, approve the TEP requests again just incase we missed this step when approving the registration/annual license above
						// it is possible this step may have been missed because the checks for whether the transaction is a registration, annual license or TEP request above
						// are mutually exclusive...this will usually happen if the request if for registration or annual license 
						$tep = new tep();
						$tep->setOrganizationID($this->organization_id);
						$tep->setApprovedBy($this->captured_by);
						$tep->setOrganizationName($organization_name);
						$tep->setRecordControl($awaiting_payment_processing);
						$tep->setInvoiceNumber($this->invoice_number);
						$tep->setIsRegistrationOrLicensing("Yes"); // this is to ensure that TEP approval process does not generate emails to requestor
						$tep->setAction("approve");					
						$tep->approve();
						// no need to check if this was successful
					}
					
					// then approve the certificates
					$message_temp = "certificate requests";
					
					$certificates = new certificate();		
					$certificates->setOrganizationID($this->organization_id);
					$certificates->setApprovedBy($this->captured_by);
					$certificates->setInvoiceNumber($this->invoice_number);	
					$certificates->approve();
	
					$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
					$payment_processed = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
					
					if (!$payment_processed) {					
						$message = trim($message) . ". The organization could not be cleared for " . $message_temp;
						$message_type = MESSAGE_INFORMATION_TYPE;
					} 
				}
			}
				
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = $message_type;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		$payment_id = mysqli_insert_id($conn);
		
		// log the user activity
		audit_trail::log_trail("Pay", $_SESSION["message"], $this->captured_by, "Payment", $payment_id);
	}
	
    /**
     * Reverse payment
	 *
     */
    public function reverse()
	{
		global $APPROVAL_STATUS;
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[0];
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$reverse_details = explode("|", $this->reverse_details);
		$payment_id = $reverse_details[0];
		$payment = $reverse_details[1];
			
		if (strlen($payment_id) == 0) {											
			$_SESSION["message"] = "No reversal amount selected";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$is_reversible = "No";
		$reversal_reason = "CONCAT('Reversal for receipt #: ', receipt_number, ' > Reason: " . $conn->real_escape_string($this->payment_reference) . "')";
		
		$sql = "INSERT INTO {$table_prefix}payment (invoice_number, payment_mode, payment_reference, amount, receipt_number, is_reversible, record_control, captured_by,";
		$sql .= "captured_date, reversed_by, reversed_date, status) SELECT invoice_number, payment_mode, $reversal_reason, -1 * amount, receipt_number, '";
		$sql .= $conn->real_escape_string($is_reversible) . "', '".$conn->real_escape_string($awaiting_approval_level1)."', '".$conn->real_escape_string($this->reversed_by)."', ";
		$sql .= "NOW(), '" . $conn->real_escape_string($this->reversed_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE). "' FROM {$table_prefix}payment WHERE ";
		$sql .= "payment_id = '" . $conn->real_escape_string($payment_id) . "' AND invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$sql = " UPDATE {$table_prefix}payment SET is_reversible = '" . $conn->real_escape_string($is_reversible) . "', last_edited_by = '";
			$sql .= $conn->real_escape_string($this->reversed_by) . "', last_edited_date = NOW() WHERE payment_id = '" . $conn->real_escape_string($payment_id) . "' AND ";
			$sql .= "invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "'";

			$result = $conn->query($sql);
			$message = "Reversal of payment of '$payment' has been submitted for approval" . MESSAGE_SUCCESS;
			$message_type = MESSAGE_SUCCESS_TYPE;

			if (!$result) {					
				$message = trim($message) . ", but the original transaction could not be updated";
				$message_type = MESSAGE_INFORMATION_TYPE;
			}
			
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = $message_type;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Reverse", $_SESSION["message"], $this->reversed_by, "Payment", $payment_id);
	}
	
	/**
     * Refund payment
	 *
     */
    public function refund()
	{
		global $APPROVAL_STATUS;
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[0];
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		if ($this->refund_amount <= 0) {											
			$_SESSION["message"] = "Refund amount should be greater than 0";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$refund = "$this->currency " . number_format($this->refund_amount, 2 ) . " > $this->payment_reference > $this->invoice_number";
		$receipt_number = "";
		$payment_mode = "Refund";
		$is_reversible = "No";
		$refund_amount = -1 * $this->refund_amount;
		$refund_reason = "Refund: $this->payment_reference";
		$awaiting_approval_level1 = "0";
		
		$sql = "INSERT INTO {$table_prefix}payment (invoice_number, payment_mode, payment_reference, amount, receipt_number, is_reversible, record_control, ";
		$sql .= "captured_by, captured_date, refunded_by, refunded_date, status) VALUES('" . $conn->real_escape_string($this->invoice_number) . "', '";
		$sql .= $conn->real_escape_string($payment_mode) . "', '" . $conn->real_escape_string($refund_reason) . "', '" . $conn->real_escape_string($refund_amount) . "', '";
		$sql .= $conn->real_escape_string($receipt_number) . "', '" . $conn->real_escape_string($is_reversible) . "', '";
		$sql .= $conn->real_escape_string($awaiting_approval_level1) . "', '" . $conn->real_escape_string($this->refunded_by) . "', NOW(), '";
		$sql .= $conn->real_escape_string($this->refunded_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Refund of '$refund' has been submitted for approval" . MESSAGE_SUCCESS;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}		
		$payment_id = mysqli_insert_id($conn);

		// log the user activity
		audit_trail::log_trail("Refund", $_SESSION["message"], $this->refunded_by, "Payment", $payment_id);
	}
	
	/**
     * Reject/approve/delete payment refund/reversal
	 *
     */
    public function approval()
	{
		global $APPROVAL_STATUS;
		$awaiting_approval_level2 = array_keys($APPROVAL_STATUS)[1];
		$approved = array_keys($APPROVAL_STATUS)[2];
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	
		$sql = "UPDATE {$table_prefix}payment SET ";
		$this_record_control = $this->record_control;
		$next_record_control = $this_record_control + 1;
		$level_str = "";
		
		if ($this->action === "approve") {
			$level_str = " (Level $this->level)";
			if ($this->level == $awaiting_approval_level2) {
				$action_comments = "authorizer_comments";
				$action_by = "authorized_by";
				$action_date = "authorized_date";
			} elseif ($this->level == $approved) {
				$action_comments = "approval_comments";
				$action_by = "approved_by";
				$action_date = "approved_date";		
			}
			$sql .= "$action_comments = '" . $conn->real_escape_string($this->payment_reference) . "', $action_by = '" . $conn->real_escape_string($this->captured_by) . "', ";
			$sql .= "$action_date = NOW(), record_control = '" . $conn->real_escape_string($next_record_control) . "' ";	
			$action_str = "approved";	
		} elseif ($this->action === "reject") {			
			$sql .= "reject_comments = '" . $conn->real_escape_string($this->payment_reference) . "', rejected_by = '" . $conn->real_escape_string($this->captured_by) . "', ";
			$sql .= "rejected_date = NOW(), status = '" . $conn->real_escape_string(STATUS_REJECTED) . "' ";	
			$action_str = STATUS_REJECTED;	
		} elseif ($this->action === "delete") {			
			$sql .= "deleted_by = '" . $conn->real_escape_string($this->captured_by) . "', deleted_date = NOW(), status = '" . $conn->real_escape_string(STATUS_DELETED) . "' ";	
			$action_str = STATUS_DELETED;	
		}
		$sql .= "WHERE payment_id = '" . $conn->real_escape_string($this->payment_id) . "' AND invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "' AND ";
		$sql .= "record_control = '" . $conn->real_escape_string($this_record_control) . "'";
		
		$transaction_details = common::getFieldValue("payment", "CONCAT('$this->currency ', FORMAT(amount, 2), ' > ', payment_mode, ' > ', payment_reference)", "invoice_number", 
													$this->invoice_number, "payment_id", $this->payment_id);				
		$result = $conn->query($sql);
		if ($result) {
			$message = "Payment " . strtolower($this->request) . " request '$transaction_details' has been $action_str" . MESSAGE_SUCCESS . $level_str;
			$message_type = MESSAGE_SUCCESS_TYPE;
			
			if (in_array($this->action, array("reject", "delete")) && $this->request === "Reversal") {
				// reversal was rejected or deleted set reversal flag back to Yes
				$is_reversible = "Yes";

				$sql = " UPDATE {$table_prefix}payment SET is_reversible = '" . $conn->real_escape_string($is_reversible) . "', last_edited_by = '";
				$sql .= $conn->real_escape_string($this->captured_by) . "', last_edited_date = NOW() WHERE receipt_number = '" . $conn->real_escape_string($this->receipt_number);
				$sql .= "' AND invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "' AND payment_id <> '" . $conn->real_escape_string($this->payment_id);
				$sql .= "' AND amount > 0";

				$result = $conn->query($sql);			
			
				if (!$result) {					
					$message = trim($message) . ", but the original transaction could not be updated";
					$message_type = MESSAGE_INFORMATION_TYPE;
				}
			}
			
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = $message_type;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail(ucwords($this->action), $_SESSION["message"], $this->captured_by, "Payment", $this->payment_id);
	}
	
 	/**
	 * List all payments
	 *
	 * @param string invoice_number
	 * @param string is_reversible
	 * @param string order_by
	 * @param string record_control
	 *
 	 * @return array of payments
	 */
	public static function all($invoice_number = "", $is_reversible = "", $order_by = "", $record_control = "2")
	{	
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	   
		$payments = array();
		$sql = "SELECT * FROM {$table_prefix}payment WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND record_control = '";
		$sql .= $conn->real_escape_string($record_control) . "' ";
		if (strlen($invoice_number) > 0) $sql .= "AND invoice_number = '" . $conn->real_escape_string($invoice_number) . "' ";
		if (strlen($is_reversible) > 0) $sql .= "AND is_reversible = '" . $conn->real_escape_string($is_reversible) . "' ";
		if (strlen($order_by) > 0) $sql .= "ORDER BY " . $conn->real_escape_string($order_by);
		else $sql .= "ORDER BY captured_date DESC, receipt_number DESC";
		
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$payments[] = $row;
		}
		return $payments;
	}
	
	/**
	 * Generate receipt number
	 *
	 * @return string receipt_number
	 */
	public static function generateReceiptNumber()
	{		
		$receipt_year = date("Y");
		
		$prefix  = common::getFieldValue("system", "receipt_number_prefix");

		$length = 1 + strlen($prefix);
		$serial_number = common::getFieldValue("payment", "MAX(SUBSTRING(receipt_number, -" . RECEIPT_NUMBER_LENGTH . "))", "SUBSTRING(receipt_number, $length, 4)",$receipt_year);
		if (strlen($serial_number) == 0) $serial_number = 0;
		$serial_number++;
						
		//add trailing zeros to the serial number
		$number_of_zeros = INVOICE_NUMBER_LENGTH - strlen($serial_number);		
		for ($i = 0; $i < $number_of_zeros; $i++) {
			$serial_number = "0" . $serial_number;
		}
		
		// receipt number has format PREFIX-INVOICE YEAR-SERIAL NUMBER e.g. NGO-R-2020-00001
		$receipt_number = "$prefix$receipt_year-$serial_number";
		
		return $receipt_number;
	}
	
	/**
	 * List payment modes
	 *
	 * @return array of payment modes
	 */
	public static function getPaymentModes()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	   
		$payment_modes = array();
		$sql = "SELECT payment_mode_id, payment_mode FROM {$table_prefix}payment_mode WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY payment_mode";

		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$payment_modes[] = $row;
		}
		return $payment_modes;
	}
	
	/**
   	 * Display statements
	 *
     * @param school_code
     * @param registration_number
     * @param semester_code
     * @param record_control
     * @param search_query
     * @param limit
     * @param field_out
	 *
	 * @return array of statements
     *
	public static function getStatements($school_code, $registration_number = "", $semester_code = "", $record_control = "2", $search_query = "", $limit = "", $field_out = "*")
    {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	
		$statements = array();

		$sql = "SELECT $field_out FROM (";
		$sql .= "SELECT registration_number, 'invoice' AS transaction_type, captured_date AS order_date,DATE_FORMAT(captured_date,'%d %b %Y') AS transaction_date,invoice_number ";
		$sql .= "AS reference, semester_code, fee_category AS description, amount, school_code FROM {$table_prefix}invoice WHERE school_code = '$school_code' AND status = '";
		$sql .= STATUS_ACTIVE . "' "; 
		if (strlen($registration_number) > 0) $sql .= "AND registration_number IN ('$registration_number') ";
		if (strlen($semester_code) > 0) $sql .= "AND semester_code IN ('$semester_code') ";
		$sql .= "UNION SELECT I.registration_number AS registration_number, 'payment' AS transaction_type, IF(P.payment_mode = 'Refund', P.refunded_date, IF (P.amount < 0, ";  		
		$sql .= "P.reversed_date, P.captured_date)) AS order_date,IF(P.payment_mode='Refund',DATE_FORMAT(P.refunded_date,'%d %b %Y'),IF(P.amount<0, DATE_FORMAT(P.reversed_date,'";
		$sql .= "%d %b %Y'), DATE_FORMAT(P.captured_date,  '%d %b %Y')))AS transaction_date, IF (P.amount < 0, '', CONCAT(P.receipt_number, ' > Ref: ', p.payment_reference)) AS ";
		$sql .= "reference, I.semester_code AS semester_code, IF(P.amount < 0, P.payment_reference, 'Payment') AS reference, P.amount AS amount, I.school_code AS school_code ";
		$sql .= "FROM {$table_prefix}invoice AS ";
		$sql .= "I, {$table_prefix}payment AS P WHERE I.school_code = '$school_code' AND I.status = '" . STATUS_ACTIVE . "' AND I.invoice_number = P.invoice_number AND ";
		$sql .= "I.school_code = P.school_code AND P.status = '" . STATUS_ACTIVE . "' AND P.record_control = '$record_control' ";
		if (strlen($registration_number) > 0) $sql .= "AND I.registration_number IN ('$registration_number') ";
		if (strlen($semester_code) > 0) $sql .= "AND I.semester_code IN ('$semester_code') ";
		$sql .= "ORDER BY order_date";
        $sql .= ") AS statement ";
        if (strlen($search_query) > 0) {
			// if (!common::startsWith($search_query, "#STARTS WITH EXTRA QUERY")) $sql .= "WHERE ";
			if (common::startsWith($search_query, COMMON_PLACEHOLDER)) 
				$search_query = str_replace(COMMON_PLACEHOLDER, "", $search_query);
			else
				$sql .= "WHERE ";
				
			$sql .= "$search_query ";
		}
		
		if (strlen($limit) > 0) $sql .= " LIMIT $limit ";

		$result = $conn->query($sql);
		while ($row = $result->fetch_object()) {
		    if ($field_out === "*" || strpos($sql, "GET ALL RECORDS") !== false)
            	$statements[] = $row;
			else
				$statements = $row->field_value;
		}
		
		return $statements;
	}
	
	/**
   	 * Display payment items awaiting approval
	 *
     * @param string record_control
     * @param string requestor
     * 
	 * @return array of payment items awaiting approval
     */
	public static function getApprovals($record_control, $requestor)
    {
		global $APPROVAL_STATUS;
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[0];
		$awaiting_approval_level2 = array_keys($APPROVAL_STATUS)[1];
		$awaiting_approval_level1_str = $APPROVAL_STATUS[$awaiting_approval_level1 + 1];
		$awaiting_approval_level2_str = $APPROVAL_STATUS[$awaiting_approval_level2 + 1];;
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	
		$approvals = array();
		
		$request = "IF(P.payment_mode = 'Refund', 'Refund', 'Reversal') AS request";
		$order_date = "IF(P.payment_mode = 'Refund', P.refunded_date, P.reversed_date) AS order_date";
		$requested_date = "IF(P.payment_mode = 'Refund', P.refunded_date, P.reversed_date) AS requested_date";
		$requested_by = "IF(P.payment_mode = 'Refund', P.refunded_by, P.reversed_by) AS requested_by";
		$request_status = "IF(P.status = '" . $conn->real_escape_string(STATUS_REJECTED) . "', '" . $conn->real_escape_string(ucwords(STATUS_REJECTED)) . "', ";
		$request_status .= "IF(P.record_control = '" . $conn->real_escape_string($awaiting_approval_level1) . "', '";
		$request_status .=  $conn->real_escape_string($awaiting_approval_level1_str) . "', '" . $conn->real_escape_string($awaiting_approval_level2_str) . "')) AS request_status";
		
		// if the user is either level 1 or level 2 approver
		$sql_temp = "AND P.status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND P.record_control = '" . $conn->real_escape_string($record_control) . "' ";
			
		if ($record_control == -1) {
			// else user is a requestor tracking status of requests
			$sql_temp = "AND P.status IN ('" . STATUS_ACTIVE . "', '" . STATUS_REJECTED . "') AND P.record_control IN ('" . $conn->real_escape_string($awaiting_approval_level1);
			$sql_temp .= "', '" . $conn->real_escape_string($awaiting_approval_level2) . "') AND IF(P.payment_mode = 'Refund', P.refunded_by, P.reversed_by) = '";
			$sql_temp .= $conn->real_escape_string($requestor) . "' ";			
		}
		
		$sql = "SELECT DISTINCT $request, P.payment_id AS payment_id, P.invoice_number AS invoice_number, I.organization_id AS organization_id, P.receipt_number AS ";
		$sql .= "receipt_number, P.payment_mode AS payment_mode, P.payment_reference AS reason, $requested_date, $order_date, $requested_by, $request_status, -1 * P.amount AS ";
		$sql .= "amount, P.authorizer_comments AS authorizer_comments, P.authorized_date AS authorized_date, P.authorized_by AS authorized_by, ";
		$sql .= "P.reject_comments AS reject_comments, P.rejected_date AS rejected_date, P.rejected_by AS rejected_by, P.record_control AS record_control, ";
		$sql .= "O.registration_number, O.registration_year, CONCAT(O.organization_name, IF(LENGTH(O.abbreviation) > 0, CONCAT(' (', O.abbreviation, ')'), '')) AS ";
		$sql .= "organization_name FROM {$table_prefix}payment AS P JOIN {$table_prefix}invoice AS I ON P.invoice_number = I.invoice_number JOIN {$table_prefix}organization AS ";
		$sql .= "O ON I.organization_id = O.organization_id WHERE I.status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' $sql_temp ORDER BY order_date DESC";

		$result = $conn->query($sql);
		while ($row = $result->fetch_object()) {
			$approvals[] = $row;
		}
		
		return $approvals;
	}
	
	/**
   	 * Format large number 
	 *
     * @param string number
     * @param int decimal_places
     * 
	 * @return string formatted_number
     */
	public static function formatLargeNumber($number, $decimal_places = 0) {
		$formatted_number = number_format($number, $decimal_places);
		
		if ($number >= 1000000000000)
			$formatted_number = number_format($number / 1000000000000, $decimal_places) . " trillion";
		elseif ($number >= 1000000000)
			$formatted_number = number_format($number / 1000000000, $decimal_places) . " billion";
		elseif ($number >= 1000000)
			$formatted_number = number_format($number / 1000000, $decimal_places) . " million";
		
		return $formatted_number;
	}
	
	/**
     * Add/update payment settings
	 *
     */
    public function payment_settings()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$payment_mode_id = "";
	
		if (strlen($this->payment_mode_items) == 0) {
			$_SESSION["message"] = "Please enter payment modes";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		} else {		
			$payment_modes  = explode("|", $this->payment_mode_items);
			$payment_mode_ids = "";
			
			for ($i = 0; $i < count($payment_modes); $i++) {
				$pos = strpos($payment_modes[$i], "][");
				$payment_mode_id = trim(substr($payment_modes[$i], 0, $pos));
				$payment_mode = trim(substr($payment_modes[$i], $pos + 2));

				if (strlen($payment_mode) > 0) {						
					if (strlen($payment_mode_id) > 0) {
						// this is an existing payment mode, update the payment mode
						$sql = "UPDATE {$table_prefix}payment_mode SET payment_mode = '" . $conn->real_escape_string($payment_mode) . "', last_edited_by = '";
						$sql .= $conn->real_escape_string($this->captured_by) . "', last_edited_date = NOW() WHERE payment_mode_id = '";
						$sql .= $conn->real_escape_string($payment_mode_id) . "' AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
					} else {
						// this is a new payment mode, create the payment mode
						$sql = "INSERT INTO {$table_prefix}payment_mode (payment_mode, captured_by, captured_date, status) ";
						$sql .= "VALUES ('" . $conn->real_escape_string($payment_mode) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '";
						$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";
					}
				
					$result = $conn->query($sql);

					if (strlen($payment_mode_id) == 0) $payment_mode_id = mysqli_insert_id($conn);					
					$payment_mode_ids .= "$payment_mode_id', '";
				}
			}
			
			// delete all payment modes that are not on this list
			if (strlen($payment_mode_ids) > 0) $payment_mode_ids = substr_replace($payment_mode_ids, "", -4); // remove the last 4 characters from the string
	
			$sql = "UPDATE {$table_prefix}payment_mode SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($this->captured_by) . "', deleted_date = NOW() WHERE payment_mode_id NOT IN ('$payment_mode_ids') AND status = '";
			$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "'";
			
			$result = $conn->query($sql);			
		}
		
		if (!$result) {
			// error 
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			return;			
		} else {
			// successfully added paymode modes			
			$message = "Modes of payment" . MESSAGE_SUCCESS . "added";
			
			// log the user activity
			audit_trail::log_trail("Update", $message, $this->captured_by, "Payment Mode", $payment_mode_id);
					
			// define receipt and invoice number formats
			$sql = "UPDATE {$table_prefix}system SET invoice_number_prefix = '" . $conn->real_escape_string($this->invoice_number_prefix) . "', invoice_number_format = '";
			$sql .= $conn->real_escape_string($this->invoice_number_format) . "', receipt_number_prefix = '";
			$sql .= $conn->real_escape_string($this->receipt_number_prefix) . "', receipt_number_format = '";
			$sql .= $conn->real_escape_string($this->receipt_number_format) . "', last_edited_by = '" .$conn->real_escape_string($this->captured_by)."', last_edited_date = NOW()";
		
			$result = $conn->query($sql);			

			if ($result) {					
				$log_message = "Invoice and receipt number formats" . MESSAGE_SUCCESS . "added";
				$message = "Fee settings" . MESSAGE_SUCCESS . "added";
				$message_type = MESSAGE_SUCCESS_TYPE;
						
			} else {
				$message .= ", but could not save invoice and receipt number formats: " . strtolower(MESSAGE_ERROR);
				$log_message = $message;
				$message_type = MESSAGE_INFORMATION_TYPE;
			}
		}
		$_SESSION["message"] = $message;
		$_SESSION["message_type"] = $message_type;

		// log the user activity
		audit_trail::log_trail("Update", $log_message, $this->captured_by, "System", 0);
	}
}