<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }

  $clubs = $table->findSql("SELECT * from club");
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Life & Services</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Global styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
  color: #333;
}
h2{
  padding-bottom: 1rem;
}
p{
  padding-bottom: 1rem;
}

main {
  width: 80%;
  margin: 20px auto;
}

.club-selection {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.club-selection h2 {
  margin-top: 0;
}

#club-select {
  padding: 8px;
  font-size: 16px;
  width: 100%;
  margin-bottom: 15px;
}

#view-info-btn {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#view-info-btn:hover {
  background-color: #0056b3;
}

.club-info {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: none;
  margin-top: 20px;
}

.club-info h2 {
  margin-top: 0;
}

#club-description {
  margin-bottom: 15px;
}

#join-club-btn,
#continue-browsing-btn {
  padding: 10px 20px;
  margin-right: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#join-club-btn {
  background-color: #28a745;
  color: #fff;
}

#join-club-btn:hover {
  background-color: #218838;
}

#continue-browsing-btn {
  background-color: #dc3545;
  color: #fff;
}

#continue-browsing-btn:hover {
  background-color: #c82333;
}

  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Welcome to LAU Club Services</h1>
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
    <div class="club-selection">
      <h2>Select a Club</h2>

      <select id="club-select">
  <option value="">Select Club</option>
  <!-- PHP code to populate options from database -->
  <?php
  foreach ($clubs as $club) {
    echo "<option value=\"" . htmlspecialchars($club['club_ID']) . "\" 
    data-description=\"" . htmlspecialchars($club['description']) . "\" 
    data-capacity=\"" . htmlspecialchars($club['capacity']) . "\">" . 
    htmlspecialchars($club['club_name']) . "</option>";
  }
  ?>
  <!-- End PHP code -->
</select>

    </div>
    <div class="club-info" style="display: none;">
  <h2>Club Information</h2>
  <p id="club-capacity"></p>
  <p id="club-description"></p> <!-- Remove the PHP code from here -->
 
  <button id="join-club-btn">Join Club</button>
</div>

  </main>


  <script>

    var clubID =0;
    var studentId = getCookie('student_id');
var semesterId = getCookie('semester_id');

  document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('club-select');
    var infoDiv = document.querySelector('.club-info');
    
    var descriptionParagraph = document.getElementById('club-description');
    var capacityParagraph = document.getElementById('club-capacity');
   
    selectElement.addEventListener('change', function() {
      var selectedOption = this.options[this.selectedIndex];
      var description = selectedOption.getAttribute('data-description');
      clubID = selectedOption.getAttribute('value');
      var capacity = selectedOption.getAttribute('data-capacity');
      console.log(clubID);
      // Update the DOM with the new club info
      if (description && capacity) {
        descriptionParagraph.textContent = 'Description: ' + description;
        capacityParagraph.textContent = 'Capacity: ' + capacity;
        infoDiv.style.display = 'block';
      } else {
        infoDiv.style.display = 'none';
      }
    });
  });


  document.getElementById('join-club-btn').addEventListener('click', function() {
    console.log(clubID);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/student_portal/Backend/club_enrollment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            console.log('Response from API:', this.responseText);
            alert(this.responseText)
            // Process the response here
        } else {
            console.error('API call failed');
        }
    };
    xhr.send('club_id=' + encodeURIComponent(clubID) + '&student_id=' + encodeURIComponent(studentId) + '&semester_id=' + encodeURIComponent(semesterId));
});

function getCookie(name) {
    var cookies = document.cookie.split('; ');
    for (var i = 0; i < cookies.length; i++) {
        var parts = cookies[i].split('=');
        if (parts[0] === name) {
            return parts[1];
        }
    }
    return null; // Return null if the cookie is not found
}



</script>

  

  <div class="navbar">
    <a href="#">Contact Us</a>
    <a href="#">FAQ</a>
    <a href="#">Terms of Use</a>
</div>

  <script src="script.js"></script>
  <script src="availability.js"></script>
  <script src="clubs.js" defer></script> 
</body>
</html>
