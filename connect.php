<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "bank";

    $con = mysqli_connect($server,$username,$password,$db_name);
    if(!$con){
        die("Connection to this database failed due to " . mysqli_connect_error());
    }
    //echo "Successfully connected to db";
?>