<?php
require('db_config.php');
// Make sure data is received
if (isset($_POST['first_name'])) {
    $first_name = $_POST['first_name'];
}
if (isset($_POST['last_name'])) {
    $last_name = $_POST['last_name'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['semester_id'])) {
    $semester_id = $_POST['semester_id'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['major_id'])) {
    $major_id = $_POST['major_id'];
}

// Check if username already exists in database
$fetchemail = $table->findSql("SELECT email FROM users WHERE email = ?", [$email]);
if (!empty($fetchemail)) {

    echo '<script>alert("email already taken.") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new user into database
$insertResult = $table->insert('users', [
    'first_name' => $first_name,
    'last_name' => $last_name,
    'password' => $hashedPassword,
    'email' => $email,

]);


$insertResult = $table->insert('student', [
    'user_id' => $pdo->lastInsertId(),
    'major_id' => $major_id,
    'semester_id' => $semester_id
]);

if ($insertResult) {


    echo '<script>alert("Thank you for registering the IT will activate your account.") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
    exit();
    
        
    }
  
 else {

    
    echo '<script>alert("Error creating user.") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
    exit();
}
