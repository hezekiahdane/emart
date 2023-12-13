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
            <i onclick="window.location.href='cart.php'" class="fa-solid fa-cart-shopping"><sup>0</sup></i>
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


    <!-- contact -->
    <section id="contact" class="container my-5 py-5">
        <div class="container text-center mt-5">
            <h3>Contact us</h3>
            <hr class="mx-auto">
                
                <p class="w-50 mx-auto">
                    Phone number: <span>123 456 7890</span> 
                </p>

                <p class="w-50 mx-auto">
                    Email address: <span>emart@hotmail.com</span> 
                </p>

                <p class="w-50 mx-auto">
                    We work 24/7 to answer your questions!
            </p>
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

  </body>
</html>
