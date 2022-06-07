<?php
require_once "common.php";

/**
 * Class notices
 */

class notice
{
    private $notice_id;
    private $notice_title;
    private $notice_content;
    private $captured_by;
    private $last_edited_by;
    private $deleted_by;

    /**
     * Get the value of notice_id
     *
     * @return mixed notice_id
     */
    public function getNoticeID()
    {
        return $this->notice_id;
    }

    /**
     * Set the value of notice_id
     *
     * @param mixed notice_id
     *
     * @return self
     */
    public function setNoticeID($notice_id)
    {
        $this->notice_id = $notice_id;

        return $this;
    }

    /**
     * Get the value of notice_title
     *
     * @return mixed notice_title
     */
    public function getNoticeTitle()
    {
        return $this->notice_title;
    }

    /**
     * Set the value of notice_title
     *
     * @param mixed notice_title
     *
     * @return self
     */
    public function setNoticeTitle($notice_title)
    {
        $this->notice_title = $notice_title;

        return $this;
    }

	/**
     * Get the value of notice_content
     *
     * @return mixed notice_content
     */
    public function getNoticeContent()
    {
        return $this->notice_content;
    }
	
 	/**
     * Set the value of notice_content
     *
     * @param mixed notice_content
     *
     * @return self
     */
    public function setNoticeContent($notice_content)
    {
        $this->notice_content = $notice_content;

        return $this;
    }

    /**
     * Get the value of captured_by
     *
     * @return mixed captured_by
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
     * @return mixed last_edited_by
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
     * Get the value of deleted by
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
     * Add notices article
     */
    public function add()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;
        $record_exists = common::exists("notice", 0, "notice_title", trim($this->notice_title));

        if ($record_exists) {
            $_SESSION["message"] = "Notice  <b><i>$this->notice_title</i></b>" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

        $sql = "INSERT INTO {$table_prefix}notice (notice_title, notice_content, captured_by, captured_date, status) VALUES ('$this->notice_title', ";
		$sql.="'".$conn->real_escape_string($this->notice_content)."', '".$conn->real_escape_string($this->captured_by)."', NOW(), '".$conn->real_escape_string(STATUS_ACTIVE)."')";

        $result = $conn->query($sql);
		
        if ($result){
            $_SESSION["message"] = "Notice  <b><i>$this->notice_title</i></b>" . MESSAGE_SUCCESS . "added";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
         } else {
            $_SESSION["message"] =  MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Notices", mysqli_insert_id($conn));
    }

    /**
     * Edit notices article
     */
    public function edit()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;
        $record_exists = common::exists("notice", $this->notice_id, "notice_title", trim($this->notice_title));

        if ($record_exists) {
            $_SESSION["message"] = "Notice <b><i>$this->notice_title</i></b>" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
        $sql = "UPDATE {$table_prefix}notice SET notice_title = '" . $conn->real_escape_string($this->notice_title) . "', notice_content = '";
		$sql .= $conn->real_escape_string($this->notice_content) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() ";
		$sql .= "WHERE notice_id = '" . $conn->real_escape_string($this->notice_id) . "' ";
		
        $result = $conn->query($sql);
		
        if ($result){
            $_SESSION["message"] = "Notice <b><i>$this->notice_title</i></b>" . MESSAGE_SUCCESS . "updated";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
         } else {
            $_SESSION["message"] =  MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Notices", $this->notice_id);
    }

    /**
     * Delete notices article
     */
    public function delete()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

		$sql = "UPDATE {$table_prefix}notice SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by);
		$sql .= "', deleted_date = NOW() WHERE notice_id = '" . $conn->real_escape_string($this->notice_id) . "'";
		
        $result = $conn->query($sql);
		
        if ($result){
            $_SESSION["message"] = "Notice <b><i>$this->notice_title</i></b>" . MESSAGE_SUCCESS . "deleted";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
         } else {
            $_SESSION["message"] =  MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Notices", $this->notice_id);
	}
	
	/**
	 * 
	 * List notices articles
	 *
     * @param string limit
	 *
     * @return array of notices article
     */
    public static function all($limit = "")
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        $notices = array();
        $sql = "SELECT * FROM {$table_prefix}notice WHERE status= '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY captured_date DESC";
		if (strlen($limit) > 0) $sql .= " LIMIT $limit";

        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            $notices[] = $row;
        }
        return $notices;
    }
}