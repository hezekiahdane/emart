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
    <link rel="stylesheet" href="../assets/css/admin.css" />
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
          <a href="#"><span>e</span>mart.</a>
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
              <a class="nav-link" href="admin.php">Products</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="categories.php">Categories</a>
            </li>

            <li class="nav-item">
                <div class="dropdown">
                  <i onclick="window.location.href='account.php'" class="fa-solid fa-user dropdown"></i>                    
                    <div class="dropdown-content">
                    <a href="account.php">Edit Profile</a>
                    <a href="../server/logout.php">Log Out</a>
                    </div>
                </div>
           </li>

           
           <li class="nav-item">
           <?php
              session_start();
              include("../server/connection.php");
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

  <!-- Products -->
  <section class="cart container">

      <div class="py-5">
          <div class="row">
            <div class="col text-start"><h2 class="font-weight-bold">Manage Categories</h2></div>
            <div class="col text-end"><i onclick="window.location.href='categories.php?add_category'" class="fa-solid fa-circle-plus"></i></div>
        </div>
      </div>

      <table class="table table-hover text-center" width="100%">
        <tr>
            <th class="text-center">Category ID</th>
            <th class="text-center">Category Name</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>

        <?php (include("../server/connection.php")) ?> 
        <?php

        //query for displaying the products to the table    
          $result = $connect->query("SELECT * FROM category"); 
          
          while ($row = $result->fetch_assoc()) { 
            //storing the rows in a variable
             $id = $row['Category_ID'];
             $name = $row['Name'];
             ?>

          <tr>
            <td>
              <?php echo $id ?>
            </td>

            <td>
              <?php echo $name ?>
            </td>

            <td>
              <a href="categories.php?edit_category=<?php echo $id ?>" class="edit-btn">Edit</a>
            </td>

            <td>
              <?php
                if(isset($_GET["deleteid"])) {
                    $id = $_GET["deleteid"];

                    $sql = "DELETE FROM category WHERE Category_ID = $id";
                    $result = mysqli_query($connect,$sql);
                    if($result){
                        header("location:../admin/categories.php");
                    }else{
                        die (mysqli_error($mysqli));
                    }
                }
              ?>

              <a href="?deleteid=<?php echo $id ?>" class="delete-btn">Delete</a>
            </td>
          </tr>

          <?php } ?>

        </table>


  </section>

  <!-- Add category -->
  <div>
    <?php  
    if(isset($_GET['add_category'])){
      include('add_category.php');
    }
    ?>  
  </div>

  <!-- Edit category -->
  <?php  
    if(isset($_GET['edit_category'])){
      include('edit_category.php');
    }
    ?>  
  </div>






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
