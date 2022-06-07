<?php
	$asset_path = "../../";	
	require_once $asset_path . "config/config.php";
	
	global $APPROVAL_STATUS;	
	$level_0 = array_keys($APPROVAL_STATUS)[0];
	$level_1 = array_keys($APPROVAL_STATUS)[1];
	$level_2 = array_keys($APPROVAL_STATUS)[2];
	$level_4 = array_keys($APPROVAL_STATUS)[4];
	$level_5 = array_keys($APPROVAL_STATUS)[5];
	$approved = array_keys($APPROVAL_STATUS)[4];
	$disabled = array_keys($APPROVAL_STATUS)[5];

	$level = isset($_GET["l"]) ? $_GET["l"] : "";

	if ($level == $level_0) $page_id = 66; // licensing requests
	elseif ($level == $level_1) $page_id = 67; // licensing - first approval
	elseif ($level == $level_2) $page_id = 68; // licensing - second approval
	elseif ($level == $level_4) $page_id = 69; // licensing - annual returns list
	
	require "../includes/header.php";
	require_once $asset_path . "models/district.php";
	require_once $asset_path . "models/organization.php";
	require_once $asset_path . "models/licensing_organization.php";
	require_once $asset_path . "models/staff.php";
	require_once $asset_path . "models/sector.php";
	require_once $asset_path . "models/target_group.php";
	require_once $asset_path . "models/qualification.php";
	require_once $asset_path . "models/country.php";
	require_once $asset_path . "models/donor.php";
	require_once $asset_path . "models/currency.php";
	require_once $asset_path . "models/bank.php";
	require_once $asset_path . "models/payment.php";
	require_once $asset_path . "models/common.php";
	require_once "modal.php";
	
	// get organization details
	$page_title = common::getPageDetails($page_id, "title");
	$breadcrumb = common::getPageDetails($page_id, "breadcrumb");	
	$color = common::getPageDetails($page_id, "parent_color");
	
	$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
	$logged_organization_id = common::getFieldValue("user", "organization_id", "username", $logged_username);
	if (strlen($logged_organization_id) == 0) $logged_organization_id = 0;
	$current_year = date("Y");
	$has_submitted = common::exists("licensing_organization", 0, "organization_id", $logged_organization_id, "reporting_year", $current_year);
	$ngo_is_approved_or_disabled = common::exists("organization", 0, "organization_id", $logged_organization_id, 
												  "(record_control = '$approved' OR record_control = '$disabled') AND '1'", 1);
	$is_reporting_period = organization::isReportingPeriod();
	
	$can_submit = (!$has_submitted && $is_reporting_period && $ngo_is_approved_or_disabled && $logged_organization_id != 0 && $level == $level_0) ? true : false;
	$organization_id_check = $logged_organization_id;
	$record_control_check = "";
	$status = STATUS_ACTIVE;
	
	// users already assigned to an organization cannot report for a new organization 
	if ($level == $level_0) { 
		$status .= "', '" . STATUS_REJECTED;
	} else {
		// for approvers...don't limit by organization but limit by approval level
		$organization_id_check = "";
		$record_control_check = $level;
	}
	$currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><span class="module-title" style="color: <?php echo $color; ?>"><?php echo $page_title; ?></span></h1>
            <ol class="breadcrumb"><?php echo $breadcrumb; ?></ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box w3-card-4">
                        <div class="box-header">
							<?php if ($access_right === "RW" && $can_submit) { ?>	
    	                        <button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#submit">Request License</button>
							<?php } ?>									
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
								if ((!$is_reporting_period || !$ngo_is_approved_or_disabled) && $level == $level_0) {
									$submission_window = common::getFieldValue("system", "CONCAT(DATE_FORMAT(reporting_period_start_date, '%d %b %Y'), ' to ',
																			   DATE_FORMAT(reporting_period_end_date, '%d %b %Y'))");
									$error_message = "You are not allowed to submit your annual returns or request for a license. Either your NGO is not registered or the ";
									$error_message .= "submission window ($submission_window) has expired.";
									$_SESSION["message"] = $error_message;
									$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
								}
								/* display message after each action */
								include "../includes/message.php";							
                            ?>

							<div class="table-responsive">
								<table id="table1" class="table table-bordered w3-striped">
									<thead>
										<tr>
											<th class="text-right" style="width: 10px">#</th>
											<th>NGO</th>
											<th nowrap="nowrap">Contact Person</th>
											<th>Contact Details</th>
											<th class="text-center" nowrap="nowrap">Year</th>
											<?php if ($level == $level_0) { ?>
												<th class="text-center" nowrap="nowrap">Status</th>
											<?php } else { ?>
												<th>District</th>
											<?php } if ($access_right === "RW") { ?>
												<th class="text-center" nowrap="nowrap">Action</th>
											<?php } ?>	
										</tr>
									</thead>
									<tbody>
									<?php
										$licensing_organization_data_key = array(
											"objective" => array("objective_id", "objective"), 
											"staff capacity" => array("staff_capacity_id", "staff_type", "staff_number"), 
											"sector" => array("sector_id", "sector"), 
											"location activity" => array("location_activity_id", "vdc", "adc", "district_id"), 
											"target group" => array("target_group_id", "target_group"),
											"trustee" => array("trustee_id", "fullname", "telephone", "email", "occupation", "nationality", "national_id", "position", "timeframe"),
											"source funding" => array("source_funding_id", "donor_id", "contact_details", "funding_currency", "funding_amount"), 
											"auditor" => array("auditor_id", "name", "address", "telephone", "email"),
											"bank" => array("organization_bank_id", "bank_id", "address", "telephone", "email"),
											"tep" => array("tep_id", "fullname", "nationality", "passport_number"),
											"document" => array("document_id", "document_category", "filename")
										);																	
										$blank = "";						
										$licensing_organizations = licensing_organization::all($organization_id_check, $record_control_check, $status);	
										$i = 1;
										foreach ($licensing_organizations as $o) :
											// get annual return details
											$form_elements = array (
												// organizational details
												"licensing_organization_id" => $o->licensing_organization_id,
												"organization_id" => $o->organization_id,
												"abbreviation" => $o->abbreviation,
												"reporting_year" => $o->reporting_year,
												"organization_name" => $o->organization_name,
												"charity_number" => $o->charity_number,
												"telephone" => $o->telephone,
												"email" => $o->email,
												"organization_type" => $o->organization_type,
												"registration_type" => $o->registration_type,
												"postal_address" => $o->postal_address,
												"physical_address" => $o->physical_address,
												"district_id" => $o->district_id,
												
												// coverage
												
												// governance
												"executive_director_fullname" => $o->executive_director_fullname,
												"executive_director_nationality" => $o->executive_director_nationality,
												"executive_director_national_id" => $o->executive_director_national_id,
												"executive_director_highest_qualification" => $o->executive_director_highest_qualification,
												"executive_director_email" => $o->executive_director_email,
												"executive_director_telephone" => $o->executive_director_telephone,
												
												// accounting
												"financial_year_start_month" => $o->financial_year_start_month,
												"financial_year_end_month" => $o->financial_year_end_month,
												"annual_income" => $o->annual_income,											
												
												// documents
												
												// other
												"record_control" => $o->record_control,
												"payment_processed_by" => $o->payment_processed_by,
												"payment_processed_date" => $o->payment_processed_date,									
												"captured_by" => $o->captured_by,
												"captured_date" => $o->captured_date,
												"approved1_by" => $o->approved1_by,
												"approved1_date" => $o->approved1_date,
												"approved2_by" => $o->approved2_by,
												"approved2_date" => $o->approved2_date,
												"rejected_by" => $o->rejected_by,
												"rejected_date" => $o->rejected_date,
												"rejected_comments" => $o->rejected_comments,
												"status" => $o->status
												
											);
											
											// get annual return organization data
											$licensing_organization_data = array();
											foreach ($licensing_organization_data_key as $key => $value) :		
												$licensing_organization_data[$key] = licensing_organization::getOrganizationData($o->licensing_organization_id, $key, 
																																 implode(", ",$value));
											endforeach;
											
											// print modals
											echo modal::displayTable($i, $logged_username, $access_right, $currency, $is_reporting_period, $form_elements, 
																	 $licensing_organization_data, $level, $can_submit);		
											$i++;
										endforeach;
									?>
									</tbody>
								</table>
							</div>
                            <?php
								if ($access_right === "RW" && $can_submit) {
									// display Submit Annual Return Modal
									$blank = "";						
									$organizations = organization::all($logged_organization_id, $blank, $blank, $blank, $blank, $level_4 . "', '" . $level_5);	
									$i = 1;
									$licensing_organization_id = "";
									$form_elements = array();
									foreach ($organizations as $o) :
										// get initial annual return details from previously approved organization details
										$form_elements = array (
											// initial organizational details
											"licensing_organization_id" => $licensing_organization_id,
											"organization_id" => $o->organization_id,
											"abbreviation" => $o->abbreviation,
											"organization_name" => $o->organization_name,
											"charity_number" => $o->charity_number,
											"telephone" => $o->telephone,
											"email" => $o->email,
											"organization_type" => $o->organization_type,
											"registration_type" => $o->registration_type,
											"postal_address" => $o->postal_address,
											"physical_address" => $o->physical_address,
											"district_id" => $o->district_id,
											
											// initial coverage details
											
											// initial governance details
											"executive_director_fullname" => $o->executive_director_fullname,
											"executive_director_nationality" => $o->executive_director_nationality,
											"executive_director_national_id" => $o->executive_director_national_id,
											"executive_director_highest_qualification" => $o->executive_director_highest_qualification,
											"executive_director_email" => $o->executive_director_email,
											"executive_director_telephone" => $o->executive_director_telephone,
											
											// initial accounting details
											"financial_year_start_month" => $o->financial_year_start_month,
											"financial_year_end_month" => $o->financial_year_end_month,
											"annual_income" => $o->annual_income,											
																						
											// initial other details
											"record_control" => $level_0,
											"payment_processed_by" => $o->payment_processed_by,
											"payment_processed_date" => $o->payment_processed_date,									
											"captured_by" => $o->captured_by,
											"captured_date" => $o->captured_date,
											"approved1_by" => $o->approved1_by,
											"approved1_date" => $o->approved1_date,
											"approved2_by" => $o->approved2_by,
											"approved2_date" => $o->approved2_date,
											"rejected_by" => $o->rejected_by,
											"rejected_date" => $o->rejected_date,
											"rejected_comments" => $o->rejected_comments,
											"status" => $o->status											
										);
										
										// get annual return organization data
										$licensing_organization_data = array();
										foreach ($licensing_organization_data_key as $key => $value) :
											// don't include documents...organizatiuon needs to submit new documents for this year
											if ($key !== "document" && $key !== "tep")
												$licensing_organization_data[$key] = organization::getOrganizationData($logged_organization_id, $key, implode(", ", $value));
										endforeach;
										
										$i++;
									endforeach;
									
									echo modal::displayModal("submit", $logged_username, $currency, $is_reporting_period, $form_elements, $licensing_organization_data);
								}
                            ?>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php require "../includes/footer.php";
