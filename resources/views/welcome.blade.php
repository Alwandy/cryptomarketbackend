<?php 
setlocale(LC_MONETARY, 'en_US');
use \App\Http\Controllers\WelcomeController;
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
                <!-- TABLE STRUCTURE -->
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
                <!-- FOR EACH LOOP FOR WELCOME PAGE TO DISPLAY TOP 15 CURRENCIES -->
                @foreach($currencies as $currency)
                @if($loop->index < 15)
                  <tr>
                    <th scope="row">{{$currency['SortOrder']}}</th>
                    <td><a href="/currency/{{$currency['Name']}}">{{$currency['CoinName']}}</a></td>
                    <td>${{formatNumber((float)WelcomeController::getCurrencyInfo($currency['Name'], 'MKTCAP'))}}</td>
                    <td>${{formatNumber((float)WelcomeController::getCurrencyInfo($currency['Name'], 'PRICE'))}}</td>
                    <td>${{formatNumber((float)WelcomeController::getCurrencyInfo($currency['Name'], 'VOLUME24HOUR'))}}</td>
                    <td>${{formatNumber((float)WelcomeController::getCurrencyInfo($currency['Name'], 'SUPPLY'))}}</td>
                    <td>{{round(WelcomeController::getCurrencyInfo($currency['Name'], 'CHANGEPCT24HOUR'),2)}}%</td>
                    <td>
                        <div style="height:5%; width:70%;">
                <!-- GRAPH DRAWER -->
                        {!!WelcomeController::drawGraphs($currency['Name'])!!}
                        </div>
                    </td>
               
                  </tr>
             <!-- END -->
                  @endif
                  @endforeach
                </tbody>
              </table>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
</html>
