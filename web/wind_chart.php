<?php 

$servername = "127.0.0.1";
$username = "brk3269";
$password = "carkorabi77888";

$conn = mysqli_connect($servername, $username, $password, "brk3269");

if (mysqli_connect_errno()) {
    printf("Connection failed:\n", mysqli_connect_error());
    exit();
}

$query = "select * from WIND_Wrightsville;";
$data = array();
$data['air_temp'] = 'Time';
if ($result = mysqli_query($conn, $query)) {
while($row = mysqli_fetch_assoc($result)){
    $data['data'][] = $row["ttime"];
}
}

$data2= array();
$data2['speed'] = 'Speed';
if ($result = mysqli_query($conn, $query)) {
while($row = mysqli_fetch_assoc($result)){
    $data2['data'][] = $row["speed"];
}
}

$result = array();
array_push($result, $data);
array_push($result, $data2);
print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($conn);
?>
