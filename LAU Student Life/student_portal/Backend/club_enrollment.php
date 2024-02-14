<?php

require 'db_config.php'; // Include your db_config file

// Fetch POST data
$clubId = $_POST['club_id'] ?? null;
$studentId = $_POST['student_id'] ?? null;
$semesterId = $_POST['semester_id'] ?? null;


// Check if the student is already registered in the club
$checkEnrollmentSql = "SELECT * FROM club_enrollments WHERE club_ID = ? AND student_ID = ? AND semester_id = ?";
$existingEnrollment = $table->findSql($checkEnrollmentSql, [$clubId, $studentId, $semesterId]);

if (!empty($existingEnrollment)) {
    echo 'You are already registered in this club.';
    exit();
}

// Check if the club's capacity is exceeded
$capacitySql = "SELECT capacity FROM club WHERE club_id = ?";
$clubCapacity = $table->findSql($capacitySql, [$clubId]);

$enrollmentSql = "SELECT COUNT(*) as enrollmentCount FROM club_enrollments WHERE club_ID = ?";
$enrollmentCount = $table->findSql($enrollmentSql, [$clubId]);

if (!empty($enrollmentCount) && $enrollmentCount[0]['enrollmentCount'] >= $clubCapacity[0]['capacity']) {
    echo 'Club capacity has been reached.';
    exit();
}

// Prepare data for insertion
$data = [
    'club_ID' => $clubId,
    'student_ID' => $studentId,
    'semester_id' => $semesterId
];

// Call the insert method
if ($table->insert('club_enrollments', $data)) {
    echo 'You have successfully joined the club!';
} else {
    echo 'There was an error joining the club.';
}
?>
