<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IoT_Framework";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insert data into user table
$sql = "INSERT INTO Users (name, email, password) VALUES ('$name', '$email', '$password')";
$result = mysqli_query($conn, $sql);

// Check if insert was successful
if ($result) {
    echo "New user added successfully!";
} else {
    echo "Error adding user: " . mysqli_error($conn);
}
header("Location: user.php");

// Close database connection
mysqli_close($conn);
?>
