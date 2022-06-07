<?php 
	if(isset($_SESSION["message"])): 
	
	$message_type_icons = array(MESSAGE_ERROR_TYPE => ICON_CROSS, MESSAGE_INFORMATION_TYPE => ICON_INFORMATIOM, MESSAGE_SUCCESS_TYPE => ICON_CHECK_SQUARE);
	$message_type = $_SESSION["message_type"];
?>
    <div class="alert alert-<?php echo $message_type; ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo "<i class='fa fa-" . $message_type_icons[$message_type] . "' style='font-size: 20px'></i>  " . $_SESSION["message"];?>
    </div>
<?php 
	unset($_SESSION["message"]);
	unset($_SESSION["message_type"]);
?>
<?php endif ?>