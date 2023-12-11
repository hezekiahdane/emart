<?php 
    include("../server/connection.php"); 
    session_start();
?>


<?php
    if(isset($_POST['btnAdd'])){
      $id = $_GET['product_id'];
      $category = $_POST['category'];
      $name = $_POST['pname'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $stocks = $_POST['stocks'];
      $sku = $_POST['sku'];

      //accessing the image
      $img = $_FILES['img']['name'];

      //accessing image temp name
      $temp_img = $_FILES['img']['tmp_name'];

      //move_uploaded_file($temp_img,"./product_images/$img");


      $sql= "UPDATE product SET Category_ID = '$category', Name = '$name', Description = '$description', Price = $price, Stocks_Available = $stocks, SKU = $sku, Image = '$img'
      WHERE Product_ID = $id";

      mysqli_query($connect, $sql);
      echo"<script> alert('Product updated!'); window.location.href='admin.php' </script>";

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

    <!-- Edit Product -->
    <section class="container my-5">

      <div class="my-5">
          <h2 class="font-weight-bold">Edit product</h2>
          <hr />
        </div>

      <form class="row g-3 align-items-center" method="post" enctype="multipart/form-data">

      <!-- Category -->

      <div class="col-md-2">
      <label class="form-label">Category</label>
          <select id="category" class="form-select" id="category" name="category" required>
            <?php 
                $sql = "SELECT * FROM category";
                $result = mysqli_query($connect, $sql); 

                while($row=mysqli_fetch_array($result)){

                $id = $row["Category_ID"];
                $category = $row["Name"];

                ?>
                  <option value="<?php echo $id ?>"> <?php echo $category?></option>
              <?php } ?>
         </select>
        </div>

        <?php 
             if(isset($_GET['product_id'])){
                $id = $_GET['product_id'];
                $sql = "SELECT * FROM product WHERE Product_ID = $id";
                $result = mysqli_query($connect, $sql);

                while($row = mysqli_fetch_array($result)){
                    $name = $row["Name"];
                    $price = $row["Price"];
                    $stocks = $row["Stocks_Available"];
                    $sku = $row["SKU"];
                    $img = $row["Image"];
                    $desc = $row["Description"];


                ?>

      <!-- Name -->
        <div class="col-md-3">
          <label class="form-label">Product Name</label>
          <input type="text" class="form-control" id="name" name="pname" value="<?php echo $name ?>" required>
        </div>

        <!-- Price -->
        <div class="col-md-3">
          <label class="form-label">Price</label>
          <input type="number" class="form-control" id="price" name="price" value="<?php echo $price ?>" required>
        </div>

        <!-- Stocks Available -->
        <div class="col-md-2">
          <label class="form-label">Stocks Available</label>
          <input type="number" class="form-control" id="stocks" name="stocks" value="<?php echo $stocks ?>" required>
        </div>

        <!-- Stock Keeping Unit -->
        <div class="col-md-2">
          <label class="form-label">Stock Keeping Unit</label>
          <input type="number" class="form-control" id="sku" name="sku" value="<?php echo $sku ?>" required>
        </div>

        <!-- Image -->
        <div class="col-md-4">
          <label class="form-label">Image</label>
          <input class="form-control" type="file" id="img" name="img">
        </div>

      <!-- Description -->
        <div class="col-12">
          <label>Description</label>
          <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $desc ?></textarea>
        </div>


        <!-- Confirm Button -->
        <div class="col-12">
          <button type="submit" name="btnAdd" >Confirm</button>
        </div>
      </form>
         <?php } ?>
      <?php } ?>
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
