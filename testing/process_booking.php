<?php
include 'conn.php';
include 'send_email.php';  // Include the send_email.php file

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $ticketDetails = $_POST['ticket_details'];
    $otp = rand(100000, 999999); // Generate 6-digit OTP

    // Database connection check
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert booking details with OTP
    $stmt = $conn->prepare("INSERT INTO testing_bookings (user_email, ticket_details, otp_code) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sss", $email, $ticketDetails, $otp);
    
    if ($stmt->execute()) {
        echo "Booking data inserted successfully!";
    } else {
        die("Error executing query: " . $stmt->error);
    }

    // Send OTP email using the send_email function
    $result = sendOTPEmail($email, $otp);
    echo $result;
    echo "<a href='verify_otp.php?email=$email'>Verify OTP</a>";
    // header('Location: verify_otp.php');

    $stmt->close();
    $conn->close();
}
?>
