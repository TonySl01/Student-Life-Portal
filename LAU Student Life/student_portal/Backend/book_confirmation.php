<?php
require 'db_config.php'; 


$book_id = $_POST['book'];
$studentId = $_COOKIE['student_id'];

echo $date;
$data = [
    'book_id' => $book_id,
    'student_ID' => $studentId,

];

if ($table->insert('book_borrowing', $data)) {
    echo '<script>alert("You have successfully booked the book") </script>';
      echo "<script>window.location = '/student_portal/Library.php'</script>";
    exit();
}

?>