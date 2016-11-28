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
require './web/includes/header.php';
//require '../src/tideyEngine.php';
require 'tideyEngine.php';
date_default_timezone_set('America/New_York');  //Corrects error where date() is not configured
?>

<!DOCTYPE html>
<html>
<body>
<main>
    <div class="container">
        <!--form action="tideyEngine.php">
            Search Weather:
            <input type="search" name="city" value="Search for city">
            <input type="submit" name="submit" value="Search">
        </form -->

        <h1>5 Day Forecast:</h1><br>
        <table style="float: left;">
        <?php
        $resp = fetchResponse();
        $forecast = getForecastDay1();
        foreach($forecast as $key => $value){ ?>
            <tr>
                <td><?php echo $key . ": " . $value ?></td>
            </tr>
        <?php } ?>
        </table>

        <table style="float: left;">
            <?php
            $resp = fetchResponse();
            $forecast = getForecastDay2();
            foreach($forecast as $key => $value){ ?>
                <tr>
                    <td><?php echo $key . ": " . $value ?></td>
                </tr>
            <?php } ?>
        </table>

        <table style="float: left;">
            <?php
            $resp = fetchResponse();
            $forecast = getForecastDay3();
            foreach($forecast as $key => $value){ ?>
                <tr>
                    <td><?php echo $key . ": " . $value ?></td>
                </tr>
            <?php } ?>
        </table>

        <table style="float: left;">
            <?php
            $resp = fetchResponse();
            $forecast = getForecastDay4();
            foreach($forecast as $key => $value){ ?>
                <tr>
                    <td><?php echo $key . ": " . $value ?></td>
                </tr>
            <?php } ?>
        </table>

        <table style="float: left;">
            <?php
            $resp = fetchResponse();
            $forecast = getForecastDay5();
            foreach($forecast as $key => $value){ ?>
                <tr>
                    <td><?php echo $key . ": " . $value ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</main>

</body>
<html>

