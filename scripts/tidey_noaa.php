<?php 

$curl = curl_init();

$stations = array("8658163");
for($s = 0; $s < count($stations); $s++){
    $station = $stations[$s];
	$products = array("air_temperature", "water_temperature", "air_pressure", "wind");
	for($p = 0; $p < count($products); $p++){
		$product = $products[$p];
		$temp_pressure = array("air_temperature", "water_temperature", "air_pressure");

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

		    $servername = "localhost";
		    $username = "brk3269";
		    $password = "carkorabi77888";

		    $conn = mysqli_connect($servername, $username, $password, "brk3269");

		    if (mysqli_connect_errno()) {
			printf("Connection failed:\n", mysqli_connect_error());
			exit();
		    }
		    printf("connection good");
	            mysqli_query($conn, "truncate table $product;") or die(mysqli_error($conn));

		    for($i=0; $i<count($json["data"]); $i++){

			if (in_array($product, $temp_pressure)){
			    $t = $json["data"][$i]['t'];
			    $v = $json["data"][$i]['v'];

			}else if ($product = "wind"){
			    $t = $json["data"][$i]['t'];
			    $s = $json["data"][$i]['s'];
			    $d = $json["data"][$i]['dr'];
			}
			

			if ($product == "air_temperature"){
			    $query = "insert into air_temperature " . "values(\"" . $t ."\"," . $v .",\"" . $location ."\")";
			    printf($query);
			}else if ($product == "water_temperature"){
			    $query = "insert into water_temperature " . "values(\"" . $t ."\"," . $v .",\"" . $location ."\")";
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
		    if ($product == "air_temperature"){
			mysqli_query($conn, "drop view AIR_TEMP_Wrightsville") or die(mysqli_error($conn));
			$query_create_view = "create view AIR_TEMP_Wrightsville as select ttime, air_temperature from air_temperature where location='Wrightsville Beach';";
			mysqli_query($conn, $query_create_view) or die(mysqli_error($conn));
		    }else if ($product == "water_temperature"){
			mysqli_query($conn, "drop view WATER_TEMP_Wrightsville") or die(mysqli_error($conn));
			$query_create_view = "create view WATER_TEMP_Wrightsville as select ttime, water_temperature from water_temperature where location='Wrightsville Beach';";	
			mysqli_query($conn, $query_create_view) or die(mysqli_error($conn));
		    }
		}
	}
}
?>
