<?php
	function add(){
		$menu_item = $_POST["menu_item"];
		$menu_parent = $_POST["menu_parent"];
		$menu_link = $_POST["menu_link"];
		$weight = $_POST["weight"];
		$icon = $_POST["icon"];
		$icon_color = $_POST["icon_color"];
		$captured_by = $_POST["captured_by"];
	
		$menu = new menu();
		$menu->setMenuItem($menu_item);
		$menu->setMenuLink($menu_link);
		$menu->setMenuParent($menu_parent);
		$menu->setWeight($weight);
		$menu->setIcon($icon);
		$menu->setIconColor($icon_color);
		$menu->setCapturedBy($captured_by);
		
		$menu->add();
	}
	
	function edit(){
		$menu_id = $_POST["menu_id"];
		$menu_item = $_POST["menu_item"];
		$menu_link = $_POST["menu_link"];
		$menu_parent = $_POST["menu_parent"];
		$weight = $_POST["weight"];
		$icon = $_POST["icon"];
		$icon_color = $_POST["icon_color"];
		$last_edited_by = $_POST["last_edited_by"];
	
		$menu = new menu();
		$menu->setMenuID($menu_id);
		$menu->setMenuItem($menu_item);
		$menu->setMenuLink($menu_link);
		$menu->setMenuParent($menu_parent);
		$menu->setWeight($weight);
		$menu->setIcon($icon);
		$menu->setIconColor($icon_color);
		$menu->setLastEditedBy($last_edited_by);
		
		$menu->edit();
	}
	function delete(){
		$menu_id = $_POST["menu_id"];
		$menu_item = $_POST["menu_item"];
		$deleted_by = $_POST["deleted_by"];
		
		$menu = new menu();
		$menu->setMenuID($menu_id);
		$menu->setMenuItem($menu_item);
		$menu->setDeletedBy($deleted_by);
		$menu->delete();
	}
?>
