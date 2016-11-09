<?php 

$curl = curl_init();

//$product = "air_temperature";
//$product = "water_temperature";
//$product = "air_pressure";
//$product = "wind";
$temp_pressure = array("air_temperature", "water_temperature", "air_pressure");
$station = "8658163";

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://tidesandcurrents.noaa.gov/api/datagetter?range=24&station={$station}&product={$product}&units=english&time_zone=lst_ldt&format=json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
    echo "Curl Error #:" . $err;
} else {
    $json = json_decode($response, true); 
    print_r($json);

    $location = $json["metadata"]["name"];
    for($i=0; $i<count($json["data"]); $i++){
	$servername = "localhost";
	$username = "brk3269";
	$password = "carkorabi77888";

	$conn = mysqli_connect($servername, $username, $password, "brk3269");

	if (mysqli_connect_errno()) {
	    printf("Connection failed:\n", mysqli_connect_error());
	    exit();
	}
	printf("connection good");

	if (in_array($product, $temp_pressure)){
	    $t = $json["data"][$i]['t'];
	    $v = $json["data"][$i]['v'];

	}else if ($product = "wind"){
	    $t = $json["data"][$i]['t'];
	    $s = $json["data"][$i]['s'];
	    $d = $json["data"][$i]['dr'];
	}
	
	// Remove data out of database before adding new data
	if ($product == "air_temperature"){
	    $query = "insert into air_temp " . "values(\"" . $t ."\"," . $v .",\"" . $location ."\")";
	    printf($query);
        }else if ($product == "water_temperature"){
	    $query = "insert into water_temp " . "values(\"" . $t ."\"," . $v .",\"" . $location ."\")";
	    printf($query);
	}else if ($product == "air_pressure"){
	    $query = "insert into air_pressure " . "values(\"" . $t ."\"," . $v .",\"" . $location ."\")";
	    printf($query);
	}else if ($product == "wind"){
	    $query = "insert into wind " . "values(\"" . $t ."\"," . $s .",\"" . $d ."\",\"" . $location ."\")";
	    printf($query); 
	}
	mysqli_query($conn, $query) or die(mysqli_error($conn));
   }
}
?>
