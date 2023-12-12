<?php (include("server/connection.php")) ?> 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    .product img {
      width: 100%;
      height: auto;
      box-sizing: border-box;
      object-fit: cover;
    }

    .center {
      text-align: center;
    }

    .pagination a {
      color: #2e2e2e;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
    }

    .pagination li:hover a {
      color: white;
      background-color: burlywood;
    }

    .pagination {
      display: inline-flex;
    }

    .pagination a.active {
      background-color: burlywood;
      color: white;
      border: 1px solid burlywood;
    }
  </style>

</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 sticky-top">
      <div class="container">
        <div class="header_logo">
          <a href="index.php"><span>e</span>mart.</a>
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
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="shop.php">Shop</a>
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
              <i onclick="window.location.href='server/login.php'" class="fa-solid fa-user"></i>
                <div class="dropdown-content">
                <a href="server/login.php">Login</a>
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


  <!-- Product -->
  <section id="featured" class="my-5 pb-5">
    <div class="container">
      <h3 class="text-center">Our Products</h3>
      <hr>
    </div>
    <div class="row mx-auto container mt-5">
      <!-- Product 1 -->
      <?php
        //set the start value
          $start = 0;
        //set the number of rows to display per page
          $rows_per_page = 4;

        //query for getting the number of rows
          $result = $connect->query("SELECT * FROM product"); 
          $nr_of_rows = $result->num_rows;

        //calculate the number of pages
          $pages = ceil($nr_of_rows / $rows_per_page);

        //Setting a new starting point when user clicks on pageination buttons
        if(isset($_GET["page-nr"])){
          $page = $_GET["page-nr"] - 1;
          $start = $page * $rows_per_page;
        }

        //query for displaying the products to the table    
        $sql = "SELECT * FROM product ORDER BY Category_ID DESC LIMIT $start, $rows_per_page";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) {

        //storing the rows inside a variable for easier access
        $img = $row['Image'];
        $name = $row['Name'];
        $price = $row['Price'];
        $id = $row['Product_ID'];
        
         ?>


      <div class="product text-center col-lg-3 col-md-4 col-sm-12"><a href="product.php?product_id=<?php echo $id ?>">
      <?php echo "<img class='img-fluid mb-3' src='assets/imgs/$img' > "; ?></a>  
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
          <h5 class="p-name"><?php echo $name ?></h5>
          <h4 class="p-price">$<?php echo $price ?></h4>
          <a href="product.php?product_id=<?php echo $id ?>"><button class="buy-btn">Buy Now</button></a>

      </div>

      <?php } ?>

      <!-- pagination -->

      <nav aria-label="Page navigation">
        <div class="text-center my-3 py-3">
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

        <!-- displaying the page info -->
        <?php 
           if(!isset($_GET["page-nr"])){
              $page = 1;
           }else{
            $page = $_GET["page-nr"];
           }
        ?>

      <div class="text-center">
        <span>Showing Pages</span> <?php echo $page ?> <span>of</span> <?php echo $pages ?> <span>pages.</span>
      </div>

        </div>

      </nav>

    </div>
  </section>

    <!-- Footer -->
<section class="footer_bottom">
  <div class="footer_bottom text-center py-4">
    <p class="mb-0">Copyright &copy; 2023 emart. All rights reserved.</p>
  </div>
</section>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>