<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }
  $rides = $table->findSql("SELECT * FROM ride");
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Life & Services</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    main {
      display:flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
    }

    form {
      width: 30%;
    }

    .or-text {
      font-weight: bold;
      font-size: 18px;
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
      <h1>Welcome to Carpooling</h1>
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
          <li><a href="login.php">Log out</a></li>
        </ul>
      </div>
    </div>
  </header>

  <main>
    

    <form id="special-needs-form" action="./Backend/book_ride.php" method="post">
      <h2>Select a ride</h2>

      
      <select name="ride" required>
      <option value="" disabled selected>Select ride</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($rides as $ride) {
          echo "<option value=\"" . htmlspecialchars($ride['ride_ID']) . "\" 
          data-ride-name=\"" . htmlspecialchars($ride['ride_name']) . "\"
          data-ride-type=\"" . htmlspecialchars($ride['ride_type']) . "\" 
          data-ride-source=\"" . htmlspecialchars($ride['src']) . "\"
          data-ride-destination=\"" . htmlspecialchars($ride['dest']) . "\"
          data-ride-departure=\"" . htmlspecialchars($ride['departure']) . "\">
          " . htmlspecialchars($ride['ride_name']) . "</option>";
        }
        ?>
        <!-- End PHP code -->
      </select>
      <br>
      <label for="special-needs-source">Ride Name:</label>
      <p id="ride-name" class="styled-p"></p>
      <label for="special-needs-source">Ride Type:</label>
      <p id="ride-type" class="styled-p"></p>
      
      <label for="special-needs-source">Source:</label>
      <p id="ride-source" class="styled-p"></p>
      
      <label for="special-needs-destination">Destination:</label>
      <p id="ride-destination" class="styled-p"></p></p>
    
      <label for="special-needs-departure">Departure Time:</label>
      <p id="ride-departure" class="styled-p"></p>
        <br>
      <input type="submit" value="Book Ride">
    </form>

   
  </main>
    
  <script>
document.addEventListener('DOMContentLoaded', function() {
    var rideSelect = document.querySelector('select[name="ride"]');
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


  <div class="navbar">
    <a href="#">Contact Us</a>
    <a href="#">FAQ</a>
    <a href="#">Terms of Use</a>
</div>

  <script src="script.js"></script>
  <script src="availability.js"></script>
  <script src="advising.js"></script>
</body>
</html>
