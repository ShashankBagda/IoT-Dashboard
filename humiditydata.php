<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IoT_Framework";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Number of Devices per Location</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gaugeJS/dist/gauge.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700|Open+Sans:400,600|Source Sans Pro:400,700">
  <link rel = "stylesheet" href="./css/dv.css">

</head>
<body>
<?php include 'sidebar.php'; ?>



	<!-- =================================================================================================================================== -->
  <!-- <div class ="content">
<div style="width:50%;" >
		
	</div>
  </div> -->
  <div style="width: 50%;
margin-bottom: 30px;
height: 50%;
background-color: #eee;
box-shadow: 0px 2px 10px #1b263b;
margin-left: 280px;
padding: 20px;
border-radius: 10px;">

			<canvas id="mycanvas2"></canvas>
      <?php
	// Query to select temperature data
	$sql = "SELECT temperature, timestamp FROM Temperature WHERE sensor_id = 1 AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY)";

	$result = mysqli_query($conn, $sql);

	// Create arrays for chart data
	$temperature_data = array();
	$timestamp_data = array();

	while($row = mysqli_fetch_assoc($result)) {
		$temperature_data[] = $row['temperature'];
		$timestamp_data[] = $row['timestamp'];
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
					borderColor: 'rgba(75, 192, 192, 1)',
					borderWidth: 1,
					hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)',
					hoverBorderColor: 'rgba(75, 192, 192, 1)',
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



  <div style="width: 50%;
margin-bottom: 30px;
height: 50%;
background-color: #eee;
box-shadow: 0px 2px 10px #1b263b;
margin-left: 280px;
padding: 20px;
border-radius: 10px;">
  <div  id="chart_pie"></div>

  </div>


  <div style="width: 50%;
margin-bottom: 30px;
height: 50%;
background-color: #eee;
box-shadow: 0px 2px 10px #1b263b;
margin-left: 280px;
padding: 20px;
border-radius: 10px;">
 <div  id="chart_scatter"></div>

 <?php

// Retrieve temperature and humidity data
$sql = "SELECT Temperature.temperature, Humidity.value FROM Temperature 
        JOIN Humidity ON Temperature.device_id = Humidity.device_id 
        WHERE Temperature.user_id = 1 AND Humidity.user_id = 1";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $temp = $row["temperature"];
    $humidity = $row["value"];
    $data[] = array($temp, $humidity);
    // Print data in console
    // echo "Temperature: " . $temp . ", Humidity: " . $humidity . "<br>";
  }
}

?>


 

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
  </div>


<div style="width: 50%;
margin-bottom: 30px;
height: 50%;
background-color: #eee;
box-shadow: 0px 2px 10px #1b263b;
margin-left: 280px;
padding: 20px;
border-radius: 10px;">
 <div id="chart_area"></div>

 <script>
  // Create trace for pie chart
  var trace1 = {
    labels: [<?php foreach($data as $d) { echo "'" . $d[0] . "',"; } ?>],
    values: [<?php foreach($data as $d) { echo $d[1] . ","; } ?>],
    type: 'pie'
  };

  // Set layout for pie chart
  var layout = {
    title: 'Device status breakdown'
  };

  // Display pie chart
  Plotly.newPlot('chart_pie', [trace1], layout);
</script>

<!-- ================================================================================================ -->

<?php
// Retrieve sensor measurement data
$sql = "SELECT Measurements.timestamp, Measurements.value, Sensors.sensor_type 
        FROM Measurements JOIN Sensors ON Measurements.sensor_id = Sensors.sensor_id 
        WHERE Sensors.user_id = 1 AND Measurements.timestamp >= '2022-01-01' 
        AND Measurements.timestamp <= '2023-12-31' AND Sensors.sensor_type IN ('sensor', 'device', 'actuator')";
$result = $conn->query($sql);

$data = array();
$sensor_types = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $timestamp = strtotime($row["timestamp"]);
    $sensor_type = $row["sensor_type"];
    if (!in_array($sensor_type, $sensor_types)) {
      $sensor_types[] = $sensor_type;
    }
    $data[$timestamp][$sensor_type] = $row["value"];
  }
}
ksort($data);

// Prepare data for plotly
$traces = array();
foreach ($sensor_types as $sensor_type) {
  $x = array();
  $y = array();
  foreach ($data as $timestamp => $measurements) {
    $x[] = date('Y-m-d H:i:s', $timestamp);
    $y[] = $measurements[$sensor_type] ?? null;
  }
  $trace = array(
    'x' => $x,
    'y' => $y,
    'type' => 'scatter',
    'mode' => 'lines',
    'name' => $sensor_type,
    'fill' => 'tonexty'
  );
  $traces[] = $trace;
}
?>

</div>

<div style="width: 50%;
margin-bottom: 30px;
height: 50%;
background-color: #eee;
box-shadow: 0px 2px 10px #1b263b;
margin-left: 280px;
padding: 20px;
border-radius: 10px;">

<div id="donut_chart"></div>
<?php

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Query to get the count of events by type
$sql = "SELECT event_type, COUNT(*) as count FROM Events GROUP BY event_type";
$result = mysqli_query($conn, $sql);

// Prepare the data for the chart
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[$row['event_type']] = $row['count'];
}
?>

<script>
var data = [{
  values: [<?php echo implode(", ", $data); ?>],
  labels: ['<?php echo implode("', '", array_keys($data)); ?>'],
  type: 'pie',
  hole: 0.4
}];

var layout = {
  title: 'Event Types Breakdown',
  height: 400,
  width: 500
};

Plotly.newPlot('donut_chart', data, layout);
</script>
</div>

  <div style="width: 50%;
margin-bottom: 30px;
height: 50%;
background-color: #eee;
box-shadow: 0px 2px 10px #1b263b;
margin-left: 280px;
padding: 20px;
border-radius: 10px;">
<div id="chart_box_plot"></div>

<?php

// Retrieve temperature data per location
$sql = "SELECT Temperature.temperature, Devices.location 
        FROM Temperature 
        JOIN Devices ON Temperature.device_id = Devices.device_id 
        WHERE Temperature.user_id = 1";

$result = $conn->query($sql);

$data = array();
$locations = array();

if ($result->num_rows > 0) {
  // Collect temperature data for each location
  while($row = $result->fetch_assoc()) {
    $location = $row["location"];
    $temperature = $row["temperature"];

    // Add location to list of locations
    if (!in_array($location, $locations)) {
      $locations[] = $location;
    }

    // Add temperature to data array
    $data[$location][] = $temperature;
  }
}

// Generate box plot data
$boxPlotData = array();

foreach ($locations as $location) {
  $boxPlotData[] = array(
    "y" => $data[$location],
    "type" => "box",
    "name" => $location
  );
}
?>


  <script>
    // Create box plot trace
    var trace = <?php echo json_encode($boxPlotData); ?>;

    // Set layout for box plot
    var layout = {
      title: 'Temperature Distribution per Location',
      xaxis: {
        title: 'Location'
      },
      yaxis: {
        title: 'Temperature'
      }
    };

    // Display box plot
    Plotly.newPlot('chart_box_plot', trace, layout);
  </script>

  </div>

	

	



<!-- Display area chart -->
<div id="chart_area"></div>
<script>
  var data = <?php echo json_encode($traces); ?>;
  var layout = {
    title: 'Sensor Measurements over Time',
    xaxis: {
      title: 'Time'
    },
    yaxis: {
      title: 'Measurement Value'
    },
    showlegend: true
  };
  Plotly.newPlot('chart_area', data, layout);
</script>

<!-- ================================================================================================ -->

<?php
// Retrieve device types per user
$sql = "SELECT user_id, device_type, COUNT(*) as count FROM Devices GROUP BY user_id, device_type";
$result = $conn->query($sql);

$data = array();
$users = array();
$deviceTypes = array();

if ($result->num_rows > 0) {
  // Collect data for each user and device type
  while($row = $result->fetch_assoc()) {
    $user = $row["user_id"];
    $deviceType = $row["device_type"];
    $count = $row["count"];

    // Add user to list of users
    if (!in_array($user, $users)) {
      $users[] = $user;
    }

    // Add device type to list of device types
    if (!in_array($deviceType, $deviceTypes)) {
      $deviceTypes[] = $deviceType;
    }

    // Add count to data array
    $data[$user][$deviceType] = $count;
  }
}

?>

<div id="chart_stacked_bar"></div>
Stacked Bar Chart: Device Types per User
<script>
  // Create traces for stacked bar chart
  var traces = [];

  <?php foreach($deviceTypes as $deviceType) { ?>
    var trace = {
      x: [<?php foreach($users as $user) { echo "'User $user',"; } ?>],
      y: [<?php foreach($users as $user) { echo $data[$user][$deviceType] . ","; } ?>],
      type: 'bar',
      name: '<?php echo $deviceType ?>'
    };
    traces.push(trace);
  <?php } ?>

  // Set layout for stacked bar chart
  var layout = {
    title: 'Device Types per User',
    xaxis: {
      title: 'User'
    },
    yaxis: {
      title: 'Number of Devices'
    },
    barmode: 'stack'
  };

  // Display stacked bar chart
  Plotly.newPlot('chart_stacked_bar', traces, layout);
</script>

<!-- ========================================================================================================== -->



<!-- ===================================================================================================== -->


<!-- ======================================================================================================== -->

</body>
</html>