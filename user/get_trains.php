<?php
include '../assets/inc/conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['station_id'])) {
    $stationId = $_POST['station_id'];

    $sql = "SELECT 
                train_destination.id AS destination_id,
                stations.station AS from_station_name,
                trains.name AS train_name,
                trains.id AS train_id
            FROM 
                train_destination
            JOIN 
                stations ON train_destination.from_station = stations.id
            JOIN 
                trains ON train_destination.trainName = trains.id
            WHERE 
                train_destination.from_station = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $stationId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<option selected>-- Select Train --</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['train_id'] . '">' . $row['train_name'] . '</option>';
        }
    } else {
        echo '<option>No trains available</option>';
    }

    $stmt->close();
}

$conn->close();
?>
