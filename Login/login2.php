<?php
session_start();

$conn = mysqli_connect("127.0.0.1", "root", "", "kalender_progweb") or die("Gagal");

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username' AND password = '$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        setcookie("cookie1", $username, time() + (86400 * 30), "/");
        $_SESSION['username'] = $username;
        header("location: ../Kalender.php");
        exit;
    } else {
        if (strlen($username) > 0 || strlen($password) > 0) {
            $error = "Username or password is incorrect.";
        } else {
        }
      
    }


}



mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginStyle.css">
    <style>
        .hidden-text {
            color: transparent;
        }
    </style>
</head>
<body>
    
    <div class="box">
        <form method="post" action="">
            <h2>Sign in</h2>
            <h3 style="color: white;font-size: 40px;">YAHAHAAHHA LUPA PASSWORD YAAA?!?!</h3>
            <div class="inputBox">
                <input type="text" name="username" required="required">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="login2.php">Forgot Password</a>    
                <a href="SignUp.php">Signup</a>
            </div>
            <?php if (isset($error)) : ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
