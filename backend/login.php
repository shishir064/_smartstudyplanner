<?php
include 'db_connect.php';


$username = $_POST['username'];

$sql = "SELECT user_id FROM signup_info WHERE user_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    header("Location: ../src/dashboard.php");
    exit();
} else {
    echo "User does not exist";
}

$stmt->close();
$conn->close();
?>
