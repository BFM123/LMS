<?php
require_once "common.php";
require_once "indicator_value.php";

/**
 * Class data_import
 */
class data_import
{
    private $data_import_id;
    private $data_source;
    private $file_has_header;
    private $filename;
    private $captured_by;


    /**
     * Get the value of data_import_id
     *
     * @return mixed
     */
    public function getDataImportID()
    {
        return $this->data_import_id;
    }

    /**
     * Set the value of data_import_id
     *
     * @param mixed data_import_id
     *
     * @return self
     */
    public function setDataImportID($data_import_id)
    {
        $this->data_import_id = $data_import_id;

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
     * Get the value of file_has_header
     *
     * @return mixed
     */
    public function getFileHasHeader()
    {
        return $this->file_has_header;
    }

    /**
     * Set the value of file_has_header
     *
     * @param mixed file_has_header
     *
     * @return self
     */
    public function setFileHasHeader($file_has_header)
    {
        $this->file_has_header = $file_has_header;

        return $this;
    }


    /**
     * Get the value of filename
     *
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @param mixed filename
     *
     * @return self
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

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
     * List data_imports
     *
	 * @param string captured_by
	 *
     * @return array of data_imports
     */
    public static function all($captured_by)
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;
        $data_import = array();
        $sql = "SELECT * FROM {$table_prefix}data_import WHERE captured_by = '" . $conn->real_escape_string($captured_by) . "' AND status = '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY captured_date DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_object()) {
            $data_import[] = $row;
        }
        return $data_import;
    }
    /**
     * List Data Sources
     *
     *
     * @return array of Data Sources
     */
    public static function getDataSources()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;
        $data_sources = array();

        $sql = "SELECT * FROM {$table_prefix}data_source WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY description";
        $result = $conn->query($sql);

        while ($row = $result->fetch_object()) {
            $data_sources[] = $row;
        }
        return $data_sources;
    }


    /**
     * Import indicators
     *
     */
    public function import()
    {
        global $upload_file_extensions;
        global $INDICATOR_STATUS;
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        // set the maximum execution time to 60 seconds
        set_time_limit(60);

        // statuses
        $submitted = array_keys($INDICATOR_STATUS)[1];
        $record_control = $submitted;
		
		$file_name = $this->filename["name"];$file_name_parts = explode(".", $file_name);
        $file_size = $this->filename["size"];
        $file_tmp = $this->filename["tmp_name"];
        $file_type = $this->filename["type"];
        $file_extension = strtolower(end($file_name_parts));
        //$file_extension = substr($file_name, strrpos($file_name, "."));
        $file_size_MB = $file_size / 1024 / 1024;

        // track errors
        $error = "";
        if ($file_size <= 0) $error = "You did not upload any file";
        elseif (in_array($file_extension, $upload_file_extensions) === false) $error = "Invalid file format";
        elseif ($file_size_MB > MAX_FILE_IMPORT_SIZE) $error = "File size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
		elseif (!in_array($this->data_source, array(DATA_IMPORT_NORMAL, DATA_IMPORT_DHIS2, DATA_IMPORT_DHAMIS, DATA_IMPORT_LAHARS))) $error = "Wrong data source selected";

        // stop if any errors were encountered
        if (strlen($error) > 0) {
            $_SESSION["message"] = $error;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }	

		if ($this->data_source === DATA_IMPORT_NORMAL) {
			// specify which file colums have specific data for normal import
			$indicator_code_col_index = 0;
			$indicator_value_col_index = 2;
			$reporting_month_col_index = 3;
			$reporting_year_col_index = 4;
		} elseif ($this->data_source === DATA_IMPORT_DHAMIS) {
			// specify which file colums have specific data for DHAMIS
			$indicator_code_col_index = 0;
			$indicator_value_col_index = 2;
			$reporting_month_col_index = 3;
			$reporting_year_col_index = 4;
		} elseif ($this->data_source === DATA_IMPORT_DHIS2) {
			// specify which file colums have specific data for DHIS2
			$indicator_code_col_index = 0;
			$indicator_value_col_index = 2;
			$reporting_month_col_index = 3;
			$reporting_year_col_index = 4;
		} elseif ($this->data_source === DATA_IMPORT_LAHARS) {
			// specify which file colums have specific data for LAHARS
			$indicator_code_col_index = 0;
			$indicator_value_col_index = 2;
			$reporting_month_col_index = 3;
			$reporting_year_col_index = 4;
		}
		
		// track the number of indicators uploaded successfully, those with errors and those already submitted
		$indicators_success = 0;
		$indicators_error = 0;
		$indicators_submitted = 0;
		
		// open the file for reading
        $handle = fopen($file_tmp, "r");
        $header_row = ($this->file_has_header === "Yes") ? true : false;
        $rows = 0;
        $result_message = "";

		while ($data = fgetcsv($handle, 0, ",", "\"")) {	
            if (!$header_row) {
				$indicator_code = trim($data[$indicator_code_col_index]);
				if (strlen($indicator_code) > 0) { // check that at least all records have a indicator code
                    // get the data from the uploaded file
					$reporting_month = trim($data[$reporting_month_col_index]);
					$reporting_year = trim($data[$reporting_year_col_index]);
					$indicator_value = htmlspecialchars(trim($data[$indicator_value_col_index]));
					
					if (strlen($indicator_code) > 0) {
	                    // calculate the number of rows processed
	                    $rows++;
	
						$indicator_id = common::getFieldValue("indicator", "indicator_id", "indicator_code", $indicator_code);
						$dataset_id = common::getFieldValue("dataset", "dataset_id", "indicator_ids  LIKE '%|$indicator_id|%' AND 1 ", 1);

						if (strlen($indicator_id) > 0) {
					        $indicators = array();
							$indicators[0][0] = $indicator_id;
							$indicators[0][1] = $dataset_id;
							$indicators[0][2] = $indicator_value;
							
							// import the indicator
							$indicator_values = new indicator_value();
							$indicator_values->setDataSource($this->data_source);
							$indicator_values->setRecordControl($record_control);
							$indicator_values->setReportingMonth($reporting_month);
							$indicator_values->setReportingYear($reporting_year);
							$indicator_values->setIndicators($indicators);
							$indicator_values->setCapturedBy($this->captured_by);
							$indicator_values->capture();
							
							$result = isset($_SESSION["message"]) ?  $_SESSION["message"] : "";
							if (common::startsWith(strtolower($result), strtolower(MESSAGE_SUCCESS))) {
								$indicators_success++;
							} elseif (common::startsWith(strtolower($result), strtolower(MESSAGE_ERROR))) {
								$indicators_error++;
							} else {
								$pos_1 = strpos($result, ".");
								$pos_2 = strpos($result, " ", $pos_1 + 2);
								$errors_num = (int)substr($result, $pos_1 + 1, $pos_2 - $pos_1);
								$indicators_error += $errors_num;	
								
								$pos_1 = strpos($result, ".", $pos_2 + 1);
								$pos_2 = strpos($result, " ", $pos_1 + 2);
								$submitted_num = (int)substr($result, $pos_1 + 1, $pos_2 - $pos_1);
								$indicators_submitted += $submitted_num;
							}
						}
					}
                } 
			} else {
				$header_row = false;
			}
        }	
	
		if ($indicators_success < $rows) {
			// not all indicators were processed successfully
			if ($indicators_error == $rows) {
				// all indicators had errors
				$result_message = MESSAGE_ERROR;
				$type = MESSAGE_ERROR_TYPE;
			/*
			} elseif ($indicators_submitted == $rows) {
				// all indicators were already submitted
				$result_message = "All " . number_format($indicators_submitted, 0) . " indicator(s) were already submitted";
				$type = MESSAGE_INFORMATION_TYPE;
			*/
			} else {
				// some indicators had errors, others were already submitted
				$result_message = "A total of " . number_format($indicators_success, 0) . " indicator(s) were imported " . trim(MESSAGE_SUCCESS) . ". ";
				$result_message .= number_format($indicators_error,0) . " indicator(s) had errors. ";
				$result_message .= number_format($indicators_submitted, 0) . " indicator(s) were already submitted";
				$type = MESSAGE_INFORMATION_TYPE;
			}
		} else {
			// all indicators were processed successfully
			$result_message = ucwords(MESSAGE_SUCCESS) . "imported " . number_format($indicators_success, 0) . " indicator(s)";
			$type = MESSAGE_SUCCESS_TYPE;
		}
		$_SESSION["message"] = $result_message;
		$_SESSION["message_type"] = $type;	
			
        // insert the record into database for the file that has been uploaded		
		if ($indicators_error == $rows || $indicators_submitted == $rows) {
			// either all indicators had errors or all indicators were already submitted...do nothing
		} else {			
			$sql = "INSERT INTO {$table_prefix}data_import (data_source, filename, result, captured_by, captured_date, status)";
			$sql .= " VALUES('" . $conn->real_escape_string($this->data_source) . "', '" . $conn->real_escape_string($file_name) . "', '";
			$sql .= $conn->real_escape_string($result_message) . "', '" . $conn->real_escape_string($this->captured_by)."', NOW(), '".$conn->real_escape_string(STATUS_ACTIVE)."')";
			$result = $conn->query($sql);
		}
		
		// log the user activity
		audit_trail::log_trail("Import Data", $_SESSION["message"], $this->captured_by, "DataImport");
    }
}