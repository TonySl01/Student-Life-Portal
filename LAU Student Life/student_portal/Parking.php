<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }
  $semester_id = $_COOKIE['semester_id'];
  $unavailableBooksResult = $table->findSql("SELECT parking_ID FROM parking_rental where semester_id='$semester_id'");

  
  $unavailableBooks = array_column($unavailableBooksResult, 'parking_ID');
  // Convert the array to a comma-separated string
  $unavailableBooksString = implode(',', $unavailableBooks);
  // Use the string in your SQL query
  if(!empty($unavailableBooksString)){
    $availableBooksQuery = "SELECT * FROM parking WHERE parking_ID NOT IN ($unavailableBooksString)";
  }else{
    $availableBooksQuery = "SELECT * FROM parking";
  }
  
  $availableBooks = $table->findSql($availableBooksQuery);
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css"> <!-- Include your stylesheet -->

  <title>Parking Services</title>
  <style>
   

	

	.container {
	  width: 90%;
	  margin: 0 auto;
	  text-align: center;
	}

	header h1 {
	  margin: 0;
	  padding: 20px 0;
	  font-size: 28px;
	}
	
	
	
	form {
	  max-width: 400px;
	  margin: 0 auto;
	  padding: 20px;
	  background-color: #f9f9f9;
	  border-radius: 8px;
	  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	form label {
	  display: block;
	  margin-bottom: 8px;
	}

	form select,
	form input[type="date"],
	form input[type="text"] {
	  width: 75%;
	  padding: 10px;
	  margin-bottom: 15px;
	  border-radius: 5px;
	  border: 1px solid #ccc;
	}

	input[type="submit"] {
	  background-color: #1e8449;
	  color: #fff;
	  padding: 10px 20px;
	  border: none;
	  border-radius: 5px;
	  cursor: pointer;
	  font-size: 16px;
	}

	input[type="submit"]:hover {
	  background-color: #155c38;
	}
	
	section {
	text-align: center;
	}

	section h2 {
	margin-bottom: 20px;
	}
  </style>
</head>
<body>
	<header class="header">
		<div class="container">
		  <h1>Welcome to LAU Parking Services</h1>
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
    <section id="parking-spot-booking">
      
      <form action="./Backend/book_parking_zone.php" method="post">
        <label for="zone">Select a Parking Zone:</label>
        <select id="book" name="book" required>
        <option value="" disabled selected>Select Zone</option>
        <!-- PHP code to populate options from database -->
        <?php
        // Assume $semesters is an array of semester names fetched from the database
        foreach ($availableBooks as $book) {
          echo "<option value=\"" . htmlspecialchars($book['parking_ID']) . "\">Zone " . htmlspecialchars($book['parking_zone']) . "</option>";
        }
        
        ?>
        <!-- End PHP code -->
      </select>


        <input type="submit" value="Book Parking Spot">
      </form>
    </section>
  </main>

  <div class="navbar">
    <a href="#">Contact Us</a>
    <a href="#">FAQ</a>
    <a href="#">Terms of Use</a>
</div>


<script src="script.js"></script>

</body>
</html>
