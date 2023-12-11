<?php
session_start();
include("connection.php");

$uname = $_SESSION['uname'];
$sql = "DELETE FROM user WHERE User_ID = '$uname'";
mysqli_query($connect, $sql);        

header('Location: ../index.php');


?>