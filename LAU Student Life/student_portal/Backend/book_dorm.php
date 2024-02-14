<?php
require 'db_config.php'; 


$dorm_id = $_POST['dorm'];
$studentId = $_COOKIE['student_id'];
$semesterId = $_COOKIE['semester_id'];

echo $dorm;



$checkEnrollmentSql = "SELECT * FROM dorm_rental WHERE dorm_ID = ? AND student_ID = ? AND semester_id = ?";
$existingEnrollment = $table->findSql($checkEnrollmentSql, [$dorm_id, $studentId,$semesterId]);

if (!empty($existingEnrollment)) {
    echo '<script>alert("You are already registered in this dorm.") </script>';
    echo "<script>window.location = '/student_portal/Housing.php'</script>";
    exit();
}

// Check if the club's capacity is exceeded
$capacitySql = "SELECT capacity FROM housing WHERE dorm_id = ?";
$clubCapacity = $table->findSql($capacitySql, [$dorm_id]);

$enrollmentSql = "SELECT COUNT(*) as enrollmentCount FROM dorm_rental WHERE dorm_id = ?";
$enrollmentCount = $table->findSql($enrollmentSql, [$dorm_id]);

if (!empty($enrollmentCount) && $enrollmentCount[0]['enrollmentCount'] >= $clubCapacity[0]['capacity']) {
    echo '<script>alert("Dorm capacity has been reached.") </script>';
    echo "<script>window.location = '/student_portal/Housing.php'</script>";
    exit();
}

$data = [
    'dorm_id' => $dorm_id,
    'student_ID' => $studentId,
    'semester_id' => $semesterId,

];

if ($table->insert('dorm_rental', $data)) {
    echo '<script>alert("You have successfully booked a dorm") </script>';
      echo "<script>window.location = '/student_portal/'</script>";
    exit();
}



?>