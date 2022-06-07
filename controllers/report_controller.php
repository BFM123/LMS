<?php
	function add(){
		$report_name = isset($_POST["report_name"]) ? $_POST["report_name"] : "";
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		$destinations = "";
		foreach((array)$_POST["destination"] as $d) {
			$destinations .= "|$d";
		}
		if (strlen($destinations) > 0) $destinations .= "|";		
		$sort_order = $_POST["sort_order"];
		$captured_by = $_POST["captured_by"];

		$report = new report();
		$report->setReportName($report_name);
		$report->setDescription($description);
		$report->setDestination($destinations);
		$report->setSortOrder($sort_order);
		$report->setCapturedBy($captured_by);

		$report->add();
	}

	function edit(){
		$report_id = isset($_POST["report_id"]) ? $_POST["report_id"] : "";
		$report_name = isset($_POST["report_name"]) ? $_POST["report_name"] : "";
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		$destinations = "";
		foreach((array)$_POST["destination"] as $d) {
			$destinations .= "|$d";
		}
		if (strlen($destinations) > 0) $destinations .= "|";
		$sort_order = $_POST["sort_order"];	
		$last_edited_by = $_POST["last_edited_by"];

        $report = new report();
        $report->setReportID($report_id);
        $report->setReportName($report_name);
        $report->setDescription($description);
		$report->setDestination($destinations);
		$report->setSortOrder($sort_order);
		$report->setLastEditedBy($last_edited_by);

		$report->edit();
	}

	function delete() {
		$report_id = isset($_POST["report_id"]) ? $_POST["report_id"] : "";
		$report_name = $_POST["report_name"];
		$deleted_by = $_POST["deleted_by"];

		$report = new report();
		$report->setReportID($report_id);
		$report->setReportName($report_name);
		$report->setDeletedBy($deleted_by);

		$report->delete();
	}
	
	function download(){
		$report_id = isset($_POST["report_id"]) ? $_POST["report_id"] : "";
		$report_name = isset($_POST["report_name"]) ? $_POST["report_name"] : "";
		$custom_title = isset($_POST["custom_title"]) ? $_POST["custom_title"] : "";
		$dataset_id = isset($_POST["dataset_id"]) ? $_POST["dataset_id"] : array();
		$thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : array();
		$population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : array();
		$population_type_sub_id = isset($_POST["population_type_sub_id"]) ? $_POST["population_type_sub_id"] : array();
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : array();
		$district_id = isset($_POST["district_id"]) ? $_POST["district_id"] : array();
		$zone_id = isset($_POST["zone_id"]) ? $_POST["zone_id"] : array();
		$region_id = isset($_POST["region_id"]) ? $_POST["region_id"] : array();
		$role_id = isset($_POST["role_id"]) ? $_POST["role_id"] : array();
		$coverage = isset($_POST["coverage"]) ? $_POST["coverage"] : "";
		$period = isset($_POST["period"]) ? $_POST["period"] : "";
		$reporting_year = isset($_POST["reporting_year"]) ? $_POST["reporting_year"] : "";
		$reporting_rate_format = isset($_POST["reporting_rate_format"]) ? $_POST["reporting_rate_format"] : array();
		$destination = isset($_POST["destination"]) ? $_POST["destination"] : "";
		$printed_by  = $_POST["printed_by"];
		
		$records = array();		
		if (isset($_POST["action"]) && isset($_POST["action_by"]) && isset($_POST["start_date"]) && isset($_POST["end_date"]) && isset($_POST["detail"])) {
			// we have enough reason to believe this request is coming from audit trail...generate records for the report
			$action = $_POST["action"];
			$action_by = $_POST["action_by"];
			$start_date = $_POST["start_date"];
			$end_date = $_POST["end_date"];
			$detail = $_POST["detail"];
			$records = audit_trail::all($fields = "*", implode("', '", $action_by), implode("', '", $action), $start_date, $end_date, $detail);
		}

        $report = new report();
        $report->setReportID($report_id);	
        $report->setRecords($records);	
        $report->setReportName($report_name);	
        $report->setCustomTitle($custom_title);	
        $report->setDatasetID($dataset_id);
        $report->setThematicAreaID($thematic_area_id);
        $report->setPopulationTypeID($population_type_id);
        $report->setPopulationTypeSubID($population_type_sub_id);
        $report->setOrganizationID($organization_id);
        $report->setDistrictID($district_id);
        $report->setZoneID($zone_id);
        $report->setRegionID($region_id);
        $report->setRoleID($role_id);
        $report->setCoverage($coverage);
        $report->setPeriod($period);
        $report->setReportingYear($reporting_year);
        $report->setReportingRateFormat($reporting_rate_format);
		$report->setDestination($destination);
		$report->setPrintedBy($printed_by);

		$report->generate();
	}
?>
