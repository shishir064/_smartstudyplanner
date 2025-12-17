<?php
    include 'db_connect.php';

    $email = $_POST['email'];

    $sql = "SELECT id FROM signup_info WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
    header("location: ../src/dashboard.php");
    } else {
    echo "user not exists";
    }


    $stmt->close();
    $conn->close();
?>