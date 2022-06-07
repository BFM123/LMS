<?php
require_once "common.php";
/**
 * indicator class
 */
class indicator
{
  /**
	* declarations 
	*/
	private $indicator_id;
    private $indicator_name;
    private $indicator_code;
    private $description;
    private $thematic_area_id;
    private $data_format_id;
    private $target;
    private $minimum;
    private $maximum;
    private $disaggregation_ids;
	private $population_type_id;
    private $population_type_sub_ids;
    private $dataset_ids;
    private $old_dataset_ids;
    private $ignore_zero_values;
    private $captured_by;
    private $last_edited_by;
    private $deleted_by;
    private $record_control;
    private $year;
    private $month;
    private $indicator_values;
    private $district_id;
    private $status;

   /**
     * Get the value of indicator_id
     *
     * @return mixed
     */
    public function getIndicatorID()
    {
        return $this->indicator_id;
    }

   /**
     * Set the value of indicator_id
     *
     * @param mixed indicator_id
     *
     * @return self
     */
    public function setIndicatorID($indicator_id)
    {
        $this->indicator_id = $indicator_id;

        return $this;
    }

	/**
     * Get the value of indicator_name
     *
     * @return mixed
     */
    public function getIndicatorName()
    {
        return $this->indicator_name;
    }

   /**
     * Set the value of indicator_name
     *
     * @param mixed indicator_name
     *
     * @return self
     */
    public function setIndicatorName($indicator_name)
    {
        $this->indicator_name = $indicator_name;

        return $this;
    }
	
	/**
     * Get the value of indicator_code
     *
     * @return mixed
     */
    public function getIndicatorCode()
    {
        return $this->indicator_code;
    }

   /**
     * Set the value of indicator_code
     *
     * @param mixed indicator_code
     *
     * @return self
     */
    public function setIndicatorCode($indicator_code)
    {
        $this->indicator_code = $indicator_code;

        return $this;
    }
	
	/**
     * Get the value of description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

   /**
     * Set the value of description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

   /**
     * Get the value of thematic_area_id
     *
     * @return mixed
     */
    public function getThematicAreaID()
    {
        return $this->thematic_area_id;
    }

   /**
     * Set the value of thematic_area_id
     *
     * @param mixed thematic_area_id
     *
     * @return self
     */
    public function setThematicAreaID($thematic_area_id)
    {
        $this->thematic_area_id = $thematic_area_id;

        return $this;
    }

   /**
     * Get the value of data_format_id
     *
     * @return mixed
     */
    public function getDataFormat()
    {
        return $this->data_format_id;
    }

   /**
     * Set the value of data_format_id
     *
     * @param mixed data_format_id
     *
     * @return self
     */
    public function setDataFormat($data_format_id)
    {
        $this->data_format_id = $data_format_id;

        return $this;
    }
	
   /**
     * Get the value of target
     *
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

   /**
     * Set the value of target
     *
     * @param mixed target
     *
     * @return self
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

   /**
     * Get the value of minimum
     *
     * @return mixed
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

   /**
     * Set the value of minimum
     *
     * @param mixed minimum
     *
     * @return self
     */
    public function setMinimum($minimum)
    {
        $this->minimum = $minimum;

        return $this;
    }

   /**
     * Get the value of maximum
     *
     * @return mixed
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

   /**
     * Set the value of maximum
     *
     * @param mixed maximum
     *
     * @return self
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;

        return $this;
    }

   /**
     * Get the value of disaggregation_ids
     *
     * @return mixed
     */
    public function getDisaggregationIDs()
    {
        return $this->disaggregation_ids;
    }

   /**
     * Set the value of disaggregation_ids
     *
     * @param mixed disaggregation_ids
     *
     * @return self
     */
    public function setDisaggregationIDs($disaggregation_ids)
    {
        $this->disaggregation_ids = $disaggregation_ids;

        return $this;
    }
	
	/**
     * Get the value of population_type_id
     *
     * @return mixed
     */
    public function getPopulationTypeID()
    {
        return $this->population_type_id;
    }

   /**
     * Set the value of population_type_id
     *
     * @param mixed population_type_id
     *
     * @return self
     */
    public function setPopulationTypeID($population_type_id)
    {
        $this->population_type_id = $population_type_id;

        return $this;
    }
	
	/**
     * Get the value of population_type_sub_ids
     *
     * @return mixed
     */
    public function getPopulationTypeSubIDs()
    {
        return $this->population_type_sub_ids;
    }

   /**
     * Set the value of population_type_sub_ids
     *
     * @param mixed population_type_sub_ids
     *
     * @return self
     */
    public function setPopulationTypeSubIDs($population_type_sub_ids)
    {
        $this->population_type_sub_ids = $population_type_sub_ids;

        return $this;
    }
	
	/**
     * Get the value of dataset_ids
     *
     * @return mixed
     */
    public function getDatasetIDs()
    {
        return $this->dataset_ids;
    }

   /**
     * Set the value of dataset_ids
     *
     * @param mixed dataset_ids
     *
     * @return self
     */
    public function setDatasetIDs($dataset_ids)
    {
        $this->dataset_ids = $dataset_ids;

        return $this;
    }
	
   /**
     * Get the value of old_dataset_ids
     *
     * @return mixed
     */
    public function getDatasetOldIDs()
    {
        return $this->old_dataset_ids;
    }

   /**
     * Set the value of old_dataset_ids
     *
     * @param mixed old_dataset_ids
     *
     * @return self
     */
    public function setDatasetOldIDs($old_dataset_ids)
    {
        $this->old_dataset_ids = $old_dataset_ids;

        return $this;
    }
	
   /**
     * Get the value of month
     *
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

   /**
     * Set the value of month
     *
     * @param mixed month
     *
     * @return self
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

   /**
     * Get the value of ignore_zero_values
     *
     * @return mixed
     */
    public function getIgnoreZeroValues()
    {
        return $this->ignore_zero_values;
    }

   /**
     * Set the value of ignore_zero_values
     *
     * @param mixed ignore_zero_values
     *
     * @return self
     */
    public function setIgnoreZeroValues($ignore_zero_values)
    {
        $this->ignore_zero_values = $ignore_zero_values;

        return $this;
    }
	
	/**
     * Get the value of year
     *
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

   /**
     * Set the value of year
     *
     * @param mixed year
     *
     * @return self
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }
	
    /**
     * Get the value of sdistrict_id
     *
     * @return mixed
     */
    public function getDistrictID()
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
    public function setDistrictID($district_id)
    {
        $this->district_id = $district_id;

        return $this;
    }

   /**
     * Get the value of indicator_values
     *
     * @return mixed
     */
    public function getIndicatorValues()
    {
        return $this->indicator_values;
    }

   /**
     * Set the value of indicator_values
     *
     * @param mixed indicator_values
     *
     * @return self
     */
    public function setIndicatorValues($indicator_values)
    {
        $this->indicator_values = $indicator_values;

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
     * Add indicator
	 *
     */
    public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

        $exists = common::exists("indicator", 0, "indicator_name", $this->indicator_name, "indicator_code", $this->indicator_code);

        if ($exists) {
            $_SESSION["message"] = "Indicator '$this->indicator_name'" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

		$sql = "INSERT INTO {$table_prefix}indicator (indicator_code, indicator_name, thematic_area_id, data_format_id, target, minimum, maximum, population_type_id, ";
		$sql .= "population_type_sub_ids, description, disaggregation_ids, ignore_zero_values, captured_by, captured_date, status) VALUES('";
		$sql .= $conn->real_escape_string($this->indicator_code) . "', '" . $conn->real_escape_string($this->indicator_name) . "', '";
		$sql .= $conn->real_escape_string($this->thematic_area_id) . "', '".$conn->real_escape_string($this->data_format_id)."', '".$conn->real_escape_string($this->target)."', '";
		$sql .= $conn->real_escape_string($this->minimum) . "', '" . $conn->real_escape_string($this->maximum) . "', '".$conn->real_escape_string($this->population_type_id)."', '";
		$sql .= $conn->real_escape_string($this->population_type_sub_ids) . "', '" . $conn->real_escape_string($this->description) . "', '";
		$sql .= $conn->real_escape_string($this->disaggregation_ids) . "', '" . $conn->real_escape_string($this->ignore_zero_values) . "', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";

		$result = $conn->query($sql);
		if ($result) {
			$add_error = false;
            $indicator_id = mysqli_insert_id($conn);
			$dataset_ids = $this->dataset_ids;

			$dataset = new dataset();
			// add the indicator to the group
			foreach ($dataset_ids as $dataset_id) :
				$add_error = false;
				$indicator_ids = common::getFieldValue("dataset", "indicator_ids", "dataset_id", $dataset_id);				

				//  add the indicator to the group if its not already added
				if (strpos($indicator_ids, "|$indicator_id|") === false) {
					$indicator_ids = $indicator_ids . "$indicator_id|";
					$dataset_name = common::getFieldValue("dataset", "dataset_name", "dataset_id", $dataset_id);
					$dataset_description = common::getFieldValue("dataset", "description", "dataset_id", $dataset_id);
	
					$dataset->setDatasetID($dataset_id);
					$dataset->setIndicatorIDs($indicator_ids);
					$dataset->setDatasetName($dataset_name);
					$dataset->setDescription($dataset_description);
					$dataset->setLastEditedBy($this->captured_by);
					$dataset->edit();

					$dataset_processing_result = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
					if (strpos(strtolower($dataset_processing_result), strtolower(MESSAGE_SUCCESS)) === false) {
						$add_error = true;
						break;
					}
				}					
			endforeach;
			
			$dataset_processing_str = "";
			$type = MESSAGE_SUCCESS_TYPE;

			if ($add_error) {
				$dataset_processing_str = ". But an error was encountered while updating datasets";
				$type = MESSAGE_INFORMATION_TYPE;
			}

            $_SESSION["message"] = "Indicator '$this->indicator_name'" . MESSAGE_SUCCESS . "added$dataset_processing_str";
            $_SESSION["message_type"] = $type;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity		
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Indicators", mysqli_insert_id($conn));
	}

    /**
     * Edit indicator
     *
     */
    public function edit()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        $exists_name = common::exists("indicator", $this->indicator_id, "indicator_name", $this->indicator_name, "indicator_code", $this->indicator_code);

        if ($exists_name) {
            $_SESSION["message"] = "Indicator '$this->indicator_name'" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

        $sql = "UPDATE {$table_prefix}indicator SET indicator_code = '" . $conn->real_escape_string($this->indicator_code) . "', indicator_name = '";
		$sql .= $conn->real_escape_string($this->indicator_name) . "', description = '" . $conn->real_escape_string($this->description) . "', ";
        $sql .= "target = '" . $conn->real_escape_string($this->target) . "', data_format_id = '" . $conn->real_escape_string($this->data_format_id) . "', thematic_area_id = '";
		$sql .= $conn->real_escape_string($this->thematic_area_id) . "', disaggregation_ids = '" . $conn->real_escape_string($this->disaggregation_ids)."', ignore_zero_values = '";
		$sql .= $conn->real_escape_string($this->ignore_zero_values) . "', minimum = '" . $conn->real_escape_string($this->minimum) . "', maximum = '";
		$sql .= $conn->real_escape_string($this->maximum) . "', population_type_id = '" . $conn->real_escape_string($this->population_type_id) . "', population_type_sub_ids = '";
		$sql .= $conn->real_escape_string($this->population_type_sub_ids) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = ";
		$sql .= "NOW() WHERE indicator_id = '" . $conn->real_escape_string($this->indicator_id) . "'";

        $result = $conn->query($sql);
        if ($result) {
		  	$add_error = false;
		  	$delete_error = false;
			$indicator_id = $this->indicator_id;
			$dataset_ids = $this->dataset_ids;

			$dataset = new dataset();

			// add the indicator to the group
			foreach ($dataset_ids as $dataset_id) :
				$add_error = false;
				$indicator_ids = common::getFieldValue("dataset", "indicator_ids", "dataset_id", $dataset_id);				

				//  add the indicator to the group if its not already added
				if (strpos($indicator_ids, "|$indicator_id|") === false) {
					if (strlen(trim($indicator_ids)) == 0) $indicator_ids = "|";
					$indicator_ids = $indicator_ids . "$indicator_id|";
					$dataset_name = common::getFieldValue("dataset", "dataset_name", "dataset_id", $dataset_id);
					$dataset_description = common::getFieldValue("dataset", "description", "dataset_id", $dataset_id);
	
					$dataset->setDatasetID($dataset_id);
					$dataset->setIndicatorIDs($indicator_ids);
					$dataset->setDatasetName($dataset_name);
					$dataset->setDescription($dataset_description);
					$dataset->setLastEditedBy($this->last_edited_by);
					$dataset->edit();

					$dataset_processing_result = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
					if (strpos(strtolower($dataset_processing_result), strtolower(MESSAGE_SUCCESS)) === false) {
						$add_error = true;
						break;
					}
				}					
			endforeach;
			
			// delete the indicator from the group
			$old_dataset_ids = $this->old_dataset_ids;
			if (strlen($old_dataset_ids) > 0) {
				$old_dataset_ids = substr($old_dataset_ids, 1); // remove the first | from the string
				$old_dataset_ids = substr_replace($old_dataset_ids, "", -1); // remove the last | from the string

				$old_dataset_ids = explode("|", $old_dataset_ids);
				foreach ($old_dataset_ids as $old_dataset_id) :
					$delete_error = false;
					
					//  delete the indicator from the group if it was excluded
					if (!in_array($old_dataset_id, $dataset_ids)) {
						$old_indicator_ids = common::getFieldValue("dataset", "indicator_ids", "dataset_id", $old_dataset_id);				
						$old_indicator_ids = str_replace("$indicator_id|", "", $old_indicator_ids);
						if ($old_indicator_ids === "|") $old_indicator_ids = "";
						$old_dataset_name = common::getFieldValue("dataset", "dataset_name", "dataset_id", $old_dataset_id);
						$old_dataset_description = common::getFieldValue("dataset", "description", "dataset_id", $old_dataset_id);
		
						$dataset->setDatasetID($old_dataset_id);
						$dataset->setIndicatorIDs($old_indicator_ids);
						$dataset->setDatasetName($old_dataset_name);
						$dataset->setDescription($old_dataset_description);
						$dataset->setLastEditedBy($this->captured_by);
						$dataset->edit();
	
						$dataset_processing_result = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
						if (strpos(strtolower($dataset_processing_result), strtolower(MESSAGE_SUCCESS)) === false) {
							$delete_error = true;
							break;
						}
					}					
				endforeach;
			}	
			
  			$dataset_processing_str = "";
			$type = MESSAGE_SUCCESS_TYPE;

			if ($add_error || $delete_error) {
				$dataset_processing_str = ". But an error was encountered while updating datasets";
				$type = MESSAGE_INFORMATION_TYPE;
			}

            $_SESSION["message"] = "Indicator '$this->indicator_name'" . MESSAGE_SUCCESS . "updated$dataset_processing_str";
            $_SESSION["message_type"] = $type;
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Indicators", $this->indicator_id);
    }

    /**
     * Delete indicator
     *
     */
    public function delete()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        // check if this indicator is in use
        $is_used = false;

        if ($is_used) {
            $_SESSION["message"] = "Indicator '$this->indicator_name'" . MESSAGE_IN_USE;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

        $sql = "UPDATE {$table_prefix}indicator SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" . $conn->real_escape_string($this->deleted_by) . "', deleted_date = NOW() WHERE indicator_id = '" . $conn->real_escape_string($this->indicator_id) . "'";

        $result = $conn->query($sql);

        if ($result) {
			$delete_error = false;
			$indicator_id = $this->indicator_id;
			$dataset_ids = common::getFieldValue("dataset", "GROUP_CONCAT(DISTINCT dataset_id)", "indicator_ids LIKE '%|" . $conn->real_escape_string($indicator_id) . "|%' AND 1", 1);
			$dataset_ids = explode(",", $dataset_ids);			

			// delete the indicator from the group
			$dataset = new dataset();
			foreach ($dataset_ids as $dataset_id) :
				$delete_error = false;
				
				$indicator_ids = common::getFieldValue("dataset", "indicator_ids", "dataset_id", $dataset_id);				
				$indicator_ids = str_replace("$indicator_id|", "", $indicator_ids);
				if ($indicator_ids === "|") $indicator_ids = "";
				$dataset_name = common::getFieldValue("dataset", "dataset_name", "dataset_id", $dataset_id);
				$dataset_description = common::getFieldValue("dataset", "description", "dataset_id", $dataset_id);

				$dataset->setDatasetID($dataset_id);
				$dataset->setIndicatorIDs($indicator_ids);
				$dataset->setDatasetName($dataset_name);
				$dataset->setDescription($dataset_description);
				$dataset->setLastEditedBy($this->deleted_by);
				$dataset->edit();

				$dataset_processing_result = (isset($_SESSION["message"])) ? $_SESSION["message"] : "";
				if (strpos(strtolower($dataset_processing_result), strtolower(MESSAGE_SUCCESS)) === false) {
					$delete_error = true;
					break;
				}
			endforeach;
			
			$dataset_processing_str = "";
			$type = MESSAGE_SUCCESS_TYPE;

			if ($delete_error) {
				$dataset_processing_str = ". But an error was encountered while updating datasets";
				$type = MESSAGE_INFORMATION_TYPE;
			}

            $_SESSION["message"] = "Indicator '$this->indicator_name'" . MESSAGE_SUCCESS . "deleted$dataset_processing_str";
            $_SESSION["message_type"] = $type;						
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Indicators", $this->indicator_id);
    }

    /**
	 * List all indicators
	 *
	 * @param string indicator_id
	 * @param string order_by
 	 * @param string fields
	 * @param array dataset_ids
	 * @param array thematic_area_ids
	 * @param array population_type_ids
	 * @param array population_type_sub_ids
	 * @param int limit
	 *
 	 * @return array of indicators
	 */
	public static function all($indicator_id = "", $order_by = "", $fields = "*", $dataset_ids = array(), $thematic_area_ids = array(), 
							   $population_type_ids = array(), $population_type_sub_ids = array(), $limit = 0)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$indicators = array();
		$sql = "SELECT $fields FROM {$table_prefix}indicator WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($indicator_id) > 0) $sql .= "AND indicator_id IN ('$indicator_id') ";
		if (!empty($dataset_ids)) {
			$sql .= "AND LOCATE(CONCAT('|', indicator_id, '|'), (SELECT REPLACE(REPLACE(GROUP_CONCAT(DISTINCT indicator_ids), ',', ''), '||', '|') FROM ";
			$sql .= "{$table_prefix}dataset WHERE dataset_id IN ('" . implode("', '", $dataset_ids) . "'))) > 0 ";
		}
		if (!empty($thematic_area_ids)) {
			$sql .= "AND thematic_area_id IN ('" . implode("', '", $thematic_area_ids) . "') ";
		}
		if (!empty($population_type_ids)) {
			$sql .= "AND population_type_id IN ('" . implode("', '", $population_type_ids) . "') ";
		}
		if (!empty($population_type_sub_ids)) {
			$sql .= "AND (";
			foreach ($population_type_sub_ids as $p) :
				$sql .= "LOCATE('|$p|', population_type_sub_ids) > 0 OR ";
			endforeach;
			$sql = substr_replace(trim($sql), "", -2); // remove the OR from the string
			$sql .= ") ";
		}
		if (strlen($order_by) > 0) $sql .= "ORDER BY $order_by";
		else $sql .= "ORDER BY indicator_name";
		
		if ($limit > 0) $sql .= " LIMIT $limit";
		
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$indicators[] = $row;
		}
		return $indicators;
	}
}