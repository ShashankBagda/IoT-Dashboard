    <?php

// Establish a connection to the MySQL database

include("./connection.php");
// Query the temperature table
$sql = "SELECT * FROM temperature";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Temperature: " . $row["temperature_in_c"] . "°C, Device ID: " . $row["device_id"] . ", Time: " . $row["time"] . "<br>";
    }
} else {
    echo "0 results";
}

// Query the humidity table
$sql = "SELECT * FROM humidity";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Humidity: " . $row["humidity_value"] . "%, Device ID: " . $row["device_id"] . ", Time: " . $row["time"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
mysqli_close($conn);

?>
