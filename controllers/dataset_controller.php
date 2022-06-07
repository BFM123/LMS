<?php
	function add(){		
		$dataset_id = "";
		$dataset_name = isset($_POST["dataset_name"]) ? $_POST["dataset_name"] : "";
        $description = isset($_POST["description"]) ? $_POST["description"] : "";		
		$indicator_ids = isset($_POST["indicator_ids"]) ? $_POST["indicator_ids"] : "";
        $indicator_ids = "";
        foreach((array)$_POST["indicator_ids"] as $i) {
            $indicator_ids .= "|$i";
        }
        if (strlen($indicator_ids) > 0) $indicator_ids .= "|";
		$captured_by = $_POST["captured_by"];

		$dataset = new dataset();
		$dataset->setDatasetName($dataset_name);
		$dataset->setDescription($description);
		$dataset->setIndicatorIDs($indicator_ids);
		$dataset->setCapturedBy($captured_by);

		$dataset->add();
	}

	function edit(){
		$dataset_id = isset($_POST["dataset_id"]) ? $_POST["dataset_id"] : "";
        $dataset_name = isset($_POST["dataset_name"]) ? $_POST["dataset_name"] : "";
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
        $indicator_ids = "";
        foreach((array)$_POST["indicator_ids"] as $i) {
            $indicator_ids .= "|$i";
        }
        if (strlen($indicator_ids) > 0) $indicator_ids .= "|";		$last_edited_by = $_POST["last_edited_by"];

        $dataset = new dataset();
        $dataset->setDatasetID($dataset_id);
        $dataset->setDatasetName($dataset_name);
		$dataset->setDescription($description);		
        $dataset->setIndicatorIDs($indicator_ids);
		$dataset->setLastEditedBy($last_edited_by);

		$dataset->edit();
	}

	function delete() {
		$dataset_id = isset($_POST["dataset_id"]) ? $_POST["dataset_id"] : "";
        $dataset_name = isset($_POST["dataset_name"]) ? $_POST["dataset_name"] : "";
		$deleted_by = $_POST["deleted_by"];

		$dataset = new dataset();
		$dataset->setDatasetID($dataset_id);
        $dataset->setDatasetName($dataset_name);
		$dataset->setDeletedBy($deleted_by);

		$dataset->delete();
	}
?>
