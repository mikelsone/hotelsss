<?php
include('db_connection.php');

$errors = array();
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are submitted
    if (empty($_POST["username"])) {
        $errors[] = "Username is required.";
    }

    if (empty($_POST["password"])) {
        $errors[] = "Password is required.";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Check if the username already exists
        $check_sql = "SELECT id FROM users WHERE username = '$username'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $errors[] = "Username already exists. Please choose a different username.";
        } else {
            // Insert user into the database
            $insert_sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

            if ($conn->query($insert_sql) === TRUE) {
                $successMessage = "Registration successful!";
            } else {
                $errors[] = "Error: " . $insert_sql . "<br>" . $conn->error;
            }
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
    <title>Register - Hotel Booking</title>
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
        <h2>Register</h2>
        
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Register">

            <p>Already have an account? <a href="login.php">Login here</a></p>
            
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

        // Display success message if any
        if (!empty($successMessage)) {
            echo '<div class="success-container">' . $successMessage . '</div>';
        }
        ?>
        
    </main>

    

    <footer>
        &copy; 2024 Hotel Booking. All rights reserved.
    </footer>

</body>
</html>
