<?php

// railway_system

$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'railway_system';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>