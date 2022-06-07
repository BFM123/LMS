<?php
	function add() {
        // common fields
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
        $type = isset($_POST["type"]) ? $_POST["type"] : "";

        $captured_by = $_POST["captured_by"];
        if ($type === "population-type") {
            // population type fields
            $population_type = $_POST["population_type"];

        } else {
            // sub population type fields
            $population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : "";
            $population_type_sub_code = $_POST["population_type_sub_code"];
            $population_type_sub = $_POST["population_type_sub"];
        }

        $population_types = new population_type();

        if ($type === "population-type") {
            // population type fields
            $population_types->setPopulationType($population_type);

        } else {
            // sub population type fields
            $population_types->setPopulationTypeSubCode($population_type_sub_code);
            $population_types->setPopulationTypeSub($population_type_sub);
            $population_types->setPopulationTypeID($population_type_id);

        }

        $population_types->setDescription($description);
        $population_types->setType($type);
		$population_types->setCapturedBy($captured_by);

		$population_types->add();
	}

	function edit() {
        // common fields
        $id = $_POST["id"];
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
        $type = isset($_POST["type"]) ? $_POST["type"] : "";

        $last_edited_by = $_POST["last_edited_by"];
        if ($type === "population-type") {
            // population type fields
            $population_type = $_POST["population_type"];

        } else {
            // sub population type fields
            $population_type_sub_code = $_POST["population_type_sub_code"];
            $population_type_sub = $_POST["population_type_sub"];
            $population_type_id = isset($_POST["population_type_id"]) ? $_POST["population_type_id"] : "";

        }

        $population_types = new population_type();

        if ($type === "population-type") {
            // population type fields
            $population_types->setPopulationTypeID($id);
            $population_types->setPopulationType($population_type);

        } else {
            // sub population type fields
            $population_types->setPopulationTypeID($population_type_id);
            $population_types->setPopulationTypeSubID($id);
            $population_types->setPopulationTypeSubCode($population_type_sub_code);
            $population_types->setPopulationTypeSub($population_type_sub);
        }

        $population_types->setDescription($description);
        $population_types->setType($type);
        $population_types->setLastEditedBy($last_edited_by);

        $population_types->edit();
    }

	function delete() {		
        // common fields
        $id = $_POST["id"];
        $population_type_id = $_POST["population_type_id"];
		$type = isset($_POST["type"]) ? $_POST["type"] : "";
        $deleted_by = $_POST["deleted_by"];
        
        $population_types = new population_type();
		if ($type === "population-type") {
            // population type fields
            $population_type = $_POST["population_type"];
            $population_types->setPopulationType($population_type);
        } else {
            // sub population type fields
            $population_type_sub_code = $_POST["population_type_sub_code"];
            $population_type_sub = $_POST["population_type_sub"];
			
			$population_types->setPopulationTypeSubID($id);
            $population_types->setPopulationTypeSub($population_type_sub);
        }

		$population_types->setPopulationTypeID($population_type_id);
        $population_types->setType($type);
		$population_types->setDeletedBy($deleted_by);

		$population_types->delete();
	}
?>
