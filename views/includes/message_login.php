<?php 
	if(isset($_SESSION["message_login"])): 
	
	$message_login_type_icons = array(MESSAGE_ERROR_TYPE => ICON_CROSS, MESSAGE_INFORMATION_TYPE => ICON_INFORMATIOM, MESSAGE_SUCCESS_TYPE => ICON_CHECK_SQUARE);
	$message_login_type = $_SESSION["message_login_type"];
?>
    <div class="alert alert-<?php echo $message_login_type; ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo "<i class='fa fa-" . $message_login_type_icons[$message_login_type] . "' style='font-size: 20px'></i>  " . $_SESSION["message_login"]; ?>
    </div>
<?php 
	if ($_SESSION["message_login"] === "valid") 
		header("Location: views/dashboard");

	unset($_SESSION["message_login"]);
	unset($_SESSION["message_login_type"]);
	
?>
<?php endif ?>