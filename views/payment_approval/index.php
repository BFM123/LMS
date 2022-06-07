<?php
	$asset_path = "../../";	
	require_once $asset_path . "config/config.php";
	
	global $APPROVAL_STATUS;	
	$level_0 = array_keys($APPROVAL_STATUS)[0];
	$level_1 = array_keys($APPROVAL_STATUS)[1];
	$level_2 = array_keys($APPROVAL_STATUS)[2];
	
	$level = isset($_GET["l"]) ? $_GET["l"] : "";
	
	if ($level == $level_0) $page_id = 61;
	elseif ($level == $level_1) $page_id = 59;
	elseif ($level == $level_2) $page_id = 60;
	
	require "../includes/header.php";
	require $asset_path . "models/currency.php";
	require_once $asset_path . "models/payment.php";
	require_once "modal.php";
	
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php"; 
	
	// get payment approval details
	$page_title = common::getPageDetails($page_id, "title");
	$breadcrumb = common::getPageDetails($page_id, "breadcrumb");
	$color = common::getPageDetails($page_id, "parent_color");	
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
							<div class="box-tools pull-right">
								<!-- no add	butoton -->
							</div>
							<h3 class="box-title"></h3>
						</div>
						<!-- /.box-header -->
	
						<div class="box-body">
							<?php
								// display message after each action
								include "../includes/message.php";
								$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
								
								$currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
							?>

							<div class="table-responsive">
							<table id="table1" class="table table-bordered w3-striped">	
								<thead>
									<tr>
										<th class="text-right" style="width: 10px">#</th>
										<th>Request</th>
										<th>NGO</th>
										<th>Reason</th>
										<th nowrap="nowrap">Request Date</th>
										<?php if ($level == 0) { ?>
											<th class="text-center" nowrap="nowrap">Status</th>
										<?php } else  { ?>
											<th nowrap="nowrap">Requested By</th>
										<?php } ?>
										<th  nowrap="nowrap" class="text-right">Amount (<?php echo $currency; ?>)</th>
										<?php if ($access_right === "RW") { ?>
											<th class="text-center" nowrap="nowrap">Action</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
								<?php
									$approval_level = $level - 1;;
									$approvals = payment::getApprovals($approval_level, $logged_username);
		
									$i = 1;
									foreach ($approvals as $app) :									
										$form_elements = array (
											"payment_id" => $app->payment_id,
											"invoice_number" => $app->invoice_number,
											"request" => $app->request,
											"organization_id" => $app->organization_id,
											"organization_name" => $app->organization_name,
											"registration_number" => $app->registration_number,
											"registration_year" => $app->registration_year,
											"receipt_number" => $app->receipt_number,
											"payment_mode" => $app->payment_mode,
											"reason" => $app->reason,
											"requested_date" => $app->requested_date,
											"requested_by" => $app->requested_by,
											"request_status" => $app->request_status,
											"authorized_by" => $app->authorized_by,
											"authorized_date" => $app->authorized_date,
											"authorizer_comments" => $app->authorizer_comments,
											"rejected_by" => $app->rejected_by,
											"rejected_date" => $app->rejected_date,
											"reject_comments" => $app->reject_comments,
											"record_control" => $app->record_control,
											"amount" => $app->amount
										);
	
										// print modals
										echo modal::displayTable($i, $logged_username, $access_right, $currency, $level, $form_elements);	
										$i++;
									endforeach;
								?>
								</tbody>
							</table>
						</div>
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