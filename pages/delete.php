<?php
session_start();
include("../database.php");

if(isset($_POST["delete"])) {
    $query = "DELETE FROM tasks";
    mysqli_query($conn, $query);
}

mysqli_close($conn);
// Redirect back to dashboard
header("Location: dashboard.php");
exit;
?>