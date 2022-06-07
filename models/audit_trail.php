<?php
/**
 * Audit trail class
 */
class audit_trail
{
   /**
	 * Log user activity
	 *
	 * @param string action
	 * @param string detail
	 * @param string action_by
	 * @param string table_name
	 * @param int record_id
	 * 
	 */
	public static function log_trail($action, $detail, $action_by, $table_name, $record_id = 0)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		// log the user activity
		$sql = "INSERT INTO {$table_prefix}audit_trail (action, detail, action_by, action_date, table_name, record_id, status) VALUES(";
		$sql .= "'" . $conn->real_escape_string($action) . "', '" . $conn->real_escape_string($detail) . "', '" . $conn->real_escape_string($action_by) . "', NOW(), ";
		$sql .= "'" . $conn->real_escape_string($table_name) . "', '" . $conn->real_escape_string($record_id) . "', '" . STATUS_ACTIVE . "')";

		$result = $conn->query($sql);
	}
	
	/**
	 * List all audit trails
	 *
	 * @param string fields
	 * @param string action_by
	 * @param string action
	 * @param string start_date
	 * @param string end_date
	 * @param string table_name
	 *
	 * @return array of audit trails
	 */
	public static function all($fields = "*", $action_by = "", $action = "", $start_date = "", $end_date = "", $detail = "", $table_name = "")
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
	   
		$audit_trails = array();

		$sql = "SELECT $fields FROM {$table_prefix}audit_trail WHERE status = '" . STATUS_ACTIVE . "' ";

		if (strlen($action_by) > 0) $sql .= "AND action_by IN ('$action_by') ";
		if (strlen($action) > 0) $sql .= "AND action IN ('$action') ";
		if (strlen($start_date) > 0) $sql .= "AND action_date >= '$start_date' ";
		if (strlen($end_date) > 0) $sql .= "AND action_date < DATE_ADD('$end_date', INTERVAL 1 DAY) ";
		if (strlen($detail) > 0) $sql .= "AND detail LIKE '%" . $conn->real_escape_string($detail) . "%' ";
		if (strlen($table_name) > 0) $sql .= "AND table_name IN ('$table_name') ";

		$sql .= "ORDER BY action_date";
			
		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$audit_trails[] = $row;
		}
		return $audit_trails;
	}
}