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
            <div class="col text-start"><h2 class="font-weight-bold">Manage Products</h2></div>
            <div class="col text-end"><i onclick="window.location.href='add_product.php'" class="fa-solid fa-circle-plus"></i></div>
        </div>
      </div>

      <table class="table table-hover text-left" width="100%">
        <tr>
            <th  width="15%" class="text-center">Product ID</th>
            <th class="text-center">Category</th>
            <th class="text-center" width="15%">Product Name</th>
            <th class="text-center" width="35%">Description</th>
            <th class="text-center" >Image</th>
            <th class="text-center">Price</th>
            <th class="text-center" width="15%">Stocks Available</th> 
            <th class="text-center">SKU</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
          </tr>

        <?php (include("../server/connection.php")) ?> 
        <?php

        //set the start value
          $start = 0;
        //set the number of rows to display per page
          $rows_per_page = 5;
        //query for getting the number of rows
          $sql = "SELECT * FROM product"; 
          $records = mysqli_query($connect, $sql);

          $nr_of_rows = $records->num_rows;

        //calculate the number of pages
          $pages = ceil($nr_of_rows / $rows_per_page);

        //Setting a new starting point when user clicks on pageination buttons
          if(isset($_GET["page-nr"])){
            $page = $_GET["page-nr"] - 1;
            $start = $page * $rows_per_page;
          }

        //query for displaying the products to the table    
          $sql = "SELECT * FROM product LIMIT $start, $rows_per_page";
          $result = mysqli_query($connect, $sql);
          
          while($row = mysqli_fetch_array($result)){
            //storing the rows in a variable
             $id = $row['Product_ID'];
             $category = $row['Category_ID'];
             $name = $row['Name'];
             $desc = $row['Description'];
             $img = $row['Image'];
             $price = $row['Price'];
             $stocks = $row['Stocks_Available'];
             $sku = $row['SKU'];
             ?>

          <tr>
            <td class="text-center">
              <?php echo $id ?>
            </td>

            <td>
              <?php echo $category ?>
            </td>

            <td>
              <?php echo $name ?>
            </td>

            <td>
              <?php echo $desc ?>
            </td>

            <td>
              <div class="product-info">
                <img src="../assets/imgs/<?php echo $img ?>" />
                <div>
            </td>

            <td>
            <?php echo $price ?>
            </td>

            <td>
              <?php echo $stocks ?>
            </td>

            <td>
              <?php echo $sku ?>
            </td>

            <td>
              <a href="edit_product.php?product_id=<?php echo $id ?>" class="edit-btn">Edit</a>
            </td>

            <td>
              <a href="../server/delete.php?deleteid=<?php echo $id ?>" class="delete-btn">Delete</a>
            </td>
            
          </tr>

          <?php } ?>

        </table>

      <!-- pagination -->
      <nav aria-label="Page navigation example">
        <!-- displaying the page info -->
        <?php 
           if(!isset($_GET["page-nr"])){
              $page = 1;
           }else{
            $page = $_GET["page-nr"];
           }
        ?>

        <span>Showing Pages</span> <?php echo $page ?> <span>of</span> <?php echo $pages ?> <span>pages.</span>
        <ul class="pagination justify-content-center">
        <!-- Go to first page -->
          <li class="page-item">
            <a class="page-link" href="?page-nr=1">First</a>
          </li>

           <!-- Go to previous page -->
          <li class="page-item">
            <?php
            if(isset($_GET["page-nr"]) && $_GET["page-nr"] > 1){ ?>
              <a class="page-link" href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a>
            <?php 
            }else{
            ?>
              <!-- in case user presses previous button while on previous page -->
              <a class="page-link">Previous</a>
            <?php } ?>
          </li>

        <!-- Displaying the number of pages -->
          <li class="page-item">
            <?php 
              //Using for loop to display the number of pages available
                for($counter = 1; $counter <= $pages; $counter++){
              ?>
              <a class="page-link" href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
          </li>
            <?php 
            }
          ?>

        <!-- Go to next page -->
          <li class="page-item">
            <?php 
            //if no get req, meaning you are in the first page
              if(!isset($_GET["page-nr"])){
            ?>
                <!-- sends the user to the second page -->
                <a class="page-link" href="?page-nr=2">Next</a>
            <?php 
            }else{ 
              if($_GET["page-nr"] >= $pages){ ?>
                <!-- in case user presses next button while the last page -->
                  <a class="page-link">Next</a>
            <?php
            }else{ ?>
              <!-- Fetch the next set of rows -->
                <a class="page-link" href="?page-nr=<?php echo $_GET["page-nr"] + 1 ?>">Next</a>
              <?php
              }
            }?>
          </li>

          <!-- Last page button -->
          <li class="page-item">
            <a class="page-link" href="?page-nr=<?php echo $pages ?>">Last</a>
          </li>

        </ul>

      </nav>

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
