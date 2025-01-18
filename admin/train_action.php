<?php
session_start();
include '../assets/inc/conn.php';

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $trainName = $conn->real_escape_string(trim($_POST['trainName']));
    $total_seats = $conn->real_escape_string(trim($_POST['total_seats']));

    if (empty($trainName) || empty($total_seats)) {
        $_SESSION['error'] = "All fields is required.";
        header('Location: addTrain.php');
        exit(); 
    }
    // Generate a random 5-digit train number
    $trainNumber = rand(10000, 99999);

    $query = "INSERT INTO trains (name, train_number) VALUES ('$trainName', '$trainNumber')";
    if ($conn->query($query)) {

        $train_id = $conn->insert_id;
        $seat_sql = "INSERT INTO seats (train_id, total_seats, available_seats) VALUES ($train_id, $total_seats, $total_seats)";
        $conn->query($seat_sql);

        $_SESSION['success'] = "Add train successfully: " . $conn->error;
        header('Location: addTrain.php');
    } else {
        $_SESSION['error'] = "failed: " . $conn->error;
        // header('Location: register.php');
    }
}
?>
