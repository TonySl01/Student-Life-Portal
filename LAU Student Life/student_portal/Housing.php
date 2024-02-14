<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }
  $housings = $table->findSql("SELECT * FROM housing");

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Life & Services</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .housing-options {
      display: flex;
      gap: 20px;
    }

    .housing-option-form {
      width: 30%;
    }
    .or-text {
      font-weight: bold;
      font-size: 18px;
      position: relative;
      top: 100px;
    }
    
    .styled-p {
        display: inline-block;
        padding: 8px 12px;
        border: 1px solid #ccc; /* Dropdown-like border */
        border-radius: 4px; /* Rounded corners like many dropdowns */
        background-color: #fff; /* Background color */
        color: #333; /* Text color */
        font-family: Arial, sans-serif; /* Font styling */
        font-size: 16px; /* Similar font size to select */
        min-width: 10rem; /* Minimum width */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Optional: slight shadow for depth */
        position: relative; /* For positioning the pseudo-element */
        margin-bottom: 1rem;
    }
  
  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Welcome to LAU Housing</h1>
      <div class="menu-toggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul class="menu">
          <li><a href="index.php">Back to Main Page</a></li>
          <li><a href="Gym.php">Gym</a></li>
          <li><a href="Library.php">Library</a></li>
          <li><a href="Parking.php">Parking</a></li>
          <li><a href="Advising.php">Advising & Meetings</a></li>
          <li><a href="Carpooling.php">RideSharing</a></li>
          <li><a href="Housing.php">LAU Housing</a></li>
          <li><a href="Clubs.php">LAU Clubs</a></li>
        </ul>
      </div>
    </div>
  </header>


  <main>
    

    <form id="special-needs-form" action="./Backend/book_dorm.php" method="post">
      <h2>Book a Dorm</h2>

      
      <select name="dorm" required>
      <option value="" disabled selected>Select Dorm</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($housings as $housing) {
          echo "<option value=\"" . htmlspecialchars($housing['dorm_ID']) . "\" 
          data-ride-name=\"" . htmlspecialchars($housing['dorm_name']) . "\"
          data-ride-type=\"" . htmlspecialchars($housing['dorm_type']) . "\" 
          data-ride-source=\"" . htmlspecialchars($housing['capacity']) . " person(s)\"
          data-ride-destination=\"" . htmlspecialchars($housing['rent']) . "$ /semester\">". htmlspecialchars($housing['dorm_name']) . "</option>";
        }
        ?>
        <!-- End PHP code -->
      </select>
      <br>
      <label for="special-needs-source">Dorm Name:</label>
      <p id="ride-name" class="styled-p"></p>
      <label for="special-needs-source">Dorm Type:</label>
      <p id="ride-type" class="styled-p"></p>
      
      <label for="special-needs-source">Capacity:</label>
      <p id="ride-source" class="styled-p"></p>
      
      <label for="special-needs-destination">Rent:</label>
      <p id="ride-destination" class="styled-p"></p></p>

        <br>
      <input type="submit" value="Book Dorm">
    </form>

   
  </main>
    
  <script>
document.addEventListener('DOMContentLoaded', function() {
    var rideSelect = document.querySelector('select[name="dorm"]');
    rideSelect.addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        document.getElementById('ride-name').textContent = selectedOption.getAttribute('data-ride-name');
        document.getElementById('ride-type').textContent = selectedOption.getAttribute('data-ride-type');
        document.getElementById('ride-source').textContent = selectedOption.getAttribute('data-ride-source');
        document.getElementById('ride-destination').textContent = selectedOption.getAttribute('data-ride-destination');
        document.getElementById('ride-departure').textContent = selectedOption.getAttribute('data-ride-departure');
    });
});
</script>

    
  

  <<div class="navbar">
    <a href="#">Contact Us</a>
    <a href="#">FAQ</a>
    <a href="#">Terms of Use</a>
</div>

  <script src="script.js"></script>
  <script src="housing.js" defer></script> 
  <script src="availability.js"></script>
</body>
</html>
