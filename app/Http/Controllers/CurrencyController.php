<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class CurrencyController extends Controller
{
    public function getCurrencyList()
    
    {
    
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://www.cryptocompare.com/api/data/coinlist/');
        $arrays = json_decode($request->getBody(), true);
        usort($arrays['Data'], make_comparer('SortOrder'));
        return view('welcome')->with('currencies', $arrays['Data']);
    }

    public function getCurrencyInfo($name){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$name.'&tsyms=USD');
        $arrays = json_decode($request->getBody(), true);
       return view('currency')->with('currency', $arrays['RAW'][$name]['USD']);
    }

    
}
