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

if (isset($_POST['update_device'])) {
    $device_id = $_POST['device_id'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $sql = "UPDATE Devices SET device_type='$type', location='$location', user_id='$user_id', status='$status' WHERE device_id='$device_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Device updated successfully!";
    } else {
        echo "Error updating device: " . $conn->error;
    }
}

// Fetch device details to be edited
if (isset($_GET['id'])) {
    $device_id = $_GET['id'];
    $sql = "SELECT * FROM Devices WHERE device_id='$device_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Device</title>
    <link rel="stylesheet" href="./css/device.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Device</h1>
        <form action="" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $row['device_id']; ?>">

            <label for="type">Type</label>
            <input type="text" id="type" name="type" value="<?php echo $row['device_type']; ?>">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>">

            <label for="user_id">User ID</label>
            <input type="text" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>">

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Active" <?php if ($row['status'] == 'Active') echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if ($row['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
            </select>

            <input type="submit" name="update_device" value="Update Device">
            <a href="device.php">Cancel</a>
        </form>

    </div>
</body>

</html>