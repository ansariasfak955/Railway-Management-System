<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../assets/inc/conn.php'; 
require '../vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use TCPDF;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Verify OTP
    $stmt = $conn->prepare("SELECT id FROM bookings WHERE email = ? AND otp = ? AND is_verified = 0");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update verification status
        $updateStmt = $conn->prepare("UPDATE bookings SET is_verified = 1 WHERE email = ?");
        $updateStmt->bind_param("s", $email);
        $updateStmt->execute();


        // $userStmt = $conn->prepare("SELECT name, seat, age, date, status FROM bookings WHERE email = ?");
        $userStmt = $conn->prepare("SELECT 
        bookings.*, 
        from_stations.station AS from_station_name, 
        to_stations.station AS to_station_name, 
        trains.name AS train_name
        FROM 
            bookings
        INNER JOIN 
            stations AS from_stations 
            ON bookings.from_station_id = from_stations.id
        INNER JOIN 
            stations AS to_stations 
            ON bookings.to_station_id = to_stations.id
        INNER JOIN 
            trains 
            ON bookings.train_id = trains.id
        WHERE 
            bookings.email = ?
        ORDER BY 
            bookings.created_at DESC
        LIMIT 1");
        $userStmt->bind_param("s", $email);
        $userStmt->execute();
        $userResult = $userStmt->get_result();
        $userDetails = $userResult->fetch_assoc();

        // Generate PDF using TCPDF
        try {
            $pdfPath = __DIR__ . '/assets/tickets/ticket_' . uniqid() . '.pdf';
        
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Company');
            $pdf->SetTitle('Booking Confirmation');
            $pdf->SetSubject('Ticket Confirmation');
            $pdf->SetKeywords('TCPDF, PDF, ticket, confirmation');
        
            // Set margins
            $pdf->SetMargins(15, 15, 15);
        
            // Add a page
            $pdf->AddPage();


            $pdf->Cell(0, 10, 'Your Ticket Confirmation', 0, 1, 'C');

            // Set font for the table
            $pdf->SetFont('helvetica', 'B', 12);

            // Add table header
            $pdf->Cell(38, 10, 'Name', 1, 0, 'C');
            $pdf->Cell(38, 10, 'Seat', 1, 0, 'C');
            $pdf->Cell(38, 10, 'Age', 1, 0, 'C');
            $pdf->Cell(38, 10, 'From Station', 1, 0, 'C');
            $pdf->Cell(38, 10, 'To Station', 1, 0, 'C');
            $pdf->Cell(38, 10, 'Train Name', 1, 0, 'C');
            $pdf->Cell(38, 10, 'Date', 1, 0, 'C');
            $pdf->Cell(38, 10, 'Status', 1, 1, 'C');

            // Add table content
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(38, 10, $userDetails['name'], 1, 0, 'C');
            $pdf->Cell(38, 10, $userDetails['seat'], 1, 0, 'C');
            $pdf->Cell(38, 10, $userDetails['age'], 1, 0, 'C');
            $pdf->Cell(38, 10, $userDetails['from_station_name'], 1, 0, 'C');
            $pdf->Cell(38, 10, $userDetails['to_station_name'], 1, 0, 'C');
            $pdf->Cell(38, 10, $userDetails['train_name'], 1, 0, 'C');
            $pdf->Cell(38, 10, $userDetails['date'], 1, 0, 'C');
            $pdf->Cell(38, 10, $userDetails['status'], 1, 1, 'C');

            $pdf->Ln(10);  

            $pdf->Write(0, "Thank you for booking with us!\n\nYour ticket has been confirmed.", '', 0, 'L', true, 0, false, false, 0);
        
            // Save PDF to file
            $pdf->Output($pdfPath, 'F');
        } catch (Exception $e) {
            die("PDF Generation Error: " . $e->getMessage());
        }
        

        // Send Email with PDF
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ansariasfak955@gmail.com';
            $mail->Password = 'hotj qqbk kxaf dqkq'; // Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('ansariasfak955@gmail.com', 'Testing Info');
            $mail->addAddress($email);

            // Attachments
            $mail->addAttachment($pdfPath);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Booking Confirmation';
            $mail->Body = 'Thank you for your booking. Please find your ticket attached.';

            $mail->send();
            $_SESSION['success'] = "OTP verified. Ticket booking confirmed. PDF sent to email.";
            header("Location: bookTickets.php");
        } catch (Exception $e) {
            die("Mailer Error: " . $mail->ErrorInfo);
        }
    } else {
        // echo "Invalid OTP or already verified.";
        $_SESSION['error'] = "Invalid OTP";
        header("Location: verify_otp.php");
    }

    $stmt->close();
    $conn->close();
}
?>
