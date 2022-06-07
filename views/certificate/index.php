<?php
	$page_id = 57;

	$asset_path = "../../";
	require "../includes/header.php";
	require $asset_path . "models/certificate.php";
	require_once "modal.php";
		
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php";
	require_once $asset_path . "models/currency.php"; 
	
	// get certificate details
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
							<?php if ($access_right === "RW") { ?>	
	                            <!-- no add button -->
							<?php } ?>									
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
                            /* display message after each action */
                            include "../includes/message.php";
							$request_year = isset($_POST["request_year"]) ? $_POST["request_year"] : date("Y");;
							?>
							
							<div class="box-header">
								<div class="box box-primary" style="border: 1px solid #d2d2d2;">
									<!-- form start -->
									<form role="form" method="post">
										<div class="box-body">											
											<fieldset class="form-group col-md-5">
												<label for="request_year">Year</label>
												<select class="form-control select2" style="width: 100%;" name="request_year" id="request_year">
													<option value=""><?php echo OPTION_SELECT; ?></option>
													<?php
														$request_years = common::getPeriods($sort_order = "DESC", $format = "year", $period_depth = 5);													
														foreach ($request_years as $k => $v):
															$selected = ($request_year == $k) ? " selected" : "";
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
											<th>Organization</th>
											<th>Certificate Category</th>
											<th nowrap=\"nowrap\">Start Date</th>
											<th nowrap=\"nowrap\">End Date</th>
											<th nowrap=\"nowrap\" class=\"text-center\">Year</th>
											<th class=\"text-center\" nowrap=\"nowrap\">Printed</th>";
											
											if ($access_right === "RW") {
												$table .= "<th lass=\"text-center\" style=\"width: 30px\">Action</th>";
											}											
										$table .= "
										</tr>
										</thead>
										<tbody>";
										
										global $APPROVAL_STATUS;	
										$approved = array_keys($APPROVAL_STATUS)[4];
										
										$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";										
										$certificates = certificate::all($request_year, $approved);
		
										$i = 1;
										foreach ($certificates as $c) :
											$show_row = true;
											
											if ($c->certificate_category === CERTIFICATE_LICENSE) {
												// for licenses ensure that the annual return is approved i.e. license fee is fully paid
												$reporting_year = substr($c->start_date, 0, 4);
												$annual_return_approved = common::exists("licensing_organization", 0, "organization_id", $c->organization_id, "reporting_year",
																						  $reporting_year, "record_control", $approved);
																						  
												if (!$annual_return_approved) $show_row = false;
											}
											
											if ($show_row) {		
												$form_elements = array (
													"certificate_id" => $c->certificate_id,
													"organization_id" => $c->organization_id,
													"organization_name" => $c->organization_name,
													"registration_number" => $c->registration_number,
													"registration_year" => $c->registration_year,
													"certificate_category" => $c->certificate_category,
													"details_1" => $c->details_1,
													"start_date" => $c->start_date,
													"end_date" => $c->end_date,
													"request_year" => $c->request_year,
													"is_printed" => $c->is_printed,
													"last_printed_by" => $c->last_printed_by,
													"last_printed_date" => $c->last_printed_date
												);
			
												// print modals
												$table .= modal::displayTable($i, $logged_username, $access_right, $form_elements);
			
												$i++;
											}
										endforeach;
										
										$table .= "
									</tbody>
								</table>
							</div>";
							if ($access_right === "RW") {
								// no add modal
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
