<?php
session_start(); 
include '../assets/inc/conn.php'; 

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../ login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch current user data
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $number = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($email)) {
        $error = "Name and Email are required.";
    } else {
        $password_hash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];

        // Update query
        $update_sql = "UPDATE users SET name = ?, email = ?, contact = ?, address = ?, password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssi", $name, $email, $number, $address, $password_hash, $user_id);

        if ($update_stmt->execute()) {
            $success = "Profile updated successfully.";
            $_SESSION['user_name'] = $name;
        } else {
            $error = "Error updating profile.";
        }
    }
}
?>