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
          text: 'Temperature'
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
          text: 'Temperature'
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
    });
    </script>
    </head>
		<div class="container">
			<div class="row">
				<div class = "container">
					<div class="col-md-6 darkbg">
						<div id="airtemp">

						</div>
					</div>
					<div class="col-md-6">
						<div id="watertemp"

						</div>
					</div>
				</div>
			</div>
		</div>

<?php include './includes/footer.php'; ?>
