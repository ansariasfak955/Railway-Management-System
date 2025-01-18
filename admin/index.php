<?php
session_start();
include '../assets/inc/conn.php';
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../login.php");
//     exit;
// }

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit;
}

?>

<?php 
    include 'assets/layout/header.php' 
?>

<?php 
    include 'assets/layout/sidebar.php' 
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Users <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <?php
                      include '../assets/inc/conn.php';

                      $sql = "SELECT COUNT(*) as total_users FROM users"; 
                      $result = $conn->query($sql);

                      if ($result) {
                          $row = $result->fetch_assoc();
                          $totalUsers = $row['total_users']; 
                      } else {
                          $totalUsers = 0;
                      }
                      ?>
                    <div class="ps-3">
                      <h6><?php echo $totalUsers; ?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Station <span></span></h5>

                  <div class="d-flex align-items-center">
                      <?php

                        $sql = "SELECT COUNT(*) as total_station FROM stations"; 
                        $result = $conn->query($sql);

                        if ($result) {
                            $row = $result->fetch_assoc();
                            $totalUsers = $row['total_station']; 
                        } else {
                            $totalUsers = 0;
                        }
                      ?>
                    <div class="ps-3">
                      <h6><?php echo $totalUsers ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Total Trains <span></span></h5>
                  <div class="d-flex align-items-center">

                    <?php

                      $sql = "SELECT COUNT(*) as total_train FROM trains"; 
                      $result = $conn->query($sql);

                      if ($result) {
                          $row = $result->fetch_assoc();
                          $totalTrains = $row['total_train']; 
                      } else {
                          $totalTrains = 0;
                      }
                    ?>

                    <div class="ps-3">
                      <h6><?php echo $totalTrains ?></h6>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Total Booking <span></span></h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6>1244</h6>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Total Confirm <span></span></h5>

                <div class="d-flex align-items-center">
                  <div class="ps-3">
                    <h6>124</h6>
                  </div>
                </div>

              </div>
            </div>

            </div>


          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

<?php

include 'assets/layout/footer.php';

?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>