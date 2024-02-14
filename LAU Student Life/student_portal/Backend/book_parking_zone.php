<?php
require 'db_config.php'; 


$book_id = $_POST['book'];
$studentId = $_COOKIE['student_id'];
$semesterId = $_COOKIE['semester_id'];

echo $date;
$data = [
    'parking_id' => $book_id,
    'student_ID' => $studentId,
    'semester_id' => $semesterId,

];

if ($table->insert('parking_rental', $data)) {
    echo '<script>alert("You have successfully booked a parking zone") </script>';
      echo "<script>window.location = '/student_portal/'</script>";
    exit();
}

?>