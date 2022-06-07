<?php 	 
	function add(){			
		$region_name = $_POST["region_name"];
		$captured_by = $_POST["captured_by"];
	
		$region = new region();
		$region->setRegionName($region_name);
		$region->setCapturedBy($captured_by);
		
		$region->add();
	}
	
	function edit(){
		$region_id = $_POST["region_id"];
		$region_name = $_POST["region_name"];
		$last_edited_by = $_POST["last_edited_by"];
	
		$region = new region();
		$region->setRegionID($region_id);
		$region->setRegionName($region_name);
		$region->setLastEditedBy($last_edited_by);
	 
		$region->edit();
	}
	
	function delete(){
		$region_id = $_POST["region_id"];
		$region_name = $_POST["region_name"];
		$deleted_by = $_POST["deleted_by"];
	
		$region = new region();
		$region->setRegionID($region_id);
		$region->setRegionName($region_name);
		$region->setDeletedBy($deleted_by);
	
		$region->delete();
	}
?>