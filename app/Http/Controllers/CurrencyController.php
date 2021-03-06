<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class CurrencyController extends Controller
{


    public function getCurrencyInfo($name){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$name.'&tsyms=USD');
        $arrays = json_decode($request->getBody(), true);
       return view('currency')->with('currency', $arrays['RAW'][$name]['USD']);
    }

     /**
     * DRAW THE GRAPH
     * @return $chartjs->render();
     * DOCUMENTATION: https://github.com/fxcosta/laravel-chartjs
     */
    public static function drawGraphs($name){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://min-api.cryptocompare.com/data/histoday?fsym='.$name.'&tsym=USD&limit=7&aggregate=0&e=CCCAGG');
        $arrays = json_decode($request->getBody(), true);
        $chartjs = app()->chartjs
        ->name($name)
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', ' Day 7'])
        ->datasets([
            [
                "label" => "USD",
                'backgroundColor' => "transparent",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$arrays['Data'][1]['close'],$arrays['Data'][2]['close'],$arrays['Data'][3]['close'],$arrays['Data'][4]['close'],$arrays['Data'][5]['close'],$arrays['Data'][6]['close'],$arrays['Data'][7]['close']],
            ]
        ])
        ->options([]);
        return $chartjs->render();
    }

    
}
