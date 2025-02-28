<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;

class CurrencyController extends Controller
{
    // public function convert(Request $request)
    // {
    //     $request->validate([
    //         'amount' => 'required|numeric',
    //         'from' => 'required|string',
    //         'to' => 'required|string',
    //     ]);

    //     $apiKey = env('EXCHANGE_RATES_API_KEY'); 
    //     $baseUrl = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/USD"; 

    //     try {

    //         $response = file_get_contents($baseUrl);
    //         $data = json_decode($response, true);



    //         // Get rates
    //         $rates = $data['conversion_rates'];

    //         // Convert amount to USD first
    //         if (!isset($rates[$request->from]) || !isset($rates[$request->to])) {
    //             return response()->json(['success' => false, 'message' => 'Invalid currency code'], 400);
    //         }

    //         $amountInUSD = $request->amount / $rates[$request->from]; // Convert from base to USD
    //         $convertedAmount = $amountInUSD * $rates[$request->to]; //  USD to another currency

    //         return response()->json([
    //             'success' => true,
    //             'convertedAmount' => round($convertedAmount, 2),
    //             'from' => $request->from,
    //             'to' => $request->to,
    //             'amount' => $request->amount
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Conversion failed: ' . $e->getMessage(),
    //         ], 400);
    //     }
    // }


    public function convert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'from' => 'required|string',
            'to' => 'required|string',
        ]);

        $apiKey = env('EXCHANGE_RATES_API_KEY');
        $data = json_decode(file_get_contents("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/USD"), true);

        return response()->json([
            'success' => isset($data['conversion_rates'][$request->from], $data['conversion_rates'][$request->to]),
            'convertedAmount' => round(($request->amount / ($data['conversion_rates'][$request->from] ?? 1)) * ($data['conversion_rates'][$request->to] ?? 1), 2),
            'from' => $request->from,
            'to' => $request->to,
            'amount' => $request->amount,
            'message' => $data['result'] === 'success' ? 'Conversion successful' : 'Invalid currency code or API error',
        ], $data['result'] === 'success' ? 200 : 400);
    }

}
