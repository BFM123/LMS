<?php

//use SebastianBergmann\CodeCoverage\Report\PHP;

    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $asset_path = "../../";
   
    require_once $asset_path . "config/config.php";
    require_once $asset_path . "models/leave.php";
    require_once "modal.php";

    $leave_type = (isset($_POST["leave_type"])) ? $_POST["leave_type"] : "";
    $organization_id = (isset($_SESSION["organization_id"])) ? $_SESSION["organization_id"] : "";

    $leave_types = leave::getLeaveTypes($organization_id, "Yes");

    $is_available = false;
    if (in_array($leave_type, array_column($leave_types, "leave_type"))) {
        $is_available = true;
    }
    echo json_encode($is_available);
?>