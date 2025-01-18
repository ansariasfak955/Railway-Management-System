<?php
session_start();
include '../assets/inc/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_ticket'])) {
    // Cancel the booking
    $cancel_booking_id = $_POST['cancel_booking_id'];
    $user_id = $_SESSION['user_id'];
    
    // Fetch the canceled booking details
    $cancel_sql = "SELECT seat FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($cancel_sql);
    $stmt->bind_param("i", $cancel_booking_id);
    $stmt->execute();
    $cancel_result = $stmt->get_result();
    $cancel_booking = $cancel_result->fetch_assoc();
    $canceled_seat = $cancel_booking['seat'];  
    $stmt->close();

    // Update the canceled ticket status
    $update_cancel_sql = "UPDATE bookings SET status = 'cancel' WHERE id = ?";
    $stmt = $conn->prepare($update_cancel_sql);
    $stmt->bind_param("i", $cancel_booking_id);
    $stmt->execute();
    $stmt->close();

    // Find the first waiting ticket and assign it the canceled seat
    $waiting_sql = "SELECT id, seat FROM bookings WHERE status = 'waiting' AND user_id = ? LIMIT 1";
    $stmt = $conn->prepare($waiting_sql);
    $stmt->bind_param("i", $user_id); 
    $stmt->execute();
    $waiting_result = $stmt->get_result();
    
    if ($waiting_result->num_rows > 0) {
        $waiting_row = $waiting_result->fetch_assoc();
        $waiting_booking_id = $waiting_row['id'];
        
        // Update the waiting ticket's seat and status
        $update_waiting_sql = "UPDATE bookings SET status = 'confirm', seat = ? WHERE id = ?";
        $stmt = $conn->prepare($update_waiting_sql);
        $stmt->bind_param("si", $canceled_seat, $waiting_booking_id);
        $stmt->execute();
    }

    $stmt->close();
    header('Location: confirm_action.php');
    exit();
}
?>
