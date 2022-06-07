<?php
	$page_id = 29;

	$asset_path = "../../";
	require "../includes/header.php";
	require $asset_path . "models/role.php";
	require_once "modal.php";
	
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
							<button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#add">Add Role</button>
						<?php } ?>
					</div>
					<!-- /.box-header -->
					
					<div class="box-body">
						<?php 
							/* display message after each action */
							include "../includes/message.php";
						?>
	
						<div class="table-responsive">
							<table id="table1" class="table table-bordered table-striped">
								<thead>
									<tr>
									<td class="text-right" style="width: 10px">#</th>
									<th>Role</th>
									<th style="font-weight: normal">
										<b>Access Rights</b>&nbsp; &gt; &nbsp;
										<?php 
											echo "<i class=\"fa fa-" . ICON_CHECK . "\" style=\"color: " . COLOR_BLUE . "\"></i>Read/Write &nbsp;&nbsp;";
											echo "<i class=\"fa fa-" . ICON_CHECK . "\" style=\"color: " . COLOR_AMBER . "\"></i>Read only &nbsp;&nbsp;";
											echo "<i class=\"fa fa-" . ICON_CROSS . "\" style=\"color: " . COLOR_RED . "\"></i>No Access"; ?>
									</th>
									<?php if ($access_right === "RW") { ?>
										<td class="text-center" style="width: 10px">Action</th>
									<?php } ?>
									</tr>
								</thead>
								<tbody>
								<?php 
									$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
									
									$roles = role::all();
	
									$i = 1; 
									foreach ($roles as $r) :
										$form_elements = array (
											"role_id" => $r->role_id,
											"role_name" => $r->role_name,
											"access_levels" => $r->menu_ids
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
								// display Add Role Modal
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