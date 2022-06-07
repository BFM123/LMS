<?php 	 
	function add(){			
		$zone_name = $_POST["zone_name"];
		$region_id = $_POST["region_id"];
		$captured_by = $_POST["captured_by"];
	
		$zone = new zone();
		$zone->setZoneName($zone_name);
		$zone->setRegionID($region_id);
		$zone->setCapturedBy($captured_by);
		
		$zone->add();
	}
	
	function edit(){
		$zone_id = $_POST["zone_id"];
		$zone_name = $_POST["zone_name"];
        $region_id = $_POST["region_id"];
        $last_edited_by = $_POST["last_edited_by"];
	
		$zone = new zone();
		$zone->setZoneID($zone_id);
        $zone->setZoneName($zone_name);
        $zone->setRegionID($region_id);
		$zone->setLastEditedBy($last_edited_by);
	 
		$zone->edit();
	}
	
	function delete(){
		$zone_id = $_POST["zone_id"];
		$zone_name = $_POST["zone_name"];
		$deleted_by = $_POST["deleted_by"];
	
		$zone = new zone();
        $zone->setZoneID($zone_id);
        $zone->setZoneName($zone_name);
		$zone->setDeletedBy($deleted_by);
	
		$zone->delete();
	}
?>