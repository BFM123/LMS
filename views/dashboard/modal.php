<?php
$path = "../../";
require_once $path . "config/config.php";
require_once $path . "models/indicator.php";
require_once $path . "models/population_type.php";
require_once "modal.php";


if (isset($_POST["action"])) {

    switch ($_POST["action"]) {
        case "populationType":
            modal::populationType();
            break;
        case "changeIndicators":
            modal::changeIndicators();
            break;
        case "indicators":
            modal::indicators();
            break;
        case "hiddenInputs":
            modal::hiddenInputs();
            break;
        default:
            # code...
            break;
    }
}

class modal
{
    /**
     * @param string $title
     * @param string $chart_id
     * @param string $chart_type
     * @param string $chart_data
     * @param string $chart_labels
     * @param string $chart_data2
     * @param string $label_str
     * @param string $dataset_labels
     * @param string $data_label_2
     * @return string
     */

    public static function displayCharts($title = "", $chart_id = "", $chart_type = "", $chart_data = "", $chart_labels = "", $label_str = "", $dataset_labels = "", 
										$data_label_2 = "")
	{
		$print_chart = "";
		
		// add line break to title so that it doesnt hide action buttons at the top of the graph
		$title = "<br />$title";
        $chart = "
                <div>
	                <h3 class=\"box-title text-bold text-left\">$title</h3>
                </div>
                <div class=\"box-tools pull-right\">
                    <div class=\"btn-group\">
                        <button type=\"button\" class=\"btn btn-box-tool dropdown-toggle\" data-toggle=\"dropdown\">
                            <i class=\"fa fa-wrench\"></i></button>
                        <ul class=\"dropdown-menu\" role=\"menu\">
                            <li onclick=\"lineChart('$chart_id', 'line', '$chart_labels', '$chart_data', '$label_str', '$dataset_labels');\">Line</li>
                            <li onclick=\"pieChart('$chart_id', 'pie', '$chart_data', '$chart_labels');\">Pie</li>
                            <li onclick=\"barChart('$chart_id', 'bar', '$chart_labels', '$chart_data', '$label_str', '$dataset_labels')\">Bar</li>
                            <li class=\"divider\"></li>
                            <li data-dismiss=\"modal\">Close</li>
                        </ul>
                    </div>
                    <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i>
                    </button>
                    <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"remove\"><i class=\"fa fa-times\"></i></button>
                </div>
                </div>
                <div class=\"box-body\">
                    <div class=\"chart\">";
        if ($chart_type === "line") {
            $chart .= " <canvas id=\"$chart_id\" style=\"min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;\" onmouseenter=\"lineChart('$chart_id', '$chart_type', '$chart_labels', '$chart_data', '$label_str', '$dataset_labels')\"></canvas>";
            $print_chart .= " lineChart('$chart_id', '$chart_type', '$chart_labels', '$chart_data');\r\n";
        } elseif ($chart_type === "bar") {
            $chart .= "<canvas id=\"$chart_id\" style=\"min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;\" onmouseenter=\"barChart('$chart_id', '$chart_type', '$chart_labels', '$chart_data', '$label_str', '$dataset_labels')\"></canvas>";
            $print_chart .= " barChart('$chart_id', '$chart_type', '$chart_labels', '$chart_data');\r\n";
        } else {
            $chart .= "<canvas id=\"$chart_id\" style=\"min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;\" onmouseenter=\"pieChart('$chart_id', '$chart_type', '$chart_data', '$chart_labels')\"></canvas>";
            $print_chart .= " pieChart('$chart_id', '$chart_type', '$chart_data', '$chart_labels');\r\n";
        }

        $chart .="</div>
                </div>";

        $chart .= COMMON_PLACEHOLDER . $print_chart;
        return $chart;

    }

    /**
     * function to show sub population types on change of population types
     */
    public static function populationType()
    {
        $population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : array();
		$counter = count($population_type_id);
		
		if ($counter > 0) {
			// one or more population types were selected, display sub population types for these population types
            for ($i = 0; $i < $counter; $i++) {
				$population_type_subs = population_type::getSubPopulationTypes($population_type_id[$i]);
				foreach ($population_type_subs as $s) :
					echo "<option value=\"$s->population_type_sub_id\">$s->population_type_sub</option>";
				endforeach;
        	}
        } else {
			// no population type was selected, display all sub population types		
			$population_type_subs = population_type::getSubPopulationTypes();
			foreach ($population_type_subs as $s) :
				echo "<option value=\"$s->population_type_sub_id\">$s->population_type_sub</option>";
			endforeach;
		}
    }
  
    /**
     * function to show indicators on change of population types and sub population types
     */
    public static function changeIndicators()
    {
        $population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : array();
        $population_type_sub_id = isset($_POST["population_type_sub_id"]) ? $_POST["population_type_sub_id"] : array();
        $thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "";
		
		$indicators = indicator::all("", "", "indicator_id, indicator_name", array(), array($thematic_area_id), $population_type_id, $population_type_sub_id);									
		foreach ($indicators as $i) :
			echo "<option value=\"$i->indicator_id\">$i->indicator_name</option>";
		endforeach;
    }

    /**
     * function to show the hidden items (indicator and thematic area)
     */
    public static function hiddenInputs()
    {
        $thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "";
        $indicator_id = isset($_POST["indicator_id"]) ? $_POST["indicator_id"] : "";

        echo "<fieldset id=\"hidden\">
                    <input type=\"text\" class=\"hidden\" value=\"$thematic_area_id\" name=\"thematic_area_id\" id=\"thematic_area_id\">
                    <input type=\"text\" class=\"hidden\" value=\"$indicator_id\" name=\"indicator_id\" id=\"indicator_id\">
              </fieldset>";
    }

    /**
     * function to show indicators
     */
    public static function indicators()
    {
		global $INDICATOR_STATUS;
		// level at which a report is accepted as submitted
		// $approved = array_keys($INDICATOR_STATUS)[3];
		$approved = common::getFieldValue("reporting", "report_acceptance_status");

        $indicator_ids = isset($_POST["indicator_ids"]) ? $_POST["indicator_ids"] :  array();
        $population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] :  array();
        $thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "";
        $population_type_sub_id = isset($_POST["population_type_sub_id"]) ? $_POST["population_type_sub_id"] : array();		
		$year = isset($_POST["reporting_year"]) ? $_POST["reporting_year"] : "";
		$month = isset($_POST["reporting_month"]) ? $_POST["reporting_month"] : "";
		$bg_colors = isset($_POST["bg_colors"]) ? $_POST["bg_colors"] : array();
		
		$limit = (empty($indicator_ids) && empty($population_type_sub_id)) ? 4 : "";
		
		$indicators = indicator::all(implode("', '", $indicator_ids), "", "indicator_id, indicator_name, data_format_id, population_type_sub_ids", array(), 
									array($thematic_area_id), $population_type_id, $population_type_sub_id, $limit);
		$j = 0;
		foreach ($indicators as $ind) :
			if ($j >= count($bg_colors)) $j = 0;
			$value = common::getFieldValue("indicator_value", "SUM(indicator_value)", "indicator_id", $ind->indicator_id, "year", $year, "month", $month, 
										   "record_control >= $approved AND 1", 1);
			$value = (strlen($value) > 0) ? $value : 0;
			
			$data_format = common::getFieldValue("data_format", "data_format", "data_format_id", $ind->data_format_id);										
			if (strlen(trim($value)) > 0) {$value = number_format($value, 0); $value .= ($data_format === "Percent") ? "%" : "";}

			echo "<div class=\"col-md-3 col-sm-3 col-xs-12\" id=\"indicator\" data-value=\"$ind->indicator_id\">
					<!-- small box -->
					<div class=\"small-box $bg_colors[$j] w3-card-2\" style=\"height: 160px;\">
						<div class=\"inner\">
							<p class=\"indicator_name\">$ind->indicator_name</p>
							<h3 class=\"indicator_value\">$value</h3>
						</div>
					</div>
				</div>
			</a>";
			$indicator_id = $ind->indicator_id;
			$j++;
		endforeach;
    }
}