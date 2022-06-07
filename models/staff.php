<?php
require_once "common.php";
/**
 * staff class
 */
class staff
{
  /**
	* declarations 
	*/

	/**
	 * List all staff types
	 *
 	 * @return array of staff types
	 */
	public static function getStaffTypes() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$staff_types = array();
		$sql = "SELECT * FROM {$table_prefix}staff_type WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY staff_type";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$staff_types[] = $row;
		}
		return $staff_types;
	}
}