<?php
	$page_id = 58;
	$asset_path = "../../";	
	require_once $asset_path . "config/config.php";
	require_once "../includes/header.php";
	require_once $asset_path . "models/organization.php";
	require_once $asset_path . "models/currency.php";
	require_once $asset_path . "models/payment.php";
	require_once "modal.php";
	
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php";
	
	// get payment details
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
							$invoice_year = isset($_POST["invoice_year"]) ? $_POST["invoice_year"] : date("Y");;
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
												<?php
													$invoice_years = common::getPeriods($sort_order = "DESC", $format = "year", $period_depth = 5);													
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
											<th nowrap=\"nowrap\">Invoice #</th>
											<!--<th nowrap=\"nowrap\" class=\"text-center\">Invoice Year</th>-->
											<th nowrap=\"nowrap\" class=\"text-right\">Amount<br />($currency)</th>
											<th nowrap=\"nowrap\" class=\"text-right\">Amount<br />Paid ($currency)</th>
											<th nowrap=\"nowrap\" class=\"text-right\">Balance<br />($currency)</th>
											<th class=\"text-center\" nowrap=\"nowrap\">INV</th>";
											
											if ($access_right === "RW") {
												$table .= "<th class=\"text-center\" nowrap=\"nowrap\">Action</th>";
											}
									
										$table .= "
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
											"invoice_time" => $inv->invoice_time,
											"invoice_year" => $inv->invoice_year,
											"annual_income" => $inv->annual_income,
											"executive_director_fullname" => $inv->executive_director_fullname,
											"telephone" => $inv->telephone,
											"email" => $inv->email,
											"registration_number" => $inv->registration_number,
											"registration_year" => $inv->registration_year,
											"fee_category" => $inv->fee_category,
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
								// no Add Fee Button
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
