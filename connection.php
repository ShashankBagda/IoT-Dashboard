<?php      
$host = "localhost";  
$user = "root";  
$password = '';  
$db_name = "iot_framework";  

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Failed to connect with MySQL: " . $e->getMessage());
}
?>
