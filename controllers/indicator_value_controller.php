<?php		 
	function capture() {
        $record_control = "";
		$request = $_POST["request"];
		if (isset($_POST["draft"])) {
			$record_control = $request;
		} elseif (isset($_POST["submit"])) {
			$record_control = $request + 1;
		}

		$month = $_POST["month"];
		$year = $_POST["year"];
		$captured_by = $_POST["captured_by"];
	
		$indicators = array();
		$i = 0;
		foreach ($_POST as $key => $value) :		
			if (common::startsWith($key, "indicator_id_")) {
				$temp_str = str_replace("indicator_id_", "", $key);
				$pos = strpos($temp_str, "_");
				$indicator_id = substr($temp_str, 0, $pos);
				$dataset_id = substr($temp_str, $pos + 1);
				$indicator_value = htmlspecialchars($value);
				$indicators[$i][0] = $indicator_id;
				$indicators[$i][1] = $dataset_id;
				$indicators[$i][2] = $indicator_value;
				
				//echo "<br>indicator_id: $indicator_id >dataset_id: $dataset_id >indicator_value: $indicator_value ";
				$i++;
			}
		endforeach;
		
		$indicator_values = new indicator_value();
		$indicator_values->setDataSource("");
		$indicator_values->setRecordControl($record_control);
		$indicator_values->setReportingMonth($month);
		$indicator_values->setReportingYear($year);
		$indicator_values->setIndicators($indicators);
		$indicator_values->setCapturedBy($captured_by);
		$indicator_values->capture();
	}
	
	function approve() {
		$option_1 = (isset($_POST["submit"])) ? $_POST["submit"] : ""; $option_1 = strtolower(trim(str_replace("&nbsp;", "", $option_1)));
		$option_2 = (isset($_POST["draft"])) ? $_POST["draft"] : ""; $option_2 = strtolower(trim((str_replace("&nbsp;", "", $option_2))));



		$indicator_value_ids = array();
        $option = "";

            $i = 0;
            foreach ($_POST as $key => $value) :
                if (common::startsWith($key, "indicator_value_id_")) {
                    $indicator_value_id = str_replace("indicator_value_id_", "", $key);
                    $indicator_value_ids[] .= $indicator_value_id;
                    $i++;
                }
            endforeach;


		if ($option_1 === "approve")
			$option = "approve";
		elseif (strpos($option_2, "reject") !== false) 
			$option = "reject";
		elseif ($option_1 === "delete") {
			$option = "delete";
			
			$indicator_value_ids = explode(",", $_POST["indicator_value_ids"]);		
		}

		$request = isset($_POST["request"]) ? $_POST["request"] : "";
		$reporting_period = isset($_POST["reporting_period"]) ? $_POST["reporting_period"] : "";
		$rejection_comment = isset($_POST["rejection_comment"]) ? $_POST["rejection_comment"] : "";
		$record_control = $request;
		$captured_by = $_POST["captured_by"];
        ;
		$indicator_values = new indicator_value();
		$indicator_values->setRecordControl($record_control);
		$indicator_values->setReportingPeriod($reporting_period);
		$indicator_values->setRejectionComment($rejection_comment);
		$indicator_values->setAction($option);
		$indicator_values->setIndicators($indicator_value_ids);
		$indicator_values->setCapturedBy($captured_by);
		$indicator_values->approve();
	}
?>