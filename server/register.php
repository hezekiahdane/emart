<?php 
  include("connection.php");

  if(isset($_POST['btnAdd'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    //accessing the image
    $img = $_FILES['img']['name'];

    //accessing image temp name
    $temp_img = $_FILES['img']['tmp_name'];
    
    //this creates a copy of the image file that is uploaded and pastes it into our image folder 
    move_uploaded_file($temp_img,"../assets/imgs/$img");
    

    $sql="select * from user where User_ID= '$username'";
    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) == 0){
      $sql= "insert into user values('$username', '$password', '$firstname', '$middlename', '$lastname', '$email', $phonenumber, '$img', 0)";
      mysqli_query($connect, $sql);
      echo "<script language ='javascript'> alert('Congrats! You are now registered.'); window.location.href='login.php' </script>";

    }else{
        echo "<script language ='javascript'> alert('Username already exists, select another name.'); </script>";
      }
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
    <link rel="stylesheet" href="../assets/css/style.css" />
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
          <a href="../index.php"><span>e</span>mart.</a>
        </div>
        <!-- <img src="assets/imgs/logo.jpeg" /> -->
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
              <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#featured">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>

            <li class="nav-item">
              <i onclick="window.location.href='#'" class="fa-solid fa-cart-shopping"><sup>0</sup></i>
            </li>

            <li class="nav-item">
              <div class="dropdown">
                <i onclick="window.location.href='register.php'" class="fa-solid fa-user dropdown"></i>
                <div class="dropdown-content">
                  <a href="login.php">Log In</a>
                  <a href="register.php">Create Account</a>
                </div>
              </div>
            </li>

            <li class="nav-item">
            <a href='#' class='nav-link'>Welcome, Guest </a>
            </li>

          </ul>
        </div>
      </div>
</nav>

  <!-- Create Account -->
  <section class="container my-5">
    <div class="my-5">
        <h2 class="font-weight-bold">Create Account</h2>
        <hr />
      </div>

    <form class="row g-3 align-items-center" method="post" enctype="multipart/form-data" id="register">

    <div class="col-md-4">
      <label class="form-label">Username</label>
      <div class="input-group">

        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
        </div>

        <input type="text" class="form-control" name="username" id="username" required />

      </div>
    </div>

    <!-- Password -->
      <div class="col-md-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" required />
      </div>

    <!-- Confirm Password
      <div class="col-md-4">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="password" id="password" required />
      </div> -->

    <!-- First Name -->
      <div class="col-md-4">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" id="name" name="firstname" required>
      </div>

    <!-- Middle Name -->
    <div class="col-md-4">
        <label for="middlename" class="form-label">Middle Name</label>
        <input type="text" class="form-control" name="middlename" id="middlename" required />
      </div>

      <!-- Last Name -->
      <div class="col-md-4">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="lastname" id="lastname" required />
      </div>

      <!-- Email -->
      <div class="col-md-4">
        <label for="phonenumber" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" required />
      </div>


      <!-- Phone Number -->
      <div class="col-md-4">
        <label for="phonenumber" class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="phonenumber" id="phonenumber" required />
      </div>

      <!-- Image -->
      <div class="col-md-4">
        <label class="form-label">Image</label>
        <input class="form-control" type="file" id="img" name="img">
      </div>


      <!-- Confirm Button -->
      <div class="form-group col-12 text-end my-5">
        Already have an account? <a href="login.php" class="btn" id="login-url" style="color: burlywood;">Log In</a>
        <button type="submit" name="btnAdd" style="border-radius: 5px;" >Sign Up</button>
      </div>

    </form>
  </section>


<!-- Footer -->
<section class="footer_bottom">
  <div class="footer_bottom text-center py-4">
    <p class="mb-0">Copyright &copy; 2023 emart. All rights reserved.</p>
  </div>
</section>
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    ></script>
  </body>
</html>