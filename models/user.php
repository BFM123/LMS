<?php
require_once "common.php";
require_once "security.php";
require_once "session.php";
require_once "send_email.php";
require_once "audit_trail.php";

/**
 * user class
 */
 
class user
{
	/**
	 *declarations
	 */
	private $from_page;
	private $user_id;
	private $username;
	private $firstname;
	private $lastname;
	private $position;
	private $email;
	private $organization_id;
	private $district_id;
	private $old_password;
	private $password;
    private $confirm_password;
    private $role_id;
    private $photo;
	private $change_password;
	private	$account_disabled;
	private	$account_locked;
	private	$is_ngo_user;
	private	$send_activation_email;
    private $captured_by;
    private $captured_date;
    private $last_edited_by;
    private $last_edited_date;
    private $deleted_by;
    private $deleted_date;
    private $status;

   /**
     * Get the value of from_page
     *
     * @return mixed
     */
    public function getFromPage()
    {
        return $this->from_page;
    }

    /**
     * Set the value of from_page
     *
     * @param mixed from_page
     *
     * @return self
     */
    public function setFromPage($from_page)
    {
        $this->from_page = $from_page;

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
     * Get the value of username
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param mixed username
     *
     * @return self
     */
    public function setUsername($username)
    {
		$this->username = $username;
		
        return $this;
    }

    /**
     * Get the value of firstname
     *
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param mixed firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param mixed lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of position
     *
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @param mixed position
     *
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
 	
	/**
     * Get the value of email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of organization_id
     *
     * @return mixed
     */
    public function getOrganizationId()
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
    public function setOrganizationId($organization_id)
    {
        $this->organization_id = $organization_id;

        return $this;
    }

    /**
     * Get the value of district_id
     *
     * @return mixed
     */
    public function getDistrictId()
    {
        return $this->district_id;
    }

    /**
     * Set the value of district_id
     *
     * @param mixed district_id
     *
     * @return self
     */
    public function setDistrictId($district_id)
    {
        $this->district_id = $district_id;

        return $this;
    }

    /**
     * Get the value of old password
     *
     * @return mixed
     */
    public function getOldPassword()
    {
        return $this->old_password;
    }

    /**
     * Set the value of old password
     *
     * @param mixed old password
     *
     * @return self
     */
    public function setOldPassword($old_password)
    {
        $this->old_password = $old_password;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
	
    /**
     * Get the value of confirm_password
     *
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    /**
     * Set the value of confirm_password
     *
     * @param mixed confirm_password
     *
     * @return self
     */
    public function setConfirmPassword($confirm_password)
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }

    /**
     * Get the value of role_id
     *
     * @return mixed
     */
    public function getRoleID()
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     *
     * @param mixed role_id
     *
     * @return self
     */
    public function setRoleID($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get the value of photo
     *
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @param mixed photo
     *
     * @return self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of change_password
     *
     * @return mixed
     */
    public function getChangePassword()
    {
        return $this->change_password;
    }

    /**
     * Set the value of change_password
     *
     * @param mixed change_password
     *
     * @return self
     */
    public function setChangePassword($change_password)
    {
        $this->change_password = $change_password;

        return $this;
    }

    /**
     * Get the value of account_disabled
     *
     * @return mixed
     */
    public function getAccountDisabled()
    {
        return $this->account_disabled;
    }

    /**
     * Set the value of account_disabled
     *
     * @param mixed account_disabled
     *
     * @return self
     */
    public function setAccountDisabled($account_disabled)
    {
        $this->account_disabled = $account_disabled;

        return $this;
    }
	
	/**
     * Get the value of is_ngo_user
     *
     * @return mixed
     */
    public function getIsNGOUser()
    {
        return $this->is_ngo_user;
    }

    /**
     * Set the value of is_ngo_user
     *
     * @param mixed is_ngo_user
     *
     * @return self
     */
    public function setIsNGOUser($is_ngo_user)
    {
        $this->is_ngo_user = $is_ngo_user;

        return $this;
    }
	
	/**
     * Get the value of send_activation_email
     *
     * @return mixed
     */
    public function getSendActivationEmail()
    {
        return $this->send_activation_email;
    }

    /**
     * Set the value of send_activation_email
     *
     * @param mixed send_activation_email
     *
     * @return self
     */
    public function setSendActivationEmail($send_activation_email)
    {
        $this->send_activation_email = $send_activation_email;

        return $this;
    }

	/**
     * Get the value of account_locked
     *
     * @return mixed
     */
    public function getAccountLocked()
    {
        return $this->account_locked;
    }

    /**
     * Set the value of account_locked
     *
     * @param mixed account_locked
     *
     * @return self
     */
    public function setAccountLocked($account_locked)
    {
        $this->account_locked = $account_locked;

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
     * Get the value of deleted_date
     *
     * @return mixed
     */
    public function getDeletedDate()
    {
        return $this->deleted_date;
    }

    /**
     * Set the value of deleted_date
     *
     * @param mixed deleted_date
     *
     * @return self
     */
    public function setDeletedDate($deleted_date)
    {
        $this->deleted_date = $deleted_date;

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
     * Add user
	 *
     */
    public function add()
	{
		global $IMG_FILE_EXT;
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		if (strlen($this->username) == 0) {											
			$_SESSION["message"] = "Invalid username";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		if (strlen($this->password) == 0) {
				$_SESSION["message"] = "Please enter password";
				$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
				return;
		}
		
		if ($this->password !== $this->confirm_password) {
			$_SESSION["message"] = "The password fields do not match";;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$exists = common::exists("user", 0, "username", $this->username);		
		if ($exists) {											
			$_SESSION["message"] = "Username '$this->username'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		/*
		$exists = common::exists("user", 0, "email", $this->email);		
		if ($exists) {											
			$_SESSION["message"] = "Email address '$this->email'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		*/
		/* upload photo */
		$photo = "user.png";
		if(isset($this->photo)){
			$error = "";
			$file_name = $this->photo["name"];
			$file_size = $this->photo["size"];
			$file_tmp = $this->photo["tmp_name"];
			$file_type = $this->photo["type"];
			$file_ext = explode(".", $file_name); $file_ext = strtolower(end($file_ext));
			
			if ($file_size > 0) {
				// only process the file if it was uploaded
				$extensions = $IMG_FILE_EXT;
				
				if (in_array($file_ext, $extensions) === false) {
					$error = "Invalid photo format. Please upload a file of type gif, jpeg, jpg or png";
				}
				
				$file_size_MB = $file_size / 1024 / 1024;
				
				if ($file_size_MB > MAX_FILE_IMPORT_SIZE) {
					$error = "Photo size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
				}
				
				if (strlen($error) == 0) {
					//change filename to format username.ext
					$file_name = str_replace("/", "-", $this->username) . "." . $file_ext;
					
					move_uploaded_file($file_tmp, PHOTO_PATH . $file_name);
					
					//prepare a string to save the photo filename
					$photo = $file_name;
				} else {
					$_SESSION["message"] = $error;
					$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
					return;
				}
			}
		}
		
		$log_attempts = 0;
		$password_hash = self::generateHash($this->password);
		
		// generate email verification key
        $email_verification_key = self::generateEmailVerificationKey($this->username, $this->email);
  		
		$sql = "INSERT INTO {$table_prefix}user (username, firstname, lastname, position, email, password, role_id, is_ngo_user, email_verification_key, organization_id, ";
		$sql .= "district_id, photo, change_password, account_locked, account_disabled, log_attempts, captured_by, captured_date, status) VALUES('" ;
		$sql .= $conn->real_escape_string($this->username)."', '". $conn->real_escape_string($this->firstname) . "', '" . $conn->real_escape_string($this->lastname) . "', '";
		$sql .= $conn->real_escape_string($this->position) . "', '" . $conn->real_escape_string($this->email) . "', '" . $conn->real_escape_string($password_hash) . "', '";
		$sql .= $conn->real_escape_string($this->role_id) . "', '" . $conn->real_escape_string($this->is_ngo_user) . "', '";
		$sql .= $conn->real_escape_string($email_verification_key) . "', '" . $conn->real_escape_string($this->organization_id) . "', '";
		$sql .= $conn->real_escape_string($this->district_id) . "', '" . $conn->real_escape_string($photo) . "', '" . $conn->real_escape_string($this->change_password) . "', '";
		$sql .= $conn->real_escape_string($this->account_locked) ."', '".$conn->real_escape_string($this->account_disabled)."', '".$conn->real_escape_string($log_attempts)."', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";
		
		$result = $conn->query($sql);
		if ($result) {
			// user successfully added
			$message = "User '$this->username'" . MESSAGE_SUCCESS . "added";
			$message_type = MESSAGE_SUCCESS_TYPE;
			
			// send activation email to the user
			$subject_str = "Activate Your Account";
			$message_email = "Dear $this->firstname,</p><p>Welcome to myNGO!</p><p>Your account has been created and your username is <b>$this->username</b>. ";
			$message_email .= "To activate your account, go to " . SYS_URL . VIEWS_PATH . "activate/?k=$email_verification_key</p>";	

			if (strlen($this->email) > 0) {	
				$to_email[] = array($this->email);
				$subject[] = $subject_str;								
				$email_body[] = $message_email;
				$email_attachment[] = NULL;
				
				$send_email = new send_email();				
				$send_email->setToEmail($to_email);
				$send_email->setSubject($subject);
				$send_email->setMessage($email_body);				
				$send_email->setAttachment($email_attachment);				
				$send_email->send();
			}
			
			$emailing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
			$is_sent = (strpos(strtolower($emailing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
			
			if (!$is_sent) {
				// activation email was not sent successfully
				$message .= ", but activation email could not be sent to '$this->email': " . ucfirst($emailing_result);
				$message_type = MESSAGE_INFORMATION_TYPE;
			}
				
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = $message_type;				
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Users", mysqli_insert_id($conn));
	}
	
	/**
	 * Edit user
	 * 
	 */
	public function edit()
	{	
		global $IMG_FILE_EXT;
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$sql_update = "";

		if (strlen($this->username) == 0) {											
			$_SESSION["message"] = "Invalid username";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$exists = common::exists("user", $this->user_id, "username", $this->username);
		if ($exists) {											
			$_SESSION["message"] = "'$this->username'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		/*
		$exists = common::exists("user", , "email", $this->email);		
		if ($exists) {											
			$_SESSION["message"] = "Email address '$this->email'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		*/
		
		if ($this->from_page === "user-account") {
			if (strlen($this->old_password) == 0) {
				$_SESSION["message"] = "Please enter password";
				$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
				return;
			}
			
			$login_result = self::isValidUser($this->username, $this->old_password);
			
			if ($login_result === "locked")
				$msg = "Login failure. Your account is locked out";
			elseif ($login_result === "disabled")
				$msg = "Login failure. Your account is disabled or has been suspended";
			elseif ($login_result === "invalid")
				$msg = "Invalid password";
			elseif ($login_result === "valid" || $login_result === "inactivated")
				$msg = "valid";
			
			if ($msg !== "valid") {
				$_SESSION["message"] = $msg;
				$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
				return;
			}
		}
		
		$password = "";
		if (strlen(trim($this->password)) > 0) {
			// check if the new password fields match
			if (trim($this->password) !== trim($this->confirm_password)) {
				$_SESSION["message"] = "The new password fields do not match";;
				$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
				return;
			}
			
			// only update the password if it was typed
			$password_hash = self::generateHash($this->password);
			$password = " password = '" . $conn->real_escape_string(self::generateHash($this->password)) . "',";
		}
				
		/* upload photo */
		$photo = "";

		if(isset($this->photo)){
			$error = "";
			$file_name = $this->photo["name"];
			$file_size = $this->photo["size"];
			$file_tmp = $this->photo["tmp_name"];
			$file_type = $this->photo["type"];
			$file_ext = explode(".", $file_name); $file_ext = strtolower(end($file_ext));
					
			if ($file_size > 0) {
				// only process the file if it was uploaded
				$extensions = $IMG_FILE_EXT;
				
				if (in_array($file_ext, $extensions) === false) {
					$error = "Invalid photo format. Please upload a file of type gif, jpeg, jpg or png";
				}
				
				$file_size_MB = $file_size / 1024 / 1024;
				
				if ($file_size_MB > MAX_FILE_IMPORT_SIZE) {
					$error = "Photo size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
				}
				
				if (strlen($error) == 0) {
					// get the old photo filename
					$old_filename = common::getFieldValue("user", "photo", "user_id", $this->user_id);

					// delete the old user photo if it exists
					if (strlen($old_filename) > 0 && $old_filename !== "user.png" && file_exists(PHOTO_PATH . $old_filename))
						unlink(PHOTO_PATH . $old_filename);

					//change filename to format username.ext
					$file_name = str_replace("/", "-", $this->username) . "." . $file_ext;
					
					move_uploaded_file($file_tmp, PHOTO_PATH . $file_name);
					
					//prepare a string to save the photo filename
					$photo = " photo = '" . $conn->real_escape_string($file_name) . "',";
				} else {
					$_SESSION["message"] = $error;
					$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
					return;
				}
			}
		}
		
		$sql_update = "$photo $password";
		 
		if (!in_array($this->from_page, array("user-account", "user-activation"))) {
			$attempts = ($this->account_locked === "No") ? " log_attempts = 0," : "";
			
			// generate email verification key, if so required			
			$email_verification = "";
			if ($this->send_activation_email === "Yes") {
				$email_verification_key = common::getFieldValue("user", "email_verification_key", "user_id", $this->user_id);
				
				if (strlen($email_verification_key) == 0) {
					// no email verification key....generate one
					$email_verification_key = self::generateEmailVerificationKey($this->username, $this->email);					
				}
				
				$email_verification = " email_verification_key = '" . $conn->real_escape_string($email_verification_key) . "', email_verified = NULL,";
			}				
			
			$sql_update .= " role_id = '" . $conn->real_escape_string($this->role_id) . "', change_password = '" . $conn->real_escape_string($this->change_password) . "', ";
			$sql_update .= "$attempts $email_verification account_disabled = '" . $conn->real_escape_string($this->account_disabled) . "', account_locked = '";
			$sql_update .= $conn->real_escape_string($this->account_locked) . "', firstname = '" . $conn->real_escape_string($this->firstname) . "', lastname = '";
			$sql_update .= $conn->real_escape_string($this->lastname) . "', position = '" . $conn->real_escape_string($this->position) . "', email = '";
			$sql_update .= $conn->real_escape_string($this->email) . "', organization_id = '" . $conn->real_escape_string($this->organization_id) . "', district_id = '";
			$sql_update .= $conn->real_escape_string($this->district_id) . "', is_ngo_user = '" . $conn->real_escape_string($this->is_ngo_user) . "', ";
		}
		$sql = "UPDATE {$table_prefix}user SET $sql_update last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) ."', last_edited_date = NOW() WHERE user_id = '";
		$sql .= $conn->real_escape_string($this->user_id) . "'";

	   	$result = $conn->query($sql);
		if ($result) {
			// user successfully updated
			$message = "User '$this->username'" . MESSAGE_SUCCESS . "updated";
			$message_type = MESSAGE_SUCCESS_TYPE;
			
			// send activation email to the user, if so required			
			if ($this->send_activation_email === "Yes") {
				$subject_str = "Activate Your Account";
				$message_email = "Dear $this->firstname,</p><p>Welcome to myNGO!</p><p>Your account has been created and your username is <b>$this->username</b>. ";
				$message_email .= "To activate your account, go to " . SYS_URL . VIEWS_PATH . "activate/?k=$email_verification_key</p>";	

				if (strlen($this->email) > 0) {	
					$to_email[] = array($this->email);
					$subject[] = $subject_str;								
					$email_body[] = $message_email;
					$email_attachment[] = NULL;
					
					$send_email = new send_email();				
					$send_email->setToEmail($to_email);
					$send_email->setSubject($subject);
					$send_email->setMessage($email_body);				
					$send_email->setAttachment($email_attachment);				
					$send_email->send();
				}
				
				$emailing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
				$is_sent = (strpos(strtolower($emailing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
				
				if (!$is_sent) {
					// activation email was not sent successfully
					$message .= ", but activation email could not be sent to '$this->email': " . ucfirst($emailing_result);
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
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Users", $this->user_id);
	}
	
    /**
     * Delete user
	 *
     */
    public function delete()
    {		
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		if (strlen($this->username) == 0) {											
			$_SESSION["message"] = "Invalid username";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		if ($this->username === $this->deleted_by) {											
			$_SESSION["message"] = "Cannot delete own account";
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// check if this user is in use
		$is_used = false;

		if ($is_used) {											
			$_SESSION["message"] = "User '$this->username'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

	    $sql = "UPDATE {$table_prefix}user SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by) ."', ";
		$sql .= "deleted_date = NOW() WHERE user_id = '" . $conn->real_escape_string($this->user_id) . "'";
        $result = $conn->query($sql);
	
		if ($result) {
			$_SESSION["message"] = "User '$this->username'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
			
			// delete user photo
			if (strlen($this->photo) > 0 && $this->photo !== "user.png" && file_exists(PHOTO_PATH . $this->photo))
				unlink(PHOTO_PATH . $this->photo);
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Users", $this->user_id);
    }
	
	/**
	 * List all users
	 *
	 * @param string user_id
	 * @param string limit
	 * @param string organization_id
	 * @param string district_id
	 * @param string zone_id
	 * @param string region_id
	 * @param string role_id
	 * @param string search_query
	 *
 	 * @return array of users
	 */									
	public static function all($user_id = "", $limit = "", $organization_id = "", $district_id = "", $zone_id = "", $region_id = "", $role_id = "", $search_query = "") 
	{				
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$users = array();
		$sql = "SELECT * FROM {$table_prefix}user WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";

        // don't disaplay system user
		$sql .= "AND username <> 'system' ";
		
		if (strlen($user_id) > 0) $sql .= "AND user_id IN ('$user_id') ";		
		if (strlen($role_id) > 0) $sql .= "AND role_id IN ('$role_id') ";
		if (strlen($organization_id) > 0) $sql .= "AND organization_id IN ('$organization_id') ";
		if (strlen($district_id) > 0) $sql .= "AND district_id IN ('$district_id') ";
		if (strlen($zone_id) > 0) $sql .= "AND district_id IN (SELECT district_id FROM {$table_prefix}district WHERE zone_id IN ('$zone_id')) ";
		if (strlen($region_id) > 0) $sql .= "AND district_id IN (SELECT district_id FROM {$table_prefix}district WHERE region_id IN ('$region_id')) ";
		if (strlen($search_query) > 0) $sql .= "AND $search_query ";

		$sql .= "ORDER BY username";
		if (strlen($limit) > 0) $sql .= " LIMIT $limit";	

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$users[] = $row;
		}
		return $users;
	}
	
    /**
	 * Generate password hash 
	 *
	 * @param string $text
	 * @param string $salt
	 * 
	 * @return string password hash
	 */
	public static function generateHash($text, $salt = NULL) {	
		if ($salt == NULL) {	
			$salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
		} else {
			$salt = substr($salt, 0, SALT_LENGTH);
		}
		return $salt . sha1($salt . $text);
	}
	
    /**
	 * Generate random password
	 * 
	 * @return string random_password
	 */
	public static function generateRandomPassword() 
	{
		$chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz";
	  
	  	return substr(str_shuffle($chars), 0, 10);
	}
	
	/**
	 * Login
	 * 
	 */
	public function login()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$fullname = "";
		$user_since = "";
		$photo = "";
		$msg = "";
        $organization_id = "";

		if (strlen($this->username) == 0) {
			$msg = "Please enter username";
		} elseif (strlen($this->password) == 0) {
			$msg = "Please enter password";
		} else {
			$login_result = self::isValidUser($this->username, $this->password);
			
			if ($login_result === "inactivated") {
				$msg = "Login failure. Your account has not been activated, please check your email and follow the steps to activate your account";
			} elseif ($login_result === "locked") {
				$msg = "Login failure. Your account is locked out";
			} elseif ($login_result === "disabled") {
				$msg = "Login failure. Your account is disabled or has been suspended";
			} elseif ($login_result === "invalid") {
				$msg = "Invalid username or password";
				self::updateUser($this->username, 1);
			} elseif ($login_result === "valid") {
				$msg = "valid";
				
				// generate user details
				$organization_id = common::getFieldValue("user", "organization_id", "username", $this->username);
				$user_id = common::getFieldValue("user", "user_id", "username", $this->username);
				$firstname = common::getFieldValue("user", "firstname", "username", $this->username);
				$lastname = common::getFieldValue("user", "lastname", "username", $this->username);
				$user_since = common::getFieldValue("user", "DATE_FORMAT(captured_date,'%d %b %Y')", "username", $this->username);
				$photo = common::getFieldValue("user", "photo", "username", $this->username);
				if (strlen($photo) == 0) $photo = "user.png";
				$fullname = "$firstname $lastname";
				
				self::updateUser($this->username);
			}
			
			// log the user activity
			$log_details = ($msg === "valid") ? "Successfully logged in" : $msg;
			audit_trail::log_trail("Login", $log_details, $this->username, "Users");
		}
		$_SESSION["organization_id"] = $organization_id;
		$_SESSION["username"] = $this->username;
		$_SESSION["user_id"] = $user_id;
		$_SESSION["fullname"] = $fullname;
		$_SESSION["user_since"] = $user_since;
		$_SESSION["photo"] = $photo;
		$_SESSION["session_id"] = session_id();
		$_SESSION["time_stamp"] = time();
		$_SESSION["message_login"] = $msg;
		$_SESSION["message_login_type"] = MESSAGE_ERROR_TYPE;
	}
	
	/**
     * Logout
	 *
     */
	public static function logout()
	{
		session_start();

		// log the user activity
		audit_trail::log_trail("Logout", "Logged out", $_SESSION["username"], "Users");
		
		// user has logged out , invalidate all session keys
		if (isset($_SESSION["organization_id"])) unset($_SESSION["organization_id"]);
		if (isset($_SESSION["username"])) unset($_SESSION["username"]);
		if (isset($_SESSION["fullname"])) unset($_SESSION["fullname"]);
		if (isset($_SESSION["photo"])) unset($_SESSION["photo"]);
		if (isset($_SESSION["user_since"])) unset($_SESSION["user_since"]);
		if (isset($_SESSION["session_id"])) unset($_SESSION["session_id"]);
		if (isset($_SESSION["time_stamp"])) unset($_SESSION["time_stamp"]);
		if (isset($_SESSION["message_login"])) unset($_SESSION["message_login"]);
		if (isset($_SESSION["message_login_type"])) unset($_SESSION["message_login_type"]);		
	}
	
    /**
	 * Check if a user is valid 
	 *
	 * @param string username
	 * @param string password
	 * 
	 * @return string result
	 */
	public function isValidUser($username, $password) {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$login_result = "invalid";
		
		$max_log_attempts = security::getSecurityAttribute("account_lockout_threshold");
		$max_unlock_duration = security::getSecurityAttribute("account_unlock_duration") * 60;
		if (strlen($max_log_attempts) == 0) $max_log_attempts = 1;
		
		$sql = "SELECT status, log_attempts, password, account_disabled, account_locked, account_lockout_time, email_verified, email_verification_key FROM {$table_prefix}user ";
		$sql .= "WHERE username = '" . $conn->real_escape_string($username) . "'";
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {		
			$status = $row->status;
			$log_attempts = $row->log_attempts;
			$account_locked = $row->account_locked;
			$account_disabled = $row->account_disabled;
			$email_verified = $row->email_verified;
			$email_verification_key = $row->email_verification_key;

			$time_elapsed = time() - $row->account_lockout_time;
			$db_hash = $row->password;
			
			if ($time_elapsed >= $max_unlock_duration && $log_attempts >= $max_log_attempts) {
				// maximum log attempts were reached and time lockout duration has elapsed, automatically unlock the user account
				if ($max_unlock_duration == 0) {
					//  the configured lockout duration is 0, (0 = no auto-unlock)...do nothing
				} else {
					self::updateUser($username);
					$account_locked = "No";
					$log_attempts = 0;
				}
			}
			
			if (strlen($email_verified) == 0 || strlen($email_verification_key) > 0)
				$login_result = "inactivated";
			elseif ($account_locked === "Yes" || $log_attempts >= $max_log_attempts)
				$login_result = "locked";
			elseif ($account_disabled === "Yes")
				$login_result = "disabled";
			elseif ($status === STATUS_ACTIVE && $db_hash === self::generateHash($password, $db_hash))
				$login_result = "valid";					
		}
		return $login_result;
	}
	
	/**
     * Generate email verification key 
     *
     * @param string $username
     * 
     * @return string email verification key
     */

 	 public static function generateEmailVerificationKey($username, $email) {    
        $email_verification_key = self::generateHash($email . $username);
        return $email_verification_key;
    }
	
	/**
	 * Update user details 
	 *
	 * @param string username
	 * @param string field_value
	 * @param string field
	 *
	 */
	function updateUser($username, $field_value = 0, $field = "log_attempts") {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// by default, do not update or clear the account lockout time
		$update_lockout_time = false;
		$clear_lockout_time = false;
		$lockout_time = 0;
		
		if ($field === "log_attempts") {
			if ($field_value == 0) {
				$log_attempts = 0;
				$log_attempts_int = $log_attempts;
			} else {
				$log_attempts = "$field + $field_value";
				$log_attempts_int = common::getFieldValue("user", "log_attempts", "username", $username) + $field_value;
			}
					
			$field_value = $log_attempts;			
			$max_log_attempts = security::getSecurityAttribute("account_lockout_threshold");
			
			if ($log_attempts_int >= $max_log_attempts) {
				// maximum allowable log attempts have been reached and account will be lockedout, update the user account with the time when the locking happened
				$update_lockout_time = true;
				$lockout_time = time();
			} elseif ($log_attempts_int == 0) {
				$clear_lockout_time = true;
			}
		}
		
		$sql = "UPDATE {$table_prefix}user SET $field = '" . $conn->real_escape_string($field_value) . "' WHERE username = '" . $conn->real_escape_string($username) . "' ";
		$sql .= "AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		$result = $conn->query($sql);

		if ($update_lockout_time || $clear_lockout_time) self::updateUser($username, $lockout_time, "account_lockout_time");
	}
	
	/**
	 * Check if a user is an NGO user 
	 *
	 * @param string username
	 * 
	 * @return true if a user is an NGO user, false otherwise
	 */
	public function isNGOUser($username) {		
		$conn = config::connect();
        $table_prefix = TABLE_PREFIX;
		
		$sql = "SELECT user_id FROM {$table_prefix}user WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND is_ngo_user = 'Yes' AND username = '";
		$sql .= $conn->real_escape_string($username) . "'";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			return true;
		}
		return false;
	}
}