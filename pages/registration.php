<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Registration</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
    session_start();
    include("../database.php");

    // username password from inputs
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(isset($_POST["register"])) {
        if(empty($username) || empty($password)) {
            $errorMessage = "Please fill in all fields";
        } else {
            $checkQuery = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($conn, $checkQuery);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $errorMessage = "This username has already been taken.";
            } else {
                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                mysqli_query($conn, $sql);
                $successMessage = "Registration successful!";
            }
        }
    }



    ?>
    <div class="login-container">
        <h2>Register</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" value="">
            <input type="password" name="password" placeholder="Password" value="">
            <button type="submit" name="register" style="margin-top:10px;">Create your account</button>
        </form>
        <!-- show error message -->
         <?php if ($errorMessage): ?>
            <div class="errorMessage"><?php echo $errorMessage; ?></div>
         <?php endif; ?>
          <!-- show success message -->
         <?php if ($successMessage): ?>
            <div class="successMessage"><?php echo $successMessage; ?></div>
         <?php endif; ?>
    </div>

    <a href="../index.php" class="logout-btn">Go back</a>
</body>
</html>