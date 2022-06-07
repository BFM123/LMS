<?php
	$page_id = 22;

	$asset_path = "../../";
	require "../includes/header.php";
	require_once $asset_path . "models/common.php";
	require_once $asset_path . "models/audit_trail.php";
	require_once $asset_path . "models/report.php";
	require_once "modal.php";
	
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php";
	require_once $asset_path . "models/currency.php"; 
	
	// get audit trail details
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
							<!-- no action buttons -->
						</div>
						<!-- /.box-header -->

						<div class="box-header">
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
							<h3 class="box-title"></h3>
						</div>
						<!-- /.box-header -->

						<div class="box-body">
							<?php
								/* display message after each action */
								include "../includes/message.php";

								$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";																
								$action = (isset($_POST["action"])) ? $_POST["action"] : array();
								$action_by = (isset($_POST["action_by"])) ? $_POST["action_by"] : array();
								$start_date = (isset($_POST["start_date"])) ? $_POST["start_date"] : "";
								$end_date = (isset($_POST["end_date"])) ? $_POST["end_date"] : "";
								$detail = (isset($_POST["detail"])) ? $_POST["detail"] : "";
								$destination = (isset($_POST["destination"])) ? $_POST["destination"] : "";
								
								$blanks = "";
							?>
							
							<div class="box-header">
								<div class="box box-primary" style="border: 1px solid #d2d2d2;">
									<!-- form start -->
									<form role="form" method="post">
										<div class="box-body">
											<fieldset class="form-group col-md-4">
												<label for="action">Activity</label>
												<select class="form-control select2" name="action[]" style="width: 100%;" multiple="multiple">
													<?php
														$actions = audit_trail::all("DISTINCT action AS action");
					
														foreach ($actions as $a):
															$selected = in_array($a->action, $action) ? " selected" : "";
															echo "<option value=\"$a->action\"$selected>" . strtoupper($a->action) . "</option>";
														endforeach;
													?>
												</select>
											</fieldset>
											
											<fieldset class="form-group col-md-4">
												<label for="action_by">Activity By</label>
												<select class="form-control select2" name="action_by[]" style="width: 100%;" multiple="multiple">
													<?php
														$actions_by = audit_trail::all("DISTINCT action_by AS action_by");
					
														foreach ($actions_by as $ab):
															$selected = in_array($ab->action_by, $action_by) ? " selected" : "";
															$fullname = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $ab->action_by, $blanks,
																							   $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks,
																							   STATUS_ACTIVE . "', '" . STATUS_DELETED);									   
															if (strlen($fullname) == 0) $fullname = "Doesn't Exist";
															$fullname = "$ab->action_by ($fullname)";
															echo "<option value=\"$ab->action_by\"$selected>$fullname</option>";
														endforeach;
													?>
												</select>
											</fieldset>
																						
											<fieldset class="form-group col-md-4">
												<label for="detail">Details</label>
												<input class="form-control" type="text" name="detail" value="<?php echo $detail; ?>">												
											</fieldset>
											
											<fieldset class="form-group col-md-12">
											</fieldset>	
										
											<fieldset class="form-group col-md-4">
												<label class="required" for="start_date">Start Date</label>
												<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
													<input type="text" class="form-control" name="start_date" value="<?php echo $start_date; ?>" required>
													<div class="input-group-addon">
														<span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
													</div>
												</div>
											</fieldset>	
											
											<fieldset class="form-group col-md-4">
												<label class="required" for="end_date">End Date</label>
												<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
													<input type="text" class="form-control" name="end_date" value="<?php echo $end_date; ?>" required>
													<div class="input-group-addon">
														<span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
													</div>
												</div>
											</fieldset>	
											
											<fieldset class="form-group col-md-4">
												<label class="required" for="destination">Destination</label>								
												<select class="form-control" name="destination" required>
													<?php
														$selected = ($destination === "SCR") ? " selected" : "";
														echo "<option value=\"SCR\"$selected>Screen</option>";
														$destinations = report::getReportDestinations($display_section = "audit_trail");
														foreach ($destinations as $d) :
															$selected = ($destination === $d->destination_code) ? " selected" : "";
															echo "<option value=\"$d->destination_code\"$selected>$d->destination</option>";
														endforeach;
													?>
												</select> 								
											</fieldset>
											
											<fieldset class="form-group col-md-12">
												<label for="search"></label>
												<button type="submit" name="search" class="btn btn-default btn-round">Search</button>
											</fieldset>								
										</div>
										<!-- /.box-body -->
									</form>
									<!-- ./form -->
								</div>
								<!-- /.box-primary -->
							</div>
							<!-- /.box-header -->

						</div>
						<!-- /.box-body -->
                    </div>
                    <!-- /.box-w3 -->

					<div class="table-responsive">
						<table id="table1" class="table table-bordered w3-striped">
							<thead>
								<tr>
									<th>Date</th>
									<th>Activity</th>
									<th>Details</th>
									<th>Activity By</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if ($_SERVER["REQUEST_METHOD"] === "POST") {
									if (strlen($start_date) > 0) $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $start_date)));
									if (strlen($end_date) > 0) $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $end_date)));									
									
									$activities = audit_trail::all($fields = "*", implode("', '", $action_by), implode("', '", $action), $start_date, $end_date, $detail);
									
									if ($destination === "SCR") {
										// print the results to screen
										foreach ($activities as $act) :	
											$form_elements = array (
												"action_date" => $act->action_date,
												"action" => $act->action,
												"detail" => $act->detail,
												"action_by" => $act->action_by,
												"record_id" => $act->record_id
											);
										   
											// print audit trail details
											echo modal::displayTable($logged_username, $form_elements);
										endforeach;
									} elseif ($destination === "PDF") {
										// print the results to PDF											
										echo "
										<form id=\"download-report\" method=\"post\" action=\"download.php\">
											<input class=\"hidden\" name=\"report_name\" value=\"Audit Trail\">
											<input class=\"hidden\" name=\"destination\" value=\"$destination\">
											<select class=\"hidden\" name=\"action[]\" multiple=\"multiple\">";
												if (count($action) == 0) echo "<option value=\"\" selected></option>";													
												foreach ($action as $a):
													echo "<option value=\"$a\" selected></option>";
												endforeach;
											echo "
											</select>
											<select class=\"hidden\" name=\"action_by[]\" multiple=\"multiple\">";
												if (count($action_by) == 0) echo "<option value=\"\" selected></option>";													
												foreach ($action_by as $ab):
													echo "<option value=\"$ab\" selected></option>";
												endforeach;
											echo "
											</select>
											<input class=\"hidden\" name=\"start_date\" value=\"$start_date\">
											<input class=\"hidden\" name=\"end_date\" value=\"$end_date\">
											<input class=\"hidden\" name=\"detail\" value=\"$detail\">
											<input class=\"hidden\" name=\"printed_by\" value=\"$logged_username\">
											<input class=\"hidden\" name=\"option\" value=\"download\">
										</form>";
										?>
										<script type="text/javascript">
											document.getElementById("download-report").submit();
										</script>
										<?php
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->				
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

<?php require "../includes/footer.php";?>