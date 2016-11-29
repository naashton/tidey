<?php
/*********************
* Tidey 2016
* CSC 455 Utilizing a Prepared Statement
* tides_stations.php sets up a connection to each NOAA station that
* Tidey interacts with to receive weather data information to store
* in the database.
*********************/
$servername = "localhost";
$username = "brk3269";
$password = "carkorabi77888";

$conn = mysqli_connect($servername, $username, $password, "brk3269");

if (mysqli_connect_errno()) {
    printf("Connection failed:\n", mysqli_connect_error());
    exit();
}
printf("connection good");

$SQL = "insert into station (location, latitude, longitude) values (?,?,?)";

if($stmt = $conn->prepare($SQL)){
    if (!$stmt->bind_param("sss", $location, $latitude, $longitude)) {
	echo "Binding params failed: (" . $stmt->errno . ") " . $stmt->$error;
    }

    $location = "Beaufort";
    $latitude = "34";
    $longitude = "76";

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $location = "Sample Beach";
    $latitude = "77";
    $longitude = "77";

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
}

?>
