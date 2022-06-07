<?php
    $asset_path = "../../";
   
    require_once $asset_path . "config/config.php";
    require_once $asset_path . "models/common.php";
    require_once "modal.php";


    if (isset($_POST["option"]) && $_POST["option"] === "period_coverage") {
        $coverage = isset($_POST["coverage"]) ? $_POST["coverage"] : "";
		
		$format = strtolower($coverage);
		if ($format === "weekly") $period_depth = 53;
		elseif ($format === "quarterly") $period_depth = 4;
		elseif ($format === "monthly") $period_depth = 12;
		else $period_depth = 2;		
		$periods = common::getPeriods($sort_order = "ASC", $format, $period_depth);
			
        foreach ($periods as $key => $value) :
            echo "<option value=\"$key\">$value</option>";
        endforeach;
    }
?>