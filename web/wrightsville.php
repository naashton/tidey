<?php    //Brandon Harris
	require 'includes/header.php'; ?>
  <head>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
  <script>
  $(document).ready(function() {
    var options = {
        chart: {
          renderTo: 'airtemp',
          defaultSeriesType: 'spline',
        },
    title: {
        text: 'Daily Air Temperature',
    },
    xAxis: {
	categories: []
    },
    yAxis: {
        title: {
          text: 'Temperature Degrees Farenheight'
        },
    },
    credits: {
        enabled: false
    },
        series: [{showInLegend: false,}]
      };

      $.getJSON('air_temp_chart.php', function(json) {
	options.xAxis.categories = json[0]['data'];
    	options.series[0].data = json[1].data;
    	chart = new Highcharts.Chart(options);
      });

    var options2 = {
        chart: {
          renderTo: 'watertemp',
          defaultSeriesType: 'spline',
        },
    title: {
        text: 'Daily Water Temperature',
    },
    xAxis: {
	categories: []
    },
    yAxis: {
        title: {
          text: 'Temperature Degrees Farenheight'
        },
    },
    credits: {
        enabled: false
    },
        series: [{showInLegend: false,}]
      };

      $.getJSON('water_temp_chart.php', function(json) {
	options2.xAxis.categories = json[0]['data'];
    	options2.series[0].data = json[1].data;
    	chart2 = new Highcharts.Chart(options2);
      });

    var options3 = {
        chart: {
          renderTo: 'airpressure',
          defaultSeriesType: 'spline',
        },
    title: {
        text: 'Daily Air Pressure',
    },
    xAxis: {
	categories: []
    },
    yAxis: {
        title: {
          text: 'Pressure mb'
        },
    },
    credits: {
        enabled: false
    },
        series: [{showInLegend: false,}]
      };

      $.getJSON('air_pressure_chart.php', function(json) {
	options3.xAxis.categories = json[0]['data'];
    	options3.series[0].data = json[1].data;
    	chart3 = new Highcharts.Chart(options3);
      });

    var options4 = {
        chart: {
          renderTo: 'wind',
          defaultSeriesType: 'spline',
        },
    title: {
        text: 'Daily Wind Speed',
    },
    xAxis: {
	categories: []
    },
    yAxis: {
        title: {
          text: 'Speed (mph)'
        },
    },
    credits: {
        enabled: false
    },
        series: [{showInLegend: false,}]
      };

      $.getJSON('wind_chart.php', function(json) {
	options4.xAxis.categories = json[0]['data'];
    	options4.series[0].data = json[1].data;
    	chart4 = new Highcharts.Chart(options4);
      });
    });
    </script>
    </head>
		<div class="container">
			<div class="row">
				<div class = "container">
				    <table>
					<tr>
					<div class="col-md-6 darkbg">
						<div id="airtemp">

						</div>
					</div>
					<div class="col-md-6">
						<div id="watertemp"

						</div>
					</div>
					</tr>
					<tr>
					<div class="col-md-6 darkbg">
						<div id="airpressure">

						</div>
					</div>
					<div class="col-md-6">
						<div id="wind"

						</div>
					</div>
					</tr>
				    </table>
				</div>
			</div>
		</div>

<?php include './includes/footer.php'; ?>
