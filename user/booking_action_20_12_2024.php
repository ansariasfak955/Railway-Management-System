<?php
session_start();
include '../assets/inc/conn.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    // exit;
    $user_id = $_SESSION['user_id'];

    $name = $conn->real_escape_string(trim($_POST['name']));
    $age = intval($_POST['age']); 
    $email = $conn->real_escape_string(trim($_POST['email']));
    $date = $conn->real_escape_string(trim($_POST['date']));
    $gender = $conn->real_escape_string(trim($_POST['gender']));
    $number = $conn->real_escape_string(trim($_POST['number']));
    $from_station = intval($_POST['from_station']); 
    $to_station = intval($_POST['to_station']); 
    $train_id = intval($_POST['trainName']); 
    $seats_to_book = 1; 
    $classes = $conn->real_escape_string(trim($_POST['classes']));
    $status = "confirm";
    $pnr = rand(1000000000, 9999999999); 

    

    // Validate input
    if (empty($name) || empty($email) || empty($date)) {
        $_SESSION['error'] = "All fields are required.";
        header('Location: bookTickets.php');
        exit();
    }

    if ($from_station === $to_station) {
        $_SESSION['error'] = "From station and To station can't be same.";
        header('Location: bookTickets.php');
        exit();
    }

    // Check seat availability
    $seat_check_sql = "SELECT available_seats FROM seats WHERE train_id = $train_id";
    $result = $conn->query($seat_check_sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $available_seats = $row['available_seats'];

        if ($available_seats >= $seats_to_book) {
            $conn->begin_transaction();

            try {
                $last_seat_sql = "SELECT MAX(seat) AS last_seat FROM bookings WHERE train_id = $train_id";
                $last_seat_result = $conn->query($last_seat_sql);
                if (!$last_seat_result) {
                    throw new Exception("SQL error: " . $conn->error);
                }
                $last_seat_row = $last_seat_result->fetch_assoc();
                $last_seat_id = $last_seat_row['last_seat'] ?? 0;

                // Increment seat ID for each new booking
                $booked_seats = [];
                for ($i = 0; $i < $seats_to_book; $i++) {
                    $booked_seats[] = $last_seat_id + $i + 1; 
                }

                // Decrement the available seats
                $new_seats = $available_seats - $seats_to_book;
                $update_seat_sql = "UPDATE seats SET available_seats = $new_seats WHERE train_id = $train_id";
                if (!$conn->query($update_seat_sql)) {
                    throw new Exception("Failed to update seat availability: " . $conn->error);
                }

                $booking_sql = "INSERT INTO bookings 
                    (user_id, name, age, email, date, gender, contact, from_station_id, to_station_id, train_id, seat, classes, pnr, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($booking_sql);
                foreach ($booked_seats as $seat) {
                    $stmt->bind_param(
                        "isisssiiiissss",
                        $user_id,
                        $name,
                        $age,
                        $email,
                        $date,
                        $gender,
                        $number,
                        $from_station,
                        $to_station,
                        $train_id,
                        $seat,
                        $classes,
                        $pnr,
                        $status
                    );

                    if (!$stmt->execute()) {
                        throw new Exception("Failed to insert booking: " . $stmt->error);
                    }
                }

                $conn->commit();
                $_SESSION['success'] = "Ticket booked successfully.";
                header('Location: bookTickets.php');
            } catch (Exception $e) {
                $conn->rollback();
                error_log($e->getMessage()); 
                $_SESSION['error'] = "An error occurred. Please try again.";
                header('Location: bookTickets.php');
            }

        } else {
            // No available seats, check for waiting list
            $waiting_list_check_sql = "SELECT COUNT(*) AS waiting_count FROM bookings WHERE train_id = $train_id AND status = 'waiting'";
            $waiting_list_result = $conn->query($waiting_list_check_sql);
            $waiting_list_row = $waiting_list_result->fetch_assoc();
            $waiting_count = $waiting_list_row['waiting_count'];

            if ($waiting_count < 5) {
                // 5 people waiting, add to waiting list
                $conn->begin_transaction();

                try {
                    $waiting_sql = "INSERT INTO bookings 
                        (user_id, name, age, email, date, gender, contact, from_station_id, to_station_id, train_id, seat, classes, pnr, status) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $status = "waiting"; // Set status to 'waiting'
                    $stmt = $conn->prepare($waiting_sql);
                    $stmt->bind_param(
                        "isisssiiiissss",
                        $user_id,
                        $name,
                        $age,
                        $email,
                        $date,
                        $gender,
                        $number,
                        $from_station,
                        $to_station,
                        $train_id,
                        $seat, 
                        $classes,
                        $pnr,
                        $status
                    );

                    if (!$stmt->execute()) {
                        throw new Exception("Failed to insert waiting booking: " . $stmt->error);
                    }

                    $conn->commit();
                    $_SESSION['success'] = "Booking added to waiting list.";
                    header('Location: bookTickets.php');
                } catch (Exception $e) {
                    $conn->rollback();
                    error_log($e->getMessage()); 
                    $_SESSION['error'] = "An error occurred. Please try again.";
                    header('Location: bookTickets.php');
                }
            } else {
                $_SESSION['error'] = "Waiting list limit reached for this train.";
                header('Location: bookTickets.php');
            }
        }
    } else {
        $_SESSION['error'] = "Train not found or query failed.";
        header('Location: bookTickets.php');
    }
}
?>
