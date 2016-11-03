<?php 

$servername = "localhost";
$username = "brk3269";
$password = "carkorabi77888";

$conn = mysqli_connect($servername, $username, $password, "brk3269");

if (mysqli_connect_errno()) {
    printf("Connection failed:\n", mysqli_connect_error());
    exit();
}

$query = "select ttime, water_temperature from water_temp;";
$data = array();

if ($result = mysqli_query($conn, $query)) {

    while($row = mysqli_fetch_assoc($result)){
	$data[] = "[".$row["ttime"].",".$row["water_temperature"]."]";
    }
    echo json_encode($data);
    mysqli_free_result($result);
}

mysqli_close($conn);
?>
