<?php
require 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    
    $duplicate = mysqli_prepare($conn, "SELECT * FROM tb_user WHERE username = ?");
    mysqli_stmt_bind_param($duplicate, "s", $username);
    mysqli_stmt_execute($duplicate);
    $result = mysqli_stmt_get_result($duplicate);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already taken";
    } else {
        if ($password == $confirmpassword) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO tb_user (name, username, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sss", $name, $username, $hashedPassword);
            mysqli_stmt_execute($stmt);
            echo "Registration successful";
        } else {
            echo "Passwords do not match";
        }
    }
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
</head>
<body>

<h2>Registration</h2>
<form class="" action="" method="post" autocomplete="off">

<label for="name">Name: </label>
<input type="text" name="name" id="name" required value=""><br>
<label for="username">Username: </label>
<input type="text" name="username" id="username" required value=""> <br>
<label for="password">Password: </label>
<input type="password" name="password" id="password" required value=""> <br>
<label for="confirmpassword">Confirm Password: </label>
<input type="password" name="confirmpassword" id="confirmpassword" required value=""> <br>
<button type="submit" name="submit">Register</button>
</form>
<br>
<a href="login.php"></a>
</body>
</html>