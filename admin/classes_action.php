<?php
session_start();
include '../assets/inc/conn.php';

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $classes = trim($_POST['classes']);

    if (empty($classes)) {
        $_SESSION['error'] = "Classes is required.";
        header('Location: addClasses.php');
        exit(); // Ensure no further code runs
    }

    // Sanitize the input
    $classes = $conn->real_escape_string($classes);

    $query = "INSERT INTO classes (class) VALUES ('$classes')";
    if ($conn->query($query)) {
        $_SESSION['success'] = "Classes added successfully.";
        header('Location: addClasses.php');
    } else {
        $_SESSION['error'] = "Failed to add class: " . $conn->error;
        header('Location: addClasses.php');
    }
    exit();
}

?>
