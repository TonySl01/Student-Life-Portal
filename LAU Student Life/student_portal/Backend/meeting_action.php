<?php
require 'db_config.php'; 


$meeting_id = $_POST['meetingId'];
$action = $_POST['action'];

echo $action;
echo $meeting_id;


if ($action == "reject"){
    $delete_request = $table->findSql("Delete from meeting where meeting_id = '$meeting_id'");
}else{
    $approved_meeting = $table->findSql("UPDATE meeting SET status = 1 WHERE meeting_id = '$meeting_id'");
}
?>