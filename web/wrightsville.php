<?php
  //Brandon Harris
	require 'includes/header.php'; ?>

	<head>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
	</head>

	<div class="container">
	  <div class="row">
			<div class = "container">
		    <div class="col-md-6">
					<div id="airtemp">
						<script>
							$(function () {
							$.getJSON('../scripts/tidey_charts.php', function (data) {

									Highcharts.chart('airtemp', {
											chart: {
													zoomType: 'x'
											},
											title: {
													text: 'Air Temperature'
											},
											xAxis: {
													type: 'Time'
											},
											yAxis: {
													title: {
															text: 'Temperature'
													}
											},
											legend: {
													enabled: false
											},
											plotOptions: {
													area: {
															fillColor: {
																	linearGradient: {
																			x1: 0,
																			y1: 0,
																			x2: 0,
																			y2: 1
																	},
																	stops: [
																			[0, Highcharts.getOptions().colors[0]],
																			[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
																	]
															},
															marker: {
																	radius: 2
															},
															lineWidth: 1,
															states: {
																	hover: {
																			lineWidth: 1
																	}
															},
															threshold: null
													}
											},

											series: [{
													type: 'area',
													name: 'Air Temperature',
													data: data
											}]
									});
							});
						});
						</script>
					</div>
				</div>
				<div class="col-md-6">
					<div id="watertemp"
						<em>Insert graph here</em>
					</div>
				</div>
			</div>
	  </div>
	</div>


<?php include './includes/footer.php'; ?>
