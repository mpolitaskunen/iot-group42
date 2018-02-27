<?php
	include("connect.php");
	
	$query="SELECT aikaleima,temp1,hum1 FROM weather ORDER BY aikaleima DESC limit 20"; 

	$result=mysqli_query($link,$query)or die(mysqli_error($link));
	
	$datapoints = array();
	while ($row_data = mysqli_fetch_assoc($result))
		$datapoints[] = $row_data;
	
	mysqli_free_result($result);
	mysqli_close($link);
	
	
?> 
<!DOCTYPE html>
<html>
<head>
<title>Sensor Data</title>
<link rel="stylesheet" href="morris.css">
<script src="https://code.jquery.com/jquery-1.9.0.js"></script>
<script src="raphael-min.js"></script>
<script src="morris.min.js"></script>
<meta http-equiv="refresh" content"60">

</head> 

<body>
<h1>Temperature / moisture sensor readings</h1>
<div id="morris-line-chart" style="height: 500px;"></div>

</body>
<script>
new Morris.Line({
	element: 'morris-line-chart',

	data: <?php echo json_encode($datapoints);?>,
	xkey: 'aikaleima',
	ykeys: ['temp1','hum1'],
	
	ymax: [50],


	labels: ['Temperature (C)', 'Humidity (%)'],

	lineColors: ['#0b62a4','#D58665'],
	xLabels: 'time',

	smooth: true,
	resize: true
});
</script>
</html>
