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
//require '/includes/header.php';
//require '../src/tideyEngine.php';
require 'tideyEngine.php';
date_default_timezone_set('America/New_York');  //Corrects error where date() is not configured
?>

<!DOCTYPE html>
<html>
<body>
<main>
    <form action="tideyEngine.php">
        Search Weather:
        <input type="search" name="city">
        <input type="submit">
    </form>
    <div class="container">
        <h1>Forecast:</h1><br>
        <h3>Table</h3>
        <table>
            <tr>Weather Forecast:</tr>
        <?php
        $resp = fetchResponse();
        $forecast = getForecast();
        foreach($forecast as $key => $value){ ?>
            <tr>
                <td><?php echo $key . ": " . $value ?></td>
            </tr>
        <?php } ?>

        </table>
    </div>
</main>

</body>
</html>

