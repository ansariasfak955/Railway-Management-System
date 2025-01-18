<?php include 'assets/layout/header.php' ?>
<?php include 'assets/layout/sidebar.php' ?>


<main id="main" class="main">

<section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Station</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade  show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="station_action.php" method="POST">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Station Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="stationName" type="text" class="form-control" id="stationName">
                      </div>
                    </div>

                    <div class="text-center d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>

                </div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <?php
    include '../assets/inc/conn.php';

    // Pagination settings
    $records_per_page = 5; 
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    if ($current_page < 1) $current_page = 1;

    $offset = ($current_page - 1) * $records_per_page; 

    $total_sql = "SELECT COUNT(*) AS total FROM stations";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];
    $total_pages = ceil($total_records / $records_per_page);

    $sql = "SELECT * FROM stations LIMIT $records_per_page OFFSET $offset";
    $result = $conn->query($sql);

    // Display table
    echo "<table border='1' class='table table-striped table-hover'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Station Name</th>
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
                    <td>" . $row["station"] . "</td>
                    <td>" . $created_at . "</td>
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