<?php
session_start();
include '../assets/inc/conn.php';

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stationName = $conn->real_escape_string(trim($_POST['stationName']));
    
    // Insert user into the database
    $query = "INSERT INTO stations (station) VALUES ('$stationName')";
    if ($conn->query($query)) {
        // $_SESSION['user'] = $name;
        $_SESSION['success'] = "Station add successfully: " . $conn->error;
        header('Location: addStation.php');
    } else {
        $_SESSION['error'] = "Registration failed: " . $conn->error;
        // header('Location: register.php');
    }
}
?>
