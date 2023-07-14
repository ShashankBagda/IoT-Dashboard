<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/device.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Device Management</title>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container">
		<h1>Device Management</h1>

		<form action="" method="GET">
			<label for="user_id">Filter by User ID:</label>
			<input type="text" id="user_id" name="user_id" placeholder="Enter user ID..">
			<input type="submit" value="Filter">
			<?php
			if (isset($_GET['user_id'])) {
				echo '<a href="device.php" class="clear_filter">Clear Filter</a>';
			}
			?>
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Type</th>
				<th>Location</th>
				<th>User ID</th>
				<th>Status</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>

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

			// Query to fetch devices based on filter
			$sql = "SELECT * FROM Devices";
			if (isset($_GET['user_id'])) {
				$user_id = $_GET['user_id'];
				$sql .= " WHERE user_id='$user_id'";
			}

			$result = $conn->query($sql);

			// Loop through all devices and display them in a table
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["device_id"] . "</td>";
					echo "<td>" . $row["device_type"] . "</td>";
					echo "<td>" . $row["location"] . "</td>";
					echo "<td>" . $row["user_id"] . "</td>";
					echo "<td>" . $row["status"] . "</td>";
					echo "<td><a href='edit_device.php?id=" . $row["device_id"] . "'>Edit</a></td>";
					echo "<td><a href='delete_device.php?id=" . $row["device_id"] . "'>Delete</a></td>";
					echo "</tr>";
				}
			} else {
				echo "0 results";
			}

			$conn->close();
			?>


        </table>
        <form action="add_device.php" method="POST">
            <label for="type">Type</label>
            <input type="text" id="type" name="type" placeholder="Enter device type..">
            <br>
            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter device location..">
            <br>
            <label for="user_id">User ID</label>
            <input type="text" id="user_id" name="user_id" placeholder="Enter user ID..">
            <br>
            <label for="status">Status</label>
            <input type="text" id="status" name="status" placeholder="Enter device status..">
            <br>
            <input type="submit" value="Add Device">
        </form>
    </div>
</body>

</html>
