<?php

session_start();
include("../database.php");

// getting user_id
$user_id = $_SESSION['user_id'];
// getting task_id
$task_id = $_POST["task_id"];

if (isset($_POST["delete"])) {
    $query = "DELETE FROM tasks WHERE user_id = ? AND id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $task_id);
    mysqli_stmt_execute($stmt);
}

mysqli_close($conn);
// Redirect back to dashboard
header("Location: dashboard.php");
exit;
