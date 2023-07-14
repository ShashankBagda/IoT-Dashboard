<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IoT_Framework";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Get data from form
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Update data in user table
$sql = "UPDATE Users SET name='$name', email='$email', password='$password' WHERE user_id='$id'";
$result = mysqli_query($conn, $sql);

// Check if update was successful
if ($result) {
    echo "User updated successfully!";
} else {
    echo "Error updating user: " . mysqli_error($conn);
}

// Close database connection
	header("Location: user.php");
mysqli_close($conn);
?>
