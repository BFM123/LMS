<?php
require_once "audit_trail.php";

/**
 * A class of commonly used functions
 */

class common 
{
	/**
	 * List menu item weights
	 *
	 * @return array of menu item weights
	 */
	public static function listWeights() {
		$weights = array();
		for ($i = -MAX_WEIGHT; $i <= MAX_WEIGHT; $i++) {
			$weights[] = $i;
		}
		return $weights;
	}
	
	/**
	 * Check if a specific record exists
	 *
	 * @param string table_name
	 * @param int record_id
	 * @param string field_name_1
	 * @param string field_value_1
	 * @param string field_name_2
	 * @param string field_value_2
	 * @param string field_name_3
	 * @param string field_value_3
	 * @param string status
	 * @param string status_operator
	 * @param string functionn
	 *
	 * @return true if record exists, false otherwise
	 */
	public static function exists($table_name, $record_id = 0, $field_name_1 = "", $field_value_1 = "", $field_name_2 = "", $field_value_2 = "", $field_name_3 = "", 
								  $field_value_3 = "", $status = STATUS_ACTIVE, $status_operator = "=") {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		

		$table_id = $table_name . "_id";
		
		$sql = "SELECT $table_id FROM {$table_prefix}$table_name WHERE status $status_operator '$status' ";		
		if (strlen(trim($field_name_1)) > 0) $sql .= "AND $field_name_1 = '" . $conn->real_escape_string($field_value_1). "' ";		
		if (strlen(trim($field_name_2)) > 0) $sql .= "AND $field_name_2 = '" . $conn->real_escape_string($field_value_2) . "' ";		
		if (strlen(trim($field_name_3)) > 0) $sql .= "AND $field_name_3 = '" . $conn->real_escape_string($field_value_3) . "' ";					
		if ($record_id != 0) $sql .= "AND $table_id <> '$record_id'";
		//if (self::startsWith($table_name, "certificate")) {echo $sql; die();}
		//if (self::startsWith($table_name, "reporting_organization")) {echo $sql; die();}

		$result = $conn->query($sql);
		while ($row = $result->fetch_object()) {
			return true;
		}
		return false;
	}
	
	/**
	 * Get a value for a specific table field
	 *
	 * @param string table_name
	 * @param string field_out
	 * @param string field_name_1
	 * @param string field_value_1
	 * @param string field_name_2
	 * @param string field_value_2
	 * @param string field_name_3
	 * @param string field_value_3
	 * @param string field_name_4
	 * @param string field_value_4
	 * @param string field_name_5
	 * @param string field_value_5
	 * @param string field_name_6
	 * @param string field_value_6
	 * @param string status
	 * @param string status_operator
	 * @param string functionn
	 * 
	 * @return string value for a specific table field
	 */		
	 
	public static function getFieldValue($table_name, $field_out, $field_name_1 = "", $field_value_1 = "", $field_name_2 = "", $field_value_2 = "", $field_name_3 = "", 
								  		 $field_value_3 = "", $field_name_4 = "", $field_value_4 = "", $field_name_5 = "", $field_value_5 = "", $field_name_6 = "", 
										 $field_value_6 = "", $status = STATUS_ACTIVE, $status_operator = "IN", $functionn = "") {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	
		$field_value = "";	
		
		$sql = "SELECT $functionn($field_out) AS field_value FROM {$table_prefix}$table_name WHERE status $status_operator ('$status') ";
		if (strlen(trim($field_name_1)) > 0) $sql .= "AND $field_name_1 = '" . $conn->real_escape_string($field_value_1). "' ";		
		if (strlen(trim($field_name_2)) > 0) $sql .= "AND $field_name_2 = '" . $conn->real_escape_string($field_value_2). "' ";		
		if (strlen(trim($field_name_3)) > 0) $sql .= "AND $field_name_3 = '" . $conn->real_escape_string($field_value_3). "' ";
		if (strlen(trim($field_name_4)) > 0) $sql .= "AND $field_name_4 = '" . $conn->real_escape_string($field_value_4). "' ";
		if (strlen(trim($field_name_5)) > 0) $sql .= "AND $field_name_5 = '" . $conn->real_escape_string($field_value_5). "' ";
		if (strlen(trim($field_name_6)) > 0) $sql .= "AND $field_name_6 = '" . $conn->real_escape_string($field_value_6). "' ";
		//if (self::startsWith($field_out, "MAX(SUBSTRING(")) {echo $sql; die();}		
		//if (self::startsWith($field_out, "MAX(SUBSTRING(invoice_number,")) {echo $sql;die();}
		//if (self::startsWith($field_name_1, "role_id IN (SELECT role_id FROM")) echo $sql;
		//echo "<br>$sql";
		
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$field_value = $row->field_value;
		}
		
		return $field_value;
	}
	
	/**
	 * List table fields
	 *
	 * @param string table_name
	 *
	 * @return array of table fields
	 */
	public static function getTableFields($table_name) {
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$database_name = DATABASE_NAME;
		
		$fields = array();
		$non_display_fields = NON_DISPLAY_FIELDS;
		$non_display_fields = substr($non_display_fields, 1); // remove the first | from the string
		$non_display_fields = substr_replace($non_display_fields, "", -1);// remove the last | from the string
		$non_display_fields = "('" . str_replace("|", "', '", $non_display_fields) . "')";
		
		$sql = "SHOW FULL COLUMNS FROM {$table_prefix}$table_name WHERE Field NOT IN $non_display_fields";// AND Field NOT LIKE '%_id'";		

        $result = $conn->query($sql);
		
        while ($row = $result->fetch_object()) {
            $fields[] = $row;
        }
        return $fields;
		
	}
	
	/**
	 * Get page details
	 *
	 * @param string page_id
	 * @param string page_details
	 *
	 * @return string details
	 */				
	public static function getPageDetails($page_id, $page_details) {
		$details = self::getFieldValue("menu", "menu_item", "menu_id", $page_id);
		
		if ($page_details === "title") {
			// get page title
			return $details;
		} else {
			$parent_id = self::getFieldValue("menu", "menu_parent", "menu_id", $page_id);
			
			if ($page_details === "parent_color") {
				$details = self::getFieldValue("menu", "icon_color", "menu_id", $page_id, "menu_parent", $parent_id);
			} elseif ($page_details === "breadcrumb") {
				// get breadcrumb details
				$breadcrumb = "";
				
				if (strlen($parent_id) > 0) {
					$parent_title = self::getFieldValue("menu", "menu_item", "menu_id", $parent_id);
					$breadcrumb = "<li>$parent_title</li><li>$details</li>";
				}
				
				$details = $breadcrumb;
			}
		}

		return $details;
	}
	
   /**
	 * Check if a string starts with a particular sub string
	 *
	 * @param string string
	 * @param string start_string
	 * 
	 * @return true if a string starts with a particular sub string, false otherwise
	 */				
	public static function startsWith($string, $start_string) {
		$this_string = substr($string, 0, strlen($start_string));
		$starts_with = ($this_string == $start_string) ? true : false;
		
		return $starts_with;
	}
	
   /**
	 * Check if a string ends with a particular sub string
	 *
	 * @param string string
	 * @param string end_string
	 * 
	 * @return true if a string ends with a particular sub string, false otherwise
	 */				
	public static function endsWith($string, $end_string) {
		$ends_with = false;
		
		if (strlen($end_string) == 0)
			$ends_with = true;
			
		$this_string = substr($string, -strlen($end_string));
		if ($this_string == $end_string)
			$ends_with = true;
			
		return $ends_with;
	}
	
	/**
	 * List genders
	 *
	 * @return array of genders
	 */
	public static function getGender() {
		$gender = array("M", "F");

		return $gender;
	}
	
	/**
	 * Get days of the month
	 *
	 * @param int start_day
	 * @param int end_day
	 *
	 * @return an array of days
	 */	 
	public static function getDays($start_day = 1, $end_day = 28) {
		$days = array();
		for ($d = $start_day; $d <= $end_day; $d++) {
			$days[] = $d;					
		}
		return $days;
	}
	
    /**
	 * Get periods 
	 *
 	 * @param string sort_order
 	 * @param string format
 	 * @param string period_depth
	 *
	 * @return an array of periods
	 */	 
	public static function getPeriods($sort_order = "ASC", $format = "period", $period_depth = 12) {
		$sort = true;
		$periods = array();
		// get current year
		$current_year = date("Y");
		// get current month
		$current_month_num = date("n");
					
		if ($format === "period") {	
			// get current year
			$current_month_year = $current_year;
			$max_month_num = $current_month_num - 1;
			
			if ($current_month_num == 1) {
				// when the current month is January, show months from the previous year
				$max_month_num = $period_depth;
				$current_month_year = $current_month_year - 1;
			}
			
			for ($m = 1; $m <= $max_month_num; $m++) {
				$month_name = date("F", mktime(0, 0, 0, $m, 10)); 
				
				// when month number < 0, include a leading 0 
				$mm = ($m < 10) ? "0$m" : $m;
				// periods are an array of type mm-YYYY => Month YYYY e.g. 05-2020 => May 2020
				$periods["$mm-$current_month_year"] = "$month_name $current_month_year";
			}
		} elseif ($format === "last-12-months") {
			$max_month_num = $current_month_num - 1;
			$min_month_num = $max_month_num - $period_depth + 1;
			
			for ($m = $max_month_num; $m >= $min_month_num; $m--) {
				$year = $current_year;
				$month_num = $m;
				
				if ($m <= 0) {
					$month_num = $m + $period_depth;
					$year--;
				}
				$month_name = date("F", mktime(0, 0, 0, $month_num, 10));

				// periods are an array of type m-YYYY => Month YYYY e.g. 5-2020 => May 2020
				$periods["$month_num-$year"] = "$month_name $year";
			}
			
			$sort = false;
		} elseif ($format === "last-4-quarters") {
			$max_month_num = $current_month_num - 1;
			$min_month_num = $max_month_num - $period_depth + 1;

			for ($m = $max_month_num; $m >= $min_month_num; $m--) {
				$year = $current_year;
				$month_num = $m;

				if ($m <= 0) {
					$month_num = $m + $period_depth;
					$year--;
				}

				// periods are an array of type q-YYYY => quarter YYYY e.g. 1-2020 => Q2 2020
                $month_quarter = ceil($month_num / 3);
                $month_quarter = number_format($month_quarter, 0);
				$periods["$month_quarter-$year"] = "Q$month_quarter $year";
                $m = $m - 2;
			}

			$sort = false;
		} elseif ($format === "year") {
			$max_years = $current_year;
			$min_years = $current_year - $period_depth;
			
			if ($min_years > $max_years) {
				// if for some reason minimum year is greater tahn maximun year (usually when period depth is negative), then twist the numbers
				$years_temp = $min_years;
				$min_years = $max_years;
				$max_years = $years_temp;
			}
						
			for ($year = $min_years; $year <= $max_years; $year++) {
				$periods[$year] = $year;
			}
		} elseif ($format === "monthly") {
			$max_months = $period_depth;
			$min_months = 1;
			
			for ($month = $min_months; $month <= $max_months; $month++) {
				$month_name = date("F", mktime(0, 0, 0, $month, 10)); 
				$periods[$month] = $month_name;
			}
		} elseif ($format === "report_periods") {
			global $REPORT_PERIODS;
			
			$periods = $REPORT_PERIODS;
		} elseif ($format === "weekly") {
			$max_week = $period_depth;
			$min_week = 1;
			
			for ($week = $min_week; $week <= $max_week; $week++) {
				$periods[$week] = "Week $week";
			}
		} elseif ($format === "quarterly") {
			$max_quarter = $period_depth;
			$min_quarter = 1;
			
			for ($quarter = $min_quarter; $quarter <= $max_quarter; $quarter++) {
				$periods[$quarter] = "Quarter $quarter";
			}
		} elseif ($format === "semi-annually") {
			$periods["01-06"] = "January - June";
			$periods["07-12"] = "July - December";
		} elseif ($format === "annually") {
			$periods["01-12"] = "January - December (Calendar)";
			$periods["07-06"] = "July - June (Fiscal)";
		} 	
			
		// sort periods
		if ($sort) {
			if ($sort_order === "DESC") krsort($periods);
			else ksort($periods);
		}		
		return $periods;
	}

    /**
	 * Group an array by a specific key 
	 *
 	 * @param string key
 	 * @param array array
	 *
	 * @return an array grouped by a specific key
	 */	 	
	function arrayGroupBy($key, $array) {
		$result = array();
		
		foreach($array as $a) :
			if (array_key_exists($key, $a)) {
				$result[$a[$key]][] = $a;													
			} else {
				$result[""][] = $a;
			}
		endforeach;
		return $result;
	}
}