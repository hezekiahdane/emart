<?php

include("connection.php");

if(isset($_GET["deleteid"])) {
    $id = $_GET["deleteid"];

    $sql = "DELETE FROM product WHERE Product_ID = $id";
    $result = mysqli_query($connect,$sql);
    if($result){
        header("location:../admin/admin.php");
    }else{
        die (mysqli_error($mysqli));
    }

}


?>