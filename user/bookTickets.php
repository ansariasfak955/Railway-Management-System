<?php include 'assets/layout/header.php' ?>
<?php include 'assets/layout/sidebar.php' ?>
<?php include '../assets/inc/conn.php'; ?>

<main id="main" class="main">

<section class="section profile">
      <div class="row">

      <div class="col-xl-12">
        <div class="card">
            <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Train Booking</button>
                </li>
            </ul>
            <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                <!-- Profile Edit Form -->
                <?php
                    session_start();
                    if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="successAlert">
                            <strong>' . $_SESSION['success'] . '</strong>
                            </div>';
                    unset($_SESSION['success']);
                    }

                    if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorAlert">
                            <strong>' . $_SESSION['error'] . '</strong>
                            </div>';
                    unset($_SESSION['error']);
                    }
                ?>
                <form action="booking_action.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="col-form-label">Passenger Name</label>
                            <input name="name" type="text" class="form-control" id="name" require>
                        </div>
                        <div class="col-md-6">
                            <label for="age" class="col-form-label">Age</label>
                            <input name="age" type="text" class="form-control" id="age" require>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gender" class="col-form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" require>
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="col-form-label">Date</label>
                            <input name="date" type="date" class="form-control" id="date" require>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gender" class="col-form-label">Gender</label>
                            <select name="gender" class="form-select" aria-label="Default select example" id="gender">
                            <option selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="col-form-label">Contact</label>
                            <input name="number" type="number" class="form-control" id="number">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                        <label for="from_station" class="col-form-label">From Station</label>
                        <select class="form-select" aria-label="Default select example" name="from_station" id="from_station">
                            <option selected>-- Select Station --</option>
                            <?php
                            $sql = "SELECT * FROM stations"; 
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['station'] . '</option>';
                                }
                            } else {
                                echo "No stations found";
                            }
                            ?>
                        </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="col-form-label">To Station </label>
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
                        <div class="col-md-6">
                        <label for="trainName" class="col-form-label">Train Name</label>
                        <select class="form-select" aria-label="Default select example" name="trainName" id="trainName" class="train-name" onchange="getAvailableSeats()">
                            <option selected>-- Select Train --</option>
                        </select>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="seats" class="col-form-label">Available Seats</label>
                            <div id="seatCheckboxes">
                                
                            </div> -->
                            <label for="date" class="col-form-label">Class </label>
                            <?php
                            $sql = "SELECT * FROM classes"; 

                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                            ?>
                                <select class="form-select" aria-label="Default select example" name="classes">
                                <option selected>-- Select class --</option>
                            <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['class'] . '</option>';
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

                     <div class="row mb-3" style="display:none;">
                        <div class="col-md-6">
                            <label for="seats" class="col-form-label">Available Seats</label>
                            <input name="availableSeats" type="text" class="form-control" id="availableSeats">
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

</main>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#successAlert').fadeOut('slow');
        }, 3000); 
    });
    $(document).ready(function() {
        setTimeout(function() {
            $('#errorAlert').fadeOut('slow');
        }, 3000); 
    });
</script>

<script>
    $(document).ready(function() {
        $('#from_station').change(function() {
            const stationId = $(this).val();
            console.log('station id :', stationId);
            if (stationId) {
                $.ajax({
                    url: 'get_trains.php', 
                    type: 'POST',
                    data: { station_id: stationId },
                    success: function(response) {
                        $('#trainName').html(response);
                    }
                });
            } else {
                $('#trainName').html('<option selected>-- Select Train --</option>');
            }
        });
    });
</script>

 <script>
function getAvailableSeats() {
    var trainId = document.getElementById("trainName").value;
    // console.log('Train id : ', trainId);
    if (trainId != "") {
        $.ajax({
            url: 'fetch_seats.php',  
            type: 'GET',
            data: { train_id: trainId },
            success: function(response) {
                var data = JSON.parse(response);
                console.log("Total Seats: " + data.total_seats);
                document.getElementById("availableSeats").value = data.total_seats;
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    }
}


</script>

<script>
const dateInput = document.getElementById('date');
    const today = new Date();
    const currentDate = today.toISOString().split('T')[0]; 

    dateInput.value = currentDate;

    dateInput.setAttribute('min', currentDate);

    dateInput.focus();

    dateInput.addEventListener('click', () => {
        dateInput.showPicker();
    });
</script>


<!-- <script>
   $(document).ready(function () {
    $('#trainName').change(function () {
        var trainId = $(this).val();

        if (trainId !== "") {
            $.ajax({
                url: "fetch_seats.php",
                type: "POST",
                data: { train_id: trainId },
                success: function (response) {
                    var data = JSON.parse(response);
                    var availableSeats = data.totalSeats;
                    var bookedSeats = data.bookedSeats;

                    var seatCheckboxes = "<div class='row'>";
                    for (var i = 1; i <= availableSeats; i++) {
                        var isBooked = bookedSeats.includes(i.toString());
                        seatCheckboxes += 
                            "<div class='col-3'>" + 
                            "<div class='form-check'>" +
                            "<input class='form-check-input' type='checkbox' name='seats[]' value='" + i + "' id='seat" + i + "'" +
                            (isBooked ? " disabled" : "") + ">" + // Disable if booked
                            "<label class='form-check-label' for='seat" + i + "'>" + i + "</label>" +
                            "</div>" +
                            "</div>";

                        if (i % 4 === 0) {
                            seatCheckboxes += "</div><div class='row'>";
                        }
                    }
                    seatCheckboxes += "</div>";
                    $('#seatCheckboxes').html(seatCheckboxes);
                },
                error: function () {
                    alert("Error fetching seats");
                }
            });
        } else {
            $('#seatCheckboxes').html("");
        }
    });
});


</script> -->






<?php include 'assets/layout/footer.php' ?>