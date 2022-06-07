<?php

use SebastianBergmann\CodeCoverage\Report\PHP;

    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $asset_path = "../../";
   
    require_once $asset_path . "config/config.php";
    require_once $asset_path . "models/leave.php";
    require_once "modal.php";

    $start_date = (isset($_POST["start_date"])) ? $_POST["start_date"] : "";
    $end_date = (isset($_POST["end_date"])) ? $_POST["end_date"] : "";
    $organization_id = (isset($_SESSION["organization_id"])) ? $_SESSION["organization_id"] : "";

    $leave_duration = "";
    if (strlen($start_date) > 0 && strlen($end_date) > 0 && strlen($organization_id) > 0) {
        $holidays = leave::getHolidays($organization_id);
        $leave_duration = leave::getWorkingDays($start_date, $end_date, $holidays);
    }
    echo json_encode($leave_duration);
?>