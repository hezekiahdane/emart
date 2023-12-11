     <div class="container">

        <form method="post">

        <!-- php code here -->

        <?php 
            include("../server/connection.php");

            if(isset($_POST['btnAdd'])){

            $category = $_POST['new-category'];
            
            $sql="SELECT * FROM category WHERE Name = '$category'";
            $result = mysqli_query($connect, $sql);
        
            if(mysqli_num_rows($result) == 0){
              $sql= "INSERT INTO category (Name) VALUES('$category')";
              mysqli_query($connect, $sql);
              echo "<script language ='javascript'> alert('New category added!'); window.location.href='categories.php' </script>";
            }else{
                echo "<script language ='javascript'> alert('Category already exists.'); </script>";
              }
            }
        ?>
        

        <!-- Category -->

            <div class="col-2 mt-2">
                <label class="form-label">New Category</label>
                <input type="text" class="form-control" id="name" name="new-category">
            </div>

            <!-- Confirm Button -->
            <div class="mt-2">
                <button type="submit" name="btnAdd">Confirm</button>
            </div>

        </form>
      </div>