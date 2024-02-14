<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }
$advisor_id = $_COOKIE['advisor_id'];
$meetings = $table->findSql("SELECT users.first_name, users.last_name, meeting.date, meeting.description, meeting.meeting_id as meeting_id
FROM meeting 
JOIN student ON meeting.student_ID = student.student_id 
JOIN users ON student.user_id = users.id  
WHERE meeting.advisor_id = '$advisor_id' AND meeting.status = 0;
");

$first_name = $_COOKIE['first_name'];
$last_name = $_COOKIE['last_name'];
$full_name = $first_name . " ". $last_name;
$meeting_count = $table->findSql("SELECT count(*) as number FROM meeting where advisor_id = '$advisor_id' AND meeting.status = 0");
$request_count = $meeting_count[0]['number'];
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Life & Services</title>
  <link rel="stylesheet" href="styles.css">
  <style>/* Global styles (similar to the Clubs page) */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
    }
    
    main {
      width: 80%;
      margin: 20px auto;
    }

.meeting-list {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-height: 500px; /* Set a maximum height for the container */
  overflow-y: auto; /* Enable vertical scrollbar if needed */
}
    
    .meeting-list h2 {
      margin-top: 0;
    }
    
    .meeting-request {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }
    
    .meeting-request h3 {
      margin-top: 0;
    }
    
    .action-buttons button {
      padding: 8px 16px;
      margin-right: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    .approve-btn {
      background-color: #28a745;
      color: #fff;
    }
    
    .approve-btn:hover {
      background-color: #218838;
    }
    
    .reject-btn {
      background-color: #dc3545;
      color: #fff;
    }
    
    .reject-btn:hover {
      background-color: #c82333;
    }
    </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Welcome Dr. <?=$full_name?></h1>
      <div class="menu-toggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul class="menu">
          <li><a href="login.php">Log out</a></li>
        </ul>
      </div>
    </div>
  </header>

  <main>
    <div class="meeting-list">
        <h2>Meeting Requests: <span id="request-count"><?php echo $request_count?></span></h2>
        <!-- Display meeting requests here -->
        <?php foreach ($meetings as $meeting): ?>
            <div class="meeting-request">
                <h3>Student: <?php echo htmlspecialchars($meeting['first_name']. " ". $meeting['last_name']); ?></h3>
                <p>Date & Time: <?php echo htmlspecialchars($meeting['date']); ?></p>
                <p>Description: <?php echo htmlspecialchars($meeting['description']); ?></p>
                <div class="action-buttons">
                    <button class="approve-btn" data-meeting-id="<?php echo $meeting['meeting_id']; ?>">Approve</button>
                    <button class="reject-btn" data-meeting-id="<?php echo $meeting['meeting_id']; ?>">Reject</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>


<script>
document.querySelectorAll('.approve-btn, .reject-btn').forEach(button => {
    button.addEventListener('click', function() {
        const meetingId = this.getAttribute('data-meeting-id');
        const action = this.classList.contains('approve-btn') ? 'approve' : 'reject';

        // AJAX request to server to process the action
        fetch('/student_portal/Backend/meeting_action.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'meetingId=' + meetingId + '&action=' + action
        })
        .then(response => response.text())
        .then(result => {
            console.log(result); // Process the server response
            this.closest('.meeting-request').remove();
            var requestCountElement = document.getElementById('request-count');
    var currentCount = parseInt(requestCountElement.textContent);
    if (currentCount > 0) {
        requestCountElement.textContent = currentCount - 1;
    }
        })
        .catch(error => {
            console.error('Error:', error);
           
        });
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
</body>
</html>
