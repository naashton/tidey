<?php 

$servername = "127.0.0.1";
$username = "brk3269";
$password = "carkorabi77888";

$conn = mysqli_connect($servername, $username, $password, "brk3269");

if (mysqli_connect_errno()) {
    printf("Connection failed:\n", mysqli_connect_error());
    exit();
}

$query = "select ttime, water_temperature from water_temp;";
$data = array();
$data['water_temp'] = 'Time';
if ($result = mysqli_query($conn, $query)) {
    while($row = mysqli_fetch_assoc($result)){
	$data['data'][] = $row["ttime"];
    }
}

$data2= array();
$data2['water_temp'] = 'WaterTemp';
if ($result = mysqli_query($conn, $query)) {
    while($row = mysqli_fetch_assoc($result)){
	$data2['data'][] = $row["water_temperature"];
    }
}

$result = array();
array_push($result, $data);
array_push($result, $data2);
print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($conn);
?>
