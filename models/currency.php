<?php
require_once "common.php";
/**
 * currency class
 */
class currency
{
   /**
	* declarations 
	*/

	/**
	 * List all currencies
	 *
 	 * @return array of currencies
	 */
	public static function all() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$currencies = array();
		$sql = "SELECT * FROM {$table_prefix}currency WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY currency";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$currencies[] = $row;
		}
		return $currencies;
	}
}