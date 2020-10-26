<?php
    $servername = "localhost";
    $username = "root";
    $password   = "";
    $database = "bookstore";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
    die("sorry we failed to provide you information ". mysqli_connect_error());
    }
?>