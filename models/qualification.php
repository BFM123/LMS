<?php
require_once "common.php";
/**
 * qualification class
 */
class qualification
{
  /**
	* declarations 
	*/

	/**
	 * List all qualifications
	 *
 	 * @return array of qualifications
	 */
	public static function all() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$qualifications = array();
		$sql = "SELECT * FROM {$table_prefix}qualification WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY qualification";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$qualifications[] = $row;
		}
		return $qualifications;
	}
}