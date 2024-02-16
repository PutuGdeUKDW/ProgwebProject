<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "kalender_progweb") or die("Gagal");

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username sudah ada dalam database
    $cek_username = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        $error = "Username sudah dipakai. Silakan gunakan username yang lain.";
    } else {
        // Jika username belum ada, insert data ke dalam database
        $sql = "INSERT INTO pengguna VALUES ('$username', '$password')";

        $daftar = mysqli_query($conn, $sql);
        if ($daftar) {
            // Redirect ke halaman login atau halaman lain yang diinginkan
            header("Location: login.php");
            exit;
        } else {
            $error = "Gagal mendaftar. Silakan coba lagi.";
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
        <form method="post" action=""  id="myForm">
            <h2>Daftar</h2>
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
            <?php if (isset($error)) : ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <div>
                <input type="submit" value="Cancel" class="daftar" onclick="setFormAction('login.php'); return false;">
                <input type="submit" value="Daftar" class="daftar">
            </div>
        </form>
        <script>
            function setFormAction(action) {
                document.getElementById("myForm").action = action;
                document.getElementById("myForm").submit();
            }
        </script>
    </div>
</body>
</html>
