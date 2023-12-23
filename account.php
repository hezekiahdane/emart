<?php   
  include("server/connection.php"); 
  session_start();
  $uname = $_SESSION['uname'];

  //Displaying the Account Details
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
              <?php echo "<a href='#' class='nav-link'>Welcome, $uname </a>"; ?>
            </li>

          </ul>
        </div>
      </div>
  </nav>

<!-- Account -->
<section>
  <!-- Header -->
   <div class="container my-5">
    <div class="row">
      <h2 class="col font-weight-bold my-3">Account Details</h2>

    <!-- Buttons -->
      <div class="col container text-end my-3">
        <button onclick="window.location.href='profile.php'" id="update-btn">Edit Account</button>
        <button onclick=" if (checkdelete() == true){
          window.location.href='server/delete_account.php';
          }" id="delete-btn">Delete Account</button>          
        <button onclick="window.location.href='address.php'" id="update-btn">Add Address</button>
        <button onclick=" if (logout() == true){
          window.location.href='server/logout.php';
          }" id="logout-btn">Log Out</button>
      </div>
    </div>
    
    <hr>
  </div>

<!-- Account Details -->
  <div class="container my-3">
    <!-- Account Details Row -->
    <div class="row">
      <!-- Account Details Left child -->
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="assets/imgs/<?php echo $img ?>"
              class="rounded-circle img-fluid" style="width: 145px;">
            <h5 class="my-3"><b>User : <?php echo " " . $uname ?></b></h5>
          </div>
        </div>
      </div>
      
      <!-- Account Details Right child -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
          <!-- Full name -->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><b>Full Name</b></p>
              </div>
              <div class="col-sm-9">
                <!-- Using string concatentation to display full name -->
                <p class="text-muted mb-0"><?php echo $fname . " " . $mname . " " .$lname ?></p>
              </div>
            </div>
            <hr>

            <!-- email -->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><b>Email</b></p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $email ?></p>
              </div>
            </div>
            <hr>

            <!-- mobile -->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><b>Mobile</b></p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $phone ?></p>
              </div>
            </div>
            <hr>

            <!-- Address -->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><b>Address</b></p>
              </div>

            <?php 
              //Displaying the User Address
              $sql = "SELECT * FROM user_address ua JOIN address a ON ua.Address_ID = a.Address_ID WHERE User_ID = '$uname'";
              $result = mysqli_query($connect, $sql);
              //mysqli_num_rows returns the number of rows in a table
              if (mysqli_num_rows($result) == 0) {
                //This will be displayed if user has no address
                echo "<div class='row'>
                <div class='col-sm-3'>
                </div>
                
                <div class='col-sm-9'>
                  <p class='text-muted mb-0'>There is no address </p>
                </div>
              </div>";

              } else {
                //This will be displayed after user adds an address
                while ($row = mysqli_fetch_assoc($result)) {
                  $id1 = $row["Address_ID"];
                  $add1 = $row['Address_Line_1'];
                  $add2 = $row['Address_Line_2'];
                  $city = $row['City'];
                  $state = $row['State'];
                  $pcode = $row['Postal_Code'];
          ?> 

            <!-- Display address content -->
              
              <div class="col mb-0">
                <p class="text-muted mb-3"><?php echo $add1 . ", " . $add2 . ", " . $city . ", " . $state . ", " . $pcode ?></p>
                <?php
                if(isset($_GET["deleteadd"])) {
                    $id = $_GET["deleteadd"];

                    $delete_sql = "DELETE FROM address WHERE Address_ID = $id";
                    mysqli_query($connect, $delete_sql);
                    echo"<script>window.location.href='account.php'</script>";
                }
              ?>
              <div class="mb-3">
                <a href="account.php?deleteadd=<?php echo $id1 ?>" class="delete-btn"> Remove</a>
              </div>
                <?php }
                  }
                ?> 
              </div>

            </div>

          </div>
        </div>
       </div>

      </div>
    </div>

</section>

<!-- Orders -->
<section>
    <div class='container'>
      <div class='text-start'>
          <h2 class='mb-3'>Your Orders</h2>
      </div>

      <table class='cart table table-hover text-center my-5' width='100%'>
         <tr>
          <th class='text-center'>Order ID</th>
          <th class='text-center'>Payment ID</th>
          <th class='text-center'>Address</th>
          <th class='text-center'>Order Date</th>
          <th class='text-center'>Total Price</th>
          <th class='text-center'>Status</th>
        </tr>

        <?php 
     //Displaying the orders here
     $sql = "SELECT * FROM orders WHERE User_ID = '$uname'";
     $result = mysqli_query($connect, $sql);
     while ($row = mysqli_fetch_assoc($result)) {
       $order_id = $row["Order_ID"];
       $payment_id = $row["Payment_ID"];
       $user_address = $row["Address_ID"];
       $order_date = $row["Order_Date"];
       $status = $row["Status"];
      ?>
          
        <tr>
          <td class='text-center'><?php echo $order_id ?> </td>
          <td ><?php echo $payment_id ?></td>
          <td ><?php echo $user_address?> </td>
          <td ><?php echo $order_date ?> </td>
          <td ><?php echo $order_id ?></td>
          <td class='text-center'><?php echo $status ?></td>
        </tr>

    <?php  } ?>

     </table>
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
