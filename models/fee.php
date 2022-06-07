<?php
require_once "common.php";

/**
 * fee class
 */
class fee
{
   /**
	* declarations 
	*/
	private $fee_id;
    private $fee_category;
    private $invoice_time;
    private $based_on_income;
    private $from_income;
    private $to_income;
    private $currency;
    private $amount;
    private $captured_by;
    private $last_edited_by;
    private $deleted_by;
    private $status;

    /**
     * Get the value of fee_id
     *
     * @return mixed
     */
    public function getFeeID()
    {
        return $this->fee_id;
    }

    /**
     * Set the value of fee_id
     *
     * @param mixed fee_id
     *
     * @return self
     */
    public function setFeeID($fee_id)
    {
        $this->fee_id = $fee_id;

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
     * Get the value of based_on_income
     *
     * @return mixed
     */
    public function getBasedOnIncome()
    {
        return $this->based_on_income;
    }

    /**
     * Set the value of based_on_income
     *
     * @param mixed based_on_income
     *
     * @return self
     */
    public function setBasedOnIncome($based_on_income)
    {
        $this->based_on_income = $based_on_income;

        return $this;
    }
	/**
     * Get the value of from_income
     *
     * @return mixed
     */
    public function getFromIncome()
    {
        return $this->from_income;
    }

    /**
     * Set the value of from_income
     *
     * @param mixed from_income
     *
     * @return self
     */
    public function setFromIncome($from_income)
    {
        $this->from_income = $from_income;

        return $this;
    }
	/**
     * Get the value of to_income
     *
     * @return mixed
     */
    public function getToIncome()
    {
        return $this->to_income;
    }

    /**
     * Set the value of to_income
     *
     * @param mixed to_income
     *
     * @return self
     */
    public function setToIncome($to_income)
    {
        $this->to_income = $to_income;

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
     * Get the value of amount
     *
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @param mixed amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

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
     * Add fee
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::getFieldValue("fee", "fee_id", "fee_category", $this->fee_category, "invoice_time", $this->invoice_time, "based_on_income", $this->based_on_income, 
										"from_income", $this->from_income, "to_income", $this->to_income);										
		if ($exists) {											
			$_SESSION["message"] = "Fee '$this->fee_category'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$sql = "INSERT INTO {$table_prefix}fee (fee_category, invoice_time, based_on_income, from_income, to_income, currency, amount, captured_by, captured_date,status) VALUES('";
		$sql .= $conn->real_escape_string($this->fee_category) . "', '". $conn->real_escape_string($this->invoice_time) . "', '";
		$sql .= $conn->real_escape_string($this->based_on_income) . "', '" . $conn->real_escape_string($this->from_income) . "', '";
		$sql .= $conn->real_escape_string($this->to_income) . "', '". $conn->real_escape_string($this->currency) . "', '";
		$sql .= $conn->real_escape_string($this->amount) . "', '". $conn->real_escape_string($this->captured_by) . "', NOW(), '". $conn->real_escape_string(STATUS_ACTIVE) . "')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Fee '$this->fee_category'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		$fee_id = mysqli_insert_id($conn);
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Fee", $fee_id);
	}
	
	/**
	 * Edit fee
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::getFieldValue("fee", "fee_id", "fee_category", $this->fee_category, "invoice_time", $this->invoice_time, "based_on_income", $this->based_on_income, 
										"from_income", $this->from_income, "to_income", $this->to_income, "fee_id <> '$this->fee_id' AND '1'", "1");		
		if ($exists) {											
			$_SESSION["message"] = "Fee '$this->fee_category'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "UPDATE {$table_prefix}fee SET fee_category = '". $conn->real_escape_string($this->fee_category) . "', invoice_time = '";
		$sql .= $conn->real_escape_string($this->invoice_time) . "', based_on_income = '". $conn->real_escape_string($this->based_on_income) . "', from_income = '";
		$sql .= $conn->real_escape_string($this->from_income) . "', to_income = '". $conn->real_escape_string($this->to_income) . "', currency = '";
		$sql .= $conn->real_escape_string($this->currency) . "', amount = '" . $conn->real_escape_string($this->amount) . "', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE fee_id = '". $conn->real_escape_string($this->fee_id) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Fee '$this->fee_category'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Fee", $this->fee_id);
	}
	
	/**
	 * Delete fee
	 * 
	 */
	public function delete()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		
		$in_use = false;//common::getFieldValue("invoice", "invoice_id", "fee_category", $this->fee_category);
		
		if ($in_use) {											
			$_SESSION["message"] = "Fee '$this->fee_category'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "UPDATE {$table_prefix}fee SET status = '". $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '". $conn->real_escape_string($this->deleted_by) . "', ";
		$sql .= "deleted_date = NOW() WHERE fee_id = '". $conn->real_escape_string($this->fee_id) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Fee '$this->fee_category'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Fee", $this->fee_id);
	}	
	
	/**
	 * List invoice times
	 *
 	 *
	 * @return array of invoice times
	 */
	public static function getInvoiceTimes()
	{
		$invoice_time = array(INVOICE_TIME_REGISTRATION, INVOICE_TIME_YEARLY, INVOICE_TIME_TEP, INVOICE_TIME_ADHOC);
		return $invoice_time;
	}
	
 	/**
	 * List all fees
	 *
 	 * @param string invoice_time
 	 * @param string fee_category
 	 * @param string fields
 	 * @param boolean order
 	 *
	 * @return array of fees
	 */
	public static function all($invoice_time = "", $fee_category = "", $fields = "F.*", $order = true)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$fees = array();		
		
		$sql = "SELECT $fields FROM {$table_prefix}fee AS F JOIN {$table_prefix}currency AS C ON F.currency = C.currency WHERE F.status = '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "' AND C.status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($invoice_time) > 0) $sql .= "AND F.invoice_time IN ('$invoice_time') ";
		if (strlen($fee_category) > 0) $sql .= "AND F.fee_category IN ('$fee_category') ";
		if ($order) $sql .= "ORDER BY F.fee_category, F.from_income * 1, F.to_income * 1, F.amount * 1";

		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$fees[] = $row;
		}
		return $fees;
	}
	
 	/**
	 * get fees
	 *
 	 * @param string invoice_time
 	 * @param double annual_income
 	 *
	 * @return fees
	 */
	public static function getFees($invoice_time, $annual_income = 0)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
   		$annual_income = str_replace(",", "", $annual_income); // remove commas

		if (strlen($annual_income) == 0) $annual_income = 0;
		
		$fees = 0;		
		
		$sql = "SELECT F.amount * C.exchange_rate AS fees FROM {$table_prefix}fee AS F JOIN {$table_prefix}currency AS C ON F.currency = C.currency WHERE F.status = '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "' AND C.status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND F.invoice_time = '";
		$sql .= $conn->real_escape_string($invoice_time) . "' AND (IF(F.from_income IS NULL, 1, IF($annual_income <= 0, F.from_income <= ROUND($annual_income), ";		
		$sql .= "F.from_income < ROUND($annual_income)))) ORDER BY F.amount * C.exchange_rate DESC LIMIT 1";
		//echo $sql;
		
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$fees = $row->fees;
		}
		return $fees;
	}
}