<?php
include 'db_connect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


if (empty($username) || empty($email) || empty($password)) {
    die("All fields are required");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO signup_info (user_name,email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username,$email, $hashedPassword);

if ($stmt->execute()) {
    header("Location: ../src/login.html");
    exit();
} else {
    die("Something went wrong. Try again.");
}
?>
