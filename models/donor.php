<?php
require_once "common.php";
/**
 * donor class
 */
class donor
{
  /**
	* declarations 
	*/

	/**
	 * List all donors
	 *
 	 * @return array of donors
	 */
	public static function all() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$donors = array();
		$sql = "SELECT * FROM {$table_prefix}donor WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY donor";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$donors[] = $row;
		}
		return $donors;
	}
}