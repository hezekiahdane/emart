<div class="container">
    <form method="post">

    <!-- Updating the category name selected based on category ID -->
    <?php include("../server/connection.php"); ?>
    <?php 
        if(isset($_POST['btnAdd'])){
        $id = $_GET['edit_category'];
        $name = $_POST['edit-category'];

        $sql= "UPDATE category SET Name = '$name' WHERE Category_ID = $id";
  
        mysqli_query($connect, $sql);
        echo"<script> alert('Category updated!'); window.location.href='categories.php' </script>";
          }
    ?>

    <!-- Displaying the category name selected based on category ID -->

    <?php
        $sql="SELECT * FROM category WHERE Category_ID = $id";
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_assoc($result)){ 
        $category_name = $row["Name"];
    ?>

    <!-- Edit Category -->
        <div class="col-2 mt-2">
            <label class="form-label">Edit Category</label>
            <input type="text" class="form-control" id="name" name="edit-category" value="<?php echo $category_name ?>">
        </div>
        
        <!-- Confirm Button -->
        <div class="mt-2">
            <button type="submit" name="btnAdd">Confirm</button>
        </div>

        <?php } ?>
    </form>
</div>