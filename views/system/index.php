<?php
	$page_id = 39;

	$asset_path = "../../";
	require "../includes/header.php";
	require_once $asset_path . "models/system.php";
	require_once "modal.php";
	
	// get system details
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
							<!-- No header -->
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
								/* display message after each action */
								include "../includes/message.php";
								$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";

								// print details
								echo modal::displayDetails($logged_username, $access_right);
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


