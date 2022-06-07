<?php
	function add(){
		$data_format_id = "";
		$data_format = isset($_POST["data_format"]) ? $_POST["data_format"] : "";
		$factor = isset($_POST["factor"]) ? $_POST["factor"] : "";
		$captured_by = $_POST["captured_by"];

		$data_formats = new data_format();
		$data_formats->setDataFormat($data_format);
		$data_formats->setFactor($factor);
		$data_formats->setCapturedBy($captured_by);

		$data_formats->add();
	}

	function edit(){
		$data_format_id = isset($_POST["data_format_id"]) ? $_POST["data_format_id"] : "";
        $data_format = isset($_POST["data_format"]) ? $_POST["data_format"] : "";
        $factor = isset($_POST["factor"]) ? $_POST["factor"] : "";
		$last_edited_by = $_POST["last_edited_by"];

        $data_formats = new data_format();
        $data_formats->setDataFormatID($data_format_id);
        $data_formats->setDataFormat($data_format);
        $data_formats->setFactor($factor);
		$data_formats->setLastEditedBy($last_edited_by);

		$data_formats->edit();
	}

	function delete() {
		$data_format_id = isset($_POST["data_format_id"]) ? $_POST["data_format_id"] : "";
        $data_format = isset($_POST["data_format"]) ? $_POST["data_format"] : "";
		$deleted_by = $_POST["deleted_by"];

		$data_formats = new data_format();
		$data_formats->setDataFormatID($data_format_id);
        $data_formats->setDataFormat($data_format);
		$data_formats->setDeletedBy($deleted_by);

		$data_formats->delete();
	}
?>
