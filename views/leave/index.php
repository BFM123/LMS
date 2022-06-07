<?php
	$asset_path = "../../";	
	require_once $asset_path . "config/config.php";
	require $asset_path . 'models/leave.php';
	
	global $APPROVAL_STATUS;	
	$level_0 = array_keys($APPROVAL_STATUS)[0];
	$level_1 = array_keys($APPROVAL_STATUS)[1];
	$level_2 = array_keys($APPROVAL_STATUS)[2];
	$level_3 = array_keys($APPROVAL_STATUS)[3];
	$level_4 = array_keys($APPROVAL_STATUS)[4];

	$level = isset($_GET["l"]) ? $_GET["l"] : 0;

	if ($level == $level_0) $page_id = 56; // Application 
	elseif ($level == $level_1) $page_id = 52; // Application - first approval
	elseif ($level == $level_2) $page_id = 51; // Application - second approval
	elseif ($level == $level_3) $page_id = 79; // Application - leave application list
	elseif ($level == $level_4) $page_id = 79; // Application - leave application list
	
	require "../includes/header.php";
	require_once $asset_path . "models/common.php";
	require_once "modal.php";
	
	// get application details
	$page_title = common::getPageDetails($page_id, "title");
	$breadcrumb = common::getPageDetails($page_id, "breadcrumb");	
	$color = common::getPageDetails($page_id, "parent_color");
	$logged_role_id = common::getFieldValue("user", "role_id", "username", $logged_username, "organization_id", $logged_organization_id);
	$can_request_for_others = common::getFieldValue("role", "can_request_for_others", "role_id", $logged_role_id, "organization_id", $logged_organization_id);
	$can_request = true;
	$record_control_check = $level;
	$status = STATUS_ACTIVE;
	$upload_document = false;
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
							<?php if ($access_right === "RW" && $level == $level_0) { ?>	
    	                        <button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#request">Request</button>
							<?php } ?>									
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
                            /* display message after each action */
                            include "../includes/message.php";
							$requested_for = isset($_POST["requested_for"]) ? $_POST["requested_for"] : "";
							$col_size = "col-md-12";
                            ?>									
							<!-- /.box-header -->	
							<div class="table-responsive">
								<table id="table1" class="table table-bordered w3-striped">
									<thead>
										<tr>
											<th class="text-right" style="width: 10px">#</th>
											<th nowrap="nowrap">Name</th>
											<th>Leave Type</th> 
											<th>Start Date</th>
											<th>End Date</th>
											<th class="text-right">Requested</th>
											<th class="text-right">Remaining</th>
											<?php if ($level == $level_0 || $level_3) { ?>
												<th class="text-center" nowrap="nowrap">Status</th>
											<?php }
												if ($access_right === "RW") { ?>	
												<th>Action</th>
											<?php } ?>	
										</tr>
									</thead>
									<tbody>
									<?php
										$username = (strlen($requested_for) > 0) ? $requested_for : $logged_username;
										$username = ($level == $level_0) ? $username : "";
										$blanks = "";
										$status = ($level == $level_3) ? STATUS_ACTIVE . "', '" . STATUS_REJECTED : STATUS_ACTIVE; // to make rejected applications visible on processed applications
										$leave = leave::all($logged_organization_id, $logged_username, $can_request_for_others, $blanks, $blanks, $blanks, $blanks, $status);
										$holidays = array_unique(leave::getHolidays($logged_organization_id));

										$i = 1;
										foreach ($leave as $l) :
											$firstname = common::getFieldValue("user", "firstname", "username", $l->requested_for); 
											$lastname = common::getFieldValue("user", "lastname", "username", $l->requested_for);
											$leave_entitlement = common::getFieldValue("leave_entitlement", "leave_days", "organization_id", $l->organization_id, "leave_type", $l->leave_type);
											$working_days = leave::getWorkingDays($l->start_date, $l->end_date, $holidays);
											$used_days = leave::getDaysUsed($l->requested_for, $l->leave_type, $l->organization_id, $l->captured_date);
											$number_of_day_due 	= $leave_entitlement - $used_days;

											$form_elements = array (
												"leave_id" => $l->leave_id,
												"organization_id" => $l->organization_id,
												"firstname" => $firstname,
												"lastname" => $lastname,
												"leave_type" => $l->leave_type,
												"duration" => $working_days,
												"number_of_day_due" => $number_of_day_due,
												"record_control" => $l->record_control,
												"comment" => $l->comment,
												"upload_document" => $upload_document,
												"level" => $l->record_control,
												"start_date" => $l->start_date,
												"end_date" => $l->end_date,
												"leave_entitlement" => $leave_entitlement,
												"requested_for" => $l->requested_for,
												"captured_date" => $l->captured_date,
												"can_request_for_others" => $can_request_for_others,
												"status" => $l->status
											);

											// print modals
											echo modal::displayTable($i, $logged_username, $access_right, $level, $form_elements);
		
											$i++;
										endforeach;
										?>
									</tbody>
								</table>
							</div>
                            <?php
								if ($access_right === "RW" && $can_request) {
									// display Leave Application Modal
									echo modal::displayModal("request", $logged_username, array(), $level, $requested_for);
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
