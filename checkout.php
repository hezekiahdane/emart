<?php 
    include("server/connection.php"); 
    session_start(); 
    $uname = $_SESSION['uname'];

    //Displaying the Account Details in the billing address section
    $sql= "SELECT * FROM user where User_ID = '$uname'";
    $result = mysqli_query($connect, $sql);

    while($row = mysqli_fetch_assoc($result)) { 
      $fname = $row['First_Name'];
      $mname = $row['Middle_Name'];
      $lname = $row['Last_Name'];
      $email = $row['Email'];
      $phone = $row['Phone_Number'];
      $img = $row['Image'];
}
?>

<?php 
    //Displaying the User Address in the billing address section
    $sql = "SELECT * FROM user_address ua JOIN address a ON ua.Address_ID = a.Address_ID WHERE User_ID = '$uname'";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

    $add1 = $row['Address_Line_1'];
    $add2 = $row['Address_Line_2'];
    $city = $row['City'];
    $state = $row['State'];
    $pcode = $row['Postal_Code'];
    
  }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
                $uname = $_SESSION['uname'];
                echo "<a href='#' class='nav-link'>Welcome, $uname </a>";
          ?>
            </li>

          </ul>
        </div>
      </div>
</nav>

<!-- Checkout Section -->
<section>
    <div class="container my-3 py-3">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-muted">Your cart</span>
              </h4>
            <!-- Cart Summary Details -->
            <ul class="list-group mb-3">

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

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <img class="img-fluid" style="width: 65px;" src="assets/imgs/<?php echo $img ?>" />
                    <div>
                        <h5 class="text-muted my-3"><?php echo $name ?></h5>
                    </div>
                    <span class="my-3">$<?php echo $subtotal ?></span>
                </li>
                <?php } ?>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<?php echo $total ?></strong>
                </li>
            </ul>

            <hr class="my-5 mt-5">

            <form id="paymentForm" action="POST">
              <h4 class="mb-3">Payment Method</h4>

              <div class="my-3">
                  <select class="form-select form-select-md mb-3" name="payment-method" id="paymentMethod">
                      <option selected value="1">Cash On Delivery</option>
                      <option value="2">Online</option>
                  </select>
              </div>

              <hr class="my-5">

              <div class="text-end">
                  <button class="btn-lg" type="button" onclick="redirectUser()">Place Order</button>
              </div>
            </form>

            
            </div>

                <div class="col-md-8 order-md-1">
                  <h4 class="mb-3">Billing address</h4>

                  <div class="row">
                        <div class="col-md-4 mb-3">
                          <label for="username">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">@</span>
                                </div>
                                <input type="text" class="form-control" id="username" placeholder="<?php echo $uname?>" disabled>
                                <div class="invalid-feedback" style="width: 100%;">Your username is required.</div>
                              </div>
                          </div>

                        <div class="col-md-4 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $fname?>" disabled>
                            <div class="invalid-feedback">
                            Valid first name is required.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $lname?>" disabled>
                            <div class="invalid-feedback">
                            Valid last name is required.
                            </div>
                        </div>

                      </div>

                  <div class="mb-3">
                    <label for="email">Email <span class="text-muted"></span></label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $email?>" disabled>
                  </div>

                  <div class="mb-3">
                    <label for="address">Address Line 1</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="" value="<?php echo $add1?>">
                  </div>

                  <div class="mb-3">
                  <label for="address2">Address Line 2 <span class="text-muted">(Optional)</span></label>
                  <input type="text" class="form-control" id="address2" placeholder="Apartment or suite" value="<?php echo $add2 ?>">
                  </div>

                  <div class="row">

                  <div class="col-md-3 mb-3">
                      <label for="zip">City</label>
                      <input type="text" class="form-control" id="state" placeholder="" required="" value="<?php echo $city ?>">
                      <div class="invalid-feedback">
                      City required.
                      </div>
                  </div>

                  <div class="col-md-3 mb-3">
                      <label for="zip">State</label>
                      <input type="text" class="form-control" id="state" placeholder="" required="" value="<?php echo $state ?>">
                      <div class="invalid-feedback">
                      State required.
                      </div>
                  </div>

                  <div class="col-md-3 mb-3">
                      <label for="zip">Postal Code</label>
                      <input type="text" class="form-control" id="zip" placeholder="" required="" value="<?php echo $pcode ?>">
                      <div class="invalid-feedback">
                      Zip code required.
                      </div>
                  </div>
          
                </div>
            </div>
        </div>
    </div>
</section>   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function redirectUser() {
        var selectedPaymentMethod = document.getElementById('paymentMethod').value;

        if (selectedPaymentMethod === '1') {
            window.location.href = 'server/order.php';
        } else if (selectedPaymentMethod === '2') {
            window.location.href = 'server/online_payment.php';
        }
    }
</script>


</body>
</html>