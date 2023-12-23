<?php   include("server/connection.php"); 
  session_start();
  $uname = $_SESSION['uname'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product</title>
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
                <a href="account.php">View Profile</a>
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

    <!-- Product -->
    <section class="container single-product my-5 pt-5">
      <div class="row mt-5">
        <div class="col-lg-5 col-md-6 col-sm-12">
        <?php

        if(isset($_GET['product_id'])){
          $id = $_GET['product_id'];

          $sql = "SELECT * FROM product WHERE Product_ID = $id";
          $result = mysqli_query($connect, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            $category_id = $row["Category_ID"];
            $name = $row["Name"];
            $desc = $row["Description"];
            $img = $row["Image"];
            $price = $row["Price"];
            $stocks = $row["Stocks_Available"];
          
          ?> 

        <img class='img-fluid w-100 pb-1' id='mainImg' src='assets/imgs/<?php echo $img ?>'>


        </div>

        <div class="col-lg-6 col-md-12 col-12">
          <!-- Displaying the category -->
        <?php
          $sql = "SELECT * FROM category WHERE Category_ID = $category_id";
          $result = mysqli_query($connect, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $category_name = $row["Name"];
          ?>
            <h6><?php echo $category_name ?></h6>
          <?php break; } ?>

            <h1 class="py-3"><?php echo $name ?></h1>
            <h2 class="py-3">$<?php echo $price ?></h2>

          <div>

          <!-- Adding product into cart -->
            <form method="post">
            <?php 
            //PHP code to insert into database
               if(isset($_POST["add-to-cart"])){

                $qty = $_POST['quantity'];

                $sql= "INSERT INTO order_items (User_ID, Product_ID, Total_Price, Quantity)
                VALUES('$uname', $id, $price, $qty)";
                mysqli_query($connect, $sql);
                echo"<script> alert('Product is added to cart!'); window.location.href='product.php?product_id= $id'</script>"; 
               }
          
          ?>
              <input type="number" value="1" name="quantity" />
              <button class="buy-btn" name="add-to-cart">Add to Cart</button><br>
            </form>
          </div>

          <h5 class="py-5"> Stocks Available: <?php echo $stocks ?> </h5>
          <span><?php echo $desc ?> </span>


        </div>
      </div>


      <?php } ?>
    <?php } ?>


    </section>

    <!-- Related Products -->
    <section id="related-products" class="container my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Related Products</h3>
        <hr class="mx-auto" />
        <p>Here you can check out our new featured products</p>
      </div>

      <div class="row mx-auto container-fluid">
        <!-- Related 1 -->
        <?php

        $sql = "SELECT * FROM product LIMIT 4";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) { 
          $img = $row['Image'];
          $name = $row['Name'];
          $price = $row['Price'];
          $id = $row['Product_ID'];
  
          ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12"><a href="product.php?product_id=<?php echo $id ?>">
        <?php echo "<img class='img-fluid mb-3' src='assets/imgs/$img'>"?></a>   
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['Name'] ?></h5>
          <h4 class="p-price">$ <?php echo $row['Price'] ?></h4>
          <a href="product.php?product_id=<?php echo $id ?>"><button class="buy-btn">Buy Now</button></a>
        </div>

        <?php } ?>

      </div>
    </section>


    <!-- Footer -->
    <section class="footer_bottom">
      <div class="footer_bottom text-center py-4">
        <p class="mb-0">Copyright &copy; 2023 emart. All rights reserved.</p>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      // var mainImg = document.getElementById("mainImg");
      // var smallImg = document.getElementsByClassName("small-img");

      // for (let i = 0; i < 4; i++) {
      //   smallImg[i].onclick = function () {
      //     mainImg.src = smallImg[i].src;
      //   };
      // }

      function logout(){
        return confirm('Are you sure you want to Log out?');
      }

    </script>
  </body>
</html>
