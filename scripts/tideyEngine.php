<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/2/16
 * Time: 11:14 AM
 -----------------------------------------------------------------------------------------------------------------------
 * Execute from terminal:
 * php -S localhost:8080 -t "/home/nick/Projects/tidey/src"
 * open a browser and go to: localhost:8080/tideyEngine.php
 */

//global $base_url;
$apikey = "apikey=pBJxClBZXLvYp0VUwAw98XdKguS16GIC";  //This is the AccuWeather API Key from November 2, 2016 + 180 days
$base_url = "http://dataservice.accuweather.com/";

/**
 * Get location based on IP Address
 */
function getLocation(){
    //$value should be either city, ip address, or geo-location
    global $base_url, $apikey;
    $api_url = "locations/v1/cities/";
    //Uncomment this variable when pushing live
    //$ip_addr = $_SERVER['REMOTE_ADDR'];
    $ip_addr = "152.20.106.38"; //my ip address
    
    $target_addr = $base_url . $api_url . "ipaddress?" . $apikey . "%20&q=" . $ip_addr;

    //echo $target_addr . "<br>";

    $response = file_get_contents($target_addr);
    $json_res = json_decode($response, true);

    $loc_key = $json_res['Key'];
    //echo "<br>", "Location Key:", "<br>";
    //echo $loc_key;
    //echo $json_res;

    return $loc_key;
}

/**
 *
 */
function getForecast(){
    global $base_url, $apikey;
    $loc_key = "329819";
    //$api_url = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/329819?apikey=pBJxClBZXLvYp0VUwAw98XdKguS16GIC";
    $forecast_url = "forecasts/v1/daily/5day/";
    $target_addr = $base_url . $forecast_url . $loc_key . "?" . $apikey;
    $response = file_get_contents($target_addr);
    $json_res = json_decode($response, true);

    foreach($json_res['DailyForecasts'] as $daily){
        //echo $daily;
        pass;
    }
    echo $target_addr, "<br>";
    echo $json_res['DailyForecasts'][0]['Date'], "<br>";
    echo $json_res['DailyForecasts'][1]['Date'], "<br>";
    echo $json_res['DailyForecasts'][0]['Day']['IconPhrase'], "<br>";
}

getForecast();
getLocation();
//echo $_SERVER['REMOTE_ADDR'];
?>