<?php
function add(){
    $notice_title = $_POST["notice_title"];
    $notice_content = $_POST["notice_content"];
    $capturedby = $_POST["captured_by"];

    $notice= new notice();
    $notice->setNoticeTitle($notice_title);
    $notice->setNoticeContent($notice_content);
    $notice->setCapturedBy($capturedby);

	$notice->add();
}

function edit(){
    $notice_id = $_POST["notice_id"];
    $notice_title = $_POST["notice_title"];
    $notice_content = $_POST["notice_content"];
    $last_edited_by = $_POST["last_edited_by"];

    $notice= new notice();
    $notice->setNoticeID($notice_id);
    $notice->setNoticeTitle($notice_title);
    $notice->setNoticeContent($notice_content);
    $notice->setLastEditedBy($last_edited_by);

    $notice->edit();
}

function delete(){
    $notice_id = $_POST["notice_id"];
    $notice_title = $_POST["notice_title"];
    $deleted_by = $_POST["deleted_by"];

    $notice = new notice();
    $notice->setNoticeID($notice_id);
    $notice->setNoticeTitle($notice_title);
    $notice->setDeletedBy($deleted_by);

    $notice->delete();
}

