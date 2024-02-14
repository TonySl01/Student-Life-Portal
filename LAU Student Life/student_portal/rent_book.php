<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Save booking details to a database or perform necessary actions
    // For example, insert data into a database table for study room bookings

    // Redirect to a confirmation/thank you page
    header("Location: confirmation.php");
    exit();
}
?>
