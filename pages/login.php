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
    
    include("../database.php");

    // username password values from inputs
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // mysql db username password infos
    $sql = "SELECT * FROM users WHERE username = '$username'"; 
    $result = mysqli_query($conn, $sql);

    // empty global username variables 
    $usernameData = "";
    $passwordData = "";

    // fetching data from db
     if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $usernameData = $row["username"];
            $passwordData = $row["password"];
        }
     mysqli_close($conn); 

     // login controls
     if(isset($_POST["login"])){
        if(empty("$username") && empty("$password")){
            $errorMessage = "Please fill in all fields";
        } else {
            if($username === $usernameData && $password === $passwordData){
                header("Location:../index.php");
            }else{
                $errorMessage = "You are not a member!";
            }
        }
     }

     // navigation to register page 
     if(isset($_POST["register"])) {
        header("Location:../pages/registration.php");
     }
    
    ?>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" value="">
            <input type="password" name="password" placeholder="Password" value="">
            <button type="submit" name="login">Login</button>
            <button type="submit" name="register" style="margin-top:10px;">Create an account</button>
        </form>
        <!-- show error message -->
         <?php if ($errorMessage): ?>
            <div class="errorMessage"><?php echo $errorMessage; ?></div>
         <?php endif; ?>
    </div>
</body>
</html>