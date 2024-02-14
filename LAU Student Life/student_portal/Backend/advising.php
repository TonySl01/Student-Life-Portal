<?php 
require 'db_config.php'; 

$meeting_time = $_POST['meeting-time'];
$advisor_id = $_POST['advisor_id'];
$studentId = $_COOKIE['student_id'];
$description = $_POST['meeting-reason'];


$data = [
    'date' => $meeting_time,
    'student_ID' => $studentId,
    'advisor_ID' => $advisor_id,
    'description' => $description
];

if ($table->checkMeetingConflict($advisor_id, $meeting_time)) {
    echo '<script>alert("There is a scheduling conflict with this meeting time. Choose another time.") </script>';
      echo "<script>window.location = '/student_portal/Advising.php'</script>";
    exit();
}

if ($table->insert('meeting', $data)) {
    echo '<script>alert("You have successfully booked a meeting!") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
  
    exit;
} 
?>