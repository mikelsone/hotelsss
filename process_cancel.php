<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $reservation_id = $_POST["reservation_id"];

    // Fetch reservation details
    $reservation_sql = "SELECT room_id, start_date, end_date FROM reservations WHERE id = $reservation_id AND user_id = $user_id";
    $reservation_result = $conn->query($reservation_sql);

    if ($reservation_result->num_rows > 0) {
        $reservation_row = $reservation_result->fetch_assoc();

        // Update room availability
        $update_room_sql = "UPDATE rooms SET availability = 1 WHERE id = " . $reservation_row['room_id'];
        $conn->query($update_room_sql);

        // Delete reservation
        $delete_reservation_sql = "DELETE FROM reservations WHERE id = $reservation_id";
        $conn->query($delete_reservation_sql);

        echo "Reservation canceled successfully!";
    } else {
        echo "Invalid reservation or you do not have permission to cancel it.";
    }
} else {
    // Redirect to cancel_reservation.php if accessed without POST
    header("Location: cancel_reservation.php");
    exit();
}
?>
