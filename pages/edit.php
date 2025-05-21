<?php
session_start();
include("../database.php");

// update task status
if (isset($_POST["edit"])) {
    // setting required variables
    $status = $_POST["statusManual"];
    $user_id = $_SESSION['user_id'];
    $task_id = $_POST["edit_task_id"];

    $queryEdit = "UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $queryEdit);
    mysqli_stmt_bind_param($stmt, "sii", $status, $task_id, $user_id);
    mysqli_stmt_execute($stmt);

}


// update task name
if (isset($_POST["edit_name"])) {
    $task_name = $_POST["edit_task_name"];
    $user_id = $_SESSION['user_id'];
    $task_id = $_POST["edit_task_id"];

    $queryNameEdit = "UPDATE tasks SET task_name = ? WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $queryNameEdit);
    mysqli_stmt_bind_param($stmt, "sii", $task_name, $task_id, $user_id);
    mysqli_stmt_execute($stmt);
}
    mysqli_close($conn);
    // Redirect back
    header("Location: dashboard.php");
    exit;


?>