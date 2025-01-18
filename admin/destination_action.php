<?php
session_start();
include '../assets/inc/conn.php';

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $from_station = $conn->real_escape_string(trim($_POST['from_station']));
    $to_station = $conn->real_escape_string(trim($_POST['to_station']));
    $trainName = $conn->real_escape_string(trim($_POST['trainName']));
    $destination = $conn->real_escape_string(trim($_POST['destination']));

    $basePricePerKm = 0.5; 
    // $distanceInKm = 1000; 
    $basePrice = $basePricePerKm * $destination;

    $query = "INSERT INTO train_destination (from_station, to_station, trainName, destination, price) 
    VALUES ('$from_station', '$to_station', '$trainName', '$destination', '$basePrice')";
    if ($conn->query($query)) {
        // $_SESSION['user'] = $name;
        $_SESSION['success'] = "Add destination successfully: " . $conn->error;
        header('Location: destination.php');
    } else {
        $_SESSION['error'] = "failed: " . $conn->error;
    }
}
?>
