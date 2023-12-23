<?php 

include("connection.php");
session_start();
$uname = $_SESSION["uname"];


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

// Insert into the payment table
$payment_query = "INSERT INTO payment (User_ID) VALUES ('$uname')";
$result = mysqli_query($connect, $payment_query);

if($result == TRUE) {
    // Retrieve the Payment_ID of the newly inserted payment ID
    $payment_id = $connect->insert_id;

    // Insert into 'Orders' table
    $order_query = "INSERT INTO `orders` (Order_ID, Payment_ID, Address_ID, User_ID, Order_Date) 
    VALUES ($id, $payment_id, $address_id, '$uname', NOW())";
    $order_result = mysqli_query($connect, $order_query);

    if ($order_result == TRUE) {
        echo "<script> alert('Order placed successfully.'); window.location.href='../account.php' </script>";
    } else {
        echo "Error updating orders table: " . $connect->error;
    }

}

?>