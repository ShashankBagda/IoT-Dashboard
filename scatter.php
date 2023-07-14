<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <title>Document</title>
</head>
<body>
    
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

// Retrieve device status count
include("./connection.php");
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
</body>
</html>

