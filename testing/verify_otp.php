<?php
$email = $_GET['email'] ?? '';
?>

<form action="verify_otp_process.php" method="POST">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" required>
    <button type="submit">Verify OTP</button>
</form>
