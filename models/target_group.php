<?php
require_once "common.php";
/**
 * target_group class
 */
class target_group
{
  /**
	* declarations 
	*/

	/**
	 * List all target_groups
	 *
 	 * @return array of target_groups
	 */
	public static function all() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$target_groups = array();
		$sql = "SELECT * FROM {$table_prefix}target_group WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY target_group";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$target_groups[] = $row;
		}
		return $target_groups;
	}
}