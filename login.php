<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Page</title>

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
	<h2>Sign Up Form</h2>
	<form action="login.php" method="post" id="myForm" onsubmit="submitForm(); return false;">
		<label>Username:</label><br>
		<input type="text" name="username" required><br>
        <label>Email:</label><br>
		<input type="text" name="email_id" required><br>
		<label>Password:</label><br>
		<input type="password" name="password" required><br><br>
		<input type="submit" value="Sign Up">
        <h5>Already have an Account?</h5>
        <a href="login_val.php"><h5>Click Here</h5></a>
	</form>
    

</body>
</html>

<?php

// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iot_framework";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// get the input values
	$username = $_POST['username'];
	$password = $_POST['password'];
    $email_id = $_POST['email_id'];

	// validate the username and password
	// for example, you could check if the username and password match a record in the database
	// in this example, we will just insert the values into the database
	$sql = "INSERT INTO user_login (username,email_id, password) VALUES ('$username','$email_id', '$password')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
        header("Location: login_val.php");
		exit;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// close the database connection
$conn->close();

?>