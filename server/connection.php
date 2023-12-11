<?php

$connect = mysqli_connect("localhost","root","","ecommerce");          

if (!$connect) {
    die (mysqli_error($mysqli));
}

?>