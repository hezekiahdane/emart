<?php
  include("server/connection.php");
  session_start();
  $uname = $_SESSION['uname'];

  //Displaying the user values
  $sql = "SELECT * FROM user WHERE User_ID = '$uname'";
  $result = mysqli_query($connect, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $fname = $row['First_Name'];
    $mname = $row['Middle_Name'];
    $lname = $row['Last_Name'];
    $email = $row['Email'];
    $phone = $row['Phone_Number'];
  }

  //Updating the user values
  if (isset($_POST['btnAdd'])) {

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    $sql= "UPDATE user SET First_Name = '$firstname', Middle_Name = '$middlename', Last_Name = '$lastname', Email = '$email', Phone_Number = $phonenumber
    WHERE User_ID = '$uname'";
    mysqli_query($connect, $sql);
      echo  "<script> alert('Your account is now updated.'); window.location.href='account.php' </script>";
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to e-mart</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
  </head>
  <body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 sticky-top">
      <div class="container">
        <div class="header_logo">
          <a href="main.php"><span>e</span>mart.</a>
        </div>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div
          class="collapse navbar-collapse nav-buttons"
          id="navbarSupportedContent"
        >
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
                <a href="#">View Profile</a>
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


<!-- Update Account -->
<section class="container my-5">
    <div class="my-5">
        <h2 class="font-weight-bold">Update Account Details</h2>
        <hr />
      </div>

    <form class="row g-3 align-items-center" method="post" enctype="multipart/form-data" id="register">

    <!-- <div class="col-md-4">
      <label class="form-label">Username</label>
      <div class="input-group">

        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
        </div>

        <input type="text" class="form-control" name="username" id="username" required />

      </div>
    </div> -->

    <!-- Password
      <div class="col-md-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required />
      </div> -->

    <!-- First Name -->
      <div class="col-md-4">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" id="name" name="firstname" value="<?php echo $fname ?>" required>
      </div>

    <!-- Middle Name -->
    <div class="col-md-4">
        <label for="middlename" class="form-label">Middle Name</label>
        <input type="text" class="form-control" name="middlename" id="middlename" value="<?php echo $mname ?>" required />
      </div>

      <!-- Last Name -->
      <div class="col-md-4">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $lname ?>" required />
      </div>

      <!-- Email -->
      <div class="col-md-4">
        <label for="phonenumber" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo $email ?>" required />
      </div>


      <!-- Phone Number -->
      <div class="col-md-4">
        <label for="phonenumber" class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo $phone ?>" required />
      </div>

      <!-- Image
      <div class="col-md-4">
        <label class="form-label">Image</label>
        <input class="form-control" type="file" id="img" name="img">
      </div> -->

      <!-- Confirm Button -->
      <div class="form-group col-12 text-end my-5">
        <button type="submit" name="btnAdd" style="border-radius: 5px;" >Confirm</button>
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
