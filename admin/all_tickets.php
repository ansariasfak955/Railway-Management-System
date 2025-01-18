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

    // $records_per_page = 10; 
    // $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    // if ($current_page < 1) $current_page = 1;

    // $offset = ($current_page - 1) * $records_per_page; 

    // $total_sql = "SELECT COUNT(*) AS total FROM bookings";
    // $total_result = $conn->query($total_sql);
    // $total_row = $total_result->fetch_assoc();
    // $total_records = $total_row['total'];
    // $total_pages = ceil($total_records / $records_per_page);

    $sql = "SELECT 
        login.*, 
        accounts.* 
    FROM 
        login 
    INNER JOIN 
        accounts 
    ON 
    login.id = accounts.user_id";

    $result = $conn->query($sql);
    echo "<pre>";
    print_r($result->num_rows)
    echo "</pre>";
    exit();
    // Display table
    echo "<table border='1' class='table table-striped table-hover'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Contact</th>
                    <th>Account Number</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Pan Card Number</th>
                    <th>Pin Code</th>
                </tr>
            </thead>
            <tbody>";

    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $created_at = date("d/m/Y", strtotime($row["created_at"]));
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>image</td>
                    <td>" . $row["first_name"] . " " . $row["last_name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["dob"] . "</td>
                    <td>" . $row["number"] . "</td>
                    <td>" . $row["account_number"] . "</td>
                    <td>" . $row["father_name"] . "</td>
                    <td>" . $row["mother_name"] . "</td>
                    <td>" . $row["p_number"] . "</td>
                    <td>" . $row["pin_code"] . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No results</td></tr>";
    }

    echo "</tbody></table>";

    // echo "<nav class='mt-3'>
    // <ul class='pagination d-flex justify-content-end'>";

    // if ($current_page > 1) {
    // echo "<li class='page-item'>
    //         <a href='?page=" . ($current_page - 1) . "' class='btn btn-primary me-1'>Previous</a>
    //     </li>";
    // }

    // for ($i = 1; $i <= $total_pages; $i++) {
    // $active_class = ($current_page == $i) ? "btn btn-secondary me-1" : "btn btn-outline-primary me-1";
    // echo "<li class='page-item'>
    //         <a href='?page=$i' class='$active_class'>$i</a>
    //     </li>";
    // }

    // if ($current_page < $total_pages) {
    // echo "<li class='page-item'>
    //         <a href='?page=" . ($current_page + 1) . "' class='btn btn-primary me-1'>Next</a>
    //     </li>";
    // }

    // echo "</ul></nav>";


    $conn->close();
?>

</main>


<?php include 'assets/layout/footer.php' ?>