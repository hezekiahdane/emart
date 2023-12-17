<?php 
    session_start();
    include("connection.php");
      if(isset($_POST['submit'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql="select * from user where User_ID = '$username'";

      $result = mysqli_query($connect, $sql);

      if(mysqli_num_rows($result) == 0){
        echo "<script language='javascript'>
				alert('Username is not existing.');
				</script>";
      }else{
        $row = mysqli_fetch_array($result);
          if($row['password']== $password && $row['usertype'] == 0){
            $_SESSION['uname'] = $row['User_ID'];
            header("Location: ../main.php");
          }else if($row['password']== $password && $row['usertype'] == 1){
            $_SESSION['uname'] = $row['User_ID'];
            header("Location: ../admin/admin.php");
          }else{
            echo "<script language='javascript'>
            alert('Incorrect password.');
            </script>";
          }
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
              <a class="nav-link" href="login.php">Shop</a>
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
                <i onclick="window.location.href='login.php'" class="fa-solid fa-user dropdown"></i>
                <div class="dropdown-content">
                  <a href="login.php">login</a>
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

    <!-- login -->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
      </div>

      <div class="mx-auto container">
      <form method="post" id="login-form">

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required />
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="*******" required />
          </div>

          <div class="form-group">
            <input type="submit" class="btn" id="login-btn" name="submit" value="Log In" />
          </div>

          <div class="form-group">
            Don't have an account? <a href="register.php" class="btn" id="register-url">Create Account</a>
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