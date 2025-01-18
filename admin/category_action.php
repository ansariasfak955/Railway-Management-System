<?php
session_start();
include '../assets/inc/conn.php';

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = trim($_POST['category']);

    if (empty($category)) {
        $_SESSION['error'] = "Category is required.";
        header('Location: addCategory.php');
        exit(); 
    }
    $category = $conn->real_escape_string($category);

    $query = "INSERT INTO categories (category) VALUES ('$category')";
    if ($conn->query($query)) {
        $_SESSION['success'] = "Category added successfully.";
        header('Location: addCategory.php');
    } else {
        $_SESSION['error'] = "Failed to add category: " . $conn->error;
        header('Location: addCategory.php');
    }
    exit();
}

?>
