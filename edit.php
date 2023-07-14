<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			margin: 0;
			padding: 20px;
		}

		h1 {
			text-align: center;
			color: #333;
			font-size: 36px;
			margin-bottom: 30px;
		}

		form {
			width: 50%;
			margin: 0 auto;
			background-color: #fff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
		}

		form label {
			display: block;
			margin-bottom: 10px;
			color: #333;
			font-size: 18px;
		}

		form input[type="text"],
		form input[type="password"] {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 16px;
			width: 100%;
			box-sizing: border-box;
			margin-bottom: 20px;
		}

		form input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 18px;
			cursor: pointer;
			transition: background-color 0.3s ease-in-out;
		}

		form input[type="submit"]:hover {
			background-color: #45a049;
		}
	
	</style>
</head>
<body>
	<h1>Edit User</h1>
	<?php
	// Connect to database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "IoT_Framework";
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Retrieve data from user table for selected user ID
	$sql = "SELECT * FROM Users WHERE user_id=".$_GET['id'];
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	?>
	<form action="update.php" method="post">
		<input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
		<label>Name:</label>
		<input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
		<label>Email:</label>
		<input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
		<label>Password:</label>
		<input type="password" name="password" value="<?php echo $row['password']; ?>"><br><br>
		<input type="submit" value="Update">
	</form>
	<?php
	// Close database connection
	// header("Location: user.php");

	mysqli_close($conn);
	?>
</body>
</html>
