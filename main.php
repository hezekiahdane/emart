<?php
     include("server/connection.php");   
    session_start();
    $uname = $_SESSION['uname'];

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

    <!-- Home -->
    <section id="home">
      <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span>Best Prices</span> for This Season</h1>
        <p>E-mart offers the best products for the most affordable prices</p>
        <a href="main_shop.php"><button>Shop Now</button></a>
      </div>
    </section>

    <!-- Brands -->
    <section id="brand" class="container my-5 py-5">
      <div class="row">
        <img
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
          src="assets/imgs/Brand/Adidas.jpg"
        />
        <img
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
          src="assets/imgs/Brand/uniqlo.png "
        />
        <img
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
          src="assets/imgs/Brand/Nike.jpg"
        />
        <img
          class="img-fluid col-lg-3 col-md-6 col-sm-12"
          src="assets/imgs/Brand/hm.jpg"
        />
      </div>
    </section>

    <!-- Featured -->
    <section id="featured" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Featured Products</h3>
        <hr class="mx-auto"/>
        <p>Here you can check out our new featured products</p>
      </div>
      <div class="row mx-auto container-fluid">
        <!-- Featured 1 -->
        <?php
        $sql = "SELECT * FROM product ORDER BY rand() LIMIT 4";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) { 
          
        //storing the rows inside a variable
          $img = $row['Image'];
          $name = $row['Name'];
          $price = $row['Price'];
          $id = $row['Product_ID'];
        
        ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12"><a href="product.php?product_id=<?php echo $id ?>">
        <?php echo "<img class='img-fluid mb-3' src='assets/imgs/$img' >"?></a>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name"><?php echo $name ?></h5>
              <h4 class="p-price">$ <?php echo $price ?></h4>
              <a href="product.php?product_id=<?php echo $id ?>"><button class="buy-btn">Buy Now</button></a>
            </div>
          <?php } ?>
        </div>
    </section>

    <!-- Banner -->
    <section id="banner" class="my-5 py-5">
      <div class="container">
        <h4>MID SEASON SALE</h4>
        <h1>
          Fall Collection <br />
          UP to 30% off
        </h1>
        <a href="main_shop.php"></a><button class="text-uppercase">Shop now</button></a>
      </div>
    </section>

    <!-- Clothes -->
  <section id="clothes" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Clothes</h3>
        <hr class="mx-auto"/>
        <p>Check out our amazing clothes</p>
      </div>
      <div class="row mx-auto container-fluid">
      <!-- Displaying product shoes -->
        <?php
        $sql = "SELECT * FROM product WHERE Category_ID = 1 ORDER BY rand() LIMIT 4";
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
          <h5 class="p-name"><?php echo $name ?></h5>
          <h4 class="p-price">$ <?php echo $price ?></h4>
          <a href="product.php?product_id=<?php echo $id ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
    <?php } ?>


      </div>
  </section>

    <!-- Shoes -->
    <section id="shoes" class="my-5">
      <div class="container text-center mt-5 py-5">
        <h3>Shoes</h3>
        <hr />
        <p>Check out our amazing shoes</p>
      </div>
      <div class="row mx-auto container-fluid">

    <!-- Displaying shoes product -->
    <?php
        $sql = "SELECT * FROM product WHERE Category_ID = 2 ORDER BY rand() LIMIT 4";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) { 

        //storing the rows inside a variable for easier access
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
          <h5 class="p-name"><?php echo $name ?></h5>
          <h4 class="p-price">$ <?php echo $price ?></h4>
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
    function logout(){
      return confirm('Are you sure you want to Log out?');
    }
  </script>

  </body>
</html>
