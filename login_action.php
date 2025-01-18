<?php
session_start();
include 'assets/inc/conn.php';

// if (!$conn) {
//     die("Database connection failed: " . $conn->connect_error);
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
  
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);
    // echo "<pre>";
    // print_r($result->num_rows);
    // echo "</pre>";
    // exit;
    // Check if user exists
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['number'] = $user['contact'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: user/index.php");
            }
        } else {
            $_SESSION['error_message'] = "Invalid email or password.";
            header("Location: login.php"); 
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Invalid email or password.";
        header("Location: login.php");
        exit;
    }
}
?>
