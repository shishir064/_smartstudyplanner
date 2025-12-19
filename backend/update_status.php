<?php
include 'db_connect.php';

if (!isset($_POST['task_id'], $_POST['status'])) {
    die("Invalid request");
}

$task_id = (int) $_POST['task_id'];
$status  = (int) $_POST['status'];

$sql = "UPDATE tasks SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $task_id);
$stmt->execute();

$stmt->close();
$conn->close();

/* Redirect back to the page user came from */
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
