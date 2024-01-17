<?php
session_start();
include('db_connection.php');

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are submitted
    if (empty($_POST["username"])) {
        $errors[] = "Username is required.";
    }

    if (empty($_POST["password"])) {
        $errors[] = "Password is required.";
    }

    // If there are no errors, proceed with login
    if (empty($errors)) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Retrieve user from the database
        $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Login successful
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                header("Location: index.php"); // Redirect to homepage or another page
                exit();
            } else {
                $errors[] = "Invalid password";
            }
        } else {
            $errors[] = "User not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login - Hotel Booking</title>
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
        <h2>Login</h2>
        
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">

            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>

        <?php
        // Display errors if any
        if (!empty($errors)) {
            echo '<div class="error-container"><ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul></div>';
        }
        ?>

    </main>

    <footer>
        &copy; 2024 Hotel Booking. All rights reserved.
    </footer>

</body>
</html>
