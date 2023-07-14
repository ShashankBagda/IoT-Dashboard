<!DOCTYPE html>
<html>
<head>
	<title>IOT FRAMEWORK</title>
	<link rel="stylesheet" href="./css/styles.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gaugeJS/dist/gauge.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700|Open+Sans:400,600|Source Sans Pro:400,700">
	
</head>
<body>
	<?php include("./header.php");?>
	<input type="checkbox" id="toggle" class="toggle-checkbox">
	<label for="toggle" class="toggle-label"><span class="toggle-icon"></span></label>
	<div class="sidebar">
		<br><br>
		<br><br>
		<a href="index.php"><i class="fa fa-ho"></i> Dashboard</a>
		<a href="device.php"><i class="fa fa-cog"></i> Device Management</a>
        <a href="humiditydata.php"><i class="fa fa-bar-chart"></i> Data Visualization</a>
        <a href="analytics.html"><i class="fa fa-line-chart"></i> Analytics & Insights</a>
        <a href="user.php"><i class="fa fa-user"></i> User Management</a>
        <a href="performance.html"><i class="fa fa-tachometer"></i> Performance </a>
	</div>

	

	  	<div class="content">
		<div style="width:500px">
			<canvas id="mycanvas2"></canvas>
    <!-- <script>
      const ctx = document.getElementById('myChart').getContext('2d');
      const chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
            label: 'My Dataset',
            data: [10, 20, 30, 40, 50, 60, 70],
            borderColor: '#003566',
            borderWidth: 2,
            pointRadius: 5,
            pointBackgroundColor: '#003566',
            fill: false
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script> -->

	

	<?php
include("./connection.php");

// Query to select temperature data
$sql = "SELECT temperature, timestamp FROM temperature WHERE sensor_id = 1 AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY)";

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Create arrays for chart data
    $temperature_data = array();
    $timestamp_data = array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $temperature_data[] = $row['temperature'];
        $timestamp_data[] = $row['timestamp'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>





	<script>
		var temperature_data = <?php echo json_encode($temperature_data); ?>;
		var timestamp_data = <?php echo json_encode($timestamp_data); ?>;

		var chartdata = {
			labels: timestamp_data,
			datasets : [
				{
					label: 'Temperature (°C)',
					backgroundColor: 'rgba(75, 192, 192, 0.6)',
					borderColor: '#003566',
					borderWidth: 1,
					hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)',
					hoverBorderColor: '#003566',
					data: temperature_data
				}
			]
		};

		var ctx = document.getElementById("mycanvas2").getContext("2d");

		var lineGraph = new Chart(ctx, {
			type: 'line',
			data: chartdata
		});
	</script>
			
		</div>
    <div style="width:500px">
		
	<canvas id="chart"></canvas>

	<?php
// Query the database to get the data
$sql = "SELECT location, COUNT(*) AS count FROM Devices GROUP BY location";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Initialize empty arrays to hold the labels and data
$labels = array();
$data = array();

// Loop through the query results and populate the arrays
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $labels[] = $row["location"];
    $data[] = $row["count"];
}
?>


	<script>
		// Get the data from PHP
		var labels = <?php echo json_encode($labels); ?>;
		var data = <?php echo json_encode($data); ?>;

		// Create the chart
		var ctx = document.getElementById('chart').getContext('2d');
		var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    type: 'bar',

		    // The data for our dataset
		    data: {
		        labels: labels,
		        datasets: [{
		            label: 'Number of Devices',
		            backgroundColor: '#b56576',
		            data: data
		        }]
		    },

		    // Configuration options go here
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
	</script>
	
	</div>

	
    <div>
	HUMIDITY
		<canvas id="gauge-chart" width="200" height="100" > </canvas>
		
		<?php
// Set gauge options
$gaugeOptions = array(
    'angle' => 0,
    'lineWidth' => 0.44,
    'radiusScale' => 1,
    'pointer' => array(
        'length' => 0.6,
        'strokeWidth' => 0.035,
        'color' => '#000000'
    ),
    'staticLabels' => array(
        'font' => '10px sans-serif',
        'labels' => array(0, 20, 40, 60, 80, 100),
        'fractionDigits' => 0
    ),
    'limitMax' => false,
    'limitMin' => false,
    'colorStart' => '#dc2f02',
    'colorStop' => '#ffa5ab',
    'strokeColor' => '#da627d',
    'generateGradient' => true
);

// Retrieve the gauge value from database
include('./connection.php');
$sql = "SELECT humidity FROM dht11 ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() > 0) {
    // Output device data as gauge chart
    $value = $row['humidity'];

    echo '<canvas id="gauge-chart"></canvas>';

    // Output script to create the gauge chart
    echo '<script>';
    echo 'var target = document.getElementById("gauge-chart");';
    echo 'var gauge = new Gauge(target).setOptions(' . json_encode($gaugeOptions) . ');';
    echo 'gauge.maxValue = 100;';
    echo 'gauge.setMinValue(0);';
    echo 'gauge.animationSpeed = 32;';
    echo 'gauge.set(' . $value . ');';
    echo '</script>';
} else {
    echo 'No device data found.';
}

$conn = null;
?>

	<p><?php echo "Humidity". $value; ?></p>

	
	</div>
    <div>
	TEMPERATURE
		<canvas id="gauge2" width="200" height="100" > </canvas>
		
		<?php
// Set gauge options
$gaugeOptions = array(
    'angle' => 0,
    'lineWidth' => 0.44,
    'radiusScale' => 1,
    'pointer' => array(
        'length' => 0.6,
        'strokeWidth' => 0.035,
        'color' => '#000000'
    ),
    'staticLabels' => array(
        'font' => '10px sans-serif',
        'labels' => array(0, 20, 40, 60, 80, 100),
        'fractionDigits' => 0
    ),
    'limitMax' => false,
    'limitMin' => false,
    'colorStart' => '#dc2f02',
    'colorStop' => '#ffa5ab',
    'strokeColor' => '#da627d',
    'generateGradient' => true
);

// Retrieve the gauge value from database
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
include("./ESP8266_DHT11_data_log_sql.php");
$sql = "SELECT temperature FROM dht11 ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() > 0) {
    // Output device data as gauge chart
    $value = $row['temperature'];

    echo '<canvas id="gauge2"></canvas>';
    echo 'Temperature: ' . $value;

    // Output script to create the gauge chart
    echo '<script>';
    echo 'var target = document.getElementById("gauge2");';
    echo 'var gauge = new Gauge(target).setOptions(' . json_encode($gaugeOptions) . ');';
    echo 'gauge.maxValue = 100;';
    echo 'gauge.setMinValue(0);';
    echo 'gauge.animationSpeed = 32;';
    echo 'gauge.set(' . $value . ');';
    echo '</script>';
} else {
    echo 'No device data found.';
}

$conn = null;
?>


		</div>

	<div style = "width: 500px;height: 200px;">
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
	$sql = "SELECT * FROM devices";
	$result = $conn->query($sql);

	// Check if there are any rows returned
	if ($result->rowCount() > 0) {
		// Output table header
		echo "<table>";
		echo "<tr><th>ID</th><th>Type</th><th>Location</th><th>User_Id</th><th>Status</th></tr>";

		// Output each row of data
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row["device_id"] . "</td>";
			echo "<td>" . $row["device_type"] . "</td>";
			echo "<td>" . $row["location"] . "</td>";
			echo "<td>" . $row["user_id"] . "</td>";
			echo "<td>" . $row["status"] . "</td>";
			echo "</tr>";
		}

		// Output table footer
		echo "</table>";
	} else {
		echo "No data found";
	}
?>

	</div>
	  <div>
		<h2>Div 6</h2>

		<p><a href="http://192.168.166.95/on" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 4px;">Turn On LED</a></p>

<p><a href="http://192.168.166.95/off" style="display: inline-block; padding: 10px 20px; background-color: #f44336; color: #fff; text-decoration: none; border-radius: 4px;">Turn Off LED</a></p>

	  </div>
	  <div>
		<h2>Coming Soon</h2>
		  </div>
	</div>
</body>
</html>     
