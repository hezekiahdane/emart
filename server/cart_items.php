
<?php 
    include("connection.php");
    //Displaying the number of items in a cart
    $sql = "SELECT COUNT(*) AS TotalRows FROM order_items WHERE User_ID = '$uname'";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    $total_rows = $row["TotalRows"];
  }
?>