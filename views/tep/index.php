<?php
	$asset_path = "../../";	
	require_once $asset_path . "config/config.php";
	
	global $APPROVAL_STATUS;	
	$level_0 = array_keys($APPROVAL_STATUS)[0];
	$level_1 = array_keys($APPROVAL_STATUS)[1];
	$level_2 = array_keys($APPROVAL_STATUS)[2];
	$level_4 = array_keys($APPROVAL_STATUS)[4];
	$draft = array_keys($APPROVAL_STATUS)[0];
	$approved = array_keys($APPROVAL_STATUS)[4];

	$level = isset($_GET["l"]) ? $_GET["l"] : "";

	if ($level == $level_0) $page_id = 73; // TEP requests 
	elseif ($level == $level_1) $page_id = 74; // TEP first approval
	elseif ($level == $level_2) $page_id = 74; // TEP second approval
	elseif ($level == $level_4) $page_id = 75; // TEP list
	
	require "../includes/header.php";
	require_once $asset_path . "models/tep.php";
	require_once $asset_path . "models/country.php";
	require_once $asset_path . "models/currency.php";
	require_once $asset_path . "models/fee.php";
	require_once $asset_path . "models/payment.php";
	require_once $asset_path . "models/common.php";
	require_once "modal.php";
	
	//  include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php"; 
		
	// get organization details
	$page_title = common::getPageDetails($page_id, "title");
	$breadcrumb = common::getPageDetails($page_id, "breadcrumb");	
	$color = common::getPageDetails($page_id, "parent_color");
	
	$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
	$logged_organization_id = common::getFieldValue("user", "organization_id", "username", $logged_username);
	if (strlen($logged_organization_id) == 0) $logged_organization_id = 0;
	
	$ngo_is_registered = common::exists("organization", 0, "organization_id", $logged_organization_id, "record_control", $approved);
	$draft_request_exists = common::exists("tep", 0, "organization_id", $logged_organization_id, "record_control", $draft);
	$ngo_is_due_for_auto_disabling = organization::getDueforAutoDisablingOrganizations($logged_organization_id, true);
	
	$can_request = ($ngo_is_registered && !$ngo_is_due_for_auto_disabling && !$draft_request_exists && $logged_organization_id != 0 && $level == $level_0) ? true : false;
	$organization_id_check = $logged_organization_id;
	$record_control_check = "";
	$status = STATUS_ACTIVE;
	
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
							<?php if ($access_right === "RW" && $can_request) { ?>	
    	                        <button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#request">Request TEP</button>
							<?php } ?>									
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
								if (!$can_request && $level == $level_0 && !$draft_request_exists) {							
									$error_message = "You are not allowed to request for TEP processing certificates. Either your NGO is not registered or you have not ";
									$error_message .= "submitted your annual returns";

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
											<th nowrap="nowrap">Invoice Number</th>
											<th class="text-center" nowrap="nowrap"># of<br />TEPs</th>
											<th nowrap="nowrap">Request Date</th>
											<?php if ($level == $level_0) { ?>
												<th class="text-center" nowrap="nowrap">Status</th>
											<?php } ?>
											<?php if ($access_right === "RW") { ?>
												<th class="text-center" nowrap="nowrap">Action</th>
											<?php } ?>	
										</tr>
									</thead>
									<tbody>
									<?php
										$teps = tep::all($organization_id_check, $invoice_number = "", $record_control_check, $status);	
										$form_elements = array();
										foreach ($teps as $t) :
											$form_elements[] = array (
												"tep_id" => $t->tep_id,
												"organization_id" => $t->organization_id,
												"organization_name" => $t->organization_name,
												"abbreviation" => $t->abbreviation,
												"registration_number" => $t->registration_number,
												"registration_year" => $t->registration_year,
												"contact_person" => $t->contact_person,
												"telephone" => $t->telephone,
												"email" => $t->email,
												"postal_address" => $t->postal_address,
												"fullname" => $t->fullname,
												"nationality" => $t->nationality,
												"passport_number" => $t->passport_number,
												"invoice_number" => $t->invoice_number,												
												"payment_proof" => $t->payment_proof,
												"record_control" => $t->record_control,
												"payment_processed_by" => $t->payment_processed_by,
												"payment_processed_date" => $t->payment_processed_date,									
												"captured_by" => $t->captured_by,
												"captured_date" => $t->captured_date,
												"approved1_by" => $t->approved1_by,
												"approved1_date" => $t->approved1_date,
												"approved2_by" => $t->approved2_by,
												"approved2_date" => $t->approved2_date,
												"rejected_by" => $t->rejected_by,
												"rejected_date" => $t->rejected_date,
												"rejected_comments" => $t->rejected_comments,
												"status" => $t->status												
											);
										endforeach;
										$form_elements = common::arrayGroupBy("invoice_number", $form_elements);

										// print modal
										echo modal::displayTable($logged_username, $access_right, $currency, $form_elements, $level);	
									?>
									</tbody>
								</table>
							</div>
                            <?php
								if ($access_right === "RW" && $can_request) {
									// display TEP Request Modal
									$organization_name = common::getFieldValue("organization", "organization_name", "organization_id", $logged_organization_id, "record_control",
																			   $approved);							
									echo modal::displayModal("request", $logged_username, $currency, $logged_organization_id, $organization_name);
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