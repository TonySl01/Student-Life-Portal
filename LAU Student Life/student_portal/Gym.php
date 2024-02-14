<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }

  $gym_sessions = $table->findSql("SELECT * FROM gym_sessions");

  // Fetch booking data
  $bookedSpots = $table->findSql("SELECT session_ID, COUNT(*) as booked_count FROM gym_booking GROUP BY session_ID");
  
  // Convert booked spots data to an associative array for easy access
  $bookedCountBySession = [];
  foreach ($bookedSpots as $booked) {
      $bookedCountBySession[$booked['session_ID']] = $booked['booked_count'];
  }
  
  // Calculate remaining spots for each session
  foreach ($gym_sessions as $key => $session) {
      $bookedCount = $bookedCountBySession[$session['session_ID']] ?? 0;
      $gym_sessions[$key]['remaining_spots'] = $session['capacity'] - $bookedCount;
  }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym Session Bookings</title>
  <link rel="stylesheet" href="styles.css"> <!-- Include your stylesheet -->

  <header class="header">
    <div class="container">
      <h1>Welcome to Gym & Sports Sessions</h1>
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

  <main class="main-gym">
    
    <table class="gym-sessions-table">


    <thead>
        <tr>
          <th>Session Type</th>
          <th>Capacity</th>
          <th>Remaining Spots</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Action</th>
        </tr>
      </thead>

     
      <tbody>
    <!-- Simulated session data -->
    <?php foreach($gym_sessions as $gym): ?>
        <tr data-session-id="<? echo htmlspecialchars($gym['session_ID']); ?>">
            <th      style="padding-top: 10px;"><?php echo htmlspecialchars($gym['session_type']); ?></th>
            <th      style="padding-top: 10px;"><?php echo htmlspecialchars($gym['capacity']); ?></th>
            <th      style="padding-top: 10px;"><?php echo htmlspecialchars($gym['remaining_spots']); ?></th>
            <th      style="padding-top: 10px;"><?php echo htmlspecialchars($gym['start_time']); ?></th>
            <th      style="padding-top: 10px;"><?php echo htmlspecialchars($gym['end_time']); ?></th>
            <th      style="padding-top: 10px;">  <button class="join-session-btn" data-session-id="<?php echo htmlspecialchars($gym['session_ID']); ?>">
                    Join Session
                </button></th>
        </tr>
    <?php endforeach; ?>
</tbody>


    </table>
  </main>
 
  <div class="navbar">
    <a href="#">Contact Us</a>
    <a href="#">FAQ</a>
    <a href="#">Terms of Use</a>
</div>
  <script src="script.js"></script>
  <script src="availability.js"></script>
  <script src="gym.js"></script>
</body>
<script>
document.querySelectorAll('.join-session-btn').forEach(button => {
    button.addEventListener('click', function() {
        const sessionId = this.getAttribute('data-session-id');

        // AJAX POST request to book_session.php
        fetch('./Backend/book_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'session_id=' + encodeURIComponent(sessionId)
        })
        .then(response => response.text())
        .then(result => {
            console.log(result); // Handle the server response
            alert(result); // Or update the UI accordingly
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error booking session.');
        });
    });
});
</script>

</html>
