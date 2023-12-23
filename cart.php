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
    <title>Your Cart</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
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
        transition: background-color 0.3s;
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

    <!-- cart -->
    <div class="container my-5">
        <div class="text-start my-5">
            <h2>Your cart</h2>
        </div>

        <table class="cart table table-hover text-center" width="100%">
           <tr>
              <th width="15%" class="text-center">Product Name</th>
              <th width="15%" class="text-center">Image</th>
              <th class="text-center">Quantity</th>
              <th class="text-center">Item Price</th>
              <th class="text-center">Subtotal</th>
              <th class="text-center"></th>
            </tr>
            
          <tr> 
            <?php 
                $sql = "SELECT * FROM product INNER JOIN order_items 
                ON product.Product_ID = order_items.Product_ID  && User_ID = '$uname'";

                $total = 0;
                
                $result = mysqli_query($connect, $sql);
                 while($row = mysqli_fetch_array($result)){
                  $id = $row['Order_Items_ID'];
                  $name = $row['Name'];    
                  $qty = $row['Quantity'];
                  $img = $row['Image'];
                  
                  //price per item
                  $price = $row['Total_Price'];
                  //total price by quantity
                  $subtotal = $qty * $row['Total_Price'];
                  //cart total price
                  $total += $qty * $row['Total_Price'];
            ?>

            <td class="py-5"><?php echo $name ?></td>
            <td class="text-center"> 
                <img src="assets/imgs/<?php echo $img ?>" />
            </td>
            <td class="py-5"><?php echo $qty ?></td>
            <td class="py-5">$ <?php echo $price ?></td>
            <td class="py-5">$ <?php echo $subtotal ?></td>

            <td class="py-5 text-center">
              
              <?php
                if(isset($_GET["deleteid"])) {
                    $id = $_GET["deleteid"];

                    $sql = "DELETE FROM order_items WHERE Order_Items_ID = $id";
                    mysqli_query($connect,$sql);
                    echo"<script> window.location.href='cart.php'</script>";
                }
              ?>

              <a href="cart.php?deleteid=<?php echo $id ?>" class="delete-btn">Remove</a>
            </td>
          </tr>
          <?php } ?>

       </table>


        <!-- Total price -->
        <div class="total-price text-end py-3">
          <p>Total Price: <span style="color:burlywood"><?php echo "$$total"?></span></p>
        </div>

        <!-- Checkout button styled similar to logout button -->
        <div class="checkout-container text-center py-3" >
            <form method="POST" action="checkout.php"> <!-- Changed action to 'checkout.php' -->
                <input type="hidden" name="checkout">
                    <button type="submit" class="logout-btn">Checkout</button>
            </form>
        </div>

    </div>

      <!-- Footer -->
      <section class="footer_bottom">
        <div class="footer_bottom text-center py-4">
          <p class="mb-0">Copyright &copy; 2023 emart. All rights reserved.</p>
        </div>
      </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function logout(){
          return confirm('Are you sure you want to Log out?');
        }
    </script>
  </body>
</html>
