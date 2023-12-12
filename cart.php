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
              <a class="nav-link active" aria-current="page" href="index.php"
                >Home</a
              >
            </li>

            <li class="nav-item">
              <a class="nav-link" href="shop.php">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="activeContact.php">Contact</a>
            </li>

            <li class="nav-item">
              <i onclick="window.location.href='#'" class="fa-solid fa-cart-shopping"><sup>0</sup></i>
            </li>



            <li class="nav-item">
              <div class="dropdown">
              <i onclick="window.location.href='account.php'"  class="fa-solid fa-user dropdown"></i>
                <div class="dropdown-content">
                  <a href="profile.php">Edit Profile</a>
                  <a href="server/logout.php">Logout</a>
                </div>
              </div>
            </li>

            <li class="nav-item">
           <?php
              session_start();
              include("server/connection.php");
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

    <!-- cart -->
    <section class="cart container my-5 py-5">
      <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr />
      </div>

      <table class="mt-5 pt-5">
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th>Image</th>
          <th>Price</th>
          <th>Stocks Available</th> 
          <th>SKU</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        <tr>
          <td>
            <div class="product-info">
              <img src="assets/imgs/nike.jpeg" />
              <div>
                <p>Nike Dunk Low Panda</p>
                <small><span>$</span>100.00</small>
                <br />
                <a href="#" class="remove-btn">Remove</a>
              </div>
            </div>
          </td>

          <td>
            <input type="number" value="1" />
            <a href="product.html" class="edit-btn">Edit</a>
          </td>

          <td>
            <span>$</span>
            <span class="price">100.00</span>
          </td>
        </tr>

      </table>

      <div class="cart-total">
        <table>
          <tr>
            <td>Subtotal</td>
            <td>$100.00</td>
          </tr>
          <tr>
            <td>Total</td>
            <td>$100.00</td>
          </tr>
        </table>
      </div>

      <div class="checkout-container">
        <button class="btn checkout-btn">Check Out</button>
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
