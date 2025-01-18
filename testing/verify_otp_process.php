<?php

include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Database connection
    // $conn = new mysqli('localhost', 'username', 'root', 'database_name');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Verify OTP
    $stmt = $conn->prepare("SELECT id FROM testing_bookings WHERE user_email = ? AND otp_code = ? AND is_verified = 0");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update verification status
        $updateStmt = $conn->prepare("UPDATE testing_bookings SET is_verified = 1 WHERE user_email = ?");
        $updateStmt->bind_param("s", $email);
        $updateStmt->execute();

        echo "OTP verified. Ticket booking confirmed.";
    } else {
        echo "Invalid OTP or already verified.";
    }

    $stmt->close();
    $conn->close();
}
?>
