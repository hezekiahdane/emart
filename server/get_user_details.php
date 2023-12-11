<?php

include("connection.php");

$stmt = $connect->prepare("SELECT * FROM user where User_ID = '$uname'");

$stmt->execute();

$user_details = $stmt->get_result();

?>