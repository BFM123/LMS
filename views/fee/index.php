<?php
	$page_id = 62;

	$asset_path = "../../";
	require "../includes/header.php";
	require_once $asset_path . "models/fee.php";
	require $asset_path . "models/currency.php";
	require $asset_path . "models/payment.php";
	require_once "modal.php";
	
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/district.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php"; 
	
	// get fee approval details
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
						<div class="box-body">
							<div class="box-header">
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#add">Add Fees</button>
								</div>
								<h3 class="box-title"></h3>
							</div>
							<!-- /.box-header -->
								
							<?php
								// display message after each action
								include "../includes/message.php";
								$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
								
								$local_currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
								
								// print modes of payment
								echo modal::displayPaymentModes($logged_username, $access_right);
							?>

							<div class="table-responsive">
								<table id="table1" class="table table-bordered w3-striped">
									<thead>								
									<tr>
										<th class="text-right" style="width: 10px">#</th>
										<th>Fee</th>
										<th>Invoice Time</th>
										<th class="text-center" nowrap="nowrap">Based<br />on Income?</th>
										<th class="text-center" nowrap="nowrap" colspan="2">Income (<?php echo $local_currency; ?>)</th>
										<th class="text-right">Fee (Original Currency)</th>
										<th class="text-right">Fee (Local Currency)</th>
										<?php if ($access_right === "RW") { ?>
											<th class="text-center" nowrap="nowrap">Action</th>
										<?php } ?>
									</tr>
									</thead>
									<tbody>
									<?php
																	
										$fees = fee::all($invoice_time = "", $fee_category = "", $fields = "F.fee_id, F.fee_category, F.invoice_time, F.based_on_income,
														 F.from_income, F.to_income, F.currency AS original_currency, F.amount, F.amount * C.exchange_rate AS amount_local");		
										$i = 1;
										foreach ($fees as $f) :
											$form_elements = array (
												"fee_id" => $f->fee_id,
												"fee_category" => $f->fee_category,
												"invoice_time" => $f->invoice_time,
												"based_on_income" => $f->based_on_income,
												"from_income" => $f->from_income,
												"to_income" => $f->to_income,
												"original_currency" => $f->original_currency,
												"amount" => $f->amount,
												"amount_local" => $f->amount_local
											);
		
											// print modals
											echo modal::displayTable($i, $logged_username, $access_right, $local_currency, $form_elements);
		
											$i++;
										endforeach;
									?>
									</tbody>
								</table>
							</div>

                            <?php
								if ($access_right === "RW") {
									// display Add Fee Modal
								   echo modal::displayModal("add", $logged_username, $local_currency);
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