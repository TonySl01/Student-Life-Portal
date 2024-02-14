<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }


  $advisors = $table->findSql("SELECT * FROM users JOIN advisor ON users.id = advisor.user_id");

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Life & Services</title>
  <link rel="stylesheet" href="styles.css">
</head>

<style>

  h2{
    padding-top: 1rem;
  }



  #meeting-reason {
    width: 100%; /* Makes the textarea span the full width of its container */
    padding: 10px; /* Adds some padding inside the textarea */
    border: 1px solid #ccc; /* Sets a border with a light grey color */
    border-radius: 5px; /* Rounds the corners of the textarea */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
    font-size: 16px; /* Sets the font size */
    line-height: 1.5; /* Adjusts line spacing */
    margin-bottom: 10px; /* Adds space below the textarea */
    resize: vertical; /* Allows vertical resizing only */
}

/* Style for focus state to improve user experience */
#meeting-reason:focus {
    border-color: #0044cc; /* Changes border color when focused */
    outline: none; /* Removes the default focus outline */
    box-shadow: 0 0 5px rgba(0, 68, 204, 0.5); /* Adds a blue glow effect */
}


</style>
<body>
  <header class="header">
    <div class="container">
      <h1>Welcome to Student Advising</h1>
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
    
    <form id="advising-form" action="/student_portal/Backend/advising.php" method="post">
      <label for="advisor-list"><h2>Choose an Advisor:</h2></label>
      
      <select name="advisor_id" required>
      <option value="">Select Advisor</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($advisors as $advisor) {
          echo "<option value=\"" . htmlspecialchars($advisor['advisor_id']) . "\">" . htmlspecialchars($advisor['first_name']." ".$advisor['last_name']) . "</option>";
        }
        ?>
        <!-- End PHP code -->
      </select>
      <br>
      <label for="meeting-time"><h2> Choose a Meeting Time:</h2></label>
      <input type="datetime-local" id="meeting-time" name="meeting-time">
      <br>
      <h2>Reason for Meeting</h2>
      <textarea id="meeting-reason" rows="4" cols="50" name="meeting-reason" placeholder="Explain the reason for the meeting..."></textarea>
      <input type="submit" value="Request Meeting">
    </form>
  </main>
    
  

  <div class="navbar">
    <a href="#">Contact Us</a>
    <a href="#">FAQ</a>
    <a href="#">Terms of Use</a>
</div>

  <script src="script.js"></script>
  <!-- <script src="availability.js"></script> -->
  <!-- <script src="advising.js"></script> -->
</body>
</html>
