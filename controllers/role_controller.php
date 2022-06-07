<?php
	function add(){
		$role_name = $_POST["role_name"];
	
		$menu_ids = "";		
		$dashboards = "";		
		foreach ($_POST as $key => $value) :
			if (!(strpos($key, "menu_id_") === false)) $menu_ids .= "|$value";
			if (!(strpos($key, "dashboard_") === false)) $dashboards .= "|$value";
		endforeach;
		$captured_by = $_POST["captured_by"];
	
		$role = new role();
		$role->setRoleName($role_name);
		$role->setMenuIDs($menu_ids);
		$role->setDashBoards($dashboards);
		$role->setCapturedBy($captured_by);
		
		$role->add();
	}
	
	function edit(){
		$role_id = $_POST["role_id"];
		$role_name = $_POST["role_name"];
	
		$menu_ids = "";		
		$dashboards = "";		
		foreach ($_POST as $key => $value) :
			if (!(strpos($key, "menu_id_") === false)) $menu_ids .= "|$value";
			if (!(strpos($key, "dashboard_") === false)) $dashboards .= "|$value";
		endforeach;
		$last_edited_by = $_POST["last_edited_by"];
	
		$role = new role();
		$role->setRoleID($role_id);
		$role->setRoleName($role_name);
		$role->setMenuIDs($menu_ids);
		$role->setDashBoards($dashboards);
		$role->setLastEditedBy($last_edited_by);
		
		$role->edit();
	}
	function delete(){
		$role_id = $_POST["role_id"];
		$role_name = $_POST["role_name"];
		$deleted_by = $_POST["deleted_by"];
		
		$role = new role();
		$role->setRoleID($role_id);
		$role->setRoleName($role_name);
		$role->setDeletedBy($deleted_by);
		$role->delete();
	}
?>
