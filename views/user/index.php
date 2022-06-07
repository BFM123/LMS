<?php
	$page_id = 28;
	$asset_path = "../../";
	require "../includes/header.php";
	require $asset_path . "models/role.php";
	require_once $asset_path . "models/user.php";
	require_once $asset_path . "models/organization.php";
	require_once $asset_path . "models/district.php";
	require_once "modal.php";
	
	// include additional models not required, but included so that views/includes/footer.php does not produce errors
	require_once $asset_path . "models/staff.php"; 
	require_once $asset_path . "models/currency.php"; 
	require_once $asset_path . "models/country.php"; 
	require_once $asset_path . "models/donor.php"; 
	require_once $asset_path . "models/bank.php"; 
	
	// get user details
	$page_title = common::getPageDetails($page_id, "title");
	$breadcrumb = common::getPageDetails($page_id, "breadcrumb");	
	$color = common::getPageDetails($page_id, "parent_color");
	$page_title_suffix = "";
	
	$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";
	$logged_role_id = common::getFieldValue("user", "role_id", "username", $logged_username);
	$logged_organization_id = common::getFieldValue("user", "organization_id", "username", $logged_username);

	if (strlen($logged_organization_id) == 0) $logged_organization_id = 0;
	
	$can_add = false;
	
	$logged_is_ngo_user = false; //user::isNGOUser($logged_username);
	
	if ($logged_is_ngo_user) {
		// this user is an NGO user...		
		$total_ngo_users = common::getFieldValue("user", "COUNT(user_id)", "organization_id", $logged_organization_id);
		$users_per_ngo = common::getFieldValue("system", "users_per_ngo");
		$page_title_suffix = " (" . number_format($total_ngo_users, 0) . " of " . number_format($users_per_ngo, 0) . ")";

		// only allow them to add users if they have already created their organization and have not exhausted their user quota		
		if ($logged_organization_id != 0 && $total_ngo_users < $users_per_ngo) $can_add = true;
	} else {
		// this user is not an NGO user (an administrator)...allow them to add users at all times
		$logged_organization_id = "";
		$can_add = true;
	}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><span class="module-title" style="color: <?php echo $color; ?>"><?php echo $page_title . $page_title_suffix; ?></span></h1>
            <ol class="breadcrumb"><?php echo $breadcrumb; ?></ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box w3-card-4">
                        <div class="box-header">
							<?php if ($access_right === "RW" && $can_add) { ?>
	                            <button type="button" class="btn btn-default btn-round dark-blue w3-right" data-toggle="modal" data-target="#add">Add User</button>
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
									<th>Username</th>
									<th>Full Name</th>
									<th>Position</th>
									<th>District</th>
									<th>Role</th>								
									<?php if ($access_right === "RW") { ?>
										<th class="text-center" style="width: 10px;">Action</th>
									<?php } ?>
									</tr>
									</thead>
									<tbody>
									<?php										
										$users = user::all($user_id = "", $limit = "", $logged_organization_id);
		
										$i = 1;
										foreach ($users as $u) :
											$form_elements = array (
												"user_id" => $u->user_id,
												"username" => $u->username,
												"firstname" => $u->firstname,
												"lastname" => $u->lastname,
												"position" => $u->position,
												"email" => $u->email,
												"is_ngo_user" => $u->is_ngo_user,
												"organization_id" => $u->organization_id,
												"district_id" => $u->district_id,
												"role_id" => $u->role_id,																								
												"change_password" => $u->change_password,
												"account_disabled" => $u->account_disabled,
												"account_locked" => $u->account_locked,			
												"log_attempts" => $u->log_attempts,			
												"photo" => $u->photo
											);
		
											// print modals
										 	echo modal::displayTable($i, $logged_username, $access_right, $logged_is_ngo_user, $logged_organization_id, $logged_role_id, 
																	 $form_elements);		
											$i++;
										endforeach;
									?>
									</tbody>
								</table>
							</div>
								<?php
								if ($access_right === "RW" && $can_add) {
									// display User Modal
                                    echo modal::displayModal("add", $logged_username, $logged_is_ngo_user, $logged_organization_id, $logged_role_id);
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

<?php require "../includes/footer.php";?>
