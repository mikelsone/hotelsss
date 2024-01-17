<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch user's reservations
$sql = "SELECT * FROM reservations WHERE user_id = $user_id";
$result = $conn->query($sql);

// Reset internal pointer to the beginning of the result set
mysqli_data_seek($result, 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cancel Reservation - Hotel Booking</title>
    <style>
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select {
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
            margin-top: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
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
        <h2>Cancel Reservation</h2>

        <?php if ($result->num_rows > 0): ?>
            <form action="process_cancel.php" method="post">
                <label for="reservation_id">Select Reservation to Cancel:</label>
                <select name="reservation_id" id="reservation_id" required>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>">
                            <?= $row['customer_name'] ?> - <?= $row['start_date'] ?> to <?= $row['end_date'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <input type="submit" value="Cancel Reservation">
            </form>
        <?php else: ?>
            <p>You have no reservations to cancel.</p>
        <?php endif; ?>
    </main>

    <footer>
        &copy; 2024 Hotel Booking. All rights reserved.
    </footer>
    
</body>
</html>
