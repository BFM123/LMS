<?php
	$page_id = 42;

	$asset_path = "../../";
	require "../includes/header.php";
	require $asset_path . "models/district.php";
	require $asset_path . "models/zone.php";
	require $asset_path . "models/region.php";
	require_once "modal.php";
			
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php";
	require_once $asset_path . "models/currency.php"; 
	
	// get districts details
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
	                            <button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#add">Add District</button>
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
										<th style="width: 10px">Code</th>
										<th>District</th>
										<th>Zone</th>
										<th>Region</th>
										<?php if ($access_right === "RW") { ?>	
											<th lass="text-center" style="width: 30px">Action</th>
										<?php } ?>											
									</tr>
									</thead>
									<tbody>
									<?php
										$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
										
										$districts = district::all();
		
										$i = 1;
										foreach ($districts as $d) :
											$form_elements = array (
												"district_id" => $d->district_id,
												"district_name" => $d->district_name,
												"district_code" => $d->district_code,
												"zone_id" => $d->zone_id,
												"region_id" => $d->region_id,
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
									// display Add District Modal
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
