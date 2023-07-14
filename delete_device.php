<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IoT_Framework";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the device id to be deleted from the query string
$id = $_GET['id'];

// SQL query to delete the device with the given id
$sql = "DELETE FROM Devices WHERE device_id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Device deleted successfully";
} else {
    echo "Error deleting device: " . $conn->error;
}

$conn->close();
?>
