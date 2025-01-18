<?php include 'assets/layout/header.php' ?>
<?php include 'assets/layout/sidebar.php' ?>


<main id="main" class="main">

<?php
    include '../assets/inc/conn.php';

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    // exit;

    // Pagination settings

    $records_per_page = 10; 
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    if ($current_page < 1) $current_page = 1;

    $offset = ($current_page - 1) * $records_per_page; 

    $total_sql = "SELECT COUNT(*) AS total FROM bookings";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];
    $total_pages = ceil($total_records / $records_per_page);

    $sql = "SELECT 
    bookings.*, 
    from_stations.station AS from_station_name, 
    to_stations.station AS to_station_name, 
    trains.name AS train_name
    FROM 
        bookings
    INNER JOIN 
        stations AS from_stations 
        ON bookings.from_station_id = from_stations.id
    INNER JOIN 
        stations AS to_stations 
        ON bookings.to_station_id = to_stations.id
    INNER JOIN 
        trains 
        ON bookings.train_id = trains.id
    WHERE 
        bookings.status = 'confirm'
    LIMIT $records_per_page OFFSET $offset";

    $result = $conn->query($sql);

    // Display table
    echo "<table border='1' class='table table-striped table-hover'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Contact</th>
                    <th>From Station</th>
                    <th>To Station</th>
                    <th>Train Name</th>
                    <th>Seat Number</th>
                    <th>PNR Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";

    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $created_at = date("d/m/Y", strtotime($row["created_at"]));
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["date"] . "</td>
                    <td>" . $row["contact"] . "</td>
                    <td>" . $row["from_station_name"] . "</td>
                    <td>" . $row["to_station_name"] . "</td>
                    <td>" . $row["train_name"] . "</td>
                    <td>" . $row["seat"] . "</td>
                    <td>" . $row["pnr"] . "</td>
                    <td>" . $row["status"] . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No results</td></tr>";
    }

    echo "</tbody></table>";

    echo "<nav class='mt-3'>
    <ul class='pagination d-flex justify-content-end'>";

    if ($current_page > 1) {
    echo "<li class='page-item'>
            <a href='?page=" . ($current_page - 1) . "' class='btn btn-primary me-1'>Previous</a>
        </li>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
    $active_class = ($current_page == $i) ? "btn btn-secondary me-1" : "btn btn-outline-primary me-1";
    echo "<li class='page-item'>
            <a href='?page=$i' class='$active_class'>$i</a>
        </li>";
    }

    if ($current_page < $total_pages) {
    echo "<li class='page-item'>
            <a href='?page=" . ($current_page + 1) . "' class='btn btn-primary me-1'>Next</a>
        </li>";
    }

    echo "</ul></nav>";


    $conn->close();
?>

</main>


<?php include 'assets/layout/footer.php' ?>