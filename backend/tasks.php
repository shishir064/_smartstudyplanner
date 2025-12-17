<?php 
include 'db_connect.php';

$task_til = $_POST['task_title'] ?? '';
$task_dis = $_POST['task_dis'] ?? '';
$categoty = $_POST['categoty'] ?? '';
$created_at = $_POST['created_at'] ?? '';

$sql = "INSERT INTO tasks(task_title,task_description,categoty,created_at) VALUES ('$task_til','$task_dis','$categoty','$created_at')";

if(mysqli_query($conn,$sql)){
    header("location: ../src/add_task.php");
}
else{
    echo"something is wrong";
}
?>