<?php
	include $asset_path . "models/menu.php";
?>
<aside class="main-sidebar">
	<!-- sidebar -->
	<section class="sidebar">
	<?php
		$logged_username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";

		if (strlen($logged_username) > 0)
			echo menu::printMenu($logged_username, $asset_path);
		else
			include "logout.php";
	?>
	</section>
	<!-- /.sidebar -->
</aside>
