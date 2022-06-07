<?php
require_once "common.php";
/**
 * sector class
 */
class sector
{
  /**
	* declarations 
	*/

	/**
	 * List all sectors
	 *
 	 * @return array of sectors
	 */
	public static function all() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$sectors = array();
		$sql = "SELECT * FROM {$table_prefix}sector WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY sector";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$sectors[] = $row;
		}
		return $sectors;
	}
}