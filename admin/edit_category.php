

<div class="container">

    <form method="post">

    <!-- php code here -->

    <?php 
        include("../server/connection.php");

        if(isset($_POST['btnAdd'])){

        $category = $_POST['edit-category'];
        
        $sql="SELECT * FROM category WHERE Name = '$category'";
        $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) == 1){
                $sql= "UPDATE category SET Name = '$category')";
                mysqli_query($connect, $sql);
                echo "<script language ='javascript'> alert('Category updated!'); window.location.href='categories.php' </script>";
            }
        }
    ?>


    <!-- Edit Category -->
        <div class="col-2 mt-2">
            <label class="form-label">Edit Category</label>
            <input type="text" class="form-control" id="name" name="edit-category">
        </div>

        <!-- Confirm Button -->
        <div class="mt-2">
            <button type="submit" name="btnAdd">Confirm</button>
        </div>

    </form>
</div>