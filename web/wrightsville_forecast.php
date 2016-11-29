<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/17/16
 * Time: 8:50 PM
 */
/*
 * Uncomment these 2 required statements when pushing live
 */
require 'includes/header.php';
//require '../src/tideyEngine.php';
require '../scripts/tideyEngine.php';
date_default_timezone_set('America/New_York');  //Corrects error where date() is not configured

$forecasts = array();
$forecasts[] = getForecastDay1("Wrightsville%20Beach");
$forecasts[] = getForecastDay2("Wrightsville%20Beach");
$forecasts[] = getForecastDay3("Wrightsville%20Beach");
$forecasts[] = getForecastDay4("Wrightsville%20Beach");
$forecasts[] = getForecastDay5("Wrightsville%20Beach");

echo "<div class=\"container\"><table class=\"table\">";
echo "<tr><td class=\"col-md-2\">Date</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-1\">".$forecasts[$index]['Date']."</td>";
}
echo "</tr>";

echo "<tr><td>Low</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['Low']."</td>";
}
echo "</tr>";

echo "<tr><td>High</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['High']."</td>";
}
echo "</tr>";

echo "<tr><td>Forecast</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['Forecast']."</td>";
}
echo "</tr>";

echo "<tr><td>Precipitation</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['Percipitation']."</td>";
}
echo "</tr>";

echo "<tr><td>Thunder</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['Thunder']."</td>";
}
echo "</tr>";

echo "<tr><td>Snow</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['Snow']."</td>";
}
echo "</tr>";

echo "<tr><td>Wind Speed</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['Wind Speed']."</td>";
}
echo "</tr>";

echo "<tr><td>Wind Direction</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td>".$forecasts[$index]['Wind Direction']."</td>";
}
echo "</tr></div>";

