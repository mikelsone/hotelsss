<!-- available_rooms.php -->
<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Fetch available rooms
$sql = "SELECT * FROM rooms WHERE availability = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your external CSS file -->
    <title>Available Rooms - Hotel Booking</title>
    <style>



/* ... rest of the styles ... */


        .room-card {
            width: 450px;
            margin: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .room-card strong {
            font-size: 1.2em;
            display: block;
            margin-bottom: 10px;
        }

        .room-card p {
            margin-bottom: 10px;
        }

        .room-card form {
            text-align: center;
        }

        /* styles.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

header {
    background-color: #333;
    color: white;
    padding: 20px 0;
    text-align: center;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

nav ul li a:hover {
    background-color: #555;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-grow: 1;
}

form {
    max-width: 400px;
    width: 100%;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border: none;
    border-radius: 4px;
    padding: 12px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

p {
    text-align: center;
}

a.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

a.button:hover {
    background-color: #45a049;
}

footer {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #333;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}

.error-container {
    background-color: #ffdddd;
    color: #f44336;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 16px;
}

.success-container {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 16px;
}

.error-container, .success-container {
    width: 100%;
    max-width: 400px;
    margin: 20px auto;
}



    </style>
</head>
<body>

<header>
        <nav class="left-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="available_rooms.php">Available Rooms</a></li>
                <li><a href="cancel_reservation.php">Cancel Rooms</a></li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>Available Rooms</h2>
        
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="room-card">
            <?php if ($row['picture']): ?>
                <img src="<?= $row['picture'] ?>" alt="<?= $row['name'] ?>" style="max-width: 100%; height: auto;">
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>
            <strong><?= $row['name'] ?></strong>
            <p>Description: <?= $row['description'] ?></p>
            <p>Price: $<?= $row['price'] ?></p>
            <!-- Add a form to allow the user to make a reservation -->
            <form action="make_reservation.php" method="post">
                <input type="hidden" name="room_id" value="<?= $row['id'] ?>">
                <input type="submit" value="Make Reservation">
            </form>
        </div>
    <?php endwhile; ?>
    </main>

    <footer>
        &copy; 2024 Hotel Booking. All rights reserved.
    </footer>

</body>
</html>


