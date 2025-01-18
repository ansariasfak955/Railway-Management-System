<?php include 'assets/layout/header.php' ?>
<?php include 'assets/layout/sidebar.php' ?>
<?php include '../assets/inc/conn.php'; ?>

<main id="main" class="main">
<?php

$sql = "SELECT * FROM users"; 

$result = $conn->query($sql);

echo "<table border='1' class='table table-striped table-hover'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Date</th>
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
                <td>" . $row["contact"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>" . $row["gender"] . "</td>
                <td>" . $row["role"] . "</td>
               <td>" . $created_at . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No results</td></tr>";
}

echo "</tbody></table>";

$conn->close();



?>

</main>
