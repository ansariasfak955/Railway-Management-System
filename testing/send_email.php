<?php
// send_email.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Make sure you include the PHPMailer autoload file

function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'ansariasfak955@gmail.com';  // SMTP username
        $mail->Password = 'hotj qqbk kxaf dqkq';  // Replace with your generated App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // SMTP port

        //Recipients
        $mail->setFrom('ansariasfak955@gmail.com', 'testinginfo');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Ticket Booking OTP';
        $mail->Body    = "Your OTP for ticket booking is: <b>$otp</b>";

        // Send email
        $mail->send();
        return "OTP sent to your email.";
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
