<?php
include 'db_connect.php';

if (!isset($_POST['task_id'])) {
    die("Task ID not found");
}

$task_id = $_POST['task_id'];

$sql = "DELETE FROM tasks WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $task_id);

$stmt->execute();

$stmt->close();
$conn->close();

header("Location: ../src/add_task.php");
exit;