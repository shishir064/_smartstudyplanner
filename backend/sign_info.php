<?php
    include 'db_connect.php';



    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO signup_info(email,username,password) VALUES ('$email','$username','$password')";

    if(mysqli_query($conn,$sql)){
        
        header("Location: ../src/login.php");
        exit();
    }
    else{
        echo "something is wrong try again...";
    }
    
?>