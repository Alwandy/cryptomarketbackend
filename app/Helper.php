<?php
/**
* change plain number to formatted currency
*
* @param $number
* @param $currency
*/
function formatNumber($number)
{
   return number_format($number, 2, '.', ',');
}


 function getCurrency($name){
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$name.'&tsyms=USD');
    $arrays = json_decode($request->getBody(), true);
    return view('welcome')->with('data', $arrays['RAW'][$name]['USD']);
}

 function make_comparer() {
    // Normalize criteria up front so that the comparer finds everything tidy
    $criteria = func_get_args();
    foreach ($criteria as $index => $criterion) {
        $criteria[$index] = is_array($criterion)
            ? array_pad($criterion, 3, null)
            : array($criterion, SORT_ASC, null);
    }

    return function($first, $second) use (&$criteria) {
        foreach ($criteria as $criterion) {
            // How will we compare this round?
            list($column, $sortOrder, $projection) = $criterion;
            $sortOrder = $sortOrder === SORT_DESC ? -1 : 1;

            // If a projection was defined project the values now
            if ($projection) {
                $lhs = call_user_func($projection, $first[$column]);
                $rhs = call_user_func($projection, $second[$column]);
            }
            else {
                $lhs = $first[$column];
                $rhs = $second[$column];
            }

            // Do the actual comparison; do not return if equal
            if ($lhs < $rhs) {
                return -1 * $sortOrder;
            }
            else if ($lhs > $rhs) {
                return 1 * $sortOrder;
            }
        }

        return 0; // tiebreakers exhausted, so $first == $second
    };
}


?>