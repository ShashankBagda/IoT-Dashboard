<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IoT_Framework";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Delete selected user from user table
$sql = "DELETE FROM Users WHERE user_id=".$_GET['id'];
$result = mysqli_query($conn, $sql);

// Redirect to index.php after delete
// header("Location: index.php");

// Close database connection
mysqli_close($conn);
?>
