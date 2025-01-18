<?php
session_start();
include 'assets/inc/conn.php';

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit;

    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $contact = $conn->real_escape_string(trim($_POST['contact']));
    $gender = $conn->real_escape_string(trim($_POST['gender']));
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $role = 'user';
    $address = '';


    $checkQuery = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email already exists!";
        header('Location: register.php');
        exit();
    }

    // Insert user into the database
    $query = "INSERT INTO users (name, email, contact, address, gender, password, role) VALUES ('$name', '$email', '$contact', '$address', '$gender', '$password', '$role')";
    if ($conn->query($query)) {
        $_SESSION['user'] = $name;
        header('Location: login.php');
    } else {
        $_SESSION['error'] = "Registration failed: " . $conn->error;
        header('Location: register.php');
    }
}
?>
