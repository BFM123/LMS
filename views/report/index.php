<?php
	$page_id = 6;

	$asset_path = "../../";
	require "../includes/header.php";
	require $asset_path . "models/report.php";
	require_once $asset_path . "models/common.php";
	require_once $asset_path . "models/organization.php";
	require_once $asset_path . "models/district.php";
	require_once $asset_path . "models/zone.php";
	require_once $asset_path . "models/region.php";
	require_once $asset_path . "models/role.php";
	require_once "modal.php";
		
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php";
	require_once $asset_path . "models/currency.php"; 
	
	// get thematic area details
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
								<button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#add">Add Report</button>
							<?php } ?>									
						</div>
						<!-- /.box-header -->

						<div class="box-body">
							<?php
							/* display message after each action */
							include "../includes/message.php";
							?>

							<div class="table-responsive">
								<table id="table1" class="table table-bordered w3-striped">
									<thead>
									<tr>
										<th class="text-right" style="width: 10px">#</th>
										<th>Report</th>
										<th>Description</th>
										<?php if ($access_right === "RW") {?>
											<th class="text-center" style="width: 20px" nowrap="nowrap">Sort Order</th>
										<?php } ?>										
										<th class="text-center" style="width: 30px" nowrap="nowrap">Action</th>
									</tr>
									</thead>
									<tbody>
									<?php
										$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
									
										$report = report::all();
		
										$i = 1;
										foreach ($report as $r) :
											$form_elements = array (
												"report_id" => $r->report_id,
												"report_name" => $r->report_name,
												"description" => $r->description,
												"destination" => $r->destination,
												"sort_order" => $r->sort_order,
											);
		
											// print modals
											echo modal::displayTable($i, $logged_username, $access_right, $form_elements);
		
											$i++;
										endforeach;
									?>
									</tbody>
								</table>
							</div>
							<?php
								if ($access_right === "RW") {
									// display Add Program Modal
									echo modal::displayModal("add", $logged_username);
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
