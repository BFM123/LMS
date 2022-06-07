<?php
function add(){
    $organization_id = $_POST["organization_id"];
    $category = $_POST["category"];
    $holiday_date = $_POST["holiday_date"];
    $capturedby = $_POST["captured_by"];

    $holiday= new holiday();
    $holiday->setOrganizationID($organization_id);
    $holiday->setCategory($category);
    $holiday->setHolidaydate($holiday_date);
    $holiday->setCapturedBy($capturedby);

	$holiday->add();
}

function edit(){
    $holiday_id = $_POST["holiday_id"];
    $category = $_POST["category"];
    $holiday_date = $_POST["holiday_date"]; 
    $last_edited_by = $_POST["last_edited_by"];

    $holiday= new holiday();
    $holiday->setHolidayID($holiday_id);
    $holiday->setCategory($category);
    $holiday->setHolidaydate($holiday_date);;
    $holiday->setLastEditedBy($last_edited_by);

    $holiday->edit();
}

function delete(){
    $holiday_id = $_POST["holiday_id"];
    $category = $_POST["category"];
    $deleted_by = $_POST["deleted_by"];

    $holiday = new holiday();
    $holiday->setHolidayID($holiday_id);
    $holiday->setCategory($category);
    $holiday->setDeletedBy($deleted_by);

    $holiday->delete();
}

