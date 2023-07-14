<!DOCTYPE html>
<html>
<head>
	<title>Sidebar with toggle button</title>
	<link rel="stylesheet" href="./css/styles.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gaugeJS/dist/gauge.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700|Open+Sans:400,600|Source Sans Pro:400,700">
	
</head>
<body>
	<input type="checkbox" id="toggle" class="toggle-checkbox">
	<label for="toggle" class="toggle-label"><span class="toggle-icon"></span></label>
	<div class="sidebar">
		<div class="logo">
			<img src="" alt="Logo">
		</div>
		<a href="device.php"><i class="fa fa-cog"></i> Device Management</a>
        <a href="datavisual.php"><i class="fa fa-bar-chart"></i> Data Visualization</a>
        <a href="analytics.html"><i class="fa fa-line-chart"></i> Analytics & Insights</a>
        <a href="user.html"><i class="fa fa-user"></i> User Management</a>
        <a href="performance.html"><i class="fa fa-tachometer"></i> Performance </a>
	</div>

	

	  	<div class="content">
          <div id="chart_scatter"></div>
Scatter plot: Temperature vs. Humidity
  <script>
    // Create trace for scatter plot
    var trace1 = {
      x: [<?php foreach($data as $d) { echo $d[0] . ","; } ?>],
      y: [<?php foreach($data as $d) { echo $d[1] . ","; } ?>],
      mode: 'markers',
      type: 'scatter'
    };

    // Set layout for scatter plot
    var layout = {
      title: 'Temperature vs. Humidity',
      xaxis: {
        title: 'Temperature (°C)'
      },
      yaxis: {
        title: 'Humidity (%)'
      }
    };

    // Display scatter plot
    Plotly.newPlot('chart_scatter', [trace1], layout);
  </script>

<!-- ==================================================================================================
 -->
 <?php

include("./connection.php");
// Retrieve device status count
$sql = "SELECT status, COUNT(*) AS count FROM Devices GROUP BY status";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $status = $row["status"];
    $count = $row["count"];
    $data[] = array($status, $count);
  }
}

?>
    <div style="width:500px">
		<canvas id="myChart1"></canvas>
    <script>
      const ctx1 = document.getElementById('myChart1').getContext('2d');
      const chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
            label: 'My Dataset',
            data: [10, 20, 30, 40, 50, 60, 70],
            borderColor: '#15616d',
            borderWidth: 2,
            pointRadius: 5,
            pointBackgroundColor: '#15616d',
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
// $sql = "SELECT value FROM humidity";
$sql = "SELECT value FROM humidity ORDER BY timestamp DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// Output device data as gauge chart
	$row = $result->fetch_assoc();
	$value = $row['value'];

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

$conn->close();
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
include('./connection.php');
$sql = "SELECT temperature FROM temperature ORDER BY timestamp DESC";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// Output device data as gauge chart
	$row = $result->fetch_assoc();
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

$conn->close();
?>

		</div>

	<div style = "width: 500px;height: 200px;">
	<?php 
	include("./connection.php");


			$sql = "SELECT * FROM devices";
			$result = $conn->query($sql);

			// Check if there are any rows returned
			if ($result->num_rows > 0) {
			// Output table header
			echo "<table>";
			echo "<tr><th>ID</th><th>Type</th><th>Location</th><th>User_Id</th><th>Status</th></tr>";

			// Output each row of data
			while($row = $result->fetch_assoc()) {
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
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel dui magna. Morbi lacinia, velit quis porttitor pellentesque, magna lorem tincidunt ex, ac malesuada leo massa at quam.</p>
	  </div>
	  <div>
		<h2>Div 7</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel dui magna. Morbi lacinia, velit quis porttitor pellentesque, magna lorem tincidunt ex, ac malesuada leo massa at quam.</p>
	  </div>
	</div>
</body>
</html>     
