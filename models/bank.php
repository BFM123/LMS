<?php
require_once "common.php";
/**
 * bank class
 */
class bank
{
  /**
	* declarations 
	*/

	/**
	 * List all banks
	 *
 	 * @return array of banks
	 */
	public static function all() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$banks = array();
		$sql = "SELECT * FROM {$table_prefix}bank WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY bank_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$banks[] = $row;
		}
		return $banks;
	}
}