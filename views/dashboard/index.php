<?php
	$page_id = 1;
	$asset_path = "../../";
	require "../includes/header.php";
	require_once $asset_path . "models/thematic_area.php";
	require_once $asset_path . "models/indicator.php";
	require_once $asset_path . "models/indicator_value.php";
	require_once $asset_path . "models/region.php";
	require_once $asset_path . "models/zone.php";
	require_once $asset_path . "models/district.php";
	require_once $asset_path . "models/population_type.php";
	require_once $asset_path . "models/thematic_area.php";
	require_once $asset_path . "models/common.php";
	require_once $asset_path . "models/notice.php";
	require_once "../notice/notice_modal.php";
	require_once "modal.php";
	
	$page_title = common::getPageDetails($page_id, "title");
	$breadcrumb = common::getPageDetails($page_id, "breadcrumb");	
	$color = common::getPageDetails($page_id, "parent_color");

// reporting deadline
$reporting_deadline = "<b>Reporting deadline</b> " . common::getFieldValue("reporting", "reporting_deadline") . " of the month";

// technical support details
$technical_support_contact = common::getFieldValue("system", "technical_support_contact");
$technical_support_email = common::getFieldValue("system", "email");
$technical_support_email = "<i class=\"fa fa-at\"></i> <a href=\"mailto:$technical_support_email\">$technical_support_email</a>";
$technical_support_telephone = " <i class=\"fa fa-phone\"></i> " . common::getFieldValue("system", "telephone");
$technical_support = "<b>Technical Support</b> $technical_support_contact $technical_support_email $technical_support_telephone";

// level at which a report is accepted as submitted
$approved = common::getFieldValue("reporting", "report_acceptance_status");

$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
$print_charts = "";
$blanks = "";
$table_prefix = TABLE_PREFIX;

// available background colors for indicators
$bg_colors = array ("bg-red", "bg-yellow", "bg-aqua", "bg-blue", "bg-gray-light", "bg-black", "bg-light-blue", "bg-green", "bg-navy", "bg-teal", "bg-olive", "bg-lime", 
					"bg-orange", "bg-fuchsia", "bg-purple", "bg-maroon", "bg-gray-light");
					
// get the thematic area id
$thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "5"; // pre-selecting the thematic area to 'mpact Mitigation and Correction' 
																						  // when opening the page for the first time
$population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : array();
$population_type_sub_id = isset($_POST["population_type_sub_id"]) ? $_POST["population_type_sub_id"] : array();
$indicator_ids = isset($_POST["indicator_ids"]) ? $_POST["indicator_ids"] : array();
$year = isset($_POST["reporting_year"]) ? $_POST["reporting_year"] : date("Y");
$month = isset($_POST["reporting_month"]) ? $_POST["reporting_month"] : "";

// if reporting month is blank then set it to the previous month
if (strlen($month) == 0) {
	$month = date("n");
	
	if ($month == 1) {
		// when the current month is January, set current month to December and current year to the previous year
		$month = 12;
		$year--;
	} else {
		$month--;
	}
}
			
$reporting_period = "$month-$year";
$indicator_id = isset($_POST["indicator_id"]) ? $_POST["indicator_id"] : "";
$thematic_area = common::getFieldValue("thematic_area", "thematic_area", "thematic_area_id", $thematic_area_id);
?>
<style>
    .show-more-less{
        height:50px;
        display:block;
        padding:10px;
        overflow:hidden;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1><ol style="padding: 0; margin: 0;" class="breadcrumb"><h5 style="text-align: right;"><?php echo $reporting_deadline . " | " . $technical_support; ?></h5></ol></h1>
        <h1><?php echo $page_title;?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
   		<div class="row" style="font-weight: normal">
			<?php			
				// show dashboard of notices
				$notices = notice::all($limit = 3);
				
				foreach ($notices as $n) :
					echo "
					<div class=\"col-md-4\">
						<div class=\"w3-card-4\">
					
						<div style=\"color: #666; padding: 0px; max-height: 150px; overflow: hidden; text-align: left;\">";
							$notice_title = substr($n->notice_title, 0, MAX_NOTICE_TITLE_PREVIEW_LENGTH);
							if (strlen($notice_title) > (MAX_NOTICE_TITLE_PREVIEW_LENGTH - 3)) $notice_title .= "...";
							$captured_date = date_format(date_create($n->captured_date), "d M Y @h:iA");
							$captured_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $n->captured_by);	
							$notice_content = substr($n->notice_content, 0, MAX_NOTICE_TITLE_PREVIEW_LENGTH);
																															
							$notice = "
							<b><a data-toggle=\"collapsexxx\" data-parent=\"#accordionxxx\" href=\"#notice-$n->notice_id\">$notice_title</a></b>
							<br />
							<span class=\"text\"><i>By $captured_by, </i></span>
							<span class=\"text\"><i>$captured_date</i></span>
							<br />
							<span style=\"color: #000;\">$notice_content</span>";
						
							echo "<span style=\"margin-bottom: 10px; display: block;\">$notice</span>";
							echo "
							</div>
						</div>
					</div>";
				endforeach;
			?>
		</div>
		
		<!--
        <div class="row">
            <nav class="navbar-custom w3-card-8">
                <div class="container-fluid">
                    <!--nav links --

                    <div class="not-in-use-nav-tabs-custom" id="not-in-use-bs-example-navbar-collapse-1">
                        <ul class="nav nav-tabs pull-right show-more-less">
                            <?php
								$thematic_areas = thematic_area::all();
								foreach ($thematic_areas as $t) :
									$active = ($thematic_area_id === $t->thematic_area_id) ? " active" : "";
									echo "<li class=\"btn-round$active\"><a href=\"#\" id=\"t\" variable=\"$t->thematic_area_id\">$t->thematic_area</a></li>";
								endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
				<div class="w3-center">
					<a id="more" href="#"><i class="fa fa-angle-double-down fa-lg"></i></a>
					<a id="less" href="#"><i class="fa fa-angle-double-up fa-lg"></i></a>
				</div>
            </nav>
        </div>
        <br />

        <div class="row">
            <div class="col-md-12">
                <div class="w3-card-4">
                    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post" class="redirect">
                        <fieldset id="hidden">
                            <input type="text" class="hidden" value="<?php echo $thematic_area_id ?>" name="thematic_area_id" id="thematic_area_id">
                            <input type="text" class="hidden" value="<?php echo $indicator_id ?>" name="indicator_id" id="indicator_id">
                        </fieldset>
                        <div class="col-md-1"><label>Population</label></div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <select id="population_type_id" class="form-control select2 population" name="population_type_id[]" style="width: 100%;" multiple>
                                    <?php
										// getting the ids for the population type
										$population_types = population_type::all();
	
										foreach ($population_types as $i):
											$selected =  in_array($i->population_type_id, $population_type_id) ? "selected" : "";
											echo "<option value=\"$i->population_type_id\" $selected>$i->population_type</option>";
										endforeach;
                                    ?>
                                </select>
                            </fieldset>
                        </div>

                        <div class="col-md-2"><label>Sub Population</label></div>
                        <div class="col-md-5">
                            <fieldset class="form-group">
                                <select id="population_type_sub_id" class="form-control select2 population_type_sub" name="population_type_sub_id[]" style="width: 100%;" multiple>
                                    <?php
										// getting the ids for the thematic area chosen
										$population_type_subs = population_type::getSubPopulationTypes();
	
										foreach ($population_type_subs as $p):
											$selected = in_array($p->population_type_sub_id, $population_type_sub_id) ? "selected" : "";
											echo "<option value=\"$p->population_type_sub_id\" $selected>$p->population_type_sub</option>";
										endforeach;
                                    ?>
                                </select>
                            </fieldset>
                        </div>

                        <div class="col-md-12"></div>

						<div class="col-md-1"><label>Indicator</label></div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <select id="indicator_ids" class="form-control select2 indicator_ids" name="indicator_ids[]" style="width: 100%;" multiple>
                                    <?php
										// getting the ids for the population type
										$indicator_id_numbers = indicator::all($blanks, $blanks, "indicator_id, indicator_name", array(), array($thematic_area_id));										
										foreach ($indicator_id_numbers as $n):
											$selected =  in_array($n->indicator_id, $indicator_ids) ? "selected" : "";
											echo "<option value=\"$n->indicator_id\" $selected>$n->indicator_name</option>";
										endforeach;
                                    ?>
                                </select>
                            </fieldset>
                        </div>
						
                        <div class="col-md-2"><label>Period</label></div>
                        <div class="col-md-2">
                            <fieldset class="form-group">
                                <select id="reporting_month" name="reporting_month" class="form-control">
                                    <?php
										$reporting_months = common::getPeriods($sort_order = "ASC", $format = "monthly");
										
										foreach ($reporting_months as $k => $v):
											$selected = ($month == $k) ? " selected" : "";
											echo "<option value=\"$k\"$selected>$v</option>";
                                    	endforeach; 
									?>
                                </select>
                            </fieldset>
						</div>
						<div class="col-md-3">
							<fieldset class="form-group">
                                <select id="reporting_year" name="reporting_year" class="form-control">
                                    <?php
										$reporting_years = common::getPeriods($sort_order = "DESC", $format = "year");
										
										foreach ($reporting_years as $k => $v):
											$selected = ($year === $k) ? " selected" : "";
											echo "<option value=\"$k\"$selected>$v</option>";
                                    	endforeach; 
									?>
                                </select>
                            </fieldset>
                        </div>
                    </form>					
                    <div class="col-md-12 col-xs-12"><h4><?php echo $thematic_area; ?></h4></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="w3-card-4 indicators">
                <?php
					// getting the ids for the thematic area chosen
					$indicators = indicator::all(implode("', '", $indicator_ids), $blanks, "indicator_id, indicator_name, data_format_id", array(), array($thematic_area_id), 
												 array(), array(), $limit = 4);						   	
					if (strlen($indicator_id > 0)){ ?>
						<div class="col-md-3 col-sm-3 col-xs-12" id="indicator" data-value="<?php echo $indicator_id ?>">
							<!-- small box --
							<div class="small-box <?php echo $bg_colors[0]; ?> w3-card-2" style="height: 160px;">
								<div class="inner">
									<p class="indicator_name">
										<?php
											$indicator_name = common::getFieldValue("indicator", "indicator_name", "indicator_id", $indicator_id);
											echo $indicator_name ;
										?>
										</p>
									<h3 class="indicator_value">
										<?php				
											$value = common::getFieldValue("indicator_value", "SUM(indicator_value)", "indicator_id", $indicator_id, "year", $year,
																			"month", $month, "record_control >= $approved AND 1", 1);
											if (strlen($value) == 0) $value = 0;
											$data_format_id = common::getFieldValue("indicator", "data_format_id", "indicator_id", $indicator_id);										
											$data_format = common::getFieldValue("data_format", "data_format", "data_format_id", $data_format_id);										
											if (strlen(trim($value)) > 0) {$value = number_format($value, 0); $value .= ($data_format === "Percent") ? "%" : "";}
											echo $value;
										?>
									</h3>
								</div>
							</div>
						</div>
                <?php  } else {
					$j = 0;
                    foreach ($indicators as $i):
						if ($j == 0) $first_indicator_id = $i->indicator_id;														
						if ($j >= count($bg_colors)) $j = 0;

					?>
                        <div class="col-md-3 col-sm-3 col-xs-12" id="indicator" data-value="<?php echo $i->indicator_id ?>">
                            <!-- small box --
                            <div class="small-box <?php echo $bg_colors[$j]; ?> w3-card-2" style="height: 160px; ">
                                <div class="inner">
                                    <p title="<?php echo $i->indicator_name ?>" class="indicator_name"><?php echo $i->indicator_name ?></p>
                                    <h3 class="indicator_value"><?php
                                        $value = common::getFieldValue("indicator_value", "SUM(indicator_value)", "indicator_id", $i->indicator_id, "year", $year, 
																	   "month", $month, "record_control >= $approved AND 1", 1);
										if (strlen($value) == 0) $value = 0;
                                        $data_format = common::getFieldValue("data_format", "data_format", "data_format_id", $i->data_format_id);										
										if (strlen(trim($value)) > 0) {$value = number_format($value, 0); $value .= ($data_format === "Percent") ? "%" : "";}
										echo $value;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $indicator_id = $i->indicator_id;
						$j++;
                    endforeach;
                }
                $indicator_id = isset($_POST["indicator_id"]) ? $_POST["indicator_id"] : "$first_indicator_id";
                $indicator_name = common::getFieldValue("indicator", "indicator_name", "indicator_id", $indicator_id);
                ?>
            </div>
        </div>
		-->
    </section>

	<!--
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="w3-card-16">
                    <!-- AREA CHART --
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <?php
                            $labels = array();
                            $months = array();
                            $data_array = array();

                            $periods = common::getPeriods($sort_order = "ASC", "last-12-months");
                            $periods = array_reverse($periods);
                            foreach ($periods as $key => $value):
                                $months[] = $key;
                            endforeach;

                            $zones = zone::all();
                            foreach ($zones as $z) :
                                $zone_id = $z->zone_id;
                                $zone_names[] = $z->zone_name;
                                $data_str = array();
                                $periods = array();
                                foreach ($months as $m) :
                                    $pos = strpos($m, "-");
                                    $month = (int)substr($m, 0, $pos);
                                    $year = substr($m, $pos + 1);

                                    $captured_by = "(SELECT DISTINCT captured_by FROM indicator_value WHERE captured_by IN (SELECT username FROM {$table_prefix}user WHERE 
									district_id IN (SELECT district_id FROM {$table_prefix}district WHERE zone_id = $zone_id)))";
                                    $values = common::getFieldValue("indicator_value", "SUM(indicator_value)", "year", $year, "month", $month, "indicator_id", $indicator_id,
																	"record_control >= $approved AND 1", 1, "captured_by IN $captured_by AND 1", 1);
                                    if ($values === null) { $values = 0;}
                                    $data_str[] =  $values;
                                    $periods[] = date("F", mktime(0, 0, 0, $month, 10)) . " " . $year;
                                endforeach;
                                $data_array[] = "[" . implode(",", $data_str) . "]";
                            endforeach;

                            $labels_str =  implode(",", $periods);
                            $data_str =  implode(",", $data_array);
                            $zones_str =  implode(",", $zone_names);

                            $chart_details =  modal::displayCharts("$indicator_name (by zone, last 12 months)", "months", "bar", "$data_str", $labels_str, $zones_str);
                            $pos = strpos($chart_details, COMMON_PLACEHOLDER);
                            $statistics = substr($chart_details, 0, $pos);
                            echo $statistics;
                            $print_charts .= substr($chart_details, $pos + strlen(COMMON_PLACEHOLDER));
                            ?>

                            <!-- /.box-body --
                        </div>
                    </div>
                    <!-- /.box --
                </div>
            </div>

            <!-- /.row --
            <div class="row">
                <div class="col-md-12">
                    <div class="w3-card-16">
                        <!-- LINE CHART --
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <?php
                                $labels = array();
                                $district_names = array();
                                $total_values = array();
                                $years = array();
                                $years = array($year - 1, $year);

                                $districts = district::all();
                                $i = 1;
                                foreach ($years as $y) :
                                    $district_values = array();
                                    $district_names = array();
                                    foreach ($districts as $d) :
                                        $district_names[] = $d->district_code;
                                        $sql_district = "captured_by IN (SELECT username FROM {$table_prefix}user WHERE district_id = $d->district_id)";
                                        $values = common::getFieldValue("indicator_value", "SUM(indicator_value)", "indicator_id", $indicator_id ,"year", $y,
																		"record_control >= $approved AND 1", 1, "$sql_district AND 1", 1);
                                        if ($values === null) { $values = 0;}
                                        $district_values[] =  $values;
                                    endforeach;
                                    $total_values[] = "[" . implode(",", $district_values) . "]";
                                    $i++;
                                endforeach;

                                $labels = $district_names;
                                $labels_str =  implode(",", $labels);
                                $data_str =  implode(",", $total_values);
                                $year_str =  implode(",", $years);

                                $chart_details =  modal::displayCharts("$indicator_name (by district, year over year)", "year_over_year", "line", $data_str, $labels_str,$year_str);
                                $pos = strpos($chart_details, COMMON_PLACEHOLDER);
                                $statistics = substr($chart_details, 0, $pos);
                                echo $statistics;
                                $print_charts .= substr($chart_details, $pos + strlen(COMMON_PLACEHOLDER));
                                ?>

                                <!-- /.box-body --
                            </div>
                        </div>
                        <!-- /.box --
                    </div>
                </div>

                <!-- /.row --
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="w3-card-16">
                    <!-- AREA CHART --
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <?php
                            $labels = array();
                            $years = array();
                            $values = array();

                            $years = common::getPeriods("ASC", "year");
                            foreach ($years as $y) :;
                                $values[] = common::getFieldValue("indicator_value", "SUM(indicator_value)", "year", $y, "indicator_id", $indicator_id,
																  "record_control >= $approved AND 1", 1);
                            endforeach;

                            $labels_str =  implode(",", $years);
                            $data_str =  implode(",", $values);

                            $chart_details =  modal::displayCharts("$indicator_name (per year)", "year", "bar",$data_str,  $labels_str);
                            $pos = strpos($chart_details, COMMON_PLACEHOLDER);
                            $statistics = substr($chart_details, 0, $pos);
                            echo $statistics;
                            $print_charts .= substr($chart_details, $pos + strlen(COMMON_PLACEHOLDER));
                            ?>
                            <!-- /.box-body --
                        </div>
                    </div>
                    <!-- /.box -->

                    <!-- DONUT CHART --
                    <div class="w3-card-16">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <?php
                                $labels = array();
                                $zone_names = array();
                                $values = array();
                                $zones = zone::all();
                                foreach ($zones as $z) :
                                    $zone_id = $z->zone_id;
                                    $zone_names[] = $z->zone_name;
                                    $sql_zone = "captured_by IN (SELECT username FROM {$table_prefix}user WHERE district_id IN (SELECT district_id FROM {$table_prefix}district 
												WHERE zone_id = $zone_id))";
                                    $values[] = common::getFieldValue("indicator_value", "SUM(indicator_value)", "indicator_id", $indicator_id, "year", $year, "month", $month,
																	  "record_control >= $approved AND 1", 1, "$sql_zone AND 1", 1);
                                endforeach;

                                $labels = $zone_names;
                                $labels_str =  implode(",", $labels);
                                $data_str =  implode(",", $values);

                                $chart_details =  modal::displayCharts("$indicator_name (per zone)", "zone", "pie", $data_str, $labels_str);
                                $pos = strpos($chart_details, COMMON_PLACEHOLDER);
                                $statistics = substr($chart_details, 0, $pos);
                                echo $statistics;
                                $print_charts .= substr($chart_details, $pos + strlen(COMMON_PLACEHOLDER));
                                ?>
                                <!-- /.box-body --
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="w3-card-16">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <?php

                                    $quarter_labels = array();
                                    $values = array();
                                    $start_month = 0;
                                    $end_month = 0;
                                    $quarters = common::getPeriods($sort_order = "DESC", "last-4-quarters");
                                    $quarters = array_reverse($quarters);

                                    foreach ($quarters as $key => $value):
                                        $pos = strpos($key, "-");
                                        $quarter = (int)substr($key, 0, $pos);
                                        $year = substr($key, $pos + 1);

                                        if ($quarter == 1) {
                                            $start_month = 1;
                                            $end_month = 3;
                                        } elseif ($quarter == 2) {
                                            $start_month = 4;
                                            $end_month = 6;
                                        } elseif ($quarter == 3) {
                                            $start_month = 7;
                                            $end_month = 9;
                                        } elseif ($quarter == 4) {
                                            $start_month = 10;
                                            $end_month = 12;
                                        }

                                        $quarter_labels[] = date("M", mktime(0, 0, 0, $start_month, 10)) . " - " . 
															date("M", mktime(0, 0, 0, $end_month, 10)) . " " . $year; //modal::getQuarter($year, $month);
                                        $values[] = common::getFieldValue("indicator_value", "SUM(indicator_value)", "indicator_id", $indicator_id, "year", $year, 
																		  "record_control >= $approved AND 1", 1, "month BETWEEN $start_month AND $end_month AND 1", 1);
                                    endforeach;

                                    $labels_str =  implode(",", $quarter_labels);
                                    $data_str =  implode(",", $values);

                                    $chart_details =  modal::displayCharts("$indicator_name (per quarter)", "quarter", "bar", $data_str, $labels_str, "Period");
                                    $pos = strpos($chart_details, COMMON_PLACEHOLDER);
                                    $statistics = substr($chart_details, 0, $pos);
                                    echo $statistics;
                                    $print_charts .= substr($chart_details, $pos + strlen(COMMON_PLACEHOLDER));
                                    ?>
                                    <!-- /.box-body donutChart --
                                </div>
                            </div>
                            <!-- /.box --

                            <!-- /.col (LEFT) --
                            <!-- BAR CHART --
                            <div class="w3-card-16">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <?php
                                        $labels = array();
                                        $region_names = array();
                                        $values = array();

                                        $regions = region::all();
                                        foreach ($regions as $r) :
                                            $region_names[] = $r->region_name;
                                            $region_id = $r->region_id;
                                            $sql_region = "captured_by IN (SELECT username FROM {$table_prefix}user WHERE district_id IN (SELECT district_id FROM 
														{$table_prefix}district WHERE region_id = $region_id))";
                                            $values[] = common::getFieldValue("indicator_value", "SUM(indicator_value)", "indicator_id", $indicator_id,"year", $year,
																			  "month", $month, "record_control >= $approved AND 1", 1, "$sql_region AND 1", 1);
                                        endforeach;

                                        $labels = $region_names;

                                        $labels_str =  implode(",", $labels);
                                        $data_str =  implode(",", $values);

                                        $chart_details =  modal::displayCharts("$indicator_name (per region)", "region", "pie", $data_str, $labels_str);
                                        $pos = strpos($chart_details, COMMON_PLACEHOLDER);
                                        $statistics = substr($chart_details, 0, $pos);
                                        echo $statistics;
                                        $print_charts .= substr($chart_details, $pos + strlen(COMMON_PLACEHOLDER));
                                        ?>
                                        <!-- /.box-body --
                                    </div>
                                </div>
                            </div>
                            <!-- /.col (RIGHT) --
                        </div>
                        <!-- /.row --
    </section>
	-->
    <!-- /.content -->
	
	<!-- notice detailss -->
	<section class="content">
		<!-- main row -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header">
						<h4 class="box-title">Notices</h4>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="box-group" id="accordion">
							<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
							<?php
								$i = 0;
								$notices = notice::all();
								foreach ($notices as $n) :
									$i++;
									$notice_details = array (
										"notice_id" => $n->notice_id,
										"notice_title" => $n->notice_title,
										"notice_content" => $n->notice_content,
										"captured_by" => $n->captured_by,
										"captured_date" => $n->captured_date
									);
									// print modals
									echo notice_modal::displayNotices($notice_details);
								endforeach;
							?>
							<!--
								 </tbody>
							</table>
							-->
						</div>
					</div>
					<!-- ./ box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
		<!-- ./ main row -->
	</section>
	<!-- ./ notice detailss -->
</div>
<!-- /.content-wrapper -->

<?php require "../includes/footer.php" ?>

<script>
    /* script to show a pie chart*/
    function pieChart(chart_id, type, dataset, labels) {
        labels =  labels.split(",");
        dataset =  dataset.split(",");

        var count = Object.keys(labels).length;

        var chart2 = {
            type: type,
            data: {
                labels: getData(labels, count),
                datasets: [{
                    data: getData(dataset, count),
                    backgroundColor: getColours(count),
                    label: 'Dashboard'
                }],
            },options: {
                responsive: true
            }
        };

        window.myPie = new Chart(document.getElementById(chart_id).getContext('2d'), chart2);
    }

    /* script to show a line chart*/
    function lineChart(chart_id, type, labels, dataset, label_str, dataset_labels){
        labels =  labels.split(",");
        label_str =  label_str.split(",");
		var display_legend = (chart_id === "months" || chart_id === "year_over_year") ? true : false;

        var count = Object.keys(labels).length;

        var lines = {
            type: type,
            data: {
                labels: getData(labels, count),
                datasets: Dataset(dataset, type, label_str, labels, chart_id),
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: ''
                },
                legend: {
                    display: display_legend,
					position: 'bottom'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: ''
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: ''
                        }
                    }]
                }
            }
        };

        window.myLine = new Chart(document.getElementById(chart_id).getContext('2d'), lines);

    }

    /* script to show a bar chart*/
    function barChart(chart_id, type, labels, dataset, dataset_labels) {
        labels = labels.split(",");
        dataset_labels = dataset_labels.split(",");
        var count = Object.keys(labels).length;
		var display_legend = (chart_id === "months" || chart_id === "year_over_year") ? true : false;
		
        var barChartData = {
            type: type,
            data: {
                labels: getData(labels, count),
                datasets: Dataset(dataset, type, dataset_labels, labels, chart_id),
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                legend: {
                    display: display_legend,
					position: 'bottom'
                },
                hover: {
                    mode: 'nearest',
                    intersect: false
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: ''
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: ''
                        }
                    }]
                }
            }
        };

        window.myBar = new Chart(document.getElementById(chart_id).getContext('2d'), barChartData);
    }

    /* script to format the content for the graph*/
    function Dataset(dataset, type, dataset_labels, labels, chart_id) {
        var ChartData = [];
        var data = "";
        var i = 0;
        var ColourArray = [window.chartColors.red, window.chartColors.blue, window.chartColors.orange, window.chartColors.green, window.chartColors.purple, window.chartColors.grey, '#ffd400', '#ff00ff', '#00ffff', '#000000', '#008620', '#001a9f', '#0096ff', '#dccf00', '#8d0088', '#890101', '#beb4b4', '#686868'];
        if (chart_id === "months" || chart_id === "year_over_year"){
            dataset = '"[' + dataset + ']"';
            dataset = eval(dataset);
            
            dataset = JSON.parse(dataset);

            dataset.forEach(function (a, i) {
                ChartData.push({
                    label: dataset_labels[i],
                    backgroundColor: ColourArray[i],
                    borderColor: ColourArray[i],
                    borderWidth: 1,
                    data: dataset[i],
                    fill: false,
                    lineTension: 0,
                });
            });
        } else {

            for (i = 0; i < dataset.length; i++) {
                dataset = dataset.split("|");

                data = dataset[i].split(",");
                if (type === "bar") {
                    ChartData.push({
                        label: '',
                        backgroundColor: ColourArray[i],
                        borderColor: ColourArray[i],
                        //borderWidth: 1,
                        data: data,
                        fill: false,
                    });
                } else {
                    ChartData.push({
                        label: '',
                        backgroundColor: ColourArray[i],
                        borderColor: ColourArray[i],
                        data: data,
                        fill: false,
                        lineTension: 0,
                    });
                }

            }
        }

        return ChartData;
    }

    /* script to format the content for the graph*/
    function getData (contents, count) {
        var data = [];

        for (var i = 0; i < count; i++) {
            data.push(contents[i]);
        }
        return data
    }

    /* script to get colors for the graph*/
    function getColours (count) {
        var colors = [];
        var ColourArray = [window.chartColors.red, window.chartColors.blue, window.chartColors.orange, window.chartColors.green, window.chartColors.purple, window.chartColors.grey, '#ffd400', '#ff00ff', '#00ffff', '#000000', '#008620', '#001a9f', '#0096ff', '#dccf00', '#8d0088', '#890101', '#beb4b4', '#686868'];
        for (var i = 0; i < count; i++) {
            colors.push(ColourArray[i]);
        }

        return colors
    }

    $(document).ready( function () {

        $(document).on('change', '.population', function() {

            var population_type_id = $(this).val();

            $.ajax({
                url: "modal.php",
                method: "POST",
                data: {
                    "population_type_id": population_type_id,
                    action : "populationType",
                },
                success: function(data) {
                    $(".population_type_sub").html(data);
                }
            })
        });
	
		$(document).on('change', '#population_type_sub_id, #indicator_ids, #reporting_month, #reporting_year', function() {
            var indicator_ids = $('#indicator_ids').val();
			var population_type_sub_id = $('#population_type_sub_id').val();
			var population_type_id = $('#population_type_id').val();
			var thematic_area_id = $('#thematic_area_id').val();       
            var reporting_month = $('#reporting_month').val();
            var reporting_year = $('#reporting_year').val();
			var bg_colors = <?php echo json_encode($bg_colors); ?>;

            $.ajax({
                url: "modal.php",
                method: "POST",
                data: {
                    "indicator_ids": indicator_ids,
					"population_type_id": population_type_id,
                    "population_type_sub_id": population_type_sub_id,
                    "thematic_area_id": thematic_area_id,
                    "reporting_month": reporting_month,
                    "reporting_year": reporting_year,
                    "bg_colors": bg_colors,
                    action : "indicators",
                },
                success: function(data) {
                    $(".indicators").html(data);
                }
            })
        });
		
		$(document).on('change', '#population_type_id, #population_type_sub_id', function() {
			var population_type_sub_id = $('#population_type_sub_id').val();
			var population_type_id = $('#population_type_id').val();
			var thematic_area_id = $('#thematic_area_id').val();       

            $.ajax({
                url: "modal.php",
                method: "POST",
                data: {
					"population_type_id": population_type_id,
                    "population_type_sub_id": population_type_sub_id,
                    "thematic_area_id": thematic_area_id,
                    action : "changeIndicators",
                },
                success: function(data) {
                    $(".indicator_ids").html(data);
                }
            })
        });

        $(document).on('click', '#indicator', function() {

            var indicator_id = this.getAttribute("data-value");
            var thematic_area_id = $('#thematic_area_id').val();

            $.ajax({
                url: "modal.php",
                method: "POST",
                data: {
                    "thematic_area_id": thematic_area_id,
                    "indicator_id": indicator_id,
                    action : "hiddenInputs",
                },
                success: function(data) {;
                    $('#hidden').html(data);
                    $('.redirect').submit();
                }
            });

        });

        $(document).on('click', '#t', function() {
            var thematic_area_id = $(this).attr('variable');
            $.ajax({
                url: "modal.php",
                method: "POST",
                data: {
                    "thematic_area_id": thematic_area_id,
                    action : "hiddenInputs",
                },
                success: function(data) {
                    $('#hidden').html(data);
                    $('.redirect').submit();
                }
            });
        });

    });
</script>

<!-- script to shore more or less on the thematic areas-->
<script>
    var h = $('.show-more-less')[0].scrollHeight;


    $('#more').click(function(e) {
        e.stopPropagation();
        $('.show-more-less').animate({
            'height': h
        })
        $('#more').hide();
        $('#less').show();
    });

    $('#less').click(function(e) {

        $('#more').show();
        $('#less').hide();
    });

    $(document).click(function() {
        $('.show-more-less').animate({
            'height': '50px'
        })
    })
    $(document).ready(function(){
        $('#less').hide();
    })
</script>