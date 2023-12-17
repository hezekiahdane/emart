<?php
include("server/connection.php");
session_start();
$uname = $_SESSION['uname'];


if (isset($_POST['btnAdd'])) {
  $add1 = $_POST['add1'];
  $add2 = $_POST['add2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $pcode = $_POST['pcode'];

  $sql = "INSERT INTO address (Address_Line_1, Address_Line_2, City, State, Postal_Code)
  VALUES ('$add1', '$add2', '$city', '$state', '$postalCode')";

  mysqli_query($connect, $sql);
  echo "<script language ='javascript'> alert('New address added.'); window.location.href='account.php' </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to e-mart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 sticky-top">
    <div class="container">
      <div class="header_logo">
        <a href="main.php"><span>e</span>mart.</a>
      </div>
      <!-- <img src="assets/imgs/logo.jpeg" /> -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="main.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main_shop.php">Shop</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>

          <li class="nav-item">
              <?php include("server/cart_items.php"); ?>
              <i onclick="window.location.href='cart.php'" class="fa-solid fa-cart-shopping"><sup><?php echo $total_rows ?></sup></i>
          </li>

          <li class="nav-item">
            <div class="dropdown">
              <i onclick="window.location.href='account.php'" class="fa-solid fa-user"></i>
              <div class="dropdown-content">
                <a href="profile.php">Edit Profile</a>
                <a onclick=" if (logout() == true){ window.location.href='server/logout.php'; }">Log Out</a>
              </div>
            </div>
          </li>

          <li class="nav-item">
            <?php
            echo "<a href='#' class='nav-link'>Welcome, $uname </a>";
            ?>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Add an Address -->
  <section class="container my-5">

    <div class="my-5">
      <h2 class="font-weight-bold">Add an Address</h2>
      <hr />
    </div>

    <form class="row g-3 align-items-center" method="post">

      <!-- Address Line 1 -->
      <div class="col-md-6">
        <label class="form-label">Address Line 1</label>
        <input type="text" class="form-control" id="add1" name="add1" required>
      </div>

      <!-- Address Line 2 -->
      <div class="col-md-6">
        <label class="form-label">Address Line 2</label>
        <input type="text" class="form-control" name="add2" id="add2" required />
      </div>

      <!-- City -->
      <div class="col-md-4">
        <label class="form-label">City</label>
        <input type="text" class="form-control" name="city" id="city" required />
      </div>

      <!-- State -->
      <div class="col-md-4">
        <label class="form-label">State</label>
        <input type="text" class="form-control" name="state" id="state" required />
      </div>

      <!-- Phone Number -->
      <div class="col-md-4">
        <label class="form-label">Postal Code</label>
        <input type="number" class="form-control" name="pcode" id="pcode" required />
      </div>

      <!-- Confirm Button -->
      <div class="form-group col-12 text-end my-5">
        <button type="submit" name="btnAdd" style="border-radius: 5px;">Confirm</button>
      </div>

    </form>

  </section>


  <!-- Footer -->
  <section class="footer_bottom">
    <div class="footer_bottom text-center py-4">
      <p class="mb-0">Copyright &copy; 2023 emart. All rights reserved.</p>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function logout(){
      return confirm('Are you sure you want to Log out?');
    }
</script>
</body>

</html>