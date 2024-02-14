<?php
require_once('./Backend/db_config.php');


if (!isset($_COOKIE['user_id'])) {
    echo "<script>window.location = '/student_portal/login.php'</script>";
  }
$user_id = $_COOKIE['user_id'];
$user_logged_id = $table->findSql("SELECT * from users where id = '$user_id'");



$first_name = $_COOKIE['first_name'];
$last_name = $_COOKIE['last_name'];
$full_name = $first_name . " ". $last_name;
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAU Student Life and Services</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your stylesheet -->

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F0F0F0;
        }

        .navbar {
            background-color: #1e8449;
            overflow: hidden;
            margin-bottom: 20px;
            display: flex;
            justify-content: right; 
        }

        .navbar a {
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 18px 24px; 
            text-decoration: none;
            margin: 5px;
            border-radius: 8px; 
            background-color: #1e8449; 
            transition: background-color 0.3s ease; 
        }

        .navbar a:hover {
            background-color: #13542e; /* Change color on hover */
        }

        .header {
            padding: 20px;
            text-align: center;
            background-color: #1e8449;
            color: white;
        }

        .row {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 40%;
            padding: 20px;
            background-color: #fff;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container {
            padding: 2px 16px;
            text-align: center; 
        }
		
		.features {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 20px;
        }

        .button-row {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .first-row,
        .second-row {
            display: flex;
            max-width: 1200px;
            width: 100%;
        }

        .library-btn,
        .parking-btn,
        .gym-btn,
        .advising-btn,
        .carpooling-btn,
        .housing-btn,
        .club-btn {
            display: inline-block;
            padding: 60px 120px;
            background-color: #1e8449;
            color: white;
            font-family: Arial, sans-serif;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, background-image 0.3s ease;
            background-image: none;
            background-size: cover;
            margin: 20px;
        }
		
		.library-btn:hover {
            background-image: url('./images/Library.jpg');
        }

        .parking-btn:hover {
            background-image: url('./images/Parking.jpg');
        }

        .gym-btn:hover {
            background-image: url('./images/Gym.jpg');
        }

        .advising-btn:hover {
            background-image: url('./images/Advising.jpg');
        }

        .carpooling-btn:hover {
            background-image: url('./images/Carpooling.jpg');
        }

        .housing-btn:hover {
            background-image: url('./images/Housing.jpg');
        }

        .club-btn:hover {
            background-image: url('./images/Club.jpg');
        }
		
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
          <h1>Welcome <?=$full_name?></h1>
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
<div class="header">
    <h1>Welcome to LAU Student Life & Services!</h1>
</div>

<div class="row">
    <div class="card">
        <div class="container">
            <h4><b>About</b></h4>
            <p>The Lebanese American University (LAU) is known for its vibrant student life, fostering a diverse and inclusive community. Student life at LAU is characterized by a range of activities and opportunities that enhance personal growth and academic experience. LAU offers a bustling campus life with numerous clubs, organizations, and extracurricular activities catering to diverse interests. From cultural clubs to academic societies and sports teams, there's something for everyone. LAU prides itself on being a multicultural environment, welcoming students from various backgrounds and beliefs. LAU values community service and engagement, encouraging students to give back and make a positive impact!</p>
        </div>
    </div>
</div>

<section class="features">
    <div class="button-row first row">
		<a href="Library.php" class="library-btn">Library</a> 
		<a href="Parking.php" class="parking-btn">Parking</a>
		<a href="Gym.php" class="gym-btn">Gym</a>
		<a href="Advising.php" class="advising-btn">Advising</a>
	</div>
	
	<div class = "button-row second-row">
		<a href="Carpooling.php" class="carpooling-btn">Carpooling</a>
		<a href="Housing.php" class="housing-btn">Housing</a>
		<a href="Clubs.php" class="club-btn">Clubs</a>
		</div>
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


