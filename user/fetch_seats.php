<?php
include '../assets/inc/conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['train_id'])) {
    $train_id = $_GET['train_id'];

    $sql = "SELECT total_seats FROM seats WHERE train_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $train_id);
    $stmt->execute();
    $stmt->bind_result($total_seats);
    
    if ($stmt->fetch()) {
        echo json_encode(['total_seats' => $total_seats]);
    } else {
        echo json_encode(['total_seats' => 0]);
    }

    $stmt->close();
}

$conn->close();
?>
