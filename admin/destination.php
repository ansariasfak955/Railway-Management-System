<?php include 'assets/layout/header.php' ?>
<?php include 'assets/layout/sidebar.php' ?>
<?php include '../assets/inc/conn.php'; ?>

<main id="main" class="main">

<section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Station  and Train Destination</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade  show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="destination_action.php" method="POST">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">From Station</label>
                      <div class="col-md-8 col-lg-9">
                      <?php
                            $sql = "SELECT * FROM stations"; 

                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                        ?>
                            <select class="form-select" aria-label="Default select example" name="from_station">
                            <option selected>-- Select Station --</option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['station'] . '</option>';
                            }
                        ?>
                            </select>
                        <?php
                            } else {
                            echo "No stations found";
                            }
                        ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">To Station</label>
                      <div class="col-md-8 col-lg-9">
                      <?php
                            $sql = "SELECT * FROM stations"; 

                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                        ?>
                            <select class="form-select" aria-label="Default select example" name="to_station">
                            <option selected>-- Select Station --</option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['station'] . '</option>';
                            }
                        ?>
                            </select>
                        <?php
                            } else {
                            echo "No stations found";
                            }
                        ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Train Name</label>
                      <div class="col-md-8 col-lg-9">
                      <?php
                            $sql = "SELECT * FROM trains"; 

                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                        ?>
                            <select class="form-select" aria-label="Default select example" name="trainName">
                            <option selected>-- Select Train --</option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                        ?>
                            </select>
                        <?php
                            } else {
                            echo "No stations found";
                            }
                        ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Destination</label>
                      <div class="col-md-8 col-lg-9">
                      <input name="destination" type="text" class="form-control" id="destination">
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

    $total_sql = "SELECT COUNT(*) AS total FROM train_destination";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];
    $total_pages = ceil($total_records / $records_per_page);
    
    $sql = "SELECT 
                train_destination.id AS destination_id, 
                trains.id AS train_id, 
                trains.name AS train_name, 
                trains.train_number AS train_number, 
                stations_from.station AS from_station_name,
                stations_to.station AS to_station_name,
                train_destination.destination AS destination_name,
                train_destination.price AS price,
                train_destination.created_at AS created_at
            FROM 
                train_destination 
            JOIN 
                trains 
            ON 
                train_destination.trainName = trains.id 
            JOIN 
                stations AS stations_from 
            ON 
                train_destination.from_station = stations_from.id
            JOIN 
                stations AS stations_to 
            ON 
                train_destination.to_station = stations_to.id
            LIMIT $records_per_page OFFSET $offset";

    $result = $conn->query($sql);

    // Display table
    echo "<table border='1' class='table table-striped table-hover'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From Station Name</th>
                    <th>To Station Name</th>
                    <th>Train Name</th>
                    <th>Train Number</th>
                    <th>Destination</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $created_at = date("d/m/Y", strtotime($row["created_at"]));
            $price = is_numeric($row["price"]) ? "INR " . number_format($row["price"], 2) : "INR 0.00";
            // var_dump($row["created_at"]);exit;
            echo "<tr>
                    <td>" . $row["destination_id"] . "</td>
                    <td>" . $row["from_station_name"] . "</td>
                    <td>" . $row["to_station_name"] . "</td>
                    <td>" . $row["train_name"] . "</td>
                    <td>" . $row["train_number"] . "</td>
                    <td>" . $row["destination_name"] . "</td>
                    <td>" . $price . "</td>
                    <td>" . $created_at . "</td>
                    <td>
                    <button class='btn btn-warning btn-sm' onclick='editRecord(" . $row["destination_id"] . ")'>Edit</button>
                </td>
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