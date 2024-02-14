<?php
require_once('./Backend/db_config.php');


$semesters = $table->findSql("Select * from semesters");
$majors = $table->findSql("Select * from majors");


setcookie('email', '', time() - 3600, "/");
setcookie('user_id', '', time() - 3600, "/");
setcookie('last_name', '', time() - 3600, "/");
setcookie('first_name', '', time() - 3600, "/");
setcookie('major', '', time() - 3600, "/");
setcookie('semester', '', time() - 3600, "/");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAU Login and Signup</title>
    <!-- Custom CSS File -->
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
    <div class="background-image"></div> <!-- Background image container -->
    <div class="container">
        <!-- Checkbox for toggling between login and signup -->
        <input type="checkbox" id="check">

        <!-- Login Form -->
        <div class="wrapper" id="login-form">
    <div class="title"><span>Welcome To LAU</span></div>
    <form action="/student_portal/Backend/login.php" method="post">
        <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Email" required>
        </div>
        <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="row button">
            <input type="submit" value="Login">
        </div>
        <div class="signup-link">Don't have an account? <a href="#" id="show-signup">Signup</a></div>
    </form>
</div>



   <!-- Signup Form -->
   <div class="wrapper" style="display:none;" id="signup-form">
  <div class="title"><span>Signup</span></div>
  <form action="/student_portal/Backend/signup.php" method="POST"> <!-- Ensure you have the correct action and method for your form -->
    <div class="row">
      <i class="fas fa-user"></i>
      <input type="text" name="first_name" placeholder="First Name" required>
    </div>
    <div class="row">
      <i class="fas fa-user"></i>
      <input type="text" name="last_name" placeholder="Last Name" required>
    </div>
    <div class="row">
      <i class="fas fa-envelope"></i>
      <input type="email" name="email" placeholder="Email" required>
    </div>
    <div class="row">
      <i class="fas fa-lock"></i>
      <input type="password" name="password" id="password"  placeholder="Create a password" required>
    </div>
    <div class="row">
      <i class="fas fa-lock"></i>
      <input type="password" name="confirm_password" id="confirm_password"  placeholder="Confirm your password" required>
    </div>

    <div class="row">
      <i class="fas fa-graduation-cap"></i>
      <select name="major_id" required>
        <option value="">Select Major</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($majors as $major) {
          echo "<option value=\"" . htmlspecialchars($major['major_id']) . "\">" . htmlspecialchars($major['major_name']) . "</option>";
        }
        ?>
        <!-- End PHP code -->
      </select>
    </div>

    <div class="row">
      <i class="fas fa-calendar"></i>
      <select name="semester_id" required>
        <option value="">Select Semester</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($semesters as $semester) {
          echo "<option value=\"" . htmlspecialchars($semester['semester_id']) . "\">" . htmlspecialchars($semester['semester_name']) . "</option>";
        }
        ?>
        <!-- End PHP code -->
      </select>
    </div>
    <div class="row button">
      <input type="submit" value="Signup">
    </div>
    <div class="signup-link">Already have an account? <a href="#" id="show-login">Login</a></div>

  </form>
</div>


    </div>
    <script src="login.js"></script>
</body>
</html>



