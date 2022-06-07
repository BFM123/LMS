<?php
	function add(){
		$indicator_id = "";
		$indicator_name = isset($_POST["indicator_name"]) ? $_POST["indicator_name"] : "";
		$indicator_code = isset($_POST["indicator_code"]) ? $_POST["indicator_code"] : "";
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		$data_format_id = isset($_POST["data_format_id"]) ? $_POST["data_format_id"] : "";
        $thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "";
        $target = isset($_POST["target"]) ? $_POST["target"] : "";
        $maximum = isset($_POST["maximum"]) ? $_POST["maximum"] : "";
        $minimum = isset($_POST["minimum"]) ? $_POST["minimum"] : "";
		$population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : "";
        $population_type_sub_ids = "";
		
		if (isset($_POST["population_type_sub_ids"])) {
			foreach((array)$_POST["population_type_sub_ids"] as $d) {
				$population_type_sub_ids .= "|$d";
			}
		}
        if (strlen($population_type_sub_ids) > 0) $population_type_sub_ids .= "|";
        $dataset_ids = isset($_POST["dataset_ids"]) ? $_POST["dataset_ids"] : array();
		$disaggregation_ids = "";
		
		if (isset($_POST["disaggregation_ids"])) {
			foreach((array)$_POST["disaggregation_ids"] as $d) {
				$disaggregation_ids .= "|$d";
			}
		}
		if (strlen($disaggregation_ids) > 0) $disaggregation_ids .= "|";		
		
        $ignore_zero_values = isset($_POST["ignore_zero_values"]) ? $_POST["ignore_zero_values"] : "No";
		$captured_by = $_POST["captured_by"];

		$indicators = new indicator();
		$indicators->setIndicatorCode($indicator_code);
		$indicators->setIndicatorName($indicator_name);
		$indicators->setDescription($description);
		$indicators->setDataFormat($data_format_id);
		$indicators->setThematicAreaID($thematic_area_id);
		$indicators->setTarget($target);
        $indicators->setMinimum($minimum);
        $indicators->setMaximum($maximum);
		$indicators->setDisaggregationIDs($disaggregation_ids);
        $indicators->setPopulationTypeID($population_type_id);
		$indicators->setPopulationTypeSubIDs($population_type_sub_ids);
		$indicators->setDatasetIDs($dataset_ids);
		$indicators->setIgnoreZeroValues($ignore_zero_values);
		$indicators->setCapturedBy($captured_by);

		$indicators->add();
	}

	function edit(){
		$indicator_id = isset($_POST["indicator_id"]) ? $_POST["indicator_id"] : "";
		$indicator_code = isset($_POST["indicator_code"]) ? $_POST["indicator_code"] : "";
     	$indicator_name = isset($_POST["indicator_name"]) ? $_POST["indicator_name"] : "";
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		$data_format_id = isset($_POST["data_format_id"]) ? $_POST["data_format_id"] : "";
        $thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "";
        $target = isset($_POST["target"]) ? $_POST["target"] : "";
        $maximum = isset($_POST["maximum"]) ? $_POST["maximum"] : "";
        $minimum = isset($_POST["minimum"]) ? $_POST["minimum"] : "";
		$population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : "";
        $population_type_sub_ids = "";
		
		if (isset($_POST["population_type_sub_ids"])) {
			foreach((array)$_POST["population_type_sub_ids"] as $d) {
				$population_type_sub_ids .= "|$d";
			}
		}
        if (strlen($population_type_sub_ids) > 0) $population_type_sub_ids .= "|";
        $dataset_ids = isset($_POST["dataset_ids"]) ? $_POST["dataset_ids"] : array();
        $old_dataset_ids = isset($_POST["old_dataset_ids"]) ? $_POST["old_dataset_ids"] : "";
		$disaggregation_ids = "";
		
		if (isset($_POST["disaggregation_ids"])) {
			foreach((array)$_POST["disaggregation_ids"] as $d) {
				$disaggregation_ids .= "|$d";
			}
		}
		if (strlen($disaggregation_ids) > 0) $disaggregation_ids .= "|";		
	
		$ignore_zero_values = isset($_POST["ignore_zero_values"]) ? $_POST["ignore_zero_values"] : "No";
		$last_edited_by = $_POST["last_edited_by"];

        $indicators = new indicator();
        $indicators->setIndicatorID($indicator_id);
		$indicators->setIndicatorCode($indicator_code);
    	$indicators->setIndicatorName($indicator_name);
		$indicators->setDescription($description);
		$indicators->setDataFormat($data_format_id);
		$indicators->setThematicAreaID($thematic_area_id);
		$indicators->setTarget($target);
		$indicators->setMinimum($minimum);
		$indicators->setMaximum($maximum);
		$indicators->setDisaggregationIDs($disaggregation_ids);
        $indicators->setPopulationTypeID($population_type_id);
		$indicators->setPopulationTypeSubIDs($population_type_sub_ids);
		$indicators->setDatasetIDs($dataset_ids);
		$indicators->setDatasetOldIDs($old_dataset_ids);
		$indicators->setIgnoreZeroValues($ignore_zero_values);
		$indicators->setLastEditedBy($last_edited_by);

		$indicators->edit();
	}

	function delete() {
        $indicator_id = isset($_POST["indicator_id"]) ? $_POST["indicator_id"] : "";
        $indicator_name = isset($_POST["indicator_name"]) ? $_POST["indicator_name"] : "";
        $deleted_by = $_POST["deleted_by"];

        $indicators = new indicator();
        $indicators->setIndicatorID($indicator_id);
        $indicators->setIndicatorName($indicator_name);
        $indicators->setDeletedBy($deleted_by);

		$indicators->delete();
	}
?>
