<?php 
  include("server/connection.php");

  if(isset($_POST['btnAdd'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    $sql="select * from user where User_ID= '$username'";
    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) == 0){
      $sql= "insert into user values('$username', '$password', '$firstname', '$middlename', '$lastname', '$email', $phonenumber, 0)";
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
          <a href="index.php"><span>e</span>mart.</a>
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
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#featured">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>

            <li class="nav-item">
              <i onclick="window.location.href='emptycart.php'" class="fa-solid fa-cart-shopping"></i>
            </li>

            <li class="nav-item">
              <div class="dropdown">
                <i onclick="window.location.href='register.php'" class="fa-solid fa-user dropdown"></i>
                <div class="dropdown-content">
                  <a href="server/login.php">login</a>
                  <a href="register.php">register</a>
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

    <!-- Register -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Create Account</h2>
      </div>
                 
      <div class="mx-auto container">
      <form method="post" id="register-form">

	        <div class="form-group">
	          <label for="username">username</label>
            <input type="text" class="form-control" name="username" id="username" required />
          </div>

          <div class="form-group">
            <label for="password">password</label>
            <input type="password" class="form-control" name="password" id="password" required />
          </div>

          <div class="form-group">
            <label for="firstname">first name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" required />
          </div>

          <div class="form-group">
            <label for="middlename">middle name</label>
            <input type="text" class="form-control" name="middlename" id="middlename" required />
          </div>

          <div class="form-group">
            <label for="lastname">last name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" required />
          </div>

          <div class="form-group">
            <label for="email">email</label>
            <input type="email" class="form-control" name="email" id="email" required />
          </div>

          <div class="form-group">
            <label for="phonenumber">phone number</label>
            <input type="text" class="form-control" name="phonenumber" id="phonenumber" required />
          </div>

          
          <div class="form-group">
            <input type="submit" class="btn" id="register-btn" name="btnAdd" value="Sign Up" />
          </div>

          <div class="form-group">
            Already have an account? <a href="login.php" class="btn" id="login-url">Log In</a>
          </div>
        </form>
      </div>
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