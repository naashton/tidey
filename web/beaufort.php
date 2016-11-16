<?php    //Brandon Harris
	require 'includes/header.php'; ?>
  <head>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
  <script>
  $(document).ready(function() {
/**
 * (c) 2010-2016 Torstein Honsi
 *
 * License: www.highcharts.com/license
 *
 * Dark theme for Highcharts JS
 * @author Torstein Honsi
 */

'use strict';
/* global document */
// Load the fonts
Highcharts.createElement('link', {
   href: 'https://fonts.googleapis.com/css?family=Unica+One',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
   colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
      '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
   chart: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, '#2a2a2b']
         ]
      },
      style: {
         fontFamily: '\'Unica One\', sans-serif'
      },
      plotBorderColor: '#606063'
   },
   title: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
   },
   subtitle: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase'
      }
   },
   xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3'
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0'
      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: '#B0B0B3'
         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
   },
   legend: {
      itemStyle: {
         color: '#E0E0E3'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666'
      }
   },
   labels: {
      style: {
         color: '#707073'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },

   // special colors for some of the
   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
   background2: '#505053',
   dataLabelsColor: '#B0B0B3',
   textColor: '#C0C0C0',
   contrastTextColor: '#F0F0F3',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);

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
          text: 'Temperature (Degrees Farenheight)'
        },
    },
    credits: {
        enabled: false
    },
        series: [{showInLegend: false,}]
      };

      $.getJSON('air_temp_chart_beaufort.php', function(json) {
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
          text: 'Temperature (Degrees Farenheight)'
        },
    },
    credits: {
        enabled: false
    },
        series: [{showInLegend: false,}]
      };

      $.getJSON('water_temp_chart_beaufort.php', function(json) {
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
          text: 'Pressure (mb)'
        },
    },
    credits: {
        enabled: false
    },
        series: [{showInLegend: false,}]
      };

      $.getJSON('air_pressure_chart_beaufort.php', function(json) {
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

      $.getJSON('wind_chart_beaufort.php', function(json) {
	options4.xAxis.categories = json[0]['data'];
    	options4.series[0].data = json[1].data;
    	chart4 = new Highcharts.Chart(options4);
      });
    });
    </script>
    </head>
	<body>
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
                                        <tr>
                                             <div class="col-md-6">
                                                 <?php include 'tides_table_beaufort.php'; ?>
                                             </div>
                                        </tr>
				    </table>
				</div>
			</div>
		</div>
	</body>

<?php include './includes/footer.php'; ?>
