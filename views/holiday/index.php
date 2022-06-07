<?php
	$page_id = 80;

	$asset_path = "../../";
	require "../includes/header.php";
	require $asset_path . "models/holiday.php";
	require_once $asset_path . "models/common.php";
	require_once "holiday_modal.php";
	
	// get holiday details
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
	                            <button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#add">Add Holiday</button>
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
											<th>Category</th>
											<th>Date</th>
											<th>Year</th>
											<?php if ($access_right === "RW") { ?>	
												<th>Action</th>
											<?php } ?>											
										</tr>
									</thead>
									<tbody>
									<?php
										$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
										
										$holidays = holiday::all();
		
										$i = 1;
										foreach ($holidays as $n) :
											$form_elements = array (
												"holiday_id" => $n->holiday_id,
												"category" => $n->category,
												"holiday_date" => $n->holiday_date,
												"holiday_year" => $n->holiday_year,
												"captured_by" => $n->captured_by,
												"captured_date" => $n->captured_date
											);
		
											// print modals
											echo holiday_modal::displayTable($i, $logged_username, $access_right, $form_elements);
		
											$i++;
										endforeach;
									?>
									</tbody>
                            	</table>
							</div>

                            <?php
										if ($access_right === "RW") {	
									// display Add holiday Modal
									echo holiday_modal::displayModal("add", $logged_organization_id, $logged_username);
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