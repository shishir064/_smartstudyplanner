<?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "smart_study";

    $conn = mysqli_connect($server,$username,$password,$db_name);
    if (!$conn){
        die("something is wrong");
    }
    else{
        echo "successful";
    }
?>