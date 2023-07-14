<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>

    <style>
		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background-color: #eaeaea;
            background-image: url("images/image4.png");
            background-size: cover;
            background-repeat: no-repeat;
            backdrop-filter: blur(5px);
		}
        
		h2 {
			color: #666;
			text-align: center;
			margin-top: 50px;
			text-shadow: 1px 1px 0 #fff;
		}
		form {
			width: 320px;
			margin: auto;
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}
		label {
			display: block;
			margin-bottom: 5px;
			color: #666;
			text-shadow: 1px 1px 0 #fff;
		}
		input[type=text], input[type=password] {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 3px;
			margin-bottom: 15px;
			box-sizing: border-box;
		}
		input[type=submit] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 15px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}
		input[type=submit]:hover {
			background-color: #3e8e41;
		}
		.error {
			color: #ff0000;
			margin-bottom: 10px;
			text-shadow: 1px 1px 0 #fff;
		}
		.success {
			color: #008000;
			margin-bottom: 10px;
			text-shadow: 1px 1px 0 #fff;
		}
		.footer {
			text-align: center;
			color: #666;
			margin-top: 20px;
			text-shadow: 1px 1px 0 #fff;
		}
		.logo-container {
			display: flex;
			align-items: center;
			justify-content: center;
			margin-top: 50px;
		}
		.logo-container img {
			max-width: 100%;
			max-height: 100%;
			object-fit: contain;
		}
	</style>
</head>
<body>
	<div class="logo-container">
		<img src="images/logo.png" height="100px" width="100px" alt="Logo">
	</div>
	<h2>Login Form</h2>
	<form action="login_val.php" method="post">
		<label>Username:</label><br>
		<input type="text" name="username" required><br>
		<label>Password:</label><br>
		<input type="password" name="password" required><br><br>
		<input type="submit" value="Login">
	</form>

</body>
</html>

<?php
// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iot_framework";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // query the database to check if the entered credentials are valid
  $sql = "SELECT * FROM user_login WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  // if there is a matching record in the database, login is successful
  if (mysqli_num_rows($result) > 0) {
    echo "Login successfully!";
    header("Location: index.php");
		exit;
  } 
  else {
    echo "<script>alert('Invalid username or password');</script>";
  }
}
?>
