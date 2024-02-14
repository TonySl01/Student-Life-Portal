<?php
require 'db_config.php'; 


$session_id = $_POST['session_id'];
$studentId = $_COOKIE['student_id'];


$checkEnrollmentSql = "SELECT * FROM gym_booking WHERE session_id = ? AND student_ID = ?";
$existingEnrollment = $table->findSql($checkEnrollmentSql, [$session_id, $studentId]);

if (!empty($existingEnrollment)) {
    echo 'You are already registered in this session.';
    exit();
}


$capacitySql = "SELECT capacity FROM gym_sessions WHERE session_id = ?";
$clubCapacity = $table->findSql($capacitySql, [$session_id]);

$enrollmentSql = "SELECT COUNT(*) as enrollmentCount FROM gym_booking WHERE session_id = ?";
$enrollmentCount = $table->findSql($enrollmentSql, [$session_id]);

if (!empty($enrollmentCount) && $enrollmentCount[0]['enrollmentCount'] >= $clubCapacity[0]['capacity']) {
    echo 'Gym Session capacity has been reached.';
    exit();
}

$data = [
    'session_ID' => $session_id,
    'student_ID' => $studentId,
];

if ($table->insert('gym_booking', $data)) {
    echo 'Gym session booked successfully!';
    exit();
}

?>