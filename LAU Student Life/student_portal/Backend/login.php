<?php
require_once('db_config.php');
$password = $_POST['password'];
$email = $_POST['email'];
// Validate the request data
if (empty($email) || empty($password)) {
    echo '<script>alert("Invalid email or password.") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
    exit();
}



$user = $table->findSql("SELECT * from users where email = '$email' and activated=1");


if (empty($user)) {

    echo '<script>alert("Invalid email or password.") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
    exit();
}
$id = $user[0]['id'];


if (password_verify($password, $user[0]['password'])) {
    setcookie('email', $email, time() + (86400 * 30), "/");
    setcookie('first_name', $user[0]['first_name'], time() + (86400 * 30), "/");
    setcookie('last_name', $user[0]['last_name'], time() + (86400 * 30), "/");
    setcookie('user_id', $user[0]['id'], time() + (86400 * 30), "/");

    if ($user[0]['role'] == 0) {


        $student = $table->findSql("SELECT * from student where user_id = '$id'");
        $major_id = $student[0]['major_id'];
        $major = $table->findSql("SELECT * from majors where major_id = '$major_id'");
        $semester_id = $student[0]['semester_id'];
        $semester = $table->findSql("SELECT * from semesters where semester_id = '$semester_id'");
        setcookie('major', $major[0]['major_name'], time() + (86400 * 30), "/");
        setcookie('semester', $semester[0]['semester_name'], time() + (86400 * 30), "/");
        setcookie('student_id', $student[0]['student_id'], time() + (86400 * 30), "/");
        setcookie('semester_id', $student[0]['semester_id'], time() + (86400 * 30), "/");
        setcookie('major_id', $student[0]['major_id'], time() + (86400 * 30), "/");
        echo "<script>window.location = '/student_portal/'</script>";
        exit();
    } else if ($user[0]['role'] == 1) {
        $advisor = $table->findSql("Select * from advisor where user_id = '$id'");
        setcookie('advisor_id', $advisor[0]['advisor_id'], time() + (86400 * 30), "/");
        echo "<script>window.location = '/student_portal/Advisor_meetings.php'</script>";
        exit();
    }
} else {

    echo '<script>alert("Invalid email or password.") </script>';
    echo "<script>window.location = '/student_portal/'</script>";
    exit();
}
