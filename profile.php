<?php
  include("server/connection.php");
  session_start();
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
              <a class="nav-link active" aria-current="page" href="main.php">Home</a>
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
            <i onclick="window.location.href='#'" class="fa-solid fa-cart-shopping"><sup>0</sup></i>
            </li>

            <li class="nav-item">
                <div class="dropdown">
                  <i onclick="window.location.href='account.php'" class="fa-solid fa-user dropdown"></i>                    
                    <div class="dropdown-content">
                    <a href="profile.php">Edit Profile</a>
                    <a href="server/logout.php">Log Out</a>
                    </div>
                </div>
           </li>

           
           <li class="nav-item">
          <?php
                $uname = $_SESSION['uname'];
                $sql="select * from user";
                $result = mysqli_query($connect, $sql);

                while($row=mysqli_fetch_array($result)){
                echo "<a href='#' class='nav-link'>Welcome, $uname </a>";
                break;
              } 
          ?>
            </li>


          </ul>
        </div>
      </div>
    </nav>


    <!-- profile -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <!-- php code here -->             
      <?php 
          $connect = mysqli_connect("localhost","root","","ecommerce") or die("Error in connection");
          $user = $_SESSION['uname'];
          echo "<h2 class='form-weight-bold'>Hello, $user</h2>";
            
            if(isset($_POST['btnAdd'])){
              $password = $_POST['password'];
              $firstname = $_POST['firstname'];
              $middlename = $_POST['middlename'];
              $lastname = $_POST['lastname'];
              $email = $_POST['email'];
              $phonenumber = $_POST['phonenumber'];

              $sql = "update user set password = '$password',
              First_Name = '$firstname',
              Middle_Name = '$middlename',
              Last_Name = '$lastname',
              Email = '$email', 
              Phone_Number = $phonenumber 
              where User_ID = '$user'";

              if ($connect->query($sql) === TRUE) {
                echo "<script language='javascript'>
                    alert('Record updated!'); window.location.href='account.php'
                  </script>";
              } else {
                  echo "<script language='javascript'>
                    alert('Error in updating record.');
                  </script>";
              }          
            }
        ?>
        </div>
          <div class="mx-auto container">
          <form method="post" id="edit-form">

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
              <input type="submit" class="btn" id="edit-btn" name="btnAdd" value="Update Profile" />
            </div>

          </div>
        </form>
      </div>  
    </section>


      <!-- Footer spad -->
      <section class="footer spad">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="footer_about">
                <div class="footer_logo">
                  <div class="footer_logo">
                    <a href="index.php"><span>e</span>mart.</a>
                  </div>
                </div>
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry.
                </p>
                <div class="footer_social">
                  <a href="#">
                    <i class="fa-brands fa-facebook-f"></i>
                  </a>
                  <a href="#">
                    <i class="fa-brands fa-twitter"></i>
                  </a>
                  <a href="#">
                    <i class="fa-brands fa-instagram"></i>
                  </a>
                  <a href="#">
                    <i class="fa-brands fa-linkedin-in"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-3">
              <div class="footer_widget">
                <h6>Quick Links</h6>
                <ul>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Blogs</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-md-3">
              <div class="footer_widget">
                <h6>Accounts</h6>
                <ul>
                  <li><a href="#">My Account</a></li>
                  <li><a href="#">Login</a></li>
                  <li><a href="#">Order Tracking</a></li>
                  <li><a href="#">Checkout</a></li>
                  <li><a href="#">Wishlist</a></li>
                </ul>
              </div>
            </div>
          </div>
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
