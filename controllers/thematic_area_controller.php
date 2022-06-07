<?php
	function add(){
		$thematic_area_id = "";
		$thematic_area = isset($_POST["thematic_area"]) ? $_POST["thematic_area"] : "";
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		$captured_by = $_POST["captured_by"];

		$thematic_areas = new thematic_area();
		$thematic_areas->setThematicArea($thematic_area);
		$thematic_areas->setDescription($description);
		$thematic_areas->setCapturedBy($captured_by);

		$thematic_areas->add();
	}

	function edit(){
		$thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "";
        $thematic_area = isset($_POST["thematic_area"]) ? $_POST["thematic_area"] : "";
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
		$last_edited_by = $_POST["last_edited_by"];

        $thematic_areas = new thematic_area();
        $thematic_areas->setThematicAreaID($thematic_area_id);
        $thematic_areas->setThematicArea($thematic_area);
        $thematic_areas->setDescription($description);
		$thematic_areas->setLastEditedBy($last_edited_by);

		$thematic_areas->edit();
	}

	function delete() {
		$thematic_area_id = isset($_POST["thematic_area_id"]) ? $_POST["thematic_area_id"] : "";
		$thematic_area = $_POST["thematic_area"];
		$deleted_by = $_POST["deleted_by"];

		$thematic_areas = new thematic_area();
		$thematic_areas->setThematicAreaID($thematic_area_id);
		$thematic_areas->setThematicArea($thematic_area);
		$thematic_areas->setDeletedBy($deleted_by);

		$thematic_areas->delete();
	}
?>
