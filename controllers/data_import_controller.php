<?php
function import() {
	$data_import_id = (isset($_POST["data_import_id"])) ? $_POST["data_import_id"] : "";
    $data_source = (isset($_POST["data_source"])) ? $_POST["data_source"] : "";
	$file_has_header = (isset($_POST["file_has_header"])) ? $_POST["file_has_header"] : "";
	$filename = (isset($_FILES["filename"])) ? $_FILES["filename"] : "";
    $captured_by = (isset($_POST["captured_by"])) ? $_POST["captured_by"] : "";
	
    $data_import = new data_import();
    $data_import->setDataImportID($data_import_id);
    $data_import->setDataSource($data_source);
    $data_import->setFileHasHeader($file_has_header);
    $data_import->setFilename($filename);
    $data_import->setCapturedBy($captured_by);
    $data_import->import();
}