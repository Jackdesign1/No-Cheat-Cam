<?php 
require 'config.php';
if (!empty($_SESSION["id"])) {
	$id = $_SESSION["id"];
	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);
}

elseif{
	header("Location: login.php");
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Index</title>
 </head>
 <body>
 <h1>Welcome <?php echo $row;  ?></h1>
 <a href="logout.php"></a>
 </body>
 </html>