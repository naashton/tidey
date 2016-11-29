<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/17/16
 * Time: 8:50 PM
 * Generates a table for the 5-day forecast for beaufort by making function
 * calls to the tideyEngine.php
 */
/*
 * Uncomment these 2 required statements when pushing live
 */
//require '../src/tideyEngine.php';
require '../scripts/tideyEngine.php';
date_default_timezone_set('America/New_York');  //Corrects error where date() is not configured

$forecasts = array();
$forecasts[] = getForecastDay1("Morehead%20City");
$forecasts[] = getForecastDay2("Morehead%20City");
$forecasts[] = getForecastDay3("Morehead%20City");
$forecasts[] = getForecastDay4("Morehead%20City");
$forecasts[] = getForecastDay5("Morehead%20City");

echo "<div class=\"container\"><table class=\"table\">";
echo "<tr><td class=\"col-md-2 chart\">Date</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2 chart\">".$forecasts[$index]['Date']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Low (Fahrenheit)</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Low']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">High (Fahrenheit)</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['High']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Forecast</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Forecast']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Precipitation (%)</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Percipitation']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Thunder (%)</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Thunder']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Snow (%)</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Snow']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Wind Speed (mph)</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Wind Speed']."</td>";
}
echo "</tr>";

echo "<tr><td class=\"col-md-2 chart\">Wind Direction</td>";
for($index = 0; $index < count($forecasts); $index++){
    echo "<td class=\"col-md-2\">".$forecasts[$index]['Wind Direction']."</td>";
}
echo "</tr></table></div>";
