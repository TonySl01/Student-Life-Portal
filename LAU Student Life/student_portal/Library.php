<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }
  $rooms = $table->findSql("SELECT * FROM study_room");

  $unavailableBooksResult = $table->findSql("SELECT book_ID FROM book_borrowing");
  $unavailableBooks = array_column($unavailableBooksResult, 'book_ID');
  
  // Convert the array to a comma-separated string
  $unavailableBooksString = implode(',', $unavailableBooks);
  // Use the string in your SQL query

  if(!empty($unavailableBooksString)){
    $availableBooksQuery = "SELECT * FROM book WHERE book_id NOT IN ($unavailableBooksString)";
  }else{
    $availableBooksQuery = "SELECT * FROM book";
  }
  
  $availableBooks = $table->findSql($availableBooksQuery);
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Life & Services</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Welcome to LAU Library Services</h1>
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
    <section id="study-room-booking">
      <h2>Study Room Booking</h2>
      <form action="./Backend/room_confirmation.php" method="post">
        <label for="room">Select a Study Room:</label>
      
        <select id="room" name="room_id" required>
        <option disabled selected>Select Room</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($rooms as $room) {
          echo "<option value=\"" . htmlspecialchars($room['room_ID']) . "\">Room " . htmlspecialchars($room['room_number']) . "</option>";
        }
        
        ?>
        <!-- End PHP code -->
      </select>

        <label for="date">Select Date & Time:</label>
        <input style="margin-bottom: 30px;"type="datetime-local" id="meeting-time" name="meeting-time">
        
        <input type="submit" value="Book Study Room">
      </form>
    </section>
    
    <section id="library-book-rental">
      <h2>Library Book Rental</h2>
      <form action="./Backend/book_confirmation.php" method="post">
        <label for="book">Select a Book:</label>
        


        <select id="book" name="book" required>
        <option value="" disabled selected>Select Book</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($availableBooks as $book) {
          echo "<option value=\"" . htmlspecialchars($book['book_ID']) . "\">" . htmlspecialchars($book['book_title']) . "</option>";
        }
        
        ?>
        <!-- End PHP code -->
      </select>
        <input type="submit" value="Rent Book">
      </form>
    </section>
    
    <!-- Additional sections and content can be added here -->
    <!-- ... -->
  </main>
    
  

  <div class="navbar">
    <a href="#">Contact Us</a>
    <a href="#">FAQ</a>
    <a href="#">Terms of Use</a>
</div>

  <script src="script.js"></script>
  <script src="availability.js"></script>
</body>
</html>
