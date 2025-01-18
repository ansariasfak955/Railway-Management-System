<?php
    // echo "worling";
    // exit;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Existing code for booking logic...

    // After successful booking, generate OTP
    $otp = rand(100000, 999999); // Generate a 6-digit OTP

    // Send OTP to user's email
    if (sendOtpEmail($email, $otp)) {
        $_SESSION['otp'] = $otp; // Save OTP in session for later verification
        $_SESSION['success'] = "Ticket booked successfully. OTP has been sent to your email for verification.";
        header('Location: verifyOtp.php'); // Redirect to OTP verification page
    } else {
        $_SESSION['error'] = "Failed to send OTP. Please try again.";
        header('Location: bookTickets.php');
    }
}