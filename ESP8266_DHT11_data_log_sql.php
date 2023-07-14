<?php

class DHT11 {
    public $conn;

    public function __construct($temperature, $humidity) {
        $this->connect();
        $this->storeInDB($temperature, $humidity);
    }

    public function connect() {
        $host = "localhost";
        $user = "root";
        $password = '';
        $db_name = "iot_framework";

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }
    }

    public function storeInDB($temperature, $humidity) {
        $query = "INSERT INTO dht11 (temperature, humidity) VALUES (:temperature, :humidity)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':temperature', $temperature);
        $stmt->bindParam(':humidity', $humidity);

        try {
            $stmt->execute();
        } catch(PDOException $e) {
            die("Error storing data in the database: " . $e->getMessage());
        }
    }
}

if (isset($_GET['temperature']) && isset($_GET['humidity'])) {
    $temperature = $_GET['temperature'];
    $humidity = $_GET['humidity'];

    $dht11 = new DHT11($temperature, $humidity);
}
?>
