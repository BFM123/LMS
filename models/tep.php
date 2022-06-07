<?php
require_once "common.php";
require_once "fee.php";
require_once "certificate.php";
require_once "send_email.php";

/**
 * tep class
 */
class tep
{
   /**
	* declarations
	*/
    private $tep_id;
    private $organization_id;
    private $organization_name;
    private $fullname;
    private $nationality;
    private $passport_number;
    private $invoice_number;
    private $record_control;
    private $payment_proof;
    private $captured_by;
    private $action;
    private $user_action;
	private $is_registration_or_licensing;
    private $last_edited_by;
    private $approved_by;
    private $rejected_comments;
    private $deleted_by;
    private $status;

    /**
     * Get the value of tep_id
     *
     * @return mixed
     */
    public function getTEPID()
    {
        return $this->tep_id;
    }
 
    /**
     * Set the value of tep_id
     *
     * @param mixed tep_id
     *
     * @return self
     */
    public function setTEPID($tep_id)
    {
        $this->tep_id = $tep_id;

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
     * Get the value of organization_name
     *
     * @return mixed
     */
    public function getOrganizationName()
    {
        return $this->organization_name;
    }
 
    /**
     * Set the value of organization_name
     *
     * @param mixed organization_name
     *
     * @return self
     */
    public function setOrganizationName($organization_name)
    {
        $this->organization_name = $organization_name;

        return $this;
    }
 
    /**
     * Get the value of fullname
     *
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }
 
    /**
     * Set the value of fullname
     *
     * @param mixed fullname
     *
     * @return self
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }
 
    /**
     * Get the value of nationality
     *
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }
 
    /**
     * Set the value of nationality
     *
     * @param mixed nationality
     *
     * @return self
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }
 
    /**
     * Get the value of passport_number
     *
     * @return mixed
     */
    public function getPassportNumber()
    {
        return $this->passport_number;
    }
 
    /**
     * Set the value of passport_number
     *
     * @param mixed passport_number
     *
     * @return self
     */
    public function setPassportNumber($passport_number)
    {
        $this->passport_number = $passport_number;

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
     * Get the value of user_action
     *
     * @return mixed
     */
    public function getUserAction()
    {
        return $this->user_action;
    }
 
    /**
     * Set the value of user_action
     *
     * @param mixed user_action
     *
     * @return self
     */
    public function setUserAction($user_action)
    {
        $this->user_action = $user_action;

        return $this;
    } 
  
    /**
     * Get the value of is_registration_or_licensing
     *
     * @return mixed
     */
    public function getIsRegistrationOrLicensing()
    {
        return $this->is_registration_or_licensing;
    }
 
    /**
     * Set the value of is_registration_or_licensing
     *
     * @param mixed is_registration_or_licensing
     *
     * @return self
     */
    public function setIsRegistrationOrLicensing($is_registration_or_licensing)
    {
        $this->is_registration_or_licensing = $is_registration_or_licensing;

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
     * Get the value of payment_proof
     *
     * @return mixed
     */
    public function getPaymentProof()
    {
        return $this->payment_proof;
    }

    /**
     * Set the value of payment_proof
     *
     * @param mixed payment_proof
     *
     * @return self
     */
    public function setPaymentProof($payment_proof)
    {
        $this->payment_proof = $payment_proof;

        return $this;
    }

    /**
     * Request TEP processing certificate
	 *
     */
    public function request()
	{
		global $APPROVAL_STATUS, $DOC_FILE_EXT;	
		$draft = array_keys($APPROVAL_STATUS)[0];
		$approved = array_keys($APPROVAL_STATUS)[3];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
        if (empty($this->fullname)) {
            $_SESSION["message"] = "Please enter TEP processing certificate details";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
		$payment_proof = "";	
		$message = "";
		
		if (!is_array($this->payment_proof)) {
			// if payment proof document is not in an array, then this is not an uploaded file
			// this is a filename uploaded to copy the TEP requests into the TEP table after registration/annual return approval
			$payment_proof = $this->payment_proof;
		} elseif (!empty($this->payment_proof)) { 
			// only process if the proof of payment has been uploaded
			$document_size = $this->payment_proof["size"];
			$document_size_MB = $document_size / 1024 / 1024;
			$document_name = $this->payment_proof["name"];
			$document_type = $this->payment_proof["type"];
			$document_tmp = $this->payment_proof["tmp_name"];
			$document_ext = explode(".", $document_name); $document_ext = strtolower(end($document_ext));

			// if the document size is greater than zero, proceed
			if ($document_size > 0 && strlen(trim($document_name)) > 0) {
				// if the document size is less than or equal to the recommended size, proceed
				if ($document_size_MB <= MAX_FILE_IMPORT_SIZE) {
					// if the document extension is the correct one (docx, doc and pdf), proceed
					if (in_array($document_ext, $DOC_FILE_EXT)) {
						// define the path where the document should be saved
						$path = DOCUMENT_UPLOAD_PATH;

						// naming conversion of the new document: organization_id-payment-proof-tep-yyyy-mm-dd.extension e.g. 1-payment-proof-tep.pdf
						$new_document_name = strtolower(str_replace(" ", "-", "$this->organization_id-" . DOCUMENT_CATEGORY_PAYMENT_PROOF_TPE."-".date("Y-m-j").".$document_ext"));						
						
						// upload proof of payment
						move_uploaded_file($document_tmp, $path . $new_document_name);
						
						//prepare a string to save the proof of payment
						$payment_proof = $new_document_name;
					} else {
						// wrong document type						
						$message = "Proof of payment file format is Invalid. Please upload files of type " . implode(", ", $DOC_FILE_EXT);
						$message_type = MESSAGE_ERROR_TYPE;
					}
				} else {
					// document size exceeded
					$message = "Proof of payment file size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
					$message_type = MESSAGE_ERROR_TYPE;
				}
		   } else {	
				// document size <= 0				
				$error_code = $this->payment_proof["error"];

				if ($error_code === UPLOAD_ERR_INI_SIZE || $error_code === UPLOAD_ERR_FORM_SIZE || $document_size_MB > MAX_FILE_IMPORT_SIZE)
					$error = "Proof of payment file size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
				elseif ($error_code === UPLOAD_ERR_PARTIAL)						
					$error = "Proof of payment file was only partially uploaded";
				else {
					if ($this->record_control != $draft)			
						$error = "No proof of payment uploaded. Please upload file";
					else
						$error = "";
				}
							  
				$message = $error;
				$message_type = MESSAGE_ERROR_TYPE;
			}
		} else {
			if ($this->record_control != $draft) {
				// proof of payment not uploaded and this is not a draft submission
				$message = "No proof of payment uploaded. Please upload file";					              
				$message_type = MESSAGE_ERROR_TYPE;
			}
		}
		
		if (strlen($message) > 0) {
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = $message_type;			
			return;
		}		
		
		$total_tep_requests = count($this->fullname);
		
		$sql = "INSERT INTO {$table_prefix}tep (organization_id, fullname, nationality, passport_number, invoice_number, payment_proof, record_control, captured_by, ";
		$sql .= "captured_date, status) VALUES";
		
		for ($i = 0; $i < $total_tep_requests; $i++) {
			if (strlen($this->fullname[$i]) > 0 && strlen($this->nationality[$i]) > 0 && strlen($this->passport_number[$i]) > 0) {
				$sql .= "('" . $conn->real_escape_string($this->organization_id) . "', '". $conn->real_escape_string($this->fullname[$i]) . "', '";
				$sql .= $conn->real_escape_string($this->nationality[$i]) . "', '" . $conn->real_escape_string($this->passport_number[$i]) . "', '";
				$sql .= $conn->real_escape_string($this->invoice_number) . "', '" . $conn->real_escape_string($payment_proof) . "', '";
				$sql .= $conn->real_escape_string($this->record_control) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '";
				$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "'), ";
			}
		}
		
		if (common::endsWith($sql, ", "))
			$sql = substr_replace($sql, "", -2); // remove the last 2 characters from the string

		$result = (!empty($this->fullname)) ? $conn->query($sql) : false;

		$tep_id = mysqli_insert_id($conn);		
		if ($result) {
			// successfully submitted the request for TEP processing certificate
			// send confirmation message to the user
			if ($this->record_control == $draft || 
				$this->record_control == $approved // this second check is to ensure that TEP requests being copied from registrations/annual returns do not generate emails
				) {
				$message = "TEP processing certificate request for '$this->organization_name'" . MESSAGE_SUCCESS;
				$message .= ($this->record_control == $draft) ? "saved as draft" : "submitted";
				$log_message = $message;
			} else {
				$subject_str = "TEP Processing Certificate Request - $this->organization_name";
				$licensee = common::getFieldValue("system", "licensee");
				$technical_support_contact = common::getFieldValue("system", "technical_support_contact");
				$technical_support_telephone = common::getFieldValue("system", "telephone");
				$technical_support_email = common::getFieldValue("system", "email");
				$technical_support_website = common::getFieldValue("system", "website");
				
				$technical_support_contact_str = "<i class=\"fa fa-user-o\"></i> $technical_support_contact";
				$technical_support_email_str = "<i class=\"fa fa-at\"></i> <a href=\"mailto:$technical_support_email?subject=$subject_str\">$technical_support_email</a>";
				$technical_support_telephone_str = " <i class=\"fa fa-phone\"></i> $technical_support_telephone";				
				$technical_support_str = "$technical_support_contact_str $technical_support_email_str $technical_support_telephone_str";
	
				$message = "Thank you for submitting your TEP processing certificate request. You can track the status of your request by ";				
				$message_email = "<p>" . $message . "login to <a href=\"" . SYS_URL . VIEWS_PATH . "tep\">myNGO</a>.</p>";
				$message .= "clicking on the information button. If in doubt, you may contact us. <b>$technical_support_str</b>";			
				
				$log_message = "TEP processing certificate request for '$this->organization_name'" . MESSAGE_SUCCESS . "submitted";
				
				// email confirmation to user
				$to_email_e = common::getFieldValue("user", "email", "username", $this->captured_by, "organization_id", $this->organization_id);	
				if (!empty($to_email_e)) {
					$to_email[] = array($to_email_e);
					$subject[] = $subject_str;		
					$to_firstname = common::getFieldValue("user", "firstname", "username", $this->captured_by, "organization_id", $this->organization_id);
					$email_body[] = "Dear $to_firstname,</p>" . $message_email;
				}

				// email approvers
				$page_id_awaiting_approval_1 = 74;
				$blanks = "";
				$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
				$search_query .= "'%|$page_id_awaiting_approval_1" . "RW|%' AND email IS NOT NULL)";														 
				$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				$subject_str = "TEP Processing Certificate Request Awaiting Approval - $this->organization_name";
				$message_email = "Dear Approver,</p><p>A TEP processing certificate request for '$this->organization_name' has been submitted awaiting your approval. ";
				$message_email .= "To approve, login to <a href=\"" . SYS_URL . VIEWS_PATH . "tep_approval_2\">myNGO</a>.</p>";				
				if (!empty($approver_emails)) {	
					$to_email[] = $approver_emails;
					$subject[] = $subject_str;								
					$email_body[] = $message_email;
				}
								
				if (!empty($to_email)) {
					$send_email = new send_email();				
					$send_email->setToEmail($to_email);
					$send_email->setSubject($subject);
					$send_email->setMessage($email_body);				
					$send_email->send();
				}
			}
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			$log_message = MESSAGE_ERROR;
		}
		
		// log the user activity
		audit_trail::log_trail("Request", $log_message, $this->captured_by, "TEP", "INV: $this->invoice_number > TEP ID: $tep_id");
	}
	
	/**
     * Edit TEP processing certificate request
	 *
     */
    public function edit()
	{
		global $APPROVAL_STATUS, $DOC_FILE_EXT;	
		$draft = array_keys($APPROVAL_STATUS)[0]; 
		$awaiting_approval_level2 = array_keys($APPROVAL_STATUS)[2];
		$payment_processed = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	
        if (empty($this->fullname)) {
            $_SESSION["message"] = "Please enter TEP processing certificate details";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
		$payment_proof_update = "";	
		$message = "";	
		
		if (!empty($this->payment_proof)) { 
			// only process if the proof of payment has been uploaded
			$document_size = $this->payment_proof["size"];
			$document_size_MB = $document_size / 1024 / 1024;
			$document_name = $this->payment_proof["name"];
			$document_type = $this->payment_proof["type"];
			$document_tmp = $this->payment_proof["tmp_name"];
			$document_ext = explode(".", $document_name); $document_ext = strtolower(end($document_ext));

			// if the document size is greater than zero, proceed
			if ($document_size > 0 && strlen(trim($document_name)) > 0) {
				// if the document size is less than or equal to the recommended size, proceed
				if ($document_size_MB <= MAX_FILE_IMPORT_SIZE) {
					// if the document extension is the correct one (docx, doc and pdf), proceed
					if (in_array($document_ext, $DOC_FILE_EXT)) {
						// define the path where the document should be saved
						$path = DOCUMENT_UPLOAD_PATH;
						
						// get the old proof of payment
						$old_document_name = common::getFieldValue("tep", "payment_proof", "organization_id", $this->organization_id, "invoice_number", $this->invoice_number);
						
						// delete the old proof of payment if it exists
						if (strlen($old_document_name) > 0 && file_exists($path . $old_document_name))
							unlink($path . $old_document_name);						

						// naming conversion of the new document: organization_id-payment-proof-tep-yyyy-mm-dd.extension e.g. 1-payment-proof-tep.pdf
						$new_document_name = strtolower(str_replace(" ", "-", "$this->organization_id-" . DOCUMENT_CATEGORY_PAYMENT_PROOF_TPE."-".date("Y-m-j").".$document_ext"));						

						// upload new proof of payment
						move_uploaded_file($document_tmp, $path . $new_document_name);
						
						//prepare a string to save the photo filename
						$payment_proof_update = "payment_proof = '" . $conn->real_escape_string($new_document_name) . "',";
					} else {
						// wrong document type						
						$message = "Proof of payment file format is Invalid. Please upload files of type " . implode(", ", $DOC_FILE_EXT);
						$message_type = MESSAGE_ERROR_TYPE;
					}
				} else {
					// document size exceeded
					$message = "Proof of payment file size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
					$message_type = MESSAGE_ERROR_TYPE;
				}
		   } else {	
				// document size <= 0				
				$error_code = $this->payment_proof["error"];

				if ($error_code === UPLOAD_ERR_INI_SIZE || $error_code === UPLOAD_ERR_FORM_SIZE || $document_size_MB > MAX_FILE_IMPORT_SIZE)
					$error = "Proof of payment file size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
				elseif ($error_code === UPLOAD_ERR_PARTIAL)						
					$error = "Proof of payment file was only partially uploaded";
				else {
					// proof of payment was not uploaded...check if it was already uploaded previously. check the possibility of rejected requests as well
					$blanks = "";
					$payment_proof = common::getFieldValue("tep", "payment_proof", "organization_id", $this->organization_id, "invoice_number", $this->invoice_number, $blanks,
														   $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);					
					if (strlen($payment_proof) == 0) // proof of payment was not previously uploaded 
						$error = "No proof of payment uploaded. Please upload file";					              
					else
						$error = "";
				}
							  
				$message = $error;
				$message_type = MESSAGE_ERROR_TYPE;
			}
		}
		
		if (strlen($message) > 0) {
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = $message_type;			
			return;
		}		

		$total_tep_requests = count($this->fullname);		
		$sql = "";		
		
		// edit TEP processing certificates
		for ($i = 0; $i < $total_tep_requests; $i++) {
			if (strlen($this->fullname[$i]) > 0 && strlen($this->nationality[$i]) > 0 && strlen($this->passport_number[$i]) > 0) {
				$sql .= "UPDATE {$table_prefix}tep SET fullname = '". $conn->real_escape_string($this->fullname[$i]) . "', nationality = '";
				$sql .= $conn->real_escape_string($this->nationality[$i]) . "', passport_number = '" . $conn->real_escape_string($this->passport_number[$i]) . "', ";
				$sql .= "invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "',$payment_proof_update last_edited_by = '";				
				$sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() ";
				
				if ($this->user_action === "request") { // && $this->record_control == $draft) {
					// if action is to request and request is in draft state, update the record control as well					
					$sql .= ", record_control = '" . $conn->real_escape_string($awaiting_approval_level2) . "', ";
						
					// clear rejected fields as well, just in case the request was previously rejected
					$sql .= "rejected_by = NULL, rejected_date = NULL, rejected_comments = NULL, status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";					
				}
				$sql .= "WHERE organization_id = '" . $conn->real_escape_string($this->organization_id) . "' AND invoice_number = '";
				$sql .= $conn->real_escape_string($this->invoice_number) . "' AND tep_id = '" . $conn->real_escape_string($this->tep_id[$i]) . "'; ";
			}
		}
		
		// delete TEP processing certificates which are not part of the edit process
		$sql .= "UPDATE {$table_prefix}tep SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($last_edited_by) . "', ";
		$sql .= "deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND organization_id = '";
		$sql .= $conn->real_escape_string($this->organization_id) . "' AND invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "' AND tep_id NOT IN ('";		
		$sql .= implode("', '", $this->tep_id) . "'); ";
				
		$result = (strlen($sql) > 0) ? $conn->multi_query($sql) : false;

		$tep_id = implode(", ", $this->tep_id);
		
		if ($result) {
			// successfully submitted the request for TEP processing certificate
			// send confirmation message to the user
			$message = "TEP processing certificate request for '$this->organization_name'" . MESSAGE_SUCCESS;
			$message .= ($this->record_control == $draft) ? "saved as draft" : "updated";
			$log_message = $message;

			if ($this->user_action === "request") {// && $this->record_control == $draft) {				
				$subject_str = "TEP Processing Certificate Request - $this->organization_name";
				$licensee = common::getFieldValue("system", "licensee");
				$technical_support_contact = common::getFieldValue("system", "technical_support_contact");
				$technical_support_telephone = common::getFieldValue("system", "telephone");
				$technical_support_email = common::getFieldValue("system", "email");
				$technical_support_website = common::getFieldValue("system", "website");
				
				$technical_support_contact_str = "<i class=\"fa fa-user-o\"></i> $technical_support_contact";
				$technical_support_email_str = "<i class=\"fa fa-at\"></i> <a href=\"mailto:$technical_support_email?subject=$subject_str\">$technical_support_email</a>";
				$technical_support_telephone_str = " <i class=\"fa fa-phone\"></i> $technical_support_telephone";				
				$technical_support_str = "$technical_support_contact_str $technical_support_email_str $technical_support_telephone_str";
	
				$message = "Thank you for submitting your TEP processing certificate request. You can track the status of your request by ";				
				$message_email = "<p>" . $message . "login to <a href=\"" . SYS_URL . VIEWS_PATH . "tep\">myNGO</a>.</p>";
				$message .= "clicking on the information button. If in doubt, you may contact us. <b>$technical_support_str</b>";			
				
				$log_message = "TEP processing certificate request for '$this->organization_name'" . MESSAGE_SUCCESS . "submitted";
				
				// email confirmation to user
				$to_email_e = common::getFieldValue("user", "email", "username", $this->last_edited_by, "organization_id", $this->organization_id);	
				if (!empty($to_email_e)) {
					$to_email[] = array($to_email_e);
					$subject[] = $subject_str;		
					$to_firstname = common::getFieldValue("user", "firstname", "username", $this->last_edited_by, "organization_id", $this->organization_id);
					$email_body[] = "Dear $to_firstname,</p>" . $message_email;
				}

				// email approvers
				$page_id_awaiting_approval_1 = 74;
				$blanks = "";
				$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
				$search_query .= "'%|$page_id_awaiting_approval_1" . "RW|%' AND email IS NOT NULL)";														 
				$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				$subject_str = "TEP Processing Certificate Request Awaiting Approval - $this->organization_name";
				$message_email = "Dear Approver,</p><p>A TEP processing certificate request for '$this->organization_name' has been submitted awaiting your approval. ";
				$message_email .= "To approve, login to <a href=\"" . SYS_URL . VIEWS_PATH . "tep_approval_2\">myNGO</a>.</p>";				
				if (!empty($approver_emails)) {	
					$to_email[] = $approver_emails;
					$subject[] = $subject_str;								
					$email_body[] = $message_email;
				}
								
				if (!empty($to_email)) {
					$send_email = new send_email();				
					$send_email->setToEmail($to_email);
					$send_email->setSubject($subject);
					$send_email->setMessage($email_body);				
					$send_email->send();
				}				
			}
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR . $conn->error . $sql;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			$log_message = MESSAGE_ERROR;
		}
		
		// log the user activity
		audit_trail::log_trail(ucwords($this->user_action), $log_message, $this->last_edited_by, "TEP", "INV: $this->invoice_number > TEP ID: $tep_id");
	}
	
	/**
     * Approve TEP processing certificate request
	 *
     */
    public function approve()
	{
		global $APPROVAL_STATUS;	
		$approved = array_keys($APPROVAL_STATUS)[3];
		$payment_processed = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$level_str = "";
		$generate_certificate = false;
		$payment_processed_sql = "";
		
		if ($this->action === "approve") {
			$level_str = " (Level $this->record_control)";
			$new_record_control = $this->record_control + 1;
			$record_control_sql = "record_control = '" . $conn->real_escape_string($new_record_control) . "', ";
			$rejection_sql = "";
			$actioned = $this->action . "d";
			$field_approved_by = $actioned . $this->record_control . "_by";
			$field_approved_date = $actioned . $this->record_control . "_date";
			
			if ($new_record_control == $approved) {
				$generate_certificate = true;
			} elseif ($new_record_control == $payment_processed) {
				$field_approved_by = "payment_processed_by";
				$field_approved_date = "payment_processed_date";
				$payment_processed_sql = " AND record_control <> '" . $conn->real_escape_string($new_record_control) . "'";
			}

		} elseif ($this->action === "reject") {
			$record_control_sql = "";
			$rejection_sql = "rejected_comments = '" . $conn->real_escape_string($this->rejected_comments) . "', status= '" . $conn->real_escape_string(STATUS_REJECTED) . "', "; 
			$actioned = $this->action . "ed";
			$field_approved_by = $actioned . "_by";
			$field_approved_date = $actioned . "_date";
		}
				
		$sql = "UPDATE {$table_prefix}tep SET $record_control_sql$rejection_sql$field_approved_by = '" . $conn->real_escape_string($this->approved_by) . "', ";
		$sql .= "$field_approved_date = NOW() WHERE organization_id = '" . $conn->real_escape_string($this->organization_id) . "' AND invoice_number = '";
		$sql .= $conn->real_escape_string($this->invoice_number) . "'$payment_processed_sql";

		$result = $conn->query($sql);

        if ($result) {
			// successfully approved TEP processing certificate request		
			$message = "TEP processing certificate request for '$this->organization_name'" . MESSAGE_SUCCESS . $actioned . $level_str;
			$message_type = MESSAGE_SUCCESS_TYPE;
            
			// inform the next user (second approver/finance/requestor) to act on the request
			// second approver has already been informed on requesr submission since TEP requests start at second approver
			/*
			$page_id_approval = 74; // awaiting approval (level 2), inform second level approvers
			$url = "tep_approval_2";
			$subject_str = "TEP Processing Certificate Request Awaiting Approval";
			$message_email = "Dear Approver,</p><p>A TEP processing certificate rrequest for '$this->organization_name' has been submitted awaiting your approval. ";
			$task = "approve";
			$blanks = "";
			$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
			$search_query .= "'%|$page_id_approval" . "RW|%' AND email IS NOT NULL)";														 
			$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
			*/
			// ensure to get the correct requestor even for rejected TEP requests
			$ngo_registration_number = common::getFieldValue("organization", "registration_number", "organization_id", $this->organization_id);
			$requested_by = common::getFieldValue("tep", "captured_by", "organization_id", $this->organization_id, "invoice_number", $this->invoice_number, $blanks, $blanks,
												  $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);
			$requestor_firstname = common::getFieldValue("user", "firstname", "username", $requested_by, "organization_id", $this->organization_id);
			
			if ($this->action === "approve") {
				if ($new_record_control == $approved) {
					$page_id_approval = 58; // awaiting payment processing, inform Finance
					$url = "payment";
					$subject_str = "TEP Processing Certificate Request Awaiting Payment Processing";
					$message_email = "Dear Finance,</p><p>A TEP processing certificate request for '$this->organization_name ($ngo_registration_number)' has been approved ";
					$message_email .= "awaiting payment processing. ";
					$task = "process payment";
					$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
					$search_query .= "'%|$page_id_approval" . "RW|%' AND email IS NOT NULL)";														 
					$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				} elseif ($new_record_control == $payment_processed) {
					// approved, inform requestor....but if this TEP approval is initiated from registrations/annual returns, then do not generate emails
					if ($this->is_registration_or_licensing === "Yes") {
						$url = "";
						$subject_str = "";
						$approver_emails = array();
						$message_email = "";
						$task = "";
					} else {
						$url = "tep";
						$subject_str = "TEP Processing Certificate Request Approved";
						$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
						$message_email = "Dear $requestor_firstname,</p><p>Your TEP processing certificate request for '$this->organization_name' has been approved. ";
						$task = "track the status of your request";
					}
				}
			} elseif ($this->action === "reject") {
				// rejected, inform requestor
				$url = "tep";
				$subject_str = "TEP Processing Certificate Request Rejected";
				$rejected_comments = common::getFieldValue("tep", "rejected_comments", "organization_id", $this->organization_id, "invoice_number", $this->invoice_number, 
														   $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE ."', '".STATUS_REJECTED);
				$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
				$message_email = "Dear $requestor_firstname,</p><p>Your TEP processing certificate request for '$this->organization_name' has been rejected with the ";				
				$message_email .= "following reasons: </p><p><b>" . str_replace("\r\n", "<br />", $rejected_comments) . "</b></p><p>";
				$task = "review your request";
			}
			
			$subject_str .= " - $this->organization_name";
			if (strlen($ngo_registration_number) > 0) $subject_str .= " ($ngo_registration_number)";
			
			$message_email .= "To $task, login to <a href=\"" . SYS_URL . VIEWS_PATH . "$url\">myNGO</a>.</p>";		
			$to_email = array();
			if (!empty($approver_emails)) {	
				$to_email[] = $approver_emails;
				$subject[] = $subject_str;								
				$email_body[] = $message_email;
				$email_attachment[] = NULL;
			}
			
			// if this is a final approval then generate the TEP processing certificate
			if ($generate_certificate) {
				// 1. firstly generate TEP fee invoice				
				$tep_details = array_column(self::all($this->organization_id, $this->invoice_number, $approved, STATUS_ACTIVE, $check_if_field_is_empty = false), "fullname");
				$number_of_tep_requests = count($tep_details);

				$tep_fees = array();
				for ($i = 0; $i < $number_of_tep_requests; $i++) {
					$tep_fees = array_merge($tep_fees, array_unique(array_column(fee::all(INVOICE_TIME_TEP), "fee_category")));
				}
				
				$processing_year = date("Y");
				$invoice = new invoice();
				$invoice->setOrganizationID(array($this->organization_id));
				$invoice->setFeeCategory($tep_fees);
				$invoice->setTEPDetails($tep_details);
				$invoice->setInvoiceYear($processing_year);													
				$invoice->setCapturedBy($this->approved_by);					
				$invoice->generate();
				
				$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
				$is_invoiced = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
				
				if (!$is_invoiced) {
					// TEP fee was not generated successfully
					$message .= ", but " . strtolower(implode(" and ", $tep_fees)) . " invoice could not be generated: " . ucfirst($processing_result);
					$message_type = MESSAGE_INFORMATION_TYPE;
				} else {
					// 2. generate the TEP processing certificate	
					$start_date = certificate::getPeriod(INVOICE_TIME_TEP, "start_date");		
					if (strlen($start_date) > 0) $start_date = $processing_year . "-" . $start_date;
		
					$end_date = certificate::getPeriod(INVOICE_TIME_TEP, "end_date");		
					if (strlen($end_date) > 0) $end_date = $processing_year . "-" . $end_date;
			
					$new_invoice_number = $this->invoice_number;
					// get the newly generated invoice number from above						
					if (isset($_SESSION["invoice_number"])) {
						$new_invoice_number = $_SESSION["invoice_number"];
						unset($_SESSION["invoice_number"]);
					}
					
					// email the invoice to the requestor
					$url = "tep";
					$subject_str = "Invoice for TEP Processing Certificate Request - $this->organization_name";
					if (strlen($ngo_registration_number) > 0) $subject_str .= " ($ngo_registration_number)";
					$message_email = "Dear $requestor_firstname,</p><p>Find attached an invoice for the TEP processing certificate request for '$this->organization_name'. ";					
					$message_email .= "To track the status of your request, login to <a href=\"" . SYS_URL . VIEWS_PATH . "$url\">myNGO</a>.</p>";	
					$requestor_email = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
					$currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
					
					$report = new report();
					$report->setOrganizationID($this->organization_id);
					$report->setReportName("Invoice");
					$report->setInvoiceNumber($new_invoice_number);
					$report->setCurrency($currency);
					$report->setDestination(PDF_FILE_EXT);
					$report->setPrintedBy($this->approved_by);
					$report->setReturnReport(true);
		
					if (!empty($requestor_email)) {	
						$to_email[] = $requestor_email;
						$subject[] = $subject_str;								
						$email_body[] = $message_email;
						$email_attachment[] = array("file" => $report->generate(), "file_name" => "tep_invoice.pdf");
					}

					$certificate_type = "New TEP";				
					$certificates = new certificate();		
					$certificates->setOrganizationID($this->organization_id);	
					$certificates->setCategory(CERTIFICATE_TEP);
					$certificates->setStartDate($start_date);								
					$certificates->setEndDate($end_date);								
					$certificates->setDetails1($tep_details);
					$certificates->setDetails2($certificate_type);
					$certificates->setInvoiceNumber($new_invoice_number);
					$certificates->setCapturedBy($this->approved_by);					
					$certificates->generate();
					
					$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
					$is_generated = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
					
					if (!$is_generated) {
						// TEP processing certificate was not generated successfully
						$message .= ", but " . strtolower(CERTIFICATE_TEP) . " could not be generated: " . ucfirst($processing_result);
						$message_type = MESSAGE_INFORMATION_TYPE;
					}
						
					// 3. update the TEP processing certificate request with the new invoice number
					$sql = "UPDATE {$table_prefix}tep SET invoice_number = '". $conn->real_escape_string($new_invoice_number) . "' WHERE organization_id = '";
					$sql .= $conn->real_escape_string($this->organization_id) . "' AND invoice_number = '" . $conn->real_escape_string($this->invoice_number) . "'";
					$result = $conn->query($sql);
				}
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
		audit_trail::log_trail(ucwords($this->action), $_SESSION["message"], $this->approved_by, "TPE", "INV: $new_invoice_number");
	}
	
    /**
     * Delete TEP processing certificate request
     *
     */
    public function delete()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        $sql = "UPDATE {$table_prefix}tep SET status = '". $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by) . "', ";
		$sql .= "deleted_date = NOW() WHERE organization_id = '" . $conn->real_escape_string($this->organization_id) . "' AND invoice_number = '";
		$sql .= $conn->real_escape_string($this->invoice_number) . "'";
				
 
        $result = $conn->query($sql);

        if ($result) {			
            $_SESSION["message"] = "TEP processing certificate request for '$this->organization_name'" . MESSAGE_SUCCESS . "deleted";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
			
			// delete proof of payment			
			if (strlen($this->payment_proof) > 0 && file_exists(DOCUMENT_UPLOAD_PATH . $this->payment_proof))
				unlink(DOCUMENT_UPLOAD_PATH . $this->payment_proof);
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "TEP", "INV: $this->invoice_number");
    }

 	/**
	 * List all TEPs
	 *
	 * @param string organization_id
	 * @param string invoice_number
	 * @param string record_control
	 * @param string status
	 * @param boolean check_if_field_is_empty
	 *
 	 * @return array of TEPs
	 */
	public static function all($organization_id = "", $invoice_number = "", $record_control = "", $status = STATUS_ACTIVE, $check_if_field_is_empty = true) 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$teps = array();
		$sql = "SELECT T.*, O.organization_name, O.abbreviation, O.registration_number, O.registration_year, O.executive_director_fullname AS contact_person,O.telephone,O.email,";
		$sql .= "O.postal_address FROM {$table_prefix}tep AS T JOIN  {$table_prefix}organization AS O ON T.organization_id = O.organization_id WHERE T.status IN ('$status') ";

		if ($check_if_field_is_empty) {
			if (strlen($organization_id) > 0) $sql .= "AND T.organization_id IN ('$organization_id') ";
			if (strlen($record_control) > 0) $sql .= "AND T.record_control IN ('$record_control') ";
			if (strlen($invoice_number) > 0) $sql .= "AND T.invoice_number IN ('$invoice_number') ";
		} else {
			$sql .= "AND T.organization_id IN ('$organization_id') ";
			$sql .= "AND T.record_control IN ('$record_control') ";
			$sql .= "AND T.invoice_number IN ('$invoice_number') ";
		}
		
		$sql .= "ORDER BY T.tep_id DESC, T.invoice_number, T.captured_date DESC, O.organization_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$teps[] = $row;
		}
		return $teps;
	}
}