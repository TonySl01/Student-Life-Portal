<?php
require 'db_config.php'; 


$room_id = $_POST['room_id'];
$date = $_POST['meeting-time'];
$studentId = $_COOKIE['student_id'];
echo "HELLO" . $room_id . "helloo";
echo $date;
$data = [
    'date' => $date,
    'student_ID' => $studentId,
    'room_ID' => $room_id,

];

if ($table->CheckRoomConflict($room_id, $date)) {
    echo '<script>alert("There is a scheduling conflict with this time booking. Choose another time.") </script>';
      echo "<script>window.location = '/student_portal/Library.php'</script>";
    exit();
}

if ($table->insert('study_room_reservation', $data)) {
    echo '<script>alert("You have successfully booked a Room!") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
  
    exit;
} 
?>