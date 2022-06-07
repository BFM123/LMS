<?php
	function add(){
		$disaggregation_id = "";
		$disaggregation = isset($_POST["disaggregation"]) ? $_POST["disaggregation"] : "";
		$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
		$description = isset($_POST["description"]) ? $_POST["description"] : "";
		$captured_by = $_POST["captured_by"];

		$disaggregations = new disaggregation();
		$disaggregations->setDisaggregation($disaggregation);
		$disaggregations->setGender($gender);
		$disaggregations->setDescription($description);
		$disaggregations->setCapturedBy($captured_by);

		$disaggregations->add();
	}

	function edit(){
		$disaggregation_id = isset($_POST["disaggregation_id"]) ? $_POST["disaggregation_id"] : "";
        $disaggregation = isset($_POST["disaggregation"]) ? $_POST["disaggregation"] : "";
		$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
		$last_edited_by = $_POST["last_edited_by"];

        $disaggregations = new disaggregation();
        $disaggregations->setDisaggregationID($disaggregation_id);
        $disaggregations->setDisaggregation($disaggregation);
		$disaggregations->setGender($gender);
        $disaggregations->setDescription($description);
		$disaggregations->setLastEditedBy($last_edited_by);

		$disaggregations->edit();
	}

	function delete() {		
		$disaggregation_id = isset($_POST["disaggregation_id"]) ? $_POST["disaggregation_id"] : "";
        $disaggregation = isset($_POST["disaggregation"]) ? $_POST["disaggregation"] : "";
        $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
		$deleted_by = $_POST["deleted_by"];

		$disaggregations = new disaggregation();
        $disaggregations->setDisaggregationID($disaggregation_id);
        $disaggregations->setDisaggregation($disaggregation);
        $disaggregations->setGender($gender);
		$disaggregations->setDeletedBy($deleted_by);

		$disaggregations->delete();
	}
?>
