<?php
session_start();
include("../database.php");

if(isset($_POST["add"])) {

    // getting the task name and status
    $task_name = $_POST["task_name"];
    $status = $_POST["status"];

    // getting user_id
    $user_id = $_SESSION['user_id'];

    if(empty($task_name)) {
        $errorMessage = "Please enter a task name.";
        $_SESSION['errorMessage'] = $errorMessage;
        header("Location: dashboard.php");
    } else {
        // database query
    $query = "INSERT INTO tasks (user_id, task_name, status, created_at) VALUES ('$user_id', '$task_name', '$status', DEFAULT)";

    }

    
    mysqli_query($conn, $query);
}

mysqli_close($conn);
// Redirect back to dashboard
header("Location: dashboard.php");
exit;
?>