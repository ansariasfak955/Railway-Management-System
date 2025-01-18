<?php
include 'assets/layout/header.php';
include 'assets/layout/sidebar.php';

$email = $_GET['email'] ?? '';
?>

<!-- <form action="verify_otp_process.php" method="POST">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" required>
    <button type="submit">Verify OTP</button>
</form> -->


<main id="main" class="main">

<section class="section profile">
      <div class="row">
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Verification OTP</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade  show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="verify_otp_process.php" method="POST">
                    <?php
                        session_start();
                        if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorAlert">
                                <strong>' . $_SESSION['error'] . '</strong>
                                </div>';
                        unset($_SESSION['error']);
                        }
                    
                    ?>
                  <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Enter OTP:</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" name="otp" required>
                      </div>
                    </div>

                    <div class="text-center d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary">Verify OTP</button>
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
            $('#errorAlert').fadeOut('slow');
        }, 3000); 
    });
</script>

<?php include 'assets/layout/footer.php' ?>