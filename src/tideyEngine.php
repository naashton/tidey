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
$apikey = "apikey=O0VMhZn0cW9ipfmzbWp3LRko2UOhOCNq";
//$apikey = "apikey=pBJxClBZXLvYp0VUwAw98XdKguS16GIC";  //This is the AccuWeather API Key from November 2, 2016 + 180 days
$base_url = "http://dataservice.accuweather.com/";

if(isset($_POST['submit'])){
    $city = $_POST['city'];
    echo $city;
}

//echo "Test";


/*
 * Test the connection, used to assign default values to variables in the forecast array
 */
function isConnected(){
    global $base_url;

    $connected = @fsockopen("google.com", 80);

    if($connected){
        $is_conn = true;
        //echo "Online";
    }
    else{
        $is_conn = false;
        //echo "Offline";
    }

    return $is_conn;

}

/**
 * Search location using autocomplete search
 */
function searchLocation($city){
    global $base_url, $apikey;
    $api_url = "locations/v1/cities/";
    //$loc_string = "wilmi";
    $loc_string = $city;

    $target_addr = $base_url . $api_url . "autocomplete?" . $apikey . "%20&q=" . $loc_string;
    echo $target_addr;
    echo "<br>";
    $response = file_get_contents($target_addr);
    $json_res = json_decode($response, true);

    $loc_key = $json_res[0]['Key'];
    //echo $loc_key;

    return $loc_key;
}
/**
 * Get location based on IP Address
 */
function getLocation(){
    //$value should be either city, ip address, or geo-location
    global $base_url, $apikey;
    $api_url = "locations/v1/cities/";
    //Get ip address to find local
    //"http://dataservice.accuweather.com/locations/v1/cities/ipaddress?apikey=O0VMhZn0cW9ipfmzbWp3LRko2UOhOCNq&q=152.20.105.160"
    $ip_addr = $_SERVER['REMOTE_ADDR'];
    //Target address used to fetch response from accu weather
    $target_addr = $base_url . $api_url . "ipaddress?" . $apikey . "&q=" . $ip_addr;

    //echo $target_addr;

    $response = file_get_contents($target_addr);
    $json_res = json_decode($response, true);
    $loc_key = $json_res['Key'];

    //$response = connectAPI($target_addr);
    //$loc_key = $response['Key'];
    //echo $response;

    //echo $loc_key;
    return $loc_key;
}

/**
 * Use location key returned from getLocation() function and make call to the Accu Weather API to get the 5-day
 * forecast and return the data in a json format.
 */
function fetchResponse(){
    //store 5-day forecasts
    $dates_arr = [];
    $forecast_arr[] = [];
    global $base_url, $apikey;

    //$loc_key = "329819"; //city key for Wilmington
    $loc_key = getLocation();

    $forecast_url = "forecasts/v1/daily/5day/";
    $target_addr = $base_url . $forecast_url . $loc_key . "?" . $apikey . "&details=true";

    $response = file_get_contents($target_addr);
    $json_res = json_decode($response, true);

    //$response = connectAPI($target_addr);
    //echo $response;

    //return $response;
    return $json_res;

}

/**
 * @return array that contains forecast details
 */
function getForecastDay1(){
    //$forecast = array();
    $is_conn = isConnected();  //Check the connection to the API
    $response = fetchResponse();

    $isoDate = $response['DailyForecasts'][0]['Date'];
    //format the date
    $date = date('M, j', strtotime($isoDate));
    $tempLow = $response['DailyForecasts'][0]['Temperature']['Minimum']['Value'];
    $tempHigh = $response['DailyForecasts'][0]['Temperature']['Maximum']['Value'];
    $dayPhrase = $response['DailyForecasts'][0]['Day']['IconPhrase'];
    $percipProb = $response['DailyForecasts'][0]['Day']['PercipitationProbability'];
    $thunderProb = $response['DailyForecasts'][0]['Day']['ThunderstormProbability'];
    $snowProb = $response['DailyForecasts'][0]['Day']['SnowProbability'];
    $windSpeed = $response['DailyForecasts'][0]['Day']['Wind']['Speed']['Value'];
    $windDirection = $response['DailyForecasts'][0]['Day']['Wind']['Direction']['Localized'];

    if($is_conn) {
        $forecast = array("Date" => $date, "Low" => $tempLow, "High" => $tempHigh, "Forecast" => $dayPhrase, "Percipitation" => $percipProb,
            "Thunder" => $thunderProb, "Snow" => $snowProb, "Wind Speed" => $windSpeed, "Wind Direction" => $windDirection);
    }
    else{
        $forecast = array("Date" => "Date", "Low" => "Low Temp", "High" => "High Temp", "Forecast" => "Forecast", "Percipitation" => "Percipitation",
            "Thunder" => "Thunderstorms", "Snow" => "Snowstorms", "Wind Speed" => "Wind Speed", "Wind Direction" => "Wind Direction");
    }

    return $forecast;
}

/**
 * @return array that contains forecast details
 */
function getForecastDay2(){
    //$forecast = array();
    $is_conn = isConnected();  //Check the connection to the API
    $response = fetchResponse();

    $isoDate = $response['DailyForecasts'][1]['Date'];
    //format the date
    $date = date('M, j', strtotime($isoDate));
    $tempLow = $response['DailyForecasts'][1]['Temperature']['Minimum']['Value'];
    $tempHigh = $response['DailyForecasts'][1]['Temperature']['Maximum']['Value'];
    $dayPhrase = $response['DailyForecasts'][1]['Day']['IconPhrase'];
    $percipProb = $response['DailyForecasts'][1]['Day']['PercipitationProbability'];
    $thunderProb = $response['DailyForecasts'][1]['Day']['ThunderstormProbability'];
    $snowProb = $response['DailyForecasts'][1]['Day']['SnowProbability'];
    $windSpeed = $response['DailyForecasts'][1]['Day']['Wind']['Speed']['Value'];
    $windDirection = $response['DailyForecasts'][1]['Day']['Wind']['Direction']['Localized'];

    if($is_conn) {
        $forecast = array("Date" => $date, "Low" => $tempLow, "High" => $tempHigh, "Forecast" => $dayPhrase, "Percipitation" => $percipProb,
            "Thunder" => $thunderProb, "Snow" => $snowProb, "Wind Speed" => $windSpeed, "Wind Direction" => $windDirection);
    }
    else{
        $forecast = array("Date" => "Date", "Low" => "Low Temp", "High" => "High Temp", "Forecast" => "Forecast", "Percipitation" => "Percipitation",
            "Thunder" => "Thunderstorms", "Snow" => "Snowstorms", "Wind Speed" => "Wind Speed", "Wind Direction" => "Wind Direction");
    }

    return $forecast;
}

/**
 * @return array that contains forecast details
 */
function getForecastDay3(){
    //$forecast = array();
    $is_conn = isConnected();  //Check the connection to the API
    $response = fetchResponse();

    $isoDate = $response['DailyForecasts'][2]['Date'];
    //format the date
    $date = date('M, j', strtotime($isoDate));
    $tempLow = $response['DailyForecasts'][2]['Temperature']['Minimum']['Value'];
    $tempHigh = $response['DailyForecasts'][2]['Temperature']['Maximum']['Value'];
    $dayPhrase = $response['DailyForecasts'][2]['Day']['IconPhrase'];
    $percipProb = $response['DailyForecasts'][2]['Day']['PercipitationProbability'];
    $thunderProb = $response['DailyForecasts'][2]['Day']['ThunderstormProbability'];
    $snowProb = $response['DailyForecasts'][2]['Day']['SnowProbability'];
    $windSpeed = $response['DailyForecasts'][2]['Day']['Wind']['Speed']['Value'];
    $windDirection = $response['DailyForecasts'][2]['Day']['Wind']['Direction']['Localized'];

    if($is_conn) {
        $forecast = array("Date" => $date, "Low" => $tempLow, "High" => $tempHigh, "Forecast" => $dayPhrase, "Percipitation" => $percipProb,
            "Thunder" => $thunderProb, "Snow" => $snowProb, "Wind Speed" => $windSpeed, "Wind Direction" => $windDirection);
    }
    else{
        $forecast = array("Date" => "Date", "Low" => "Low Temp", "High" => "High Temp", "Forecast" => "Forecast", "Percipitation" => "Percipitation",
            "Thunder" => "Thunderstorms", "Snow" => "Snowstorms", "Wind Speed" => "Wind Speed", "Wind Direction" => "Wind Direction");
    }

    return $forecast;
}

/**
 * @return array that contains forecast details
 */
function getForecastDay4(){
    //$forecast = array();
    $is_conn = isConnected();  //Check the connection to the API
    $response = fetchResponse();

    $isoDate = $response['DailyForecasts'][3]['Date'];
    //format the date
    $date = date('M, j', strtotime($isoDate));
    $tempLow = $response['DailyForecasts'][3]['Temperature']['Minimum']['Value'];
    $tempHigh = $response['DailyForecasts'][3]['Temperature']['Maximum']['Value'];
    $dayPhrase = $response['DailyForecasts'][3]['Day']['IconPhrase'];
    $percipProb = $response['DailyForecasts'][3]['Day']['PercipitationProbability'];
    $thunderProb = $response['DailyForecasts'][3]['Day']['ThunderstormProbability'];
    $snowProb = $response['DailyForecasts'][3]['Day']['SnowProbability'];
    $windSpeed = $response['DailyForecasts'][3]['Day']['Wind']['Speed']['Value'];
    $windDirection = $response['DailyForecasts'][3]['Day']['Wind']['Direction']['Localized'];

    if($is_conn) {
        $forecast = array("Date" => $date, "Low" => $tempLow, "High" => $tempHigh, "Forecast" => $dayPhrase, "Percipitation" => $percipProb,
            "Thunder" => $thunderProb, "Snow" => $snowProb, "Wind Speed" => $windSpeed, "Wind Direction" => $windDirection);
    }
    else{
        $forecast = array("Date" => "Date", "Low" => "Low Temp", "High" => "High Temp", "Forecast" => "Forecast", "Percipitation" => "Percipitation",
            "Thunder" => "Thunderstorms", "Snow" => "Snowstorms", "Wind Speed" => "Wind Speed", "Wind Direction" => "Wind Direction");
    }

    return $forecast;
}

/**
 * @return array that contains forecast details
 */
function getForecastDay5(){
    //$forecast = array();
    $is_conn = isConnected();  //Check the connection to the API
    $response = fetchResponse();

    $isoDate = $response['DailyForecasts'][4]['Date'];
    //format the date
    $date = date('M, j', strtotime($isoDate));
    $tempLow = $response['DailyForecasts'][4]['Temperature']['Minimum']['Value'];
    $tempHigh = $response['DailyForecasts'][4]['Temperature']['Maximum']['Value'];
    $dayPhrase = $response['DailyForecasts'][4]['Day']['IconPhrase'];
    $percipProb = $response['DailyForecasts'][4]['Day']['PercipitationProbability'];
    $thunderProb = $response['DailyForecasts'][4]['Day']['ThunderstormProbability'];
    $snowProb = $response['DailyForecasts'][4]['Day']['SnowProbability'];
    $windSpeed = $response['DailyForecasts'][4]['Day']['Wind']['Speed']['Value'];
    $windDirection = $response['DailyForecasts'][4]['Day']['Wind']['Direction']['Localized'];

    if($is_conn) {
        $forecast = array("Date" => $date, "Low" => $tempLow, "High" => $tempHigh, "Forecast" => $dayPhrase, "Percipitation" => $percipProb,
            "Thunder" => $thunderProb, "Snow" => $snowProb, "Wind Speed" => $windSpeed, "Wind Direction" => $windDirection);
    }
    else{
        $forecast = array("Date" => "Date", "Low" => "Low Temp", "High" => "High Temp", "Forecast" => "Forecast", "Percipitation" => "Percipitation",
            "Thunder" => "Thunderstorms", "Snow" => "Snowstorms", "Wind Speed" => "Wind Speed", "Wind Direction" => "Wind Direction");
    }

    return $forecast;
}

function getCurrent(){
    global $base_url, $apikey;

    //$loc_key = "329819";
    $loc_key = getLocation();
    $conditions_url = "currentconditions/v1/";
    //http://dataservice.accuweather.com/currentconditions/v1/329819?apikey=pBJxClBZXLvYp0VUwAw98XdKguS16GIC
    $target_addr = $base_url . $conditions_url . $loc_key . "?" . $apikey;

    $response = file_get_contents($target_addr);
    $json_res = json_decode($response, true);

    $conditions = $json_res[0]['WeatherText'];
    $icon = $json_res[0]['WeatherIcon'];
    $is_day_time = $json_res[0]['IsDayTime'];
    $temp = $json_res[0]['Temperature']['Imperial']['Value'];

    $current_conditions = array("Conditions" => $conditions, "Temperature" => $temp);

    /*
    foreach($current_conditions as $item){
        echo $item . "<br>";
    }
    */

    return $current_conditions;
}

/**
 * Encountering error where HTTP request is giving a 401 authentication error
 * This function attempts to resolve that issue using curl
 * @return mixed
 */
function connectAPI($url){
    //$url = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/329819?apikey=pBJxClBZXLvYp0VUwAw98XdKguS16GIC";
    $url = $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);

    return $data;
}

//getLocation();
//fetchResponse();
//echo connectAPI();
//getCurrent();
?>


