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

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    $location = $_POST["location"];
    $user_id = $_POST["user_id"];
    $status = $_POST["status"];

    // Insert new device into the Devices table
    $sql = "INSERT INTO Devices (device_type, location, user_id, status) VALUES ('$type', '$location', '$user_id', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Device added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
header("Location: device.php");

$conn->close();
?>
