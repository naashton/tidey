<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/17/16
 * Time: 8:50 PM
 * Fetches and presents the 5-day forecast for Wrightsville beach in a table
 */
/*
 * Uncomment these 2 required statements when pushing live
 */
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
echo "<tr><td class=\"col-md-2 chart\">Date</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2 chart\">".$forecasts[$index]['Date']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Low</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Low']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">High</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['High']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Forecast</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Forecast']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Precipitation</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Percipitation']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Thunder</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Thunder']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Snow</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Snow']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Wind Speed</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Wind Speed']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Wind Direction</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Wind Direction']."</td>";
}
echo "</tr></table></div>";
