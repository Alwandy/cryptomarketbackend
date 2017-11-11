
<?php 
setlocale(LC_MONETARY, 'en_US');
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NeuMarketCap</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="/css/app.css">  
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">  
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
    <div class="cover">
    <div class="clearfix"></div>
    <nav class="navbar navbar-expand-lg">
            <span class="navbar-brand mb-0 h1">NeuMarketCap</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-end" id="navbarNav">
              <ul class="nav justify-content-end">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Exchange</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Sponsors</a>
                </li>
              </ul>
            </div>
          </nav>
          <div class="container" align="center" style="margin-top:150px">
                <h1 class="text-center">Check today market currency worth!</h1>
                <h3 class="text-center">NeuMarketCap provides you the need to browse worlds cryptocurrency and get list of verified exchanges</h3>
               <br>
                <div class="col-sm-3">          
                <div class="input-group stylish-input-group">
                                <input type="text" class="form-control"  placeholder="Search" >
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="fa fa-search"></span>
                                    </button>  
                                </span>
                            </div>
                </div>
            </div>
        </div>

        <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Market Cap</th>
                    <th scope="col">Price</th>
                    <th scope="col">Volume (24h)</th>
                    <th scope="col">Circulating Supply</th>
                    <th scope="col">Change (24h)</th>
                    <th scope="col">Price Graph (7d)</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($currencies as $currency)
                @if($loop->index < 15)
                  <tr>
                    <th scope="row">{{$currency['SortOrder']}}</th>
                    <td><a href="/currency/{{$currency['Name']}}">{{$currency['CoinName']}}</a></td>
                    <td>WIP</td>
                    <td>WIP</td>
                    <td>WIP</td>
                    <td>WIP</td>
                    <td>WIP</td>
                    <td>
                        <div style="height:5%; width:70%;">
                            <canvas id="myChart"></canvas>
                        </div>
                    </td>
               
                  </tr>
                 
                  @endif
                  @endforeach
                </tbody>
              </table>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
  'use strict';

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

(function(global) {
	var Months = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];

	var COLORS = [
		'#4dc9f6',
		'#f67019',
		'#f53794',
		'#537bc4',
		'#acc236',
		'#166a8f',
		'#00a950',
		'#58595b',
		'#8549ba'
	];

	var Samples = global.Samples || (global.Samples = {});
	var Color = global.Color;

	Samples.utils = {
		// Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
		srand: function(seed) {
			this._seed = seed;
		},

		rand: function(min, max) {
			var seed = this._seed;
			min = min === undefined ? 0 : min;
			max = max === undefined ? 1 : max;
			this._seed = (seed * 9301 + 49297) % 233280;
			return min + (this._seed / 233280) * (max - min);
		},

		numbers: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 1;
			var from = cfg.from || [];
			var count = cfg.count || 8;
			var decimals = cfg.decimals || 8;
			var continuity = cfg.continuity || 1;
			var dfactor = Math.pow(10, decimals) || 0;
			var data = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = (from[i] || 0) + this.rand(min, max);
				if (this.rand() <= continuity) {
					data.push(Math.round(dfactor * value) / dfactor);
				} else {
					data.push(null);
				}
			}

			return data;
		},

		labels: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 100;
			var count = cfg.count || 8;
			var step = (max - min) / count;
			var decimals = cfg.decimals || 8;
			var dfactor = Math.pow(10, decimals) || 0;
			var prefix = cfg.prefix || '';
			var values = [];
			var i;

			for (i = min; i < max; i += step) {
				values.push(prefix + Math.round(dfactor * i) / dfactor);
			}

			return values;
		},

		months: function(config) {
			var cfg = config || {};
			var count = cfg.count || 12;
			var section = cfg.section;
			var values = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = Months[Math.ceil(i) % 12];
				values.push(value.substring(0, section));
			}

			return values;
		},

		color: function(index) {
			return COLORS[index % COLORS.length];
		},

		transparentize: function(color, opacity) {
			var alpha = opacity === undefined ? 0.5 : 1 - opacity;
			return Color(color).alpha(alpha).rgbString();
		}
	};

	// DEPRECATED
	window.randomScalingFactor = function() {
		return Math.round(Samples.utils.rand(-100, 100));
	};

	// INITIALIZATION

	Samples.utils.srand(Date.now());

	// Google Analytics
	/* eslint-disable */
	if (document.location.hostname.match(/^(www\.)?chartjs\.org$/)) {
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-28909194-3', 'auto');
		ga('send', 'pageview');
	}
	/* eslint-enable */

}(this));

var config = {
  type: 'line',
  data: {
      labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7"],
      datasets: [{
          label: "Bitcoin",
          backgroundColor: window.chartColors.yellow,
          borderColor: window.chartColors.yellow,
          data: [10, 30, 39, 20, 25, 34, 0],
          fill: false,
      }]
  },
  options: {
      responsive: true,
      title:{
          display:false
              },
      scales: {
          yAxes: [{
              ticks: {
                  // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
                  suggestedMin: 10,

                  // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
                  suggestedMax: 50
              }
          }]
      }
  }
};

window.onload = function() {
  var ctx = document.getElementById("myChart").getContext("2d");
  window.myLine = new Chart(ctx, config);
  var ctx2 = document.getElementById("myChart2").getContext("2d");
  window.myLine = new Chart(ctx2, config);
  var ctx3 = document.getElementById("myChart3").getContext("2d");
  window.myLine = new Chart(ctx3, config);
};
    </script>
</html>
