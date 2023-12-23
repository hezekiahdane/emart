<?php   
  include("connection.php"); 
  session_start();
  $uname = $_SESSION['uname'];

  if(isset($_POST['btnAdd'])) {

  //selecting from product and order_items table
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
  }

  //Selecting from user_address table
  $sql = "SELECT * FROM user_address ua JOIN address a ON ua.Address_ID = a.Address_ID WHERE User_ID = '$uname'";
  $result = mysqli_query($connect, $sql);
  while($row = mysqli_fetch_array($result)){
      $address_id = $row["Address_ID"];
  }

  //Storing the form values in a variable
  $acc_name = $_POST['acc-name'];    
  $acc_number = $_POST['acc-number'];    
  $status = 'Paid';


  // Insert into the payment table
  $payment_query = "INSERT INTO payment (User_ID, Account_Number, Account_Name) VALUES ('$uname', $acc_number, '$acc_name')";
  $result = mysqli_query($connect, $payment_query);

  if($result == TRUE) {
      // Retrieve the Payment_ID of the newly inserted payment
      $payment_id = $connect->insert_id;

      // Insert into 'Orders' table
      $order_query = "INSERT INTO `orders` (Order_ID, Payment_ID, Address_ID, User_ID, Order_Date, `Status`) 
      VALUES ($id, $payment_id, $address_id, '$uname', NOW(), '$status')";
      $order_result = mysqli_query($connect, $order_query);

      if ($order_result == TRUE) {
          echo "<script> alert('Order placed successfully.'); window.location.href='../account.php' </script>";
      } else {
          echo "Error updating orders table: " . $connect->error;
      }
  }
  exit();
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
          <a href="../main.php"><span>e</span>mart.</a>
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
              <a class="nav-link active" aria-current="page" href="../main.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../main_shop.php">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>

            <li class="nav-item">
            <?php include("cart_items.php"); ?>
              <i onclick="window.location.href='../cart.php'" class="fa-solid fa-cart-shopping"><sup><?php echo $total_rows ?></sup></i>
            </li>


            <li class="nav-item">
            <div class="dropdown">
              <i onclick="window.location.href='../account.php'" class="fa-solid fa-user"></i>
                <div class="dropdown-content">
                <a href="../account.php">View Profile</a>
                <a onclick=" if (logout() == true){ window.location.href='logout.php'; }">Log Out</a>
                </div>
               </div>
           </li>

           <li class="nav-item">
              <?php echo "<a href='#' class='nav-link'>Welcome, $uname </a>"; ?>
            </li>

          </ul>
        </div>
      </div>
  </nav>

  <!-- Online Payment -->
<section>
<form method="POST">
  <div class="container my-5">
      <div class="row">
        <div class="col-lg-6 my-3">
              <label>Account Name</label>
              <input type="text" class="form-control" name="acc-name" >
          </div>

          <div class="col-lg-6 my-3">
              <label>Account Number</label>
              <input type="text" class="form-control" name="acc-number">
          </div>

          <div class="col-lg text-end">
            <button type="submit" name="btnAdd">Confirm</button>
          </div>
    </div> 
  </div> 
</form>
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
