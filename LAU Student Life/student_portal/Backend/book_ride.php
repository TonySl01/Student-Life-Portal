<?php
require 'db_config.php'; 


$ride_id = $_POST['ride'];
$studentId = $_COOKIE['student_id'];
$semesterId = $_COOKIE['semester_id'];



$checkEnrollmentSql = "SELECT * FROM ride_request WHERE ride_id = ? AND student_ID = ?";
$existingEnrollment = $table->findSql($checkEnrollmentSql, [$ride_id, $studentId]);

if (!empty($existingEnrollment)) {
    echo '<script>alert("You are already registered in this ride.") </script>';
    echo "<script>window.location = '/student_portal/Carpooling.php'</script>";
    exit();
}

$capacitySql = "SELECT student_count FROM ride WHERE ride_id = ?";
$busCapacity = $table->findSql($capacitySql, [$ride_id]);

if (!empty($busCapacity)) {
    $enrollmentSql = "SELECT COUNT(*) as enrollmentCount FROM ride_request WHERE ride_id = ?";
    $enrollmentCount = $table->findSql($enrollmentSql, [$ride_id]);

    if (!empty($enrollmentCount) && $enrollmentCount[0]['enrollmentCount'] >= $busCapacity[0]['student_count']) {
        echo '<script>alert("Ride capacity has been reached.")</script>';
        echo "<script>window.location = '/student_portal/Carpooling.php'</script>";
        exit();
    }
} 
$data = [
    'ride_id' => $ride_id,
    'student_ID' => $studentId

];

if ($table->insert('ride_request', $data)) {
    echo '<script>alert("You have successfully booked a ride") </script>';
      echo "<script>window.location = '/student_portal/'</script>";
    exit();
}



?>