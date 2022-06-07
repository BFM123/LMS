<?php
require_once "common.php";
 /**
  * system class
  */
 
class system
{
    /**
	 *declarations
	 */
	private $system_id;
	private $title;
	private $licensee;
	private $slogan;
	private $landing_page_id;
	private $technical_support_contact;
	private $address;
	private $website;
	private $email;
	private $telephone;
	private $captured_by;
    private $last_edited_by;
    private $deleted_by;

    /**
     * Get the value of system_id
     *
     * @return mixed
     */
    public function getSystemID()
    {
        return $this->system_id;
    }

    /**
     * Set the value of system_id
     *
     * @param mixed system_id
     *
     * @return self
     */
    public function setSystemID($system_id)
    {
		$this->system_id = $system_id;
		
        return $this;
    }
	
    /**
     * Get the value of title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param mixed title
     *
     * @return self
     */
    public function setTitle($title)
    {
		$this->title = $title;
		
        return $this;
    }
	
    /**
     * Get the value of licensee
     *
     * @return mixed
     */
    public function getLicensee()
    {
        return $this->licensee;
    }

    /**
     * Set the value of licensee
     *
     * @param mixed licensee
     *
     * @return self
     */
    public function setLicensee($licensee)
    {
        $this->licensee = $licensee;

        return $this;
    }

    /**
     * Get the value of slogan
     *
     * @return mixed
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Set the value of slogan
     *
     * @param mixed slogan
     *
     * @return self
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }

    /**
     * Get the value of landing_page_id
     *
     * @return mixed
     */
    public function getLandingPageID()
    {
        return $this->landing_page_id;
    }

    /**
     * Set the value of landing_page_id
     *
     * @param mixed landing_page_id
     *
     * @return self
     */
    public function setLandingPageID($landing_page_id)
    {
        $this->landing_page_id = $landing_page_id;

        return $this;
    }

    /**
     * Get the value of technical_support_contact
     *
     * @return mixed
     */
    public function getTechnicalSupportContact()
    {
        return $this->technical_support_contact;
    }

    /**
     * Set the value of technical_support_contact
     *
     * @param mixed technical_support_contact
     *
     * @return self
     */
    public function setTechnicalSupportContact($technical_support_contact)
    {
        $this->technical_support_contact = $technical_support_contact;

        return $this;
    }
   
    /**
     * Get the value of address
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param mixed address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
   
    /**
     * Get the value of website
     *
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the value of website
     *
     * @param mixed website
     *
     * @return self
     */
    public function setWebsite($website)
    {
        $this->website = $website;

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
     * Get the value of telephone
     *
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @param mixed telephone
     *
     * @return self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

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
     * Add system details
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the system already exists
		$exists = common::exists("system", 0, "title", $this->title);
		
		if ($exists) {
			// this is a duplicate system, display error message to the user	
			$_SESSION["message"] = "System '$this->title'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
													
		// this is not a duplicate system, proceed to create	
		$sql = "INSERT INTO {$table_prefix}system (title, licensee, slogan, address, email, telephone, website, technical_support_contact, landing_page_id, captured_by, ";
		$sql .= "captured_date, status) VALUES('" . $conn->real_escape_string($this->title) . "', '" . $conn->real_escape_string($this->licensee) . "', '";
		$sql .= $conn->real_escape_string($this->slogan) . "', '" . $conn->real_escape_string($this->address) . "', '" . $conn->real_escape_string($this->email) . "', '";
		$sql .= $conn->real_escape_string($this->real_escape_string) . "', '" . $conn->real_escape_string($this->website) . "', '";
		$sql .= $conn->real_escape_string($this->technical_support_contact) . "', '" . $conn->real_escape_string($this->landing_page_id) . "', ";
		$sql .= $conn->real_escape_string($this->captured_by) . "NOW(), '" . STATUS_ACTIVE . "')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "System details" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "System", mysqli_insert_id($conn));
	}
		
    /**
     * Update system details
	 *
     */
    public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the system already exists
		$exists = common::exists("system", $this->system_id, "title", $this->title);
		
		if ($exists) {
			// this is a duplicate system, display error message to the user	
			$_SESSION["message"] = "System '$this->title'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// this is not a duplicate system, proceed to update	
		$sql = "UPDATE {$table_prefix}system SET title = '" . $conn->real_escape_string($this->title) . "', licensee = '" . $conn->real_escape_string($this->licensee) . "', ";
		$sql .= "slogan = '" . $conn->real_escape_string($this->slogan) . "', landing_page_id = '" . $conn->real_escape_string($this->landing_page_id) . "', ";
		$sql .= "technical_support_contact = '" . $conn->real_escape_string($this->technical_support_contact) . "', telephone = '";
		$sql .= $conn->real_escape_string($this->telephone) . "', email = '" . $conn->real_escape_string($this->email) . "', address = '";
		$sql .= $conn->real_escape_string($this->address) . "', website = '" . $conn->real_escape_string($this->website) . "', last_edited_by = '";
		$sql .= $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE system_id = '" . $conn->real_escape_string($this->system_id) . "' ";
		$sql .= "AND status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "System details" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "System", $this->system_id);
	}
	
    /**
     * Delete system details
	 *
     */
    public function delete()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if the system is in use...by default the system is in use, don't delete system details
		$is_used = true;
		
		if ($is_used) {
			// this system is in use, display error message to the user	
			$_SESSION["message"] = "System '$this->title'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		// system not in use, proceed to delete	
		$sql = "UPDATE {$table_prefix}system SET status = '" .$conn->real_escape_string(STATUS_DELETED)."', deleted_by = '".$conn->real_escape_string($this->deleted_by)."', ";
		$sql .= "deleted_date = NOW() WHERE system_id = '" . $conn->real_escape_string($this->system_id) ."' AND status = '".$conn->real_escape_string(STATUS_ACTIVE)."'";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "System" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "System", $this->system_id);
	}
	
    /**
	 * List all systems
	 *
 	 * @return array of systems
	 */
	public static function all()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
        $database_name = DATABASE_NAME;

		$systems = array();
		$sql = "SELECT * FROM {$table_prefix}{$database_name}system WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY title";
		$result = $conn->query($sql);
		
		while ($row = $result->fetch_object()) {
			$systems[] = $row;
		}
		return $systems;
	}
}