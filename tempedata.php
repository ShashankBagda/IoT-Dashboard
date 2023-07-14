<?php

// Establish database connection
include("./connection.php");

// Check if user ID is set and valid
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
  $user_id = $_GET['user_id'];

  // Prepare and execute SQL query to retrieve temperature data for the user
  $sql = "SELECT * FROM Temperature WHERE user_id = $user_id ORDER BY timestamp ASC";
  $result = $conn->query($sql);
// Convert query result to PHP array
$rows = array();
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

// Convert PHP array to JSON format
$json_data = json_encode($rows);

// Output JSON data
header('Content-type: application/json');
echo $json_data;

// Close database connection
mysqli_close($conn);

}
?>