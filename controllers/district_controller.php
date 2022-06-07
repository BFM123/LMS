<?php 	 
	function add(){			
		$district_name = $_POST["district_name"];
		$district_code = $_POST["district_code"];
		$zone_id = $_POST["zone_id"];
		$region_id = common::getFieldValue("zone", "region_id", "zone_id", $zone_id); //$_POST["region_id"];
		$captured_by = $_POST["captured_by"];
	
		$district = new district();
		$district->setDistrictName($district_name);
		$district->setDistrictCode($district_code);
		$district->setZoneID($zone_id);
		$district->setRegionID($region_id);
		$district->setCapturedBy($captured_by);
		
		$district->add();
	}
	
	function edit(){
		$district_id = $_POST["district_id"];
		$district_name = $_POST["district_name"];
		$district_code = $_POST["district_code"];
		$zone_id = $_POST["zone_id"];
		$region_id = common::getFieldValue("zone", "region_id", "zone_id", $zone_id); //$_POST["region_id"];
		$last_edited_by = $_POST["last_edited_by"];
	
		$district = new district();
		$district->setDistrictID($district_id);
		$district->setDistrictName($district_name);
		$district->setDistrictCode($district_code);
		$district->setZoneID($zone_id);
		$district->setRegionID($region_id);
		$district->setLastEditedBy($last_edited_by);
	 
		$district->edit();
	}
	
	function delete(){
		$district_id = $_POST["district_id"];
		$district_name = $_POST["district_name"];
		$deleted_by = $_POST["deleted_by"];
	
		$district = new district();
		$district->setDistrictID($district_id);
		$district->setDistrictName($district_name);
		$district->setDeletedBy($deleted_by);
	
		$district->delete();
	}
?>