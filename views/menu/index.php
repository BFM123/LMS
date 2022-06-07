<?php
	$page_id = 31;

	$asset_path = "../../";
	require "../includes/header.php";
	require_once $asset_path . "models/common.php";
	require_once "modal.php";
		
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/district.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php";
	require_once $asset_path . "models/currency.php"; 
	
	// get page details
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
							<button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#add">Add Menu</button>
						<?php } ?>							
					</div>
					<!-- /.box-header -->
					
					<div class="box-body">
						<?php 
							/* display message after each action */
							include "../includes/message.php";
						?>
	
						<div class="table-responsive">
							<table id="table-menu" class="display dataTable table table-bordered w3-striped" style="width: 100%">
								<thead>
									<tr>
									<td class="text-right" style="width: 10px">#</th>
									<th>Menu Item</th>
									<th>Menu Parent</th>
									<th>Link</th>
									<th class="text-center" style="width: 10px">Weight</th>
									<?php if ($access_right === "RW") { ?>	
										<th class="text-center" style="width: 30px">Action</th>
									<?php } ?>									
								</tr>
								</thead>
								<tbody>
								<?php 
									$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
									
									$menus = menu::display();
	
									$i = 1; 
									foreach ($menus as $m) :
										$form_elements_parent = array (
											"menu_id" => $m->menu_id,
											"menu_item" => $m->menu_item,
											"menu_link" => $m->menu_link,
											"menu_parent" => $m->menu_parent,
											"weight" => $m->weight,
											"icon" => $m->icon,
											"icon_color" => $m->icon_color,
											"menu_level" => "parent"
										);
										
										// print top level menus and modals
										echo modal::displayTable($i, $logged_username, $access_right, $form_elements_parent);
										
										// if this menu item has children then print children menus and modals
										$chilren_menus = menu::display($m->menu_id);
	
										$j = 1; 
										foreach ($chilren_menus as $c) :
											$form_elements_children = array (
												"menu_id" => $c->menu_id,
												"menu_item" => $c->menu_item,
												"menu_link" => $c->menu_link,
												"menu_parent" => $c->menu_parent,
												"weight" => $c->weight,
												"icon" => $c->icon,
												"icon_color" => $c->icon_color,
												"menu_level" => "child"
											);
										
											// print children menus and modals
											echo modal::displayTable($j, $logged_username, $access_right, $form_elements_children);
											$j++;
										endforeach;
	
										$i++;
									endforeach; 
								?>
								</tbody>
							</table>
						</div>
						
						<?php
							if ($access_right === "RW") {
								// display Add Menu Modal
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