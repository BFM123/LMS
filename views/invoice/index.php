<?php
	$page_id = 63;
	$asset_path = "../../";	
	require_once $asset_path . "config/config.php";
	require "../includes/header.php";
	require_once $asset_path . "models/organization.php";
	require_once $asset_path . "models/currency.php";
	require_once $asset_path . "models/invoice.php";
	require_once "modal.php";	
		
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php";
	
	// get invoice details
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
						<?php if ($access_right === "RW") {?>
                        	<button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#generate">Generate Invoices</button>
						<?php } ?>
					</div>
					<div class="box-header">
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
						<h3 class="box-title"></h3>
					</div>
					<!-- /.box-header -->

					<div class="box-body">
						<?php
							// display message after each action
							include "../includes/message.php";
							$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";							
							$logged_organization_id = common::getFieldValue("user", "organization_id", "username", $logged_username);
							if (strlen($logged_organization_id) == 0) $logged_organization_id = 0;
							
							// put a check to ensure that NGO's only see their organization details and NGO board should see details for all NGO's
							$logged_organization_id = (user::isNGOUser($logged_username)) ? $logged_organization_id : "";

							$currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
							$current_year = date("Y");
							$invoice_year = isset($_POST["invoice_year"]) ? $_POST["invoice_year"] : $current_year;
							$current_year++;
						?>
						
						<div class="box-header">
							<div class="box box-primary" style="border: 1px solid #d2d2d2;">
								<!-- form start -->
								<form role="form" method="post">
									<div class="box-body">											
										<fieldset class="form-group col-md-5">
											<label for="invoice_year">Year</label>
											<select class="form-control select2" style="width: 100%;" name="invoice_year" id="invoice_year">
												<option value=""><?php echo OPTION_SELECT; ?></option>
												<option value="<?php echo $current_year; ?>"><?php echo $current_year; ?></option>
												<?php
													$invoice_years = common::getPeriods($sort_order = "DESC", $format = "year", $period_depth = 4);													
													foreach ($invoice_years as $k => $v):
														$selected = ($invoice_year == $k) ? " selected" : "";
														echo "<option value=\"$k\"$selected>$v</option>";
													endforeach; 				
												?>
											</select>
										</fieldset>
									
										<fieldset class="form-group col-md-1">
											<label for="search"></label>
											<button type="submit" name="search" id="search" class="btn btn-default btn-round">Search</button>
										</fieldset>
										
										<fieldset class="form-group col-md-6">							
										</fieldset>
									</div>
									<!-- /.box-body -->
								</form>
								<!-- ./form -->
							</div>
							<!-- /.box-primary -->
						</div>
						</div>
						<!-- /.box-header -->
						
						<?php
						$table = "
							<div class=\"table-responsive\">
								<table id=\"table1\" class=\"table table-bordered w3-striped\">
									<thead>
										<tr>
											<th class=\"text-right\" style=\"width: 10px\">#</th>
											<th>NGO</th>
											<th nowrap=\"nowrap\">Fee Category</th>
											<th nowrap=\"nowrap\">Invoice Number</th>
											<th class=\"text-center\" nowrap=\"nowrap\">Invoice Year</th>
											<th nowrap=\"nowrap\">Start Date</th>
											<th nowrap=\"nowrap\">End Date</th>
											<th nowrap=\"nowrap\" class=\"text-right\">Amount ($currency)</th>
											<th nowrap=\"nowrap\" class=\"text-center\">Invoice</th>								
										</tr>
									</thead>
									<tbody>";
									
									$invoices = invoice::all($logged_organization_id, $invoice_year);	
									
									$i = 1;
									foreach ($invoices as $inv) :
										// get invoice details
										$form_elements = array (
											"invoice_id" => $inv->invoice_id,
											"invoice_number" => $inv->invoice_number,
											"organization_id" => $inv->organization_id,
											"organization_name" => $inv->organization_name,
											"registration_number" => $inv->registration_number,
											"fee_category" => $inv->fee_category,
											"registration_year" => $inv->registration_year,
											"start_date" => $inv->start_date,
											"end_date" => $inv->end_date,
											"invoice_year" => $inv->invoice_year,
											"amount" => $inv->amount
										);
										
										// print modals
										$table .= modal::displayTable($i, $logged_username, $access_right, $currency, $form_elements);
	
										$i++;
									endforeach;
									$table .= "
									</tbody>
								</table>
							</div>";

							if ($access_right === "RW") {
								// display Generate Invoices Modal
							    $table .= modal::displayModal("generate", $logged_username, $currency);
							}														
							echo $table;  
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
