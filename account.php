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
              <a class="nav-link" href="shop.php">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="activeContact.php">Contact</a>
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
              session_start();
              include("server/connection.php");
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

    <!-- account -->
    <section class="m-0 p-0">
        <div class="container mt-3 pt-5">
            <div class=" mx-auto container">
                <h2 class="font-weight-bold">Account Info</h2>
                 <hr class="mx-auto">
                 <div class="account-info">

                 <?php include('server/get_user_details.php');?>
                 <?php while($row=$user_details->fetch_assoc()) { ?>

                 
                    <p><b>Name: </b><?php echo "<span>$uname</span>" ?></p>
                    <p><b>First Name: </b><?php echo $row['First_Name']?></p>
                    <p><b>Last Name: </b><?php echo $row['Last_Name']?></p>
                    <p><b>Email: </b><?php echo $row['Email']?></p>
                    <p><b>Phone Number: </b><?php echo $row['Phone_Number']?></p>
                    
                  <?php break; } ?>

                    <div class="button py-2">
                        <button onclick="window.location.href='profile.php'" id="update-btn">Update Account</button>
                    </div>

                    <div class="button py-2">
                        <button onclick=" if (checkdelete() == true){
                          //?php header('server/delete_account.php'); ?>
                          window.location.href='server/delete_account.php';
                        }" id="delete-btn">Delete Account</button>                        
                    </div>

                    <div class="button py-2">
                        <button onclick=" if (logout() == true){
                          window.location.href='server/logout.php';
                        }" id="logout-btn">Log Out</button>
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

    <script>

      function checkdelete(){
        return confirm('Are you sure you want to Delete this account?');
      }

      function logout(){
        return confirm('Are you sure you want to Log out?');
      }


    </script>

  </body>
</html>
