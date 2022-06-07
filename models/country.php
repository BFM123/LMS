<?php
require_once "common.php";
/**
 * country class
 */
class country
{
  /**
	* declarations 
	*/

	/**
	 * List all countries
	 *
 	 * @return array of countries
	 */
	public static function all() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$countries = array();
		$sql = "SELECT * FROM {$table_prefix}country WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY country_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$countries[] = $row;
		}
		return $countries;
	}
}