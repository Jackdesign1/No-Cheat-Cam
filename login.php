<?php 
require 'config.php';
if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepared statement untuk keamanan
    $stmt = mysqli_prepare($conn, "SELECT * FROM tb_user WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
            exit(); // Tambahkan exit setelah header untuk menghentikan eksekusi lebih lanjut
        } else {
            echo "<script> alert('Wrong Password'); </script>";
        }
    } else {
        echo "<script> alert('User Not Registered'); </script>";
    }
}
 ?>

 <!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post" autocomplete="off">
        <label for="usernameemail">Username or Email: </label>
        <input type="text" name="usernameemail" id="usernameemail" required value=""> <br>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required value=""> <br>

        <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>
</body>
</html>
